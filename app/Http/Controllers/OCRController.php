<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Employer;
use App\Models\Name;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\Skill;
use App\Models\University;
use App\Models\User;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
// use Spatie\PdfToText\Pdf;
use Smalot\PdfParser\Parser;
use Web64\LaravelNlp\Facades\NLP;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use Softon\LaravelFaceDetect\Facades\FaceDetect;
use NlpTools\Stemmers\PorterStemmer;
use NlpTools\Documents\TokensDocument;
use Illuminate\Support\Facades\Validator;


class OCRController extends Controller
{
    const MIN_NAME_LENGTH = 6;


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function ResumeOCR(){
      // $user = User::findOrFail(Auth::user()->id);

      // return view('resume.resume-builder')->with(compact('user'));
      return view('ocr.resume-ocr');
    } 

    // public function textToPdfPost(Request $req){
    //   dd($req->all());
    // }






    public function profile(){

        return view('home.profile');
    }

    public function ResumeOCRPost(Request $request){

      // dd($request->all());
      $validator = Validator::make($request->all(), [
        'file' => 'mimes:pdf',
      ]);

      if ($validator->fails()) {
          return redirect('resume-ocr')
                      ->withErrors($validator)
                      ->withInput();
      } else {

        // dd($request->all());

        $this->emptyDirs();

        if($request->has('file')){

          // dd('iff');
            $file = $request->file('file');
            $ext  = $file->getClientOriginalExtension();

            $hash = md5(time());
            $file->storeAs('public/cv', $hash.'.'.$ext);

            // dd($file);
            if(in_array(strtolower($ext), ['doc', 'docx', 'rtf'])) {
                $doc = storage_path() . "/app/public/cv/" . $hash . "." . $ext;
                $cmd = env('PATH_UNOCONV') . ' -f pdf ' . $doc;
                exec($cmd, $output, $return);
            }

            $pdf  = storage_path() . "/app/public/cv/" . $hash . ".pdf";
            // dd($pdf);

            $user = $this->getData($pdf, $hash);

            // dd($user);



            $data = array(
                'resume_url' => 'https://proztec.datumcrm.com/cvs/Resume.pdf'
            );
            
            $apiUrl = "https://api.superparser.com/url"; // Update with your API endpoint
            $apiKey = "xJ7VPvFPER8iOUhRGdVXUwzZKYu6QXg9b0HpUHOi"; // Replace with your API key

            $data = array(
                'resume_url' => 'https://recruitlycdn.com/samplecvs/16.docx'
            );
            
            $curl = curl_init();
            
            // Build a query string with form parameters
            $formData = http_build_query($data);
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded", // Set the content type to form-urlencoded
                    "X-API-Key: $apiKey"
                ),
                CURLOPT_POSTFIELDS => $formData, // Send data as form parameters
                CURLOPT_CUSTOMREQUEST => "POST" // Use POST method
            ));
            
            $response = curl_exec($curl);
            
            if (curl_errno($curl)) {
                // echo "Error: " . curl_error($curl);
            } else {
                // echo "Response: $response";
            }
            
            curl_close($curl);
            // echo "<pre>";
            // print_r($response);
            // exit;
            
            // return redirect()->route('text-to-pdf')->with('user', $user);
            $request->session()->flash('successMsg', 'At times, AI may face challenges in extracting all essential information from your resume. Kindly provide the missing details in the preview below to ensure accuracy.');
            return view('ocr.resume-ocr')->with(compact('user'));
        }
        // dd('else');
        if($request->first_name){
          $request->session()->flash('successMsg', 'Resume has been updated successfully.');
        }
        return redirect()->route('resume-ocr');

      }
    }

    public function ResumeOCRUpdate(Request $request){
      $request->session()->flash('successMsg', 'Resume has been updated successfully.');
      return view('ocr.resume-ocr');

      // flash(__('You have updated your profile successfully'))->success();
      // return \Redirect::route('my.profile');
    }

    public function getData($pdf, $hash){

        $parser = new Parser();
        $pdf = $parser->parseFile($pdf);

        // $metaData = $pdf->getDetails();
        // dd($metaData);

        $text = $pdf->getText();

        // dd($text);
        // dd($this->parseEducationSegment($text));

        // dd($this->educationSegments($text));

        // $details_info = [
        //   'name' => $this->getName($text),
        //   'phone' => $this->getPhone($text),
        //   'email' => $this->getEmail($text),
        //   'education' => $this->parseEducationSegment($text),
        //   'experience' => $this->parseExperienceSegment($text)
        // ];
        $details_info = [
          'name' => $this->getName($text),
          'phone' => $this->getPhone($text),
          'email' => $this->getEmail($text),
          // 'education' => $this->parseEducationSegment($text),
          'education' => $this->educationSegments($text),
          'experience' => $this->expreriencesSegments($text)
        ];


        // dd($details_info);
        return $details_info;

        exit();
        /* ******** */
        $user = new User();

        $user->fullname    = $this->getName($text);
        $user->email       = $this->getEmail($text);
        $user->phone       = $this->getPhone($text);
        $user->nationality = $this->getNationality($text);
        $user->birthday    = $this->getBirthday($text);
        $user->gender      = $this->getGender($text);
        $user->linkedin    = $this->getLinkedInProfile($text);
        $user->github      = $this->getGithubProfile($text);
        $user->skills      = $this->getSkills($text);
        $user->languages   = $this->getLanguages($text);
        $user->image       = $this->getProfilePicture($pdf, $hash);



        //dd($this->getEducationSegment($text));
        //dd($this->parseExperienceSegment($text));

        $user->education   = $this->parseEducationSegment($textLayout);
        $user->experience  = $this->parseExperienceSegment($textLayout);

        //dd($user);

        return $user;
    }

    public function emptyDirs(){

        $dirs = ['cv', 'images', 'tmp'];

        foreach ($dirs as $dir){

            $dir = storage_path() . '/app/public/'.$dir;

            $files = glob($dir . '/*');
            foreach ($files as $file) {
                if (is_file($file))
                    @unlink($file);
            }
        }
    }

    public function getLines($text){

        return array_values(array_filter(explode("\n", $text)));
    }

    public function getTokens($text, $type = 'whitespace'){

        if($type == 'whitespaceAndPunctuation'){

            $tok = new WhitespaceAndPunctuationTokenizer();

        } else {

            $tok = new WhitespaceTokenizer();
        }

        $tokens = [];

        $lines = $this->getLines($text);

        foreach ($lines as $line) {

            $lineTokens = $tok->tokenize($line);

            foreach ($lineTokens as $token){
                $tokens[] = $token;
            }
        }

        return $tokens;
    }

    public function getText($text){

        return implode(" ", $this->getTokens($text));
    }

    public function nGrams($text, $n = 3){

        $tokens = $this->getTokens($text, 'whitespaceAndPunctuation');

        $len   = count($tokens);
        $ngram = [];

        for($i = 0; $i+$n <= $len; $i++){
            $string = "";
            for($j = 0; $j < $n; $j++){
                $string .= " ". $tokens[$j+$i];
            }
            $ngram[$i] = $string;
        }
        return $ngram;

    }

    public function getName($text){

        $userSegment = $this->getUserSegment($text);

        // dd($userSegment);

        // $names = Name::getNames();
        // // $names = ['abc', 'began'];
        // $names = ['Ali', 'Sheerazi'];

        $tok = new WhitespaceAndPunctuationTokenizer();
        
        
        foreach($userSegment as $line){

          // dd($line);

          // $words = explode(" ", $line);
          // $firstWord = $words[0];
          // $lastWord = end($words);


          return $line;
            // $lineTokens = $tok->tokenize($line);
            // foreach ($lineTokens as $token){
            //     if(strlen($token) > 2) {
            //         if (in_array(ucfirst(strtolower($token)), $names)) {
            //             if (mb_strlen($line) > self::MIN_NAME_LENGTH) {
            //                 return $this->normalizeName($line);
            //             }
            //         }
            //     }
            // }
        }

        // dd($lineTokens);
        // foreach ($userSegment as $line){

        //     $entities = NLP::spacy_entities( $line, 'en' );

        //     if(!empty($entities)){
        //         if(isset($entities['PERSON'])){
        //             if(mb_strlen($line) > self::MIN_NAME_LENGTH) {
        //                 return $this->normalizeName($line);
        //             }
        //         }
        //     }
        // }

        // dd('okdd');

        return null;
    }

    public function getNationality($text){

        $userSegment = $this->getUserSegment($text);

        //dd($userSegment);

        $nationalities = Nationality::getNationalities();

        dd($nationalities);

        $tok = new WhitespaceAndPunctuationTokenizer();

        foreach($userSegment as $line){

            $lineTokens = $tok->tokenize($line);

            foreach ($lineTokens as $token){
                if(strlen($token) > 3) {
                    if (in_array(ucfirst(strtolower($token)), $nationalities)) {
                        return $token;
                    }
                }
            }
        }
        return null;
    }

    public function getBirthday($text){

        $pattern = '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})|([0-9]{2})\.([0-9]{2})\.([0-9]{4})/i';

        $userSegment = $this->getUserSegment($text);

        //dd($userSegment);

        foreach ($userSegment as $line){

            preg_match_all($pattern, $line,$matches);

            if(count($matches) > 0){

                if(isset($matches[0][0])){
                    return $this->normalizeBirthDay($matches[0][0]);
                }
            }
        }

        return null;
    }

    public function getGender($text){

        $tok = new WhitespaceAndPunctuationTokenizer();

        $userSegment = $this->getUserSegment($text);

        foreach($userSegment as $line){

            $lineTokens = $tok->tokenize($line);

            foreach ($lineTokens as $token){
                if(in_array(strtolower($token), ['male', 'female'])){
                    return ucfirst($token);
                }
            }
        }

        return null;
    }

    public function getEmail($text){

        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';

        preg_match_all($pattern, $text,$matches);

        if(count($matches) > 0){

            if(isset($matches[0][0])){
                return $matches[0][0];
            }
        }

        return null;
    }

    public function getPhone($text){

        $pattern = "/\d{9,}/i";

        $text = str_replace(array(" ", "-", "(", ")", "/"), array("", "", "", "", ""), $text);

        preg_match_all($pattern, $text,$matches);

        if(count($matches) > 0){
            if(isset($matches[0][0])){
                return $matches[0][0];
            }
        }

        return null;
    }

    public function getProfilePicture($pdf, $hash){

        $tmp = storage_path() . '/app/public/tmp';

        $cmd = env('PATH_PDFIMAGES') . ' -all -f 1 ' . $pdf . ' ' . $tmp . '/prefix';
        exec($cmd);

        $images = array_diff(preg_grep('~\.(jpeg|jpg|png)$~', scandir($tmp)), array('.', '..', '.DS_Store'));
        $images = array_slice($images, 0, 3, true);

        foreach ($images as $image) {

            $imageInfo = getimagesize($tmp . '/' . $image);

            $width  = $imageInfo[0];
            $height = $imageInfo[1];

            if ($height > 50) {

                if ($width > 200) {

                    $img = Image::make($tmp . '/' . $image);
                    $img->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($tmp . '/' . $image);
                }

                $ext = File::extension($tmp . '/' . $image);

                if ($ext == 'png' || $ext == 'jpeg') {
                    $newImage = str_replace('png', 'jpg', $image);
                    $newImage = str_replace('jpeg', 'jpg', $newImage);

                    $img = Image::make($tmp . '/' . $image)->encode('jpg', 75);
                    $img->save($tmp . '/' . $newImage);
                    $image = $newImage;
                }

                $isFace = FaceDetect::extract($tmp . '/' . $image)->face_found;

                if ($isFace) {
                    $imageDir = storage_path() . "/app/public/images/".$hash . ".jpg";
                    FaceDetect::extract($tmp . '/' . $image)->save($imageDir);
                    break;
                }
            }
        }

        return (isset($imageDir))? $hash . ".jpg" : null;
    }

    public function getSkills($text){

        $allSkills = Skill::getSkills();

        $skills = [];

        $text = $this->getText($text);

        foreach ($allSkills as $skill){

            if(HelperController::isWordInText($skill, $text)){

                $skills[] = $skill;
            }
        }

        return $skills;
    }

    public function getLanguages($text){

        $allLanguages = Skill::getLanguages();

        $languages = [];

        $text = $this->getText($text);

        foreach ($allLanguages as $language){

            if(HelperController::isWordInText($language, $text)){

                $languages[] = $language;
            }
        }

        return $languages;
    }

    public function getLinkedInProfile($text){

        $needle = "linkedin.com";

        $tokens = $this->getTokens($text);

        foreach($tokens as $token){

            $pos = strpos(strtolower($token), $needle);

            if ($pos > - 1) {
                return $token;
            }
        }

        return "";
    }

    public function getGithubProfile($text){

        $needle = "github.com";

        $tokens = $this->getTokens($text);

        foreach($tokens as $token){

            $pos = strpos(strtolower($token), $needle);

            if ($pos > - 1) {
                return $token;
            }
        }

        return "";
    }


    /* SEGMENTS */

    public function getEducationSegmentKeywords(){

        return config('segments.education');
    }

    public function getDegreeSegmentKeywords(){

        return config('segments.degree');
    }

    public function getExperienceSegmentKeywords(){

        return config('segments.experience');
    }

    public function getSkillSegmentKeywords(){

        return config('segments.skill');
    }

    public function getProjectSegmentKeywords(){

        return config('segments.project');
    }

    public function getAccomplishmentSegmentKeywords(){

        return config('segments.accomplishment');
    }

    public function searchKeywordsInText($keywords, $text){

      if($keywords){
        foreach ($keywords as $keyword){
            if(HelperController::isWordInText($keyword, $text)){
                return true;
            }
        }
      }
        return false;
    }

    public function getUserSegment($text){

        $segment = [];

        $lines = $this->getLines($text);

        $educationKeywords      = $this->getEducationSegmentKeywords();
        $degreeKeywords         = $this->getDegreeSegmentKeywords();
        $projectKeywords        = $this->getProjectSegmentKeywords();
        $skillKeywords          = $this->getSkillSegmentKeywords();
        $accomplishmentKeywords = $this->getAccomplishmentSegmentKeywords();
        $experienceKeywords     = $this->getExperienceSegmentKeywords();

        foreach ($lines as $line){

            if(!$this->searchKeywordsInText($educationKeywords, $line) &&
                !$this->searchKeywordsInText($degreeKeywords, $line) &&
                !$this->searchKeywordsInText($projectKeywords, $line) &&
                !$this->searchKeywordsInText($skillKeywords, $line) &&
                !$this->searchKeywordsInText($accomplishmentKeywords, $line) &&
                !$this->searchKeywordsInText($experienceKeywords, $line)
              ){
                $segment[] = $line;
            } else {
                break;
            }
        }

        return $segment;
    }

    public function getEducationSegment($text){

        $segment = [];

        $lines = $this->getLines($text);

        $educationKeywords      = $this->getEducationSegmentKeywords();
        $projectKeywords        = $this->getProjectSegmentKeywords();
        $skillKeywords          = $this->getSkillSegmentKeywords();
        $accomplishmentKeywords = $this->getAccomplishmentSegmentKeywords();
        $experienceKeywords     = $this->getExperienceSegmentKeywords();

        $i = 0;
        foreach ($lines as $line){

            $i++;
            $flag = false;

            if($this->searchKeywordsInText($educationKeywords, $line)){

                $segment[] = $line;
                //$i++;
                $flag = true;

                while ($i < count($lines)){

                    $row = $lines[$i];

                    if(
                        //!$this->searchKeywordsInText($projectKeywords, $row) &&
                        !$this->searchKeywordsInText($skillKeywords, $row) &&
                        !$this->searchKeywordsInText($accomplishmentKeywords, $row) &&
                        !$this->searchKeywordsInText($experienceKeywords, $row)
                    ){
                        $segment[] = $row;
                    } else {
                        break;
                    }
                    $i++;
                }
            }

            if($flag) {
                break;
            }
        }
        return $segment;
    }

    public function getExperienceSegment($text){

        $segment = [];

        $lines = $this->getLines($text);

        //dd($lines);

        $educationKeywords      = $this->getEducationSegmentKeywords();
        $degreeKeywords         = $this->getDegreeSegmentKeywords();
        //$projectKeywords        = $this->getProjectSegmentKeywords();
        $skillKeywords          = $this->getSkillSegmentKeywords();
        $accomplishmentKeywords = $this->getAccomplishmentSegmentKeywords();
        $experienceKeywords     = $this->getExperienceSegmentKeywords();

        $i = 0;
        foreach ($lines as $line){

            $i++;
            $flag = false;

            if($this->searchKeywordsInText($experienceKeywords, $line)){

                $segment[] = $line;
                //$i++;
                $flag = true;

                while ($i < count($lines)){

                    $row = $lines[$i];

                    if(
                        //!$this->searchKeywordsInText($projectKeywords, $row) &&
                        !$this->searchKeywordsInText($skillKeywords, $row) &&
                        !$this->searchKeywordsInText($accomplishmentKeywords, $row) &&
                        !$this->searchKeywordsInText($educationKeywords, $row) &&
                        !$this->searchKeywordsInText($degreeKeywords, $row)
                    ){
                        $segment[] = $row;
//                        echo $row;
//                        echo "<br>";
                    } else {
                        break;
                    }
                    $i++;
                }
            }

            if($flag) {
                break;
            }
        }
        return $segment;
    }

    public function parseEducationSegment($text){

        $datesFound   = [];
        $degreesFound = [];
        $schoolsFound = [];

        $education = [];

        $educationSegment = $this->getEducationSegment($text);

        // dd($educationSegment);
        return $educationSegment;
        exit();

        $pattern      = $this->dateRegex();
        // $degrees      = Degree::getDegrees();
        // $degreesAssoc = Degree::getDegreesАssoc();
        // $universities = University::getUniversities();
        
        $datesSegments = [];
        $i = 0;
        

        foreach ($educationSegment as $line){

            $datesSegments[$i][] = $line;

            preg_match_all($pattern, $line,$matches);

            
            if(count($matches) > 0){

                if(isset($matches[0][0])){
                    $datesFound[] = $matches[0][0];

                    $i++;
                    $datesSegments[$i][] = $line;

                    array_pop($datesSegments[$i-1]);
                }
            }

        }

        array_shift($datesSegments);

        for($i = 0; $i < count($datesSegments); $i++){

            $flag = false;

            for($j = 0; $j < count($datesSegments[$i]); $j++){

                // foreach ($degrees as $degree) {

                //     if(strpos(ucwords($datesSegments[$i][$j]), $degree) > - 1){
                //         $degreesFound[] = $degree;
                //         $flag = true;
                //         break;
                //     }
                // }

                if($flag) break;
            }

            if(!$flag) {
                $degreesFound[] = '';
            }
        }

        //dd($datesSegments);

        for($i = 0; $i < count($datesSegments); $i++){

            $flag = false;

            for($j = 0; $j < count($datesSegments[$i]); $j++) {

                //var_dump(preg_replace("/(?![.=$'€%-])\p{P}/u", "", $datesSegments[$i][$j]));

                // foreach ($universities as $university) {

                //     if (strpos(preg_replace("/(?![.=$'€%-])\p{P}/u", "", strtolower($datesSegments[$i][$j])), str_replace('"', '', strtolower($university))) > -1) {
                //         $schoolsFound[] = $university;
                //         $flag = true;
                //         break;
                //     }
                // }
            }

            if(!$flag) {

                for ($j = 0; $j < count($datesSegments[$i]); $j++) {

                    $entities = NLP::spacy_entities($datesSegments[$i][$j]);

                    if (!empty($entities)) {
                        //dd($entities);
                        if (isset($entities['ORG'])) {
                            $schoolsFound[] = $entities['ORG'][0];
                            $flag = true;
                            break;
                        }
                    }
                }
            }


            if(!$flag) {
                $schoolsFound[] = '';
            }
        }

        //exit;
        //dd($datesSegments);
        //dd($datesFound);
        //dd($degreesFound);
        //var_dump($datesFound);
        //var_dump($degreesFound);
        //exit;

        $i = 0;
        foreach ($datesFound as $date){

            $education[$i]['date']        = $date;
            $education[$i]['degree']      = (isset($degreesFound[$i]) && isset($degreesAssoc[$degreesFound[$i]])) ? $degreesAssoc[$degreesFound[$i]] : '';
            $education[$i]['university']  = isset($schoolsFound[$i])? $schoolsFound[$i] : '';;

            $i++;
        }

        return $education;
    }

    public function parseExperienceSegment($text){

        $datesFound     = [];
        $positionsFound = [];
        $employersFound = [];


        // $positions = Position::getPositions();
        // $employers = Employer::getEmployers();
        //dd($employers);

        $experience = [];

        $experienceSegment = $this->getExperienceSegment($text);
        // dd($experienceSegment);
        return $experienceSegment;
        exit();


        $pattern = $this->dateRegex();

        
        $datesSegments = [];
        $i = 0;


        foreach ($experienceSegment as $line){

            $datesSegments[$i][] = $line;

            preg_match_all($pattern, $line,$matches);

            if(count($matches) > 0){

                if(isset($matches[0][0])){
                    $datesFound[] = $matches[0][0];

                    $i++;
                    $datesSegments[$i][] = $line;

                    array_pop($datesSegments[$i-1]);
                }
            }
        }

        array_shift($datesSegments);

        return $datesSegments;
        exit();
        for($i = 0; $i < count($datesSegments); $i++){

            $flag = false;

            for($j = 0; $j < count($datesSegments[$i]); $j++){

                // foreach ($positions as $position) {

                //     if(strpos(ucwords($datesSegments[$i][$j]), $position) > -1){
                //         $positionsFound[] = $position;
                //         $flag = true;
                //         break;
                //     }
                // }

                if($flag) {
                    break;
                }
            }

            if(!$flag) {
                $positionsFound[] = '';
            }
        }

        $companyKeywords = ["name of employer", "company", "employer", 'organization'];
        $replace = ['', '', '', ''];

        for($i = 0; $i < count($datesSegments); $i++){

            $flag = false;

            for($j = 0; $j < count($datesSegments[$i]); $j++) {

                //echo $datesSegments[$i][$j];
                //echo "<br>";
                foreach($companyKeywords as $comopanyKeyword) {

                    if (strpos(strtolower($datesSegments[$i][$j]), $comopanyKeyword) > -1) {
                        $employersFound[] = preg_replace("/(?![.=$'€%-])\p{P}/u", "", ucwords(trim(str_replace($companyKeywords, $replace, strtolower($datesSegments[$i][$j])))));

                        $flag = true;
                        break;
                    }
                }
                if($flag) break;
            }

            if(!$flag) {

                for ($j = 0; $j < count($datesSegments[$i]); $j++) {

                    if ($flag) {
                        break;
                    } else {

                        $entities = NLP::spacy_entities($datesSegments[$i][$j], 'en');

                        if (!empty($entities)) {

                            //var_dump($entities);

                            if (isset($entities['ORG'])) {
                                $employersFound[] = $entities['ORG'][0];
                                $flag = true;
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        break;
                    } else {

                        // foreach ($employers as $employer) {

                        //     if (strpos(strtolower($datesSegments[$i][$j]), strtolower(trim($employer))) > -1) {
                        //         $employersFound[] = $employer;
                        //         $flag = true;
                        //         break;
                        //     }
                        // }
                    }
                }
            }

            if(!$flag) {
                $employersFound[] = '';
            }
        }

        //exit;
        //dd($datesSegments);
        //dd($positionsFound);
        //dd($dates);

        $i = 0;
        foreach ($datesFound as $date){

            // $experience[$i]['date']     = $date;
            $experience[$i]['position'] = isset($positionsFound[$i])? $positionsFound[$i] : '';
            $experience[$i]['company']  = isset($employersFound[$i])? $employersFound[$i] : '';

            $i++;
        }


        return $experience;
    }

    /* NORMALIZE */

    public function normalizeName($name){

        $search  = ['Name', ':'];
        $replace = ['', ''];

        $name = str_replace($search, $replace, $name);

        return ucwords(strtolower($name));
    }

    public function normalizeBirthDay($birthday){

        $birthday = str_replace(['/'], ['.'], $birthday);

        return Carbon::parse($birthday)->format('d.m.Y');
    }

    public function normalizePosition($name){

        return ucwords(strtolower($name));
    }

    public function dateRegex(){

        $patterns = [];

        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s–\-\—]+(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sept(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s–\-\—]+(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sept(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s­]+(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s­]+(till now)';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s–\-]+(till now)';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s–\-]+(now)';
        $patterns[] = '(Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)\s+(\d{4})[\s–\-]+(ongoing)';
        $patterns[] = '([0-9]{2})\/([0-9]{2})\/([0-9]{4})[\s–\-]+([0-9]{2})\/([0-9]{2})\/([0-9]{4})';
        $patterns[] = '([0-9]{2})\.([0-9]{2})\.([0-9]{4})[\s–\-]+([0-9]{2})\.([0-9]{2})\.([0-9]{4})';
        $patterns[] = '([0-9]{2})\/([0-9]{4})[\s–\-]+([0-9]{2})\/([0-9]{4})';
        $patterns[] = '([0-9]{2})\.([0-9]{4})[\s–\-]+([0-9]{2})\.([0-9]{4})';
        $patterns[] = '([0-9]{2})\/([0-9]{4})[\s–\-]+(present)';
        $patterns[] = '([0-9]{2})\.([0-9]{4})[\s–\-]+(present)';
        $patterns[] = '([0-9]{2})\/([0-9]{4})[\s–\-]+(now)';
        $patterns[] = '([0-9]{2})\/([0-9]{4})[\s–\-]+(till now)';
        $patterns[] = '([0-9]{2})\.([0-9]{4})[\s–\-]+(till now)';
        $patterns[] = '([0-9]{2})\/([0-9]{4})[\s–\-]+(till today)';
        $patterns[] = '([0-9]{2})\.([0-9]{4})[\s–\-]+(till today)';
        $patterns[] = '([0-9]{4})[\s–\-]+([0-9]{4})';
        $patterns[] = '([0-9]{4})[\s–\—]+([0-9]{4})';
        $patterns[] = '([0-9]{4}) to ([0-9]{4})';
        $patterns[] = '([0-9]{4})[\s–\-]+(present)';
        $patterns[] = '([0-9]{4})[\s–\-]+(till now)';
        $patterns[] = '([0-9]{4})[\s–\-]+(until now)';
        $patterns[] = '([0-9]{4})[\s–\-]+(till today)';
        $patterns[] = '([0-9]{4})[\s–\-]+(still)';
        $patterns[] = '([0-9]{4})[\s–\-]+(ongoing)';

        $patterns[] = '([0-9]{2})\.[\s]([0-9]{4})[\s–\-]+([0-9]{2})\.[\s]([0-9]{4})';
        $patterns[] = '([0-9]{2})\/([0-9]{2})\/([0-9]{4})[ to ]+([0-9]{2})\/([0-9]{2})\/([0-9]{4})';
        $patterns[] = '([0-9]{1})\/([0-9]{2})\/([0-9]{4})[\s]+(to now)';
        //$patterns[] = '([0-9]{4})';

        $pattern = '/'. implode('|', $patterns) .'/i';

        return $pattern;
    }

    public function expreriencesSegments($text){
        // Define an array to store extracted work experience entries
    $workExperience = [];

    // Split the text into lines
    $lines = explode("\n", $text);

    // Initialize variables to store information
    $startDate = '';
    $endDate = '';
    $companyName = '';
    $jobTitle = '';
    $description = '';
    $inExperienceSection = false;

    // Regular expression pattern to match dates in various formats
    $date_pattern = '/\d{1,2}\s+\w+\,\s+\d{4}/';

    // Iterate through each line
    foreach ($lines as $line) {
        // Check if the line contains the "From" keyword to identify the start of an experience entry
        if (strpos($line, "From ") === 0) {
            // If we were already in an experience section, save the previous entry
            if ($inExperienceSection) {
                $workExperience[] = [
                    'startDate' => date('Y-n-d', strtotime($startDate)),
                    'endDate' => date('Y-n-d', strtotime($endDate)),
                    'companyName' => $companyName,
                    'jobTitle' => $jobTitle,
                    'description' => $description,
                ];
            }

            // Reset variables for the new entry
            $inExperienceSection = true;
            $date_matches = [];
            preg_match_all($date_pattern, $line, $date_matches);

            if (count($date_matches[0]) == 2) {
                // If we have two date-like strings, assume the first is start date and the second is end date
                $startDate = trim($date_matches[0][0]);
                $endDate = trim($date_matches[0][1]);
            } else {
                // Otherwise, assume a single date-like string as start date
                $startDate = trim($date_matches[0][0]);
                $endDate = ''; // No end date specified
            }

            $companyName = '';
            $jobTitle = '';
            $description = ''; // Initialize the description field
        } elseif ($inExperienceSection) {
            // If we are inside an experience section, extract company name, job title, and description
            if (empty($companyName)) {
                $companyName = trim($line);
            } elseif (empty($jobTitle)) {
                $jobTitle = trim($line);
            } else {
                // Append the line to the description
                $description .= $line . "\n";
            }
        }
    }

    // After the loop, add the last entry if it exists
    if ($inExperienceSection) {
        $workExperience[] = [
            'startDate' => date('Y-m-d', strtotime($startDate)),
            'endDate' => date('Y-m-d', strtotime($endDate)),
            'companyName' => $companyName,
            'jobTitle' => $jobTitle,
            'description' => $description
        ];
    }

    return $workExperience;
       
    }

    public function educationSegments($text){
      $educationSegment = $this->parseEducationSegment($text);

      $EduDates = [];

      // $pattern = $this->dateRegex();

      $pattern = '/\b(?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?|[0-9]{4}|present|till\s+now|till\s+today|ongoing)\b/i';
      
      foreach ($educationSegment as $string) {
          preg_match_all($pattern, $string, $matches);
          $EduDates = array_merge($EduDates, $matches[0]);
      }

      $education_meta = [
        'edu_title' => $educationSegment,
        'edu_dates' => $EduDates
      ];
      // excluded months
      // $excludedMonths = [
      //     'Jan', 'January', 'Feb', 'February', 'Mar', 'March', 'Apr', 'April', 'May', 'Jun', 'June', 
      //     'Jul', 'July', 'Aug', 'August', 'Sep', 'September', 'Oct', 'October', 'Nov', 'November', 'Dec', 'December'
      // ];
      // $pattern = '/\b(?!(?:\d+|' . implode('|', $excludedMonths) . ')\b)\w+\b/i';
      // $matches = [];
      // foreach ($educationSegment as $string) {
      //   if (preg_match_all($pattern, $string, $match)) {
      //       $matches[] = $match[0];
      //   }
      // }
      // dd($matches);

      return $education_meta;
    }

}

