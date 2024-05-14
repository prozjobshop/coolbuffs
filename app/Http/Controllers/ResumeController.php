<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

use HTMLPurifier;

class ResumeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function resumeBuilder(){

        $user = User::findOrFail(Auth::user()->id);

        return view('resume.resume-builder')->with(compact('user'));
    }

    public function viewResume(){

        $user = User::findOrFail(Auth::user()->id);

        // Eloquent
        $user_id = Auth::user()->only(['first_name', 'last_name', 'email', 'date_of_birth', 'phone']);

        // Query Builder
        $user_id = DB::table('users as u')
            // ->join('profile_experiences as pe', 'u.id', '=', 'pe.user_id', 'left')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                )
            ->where('u.id', Auth::user()->id)->first();

        $user_experience = DB::table('profile_experiences as pe')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->select('pe.*', 'c.city as city_name')
                            ->where('user_id', $user->id)
                            ->get();

        $user_meta = DB::table('users as u')
            ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
            ->join('cities as c', 'u.city_id', '=', 'c.id')
            ->join('countries as cc', 'u.country_id', '=', 'cc.id')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                'c.city',
                'cc.country',
                'cl.career_level'
                )
            ->where('u.id', Auth::user()->id)->first();


        $user_skills = DB::table('profile_skills as ps')
                            ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                            ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                            ->select('ps.id', 'js.job_skill', 'je.job_experience')
                            ->where('user_id', $user->id)
                            ->get();

        $user_educations = DB::table('profile_educations as pe')
                            ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                            ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                            ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                            ->select(
                                'pe.*',
                                'dl.degree_level',
                                'dt.degree_type',
                                'c.city',
                                'ms.major_subject'
                                )
                            ->where('user_id', $user->id)
                            ->get();
        // dd($user_meta);
        return view('resume.view-resume')->with(compact('user', 'user_experience', 'user_educations', 'user_meta', 'user_skills'));
    }

    public function viewResumeRef($ref_id){

        $user = User::findOrFail(Auth::user()->id);

        // dd($user->printUserImage());
        

        $user_meta = DB::table('users as u')
            ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
            ->join('cities as c', 'u.city_id', '=', 'c.id')
            ->join('countries as cc', 'u.country_id', '=', 'cc.id')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                'c.city',
                'cc.country',
                'cl.career_level'
                )
            ->where('u.id', Auth::user()->id)->first();


        $user_experience = DB::table('profile_experiences as pe')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->select('pe.*', 'c.city as city_name')
                            ->where('user_id', $user->id)
                            ->get();

        $user_educations = DB::table('profile_educations as pe')
                            ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                            ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                            ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                            ->select(
                                'pe.*',
                                'dl.degree_level',
                                'dt.degree_type',
                                'c.city',
                                'ms.major_subject'
                                )
                            ->where('user_id', $user->id)
                            ->get();

        $user_skills = DB::table('profile_skills as ps')
                            ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                            ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                            ->select('ps.id', 'js.job_skill', 'je.job_experience')
                            ->where('user_id', $user->id)
                            ->get();
        // dd($user);
        
        // load selected template blade file
        $view_resume = '';
        if($ref_id === 'temp-1'){
            $view_resume = 'resume.view-resume';
        }else if($ref_id === 'temp-2'){
            $view_resume = 'resume.view-resume-temp-2';
        }else if($ref_id === 'temp-3'){
            $view_resume = 'resume.view-resume-temp-3';
        }else{
            $view_resume = 'resume.resume-builder';
        }


        // update resume exist & resume template only when temp-* file is selected
        if($ref_id === 'temp-1' || $ref_id === 'temp-2' || $ref_id === 'temp-3'){
            // update for resume exist
            $is_resume_update = User::where('id', Auth::user()->id)->update(['is_resume' => '1']);

            // update resume template
            $resume_temp = User::where('id', Auth::user()->id)->update(['resume_temp' => $ref_id]);
        }

        return view($view_resume)->with(compact('user', 'user_meta', 'user_experience', 'user_educations', 'user_skills'));

    }

    // public function viewResumeTemp2(){
    //     return view('resume.view-resume-temp-2');
    // }
    // public function viewResumeTemp3(){
    //     return view('resume.view-resume-temp-3');
    // }

    // public function resumePDF(){
    //     $data = [
    //     'foo' => 'bar'
    //     ];

    //     // $pdf = PDF::loadView('resume.document', compact( 'data'));
    //     // // return $pdf->download('Invoice#.pdf');
    //     // return $pdf->stream('document.pdf');

    //     $html = '';
        
    //     $view = view('resume.document')->with(compact('data'));
    //     $html .= $view->render();
    //     // }
    //     $pdf = PDF::loadHTML($html,[
    //       'format'                => 'A4',
    //       'margin_left'           => 10,
    //       'margin_right'          => 10,
    //       'margin_top'            => 10,
    //       'margin_bottom'         => 10,
    //       'margin_header'         => 0,
    //       'margin_footer'         => 0,
    //     ]);

    //     return $pdf->stream('Resume.pdf');
    // }

    public function downloadResume(Request $req){
       $user = User::leftJoin('countries', 'users.country_id', '=', 'countries.id')
        ->leftJoin('states', 'users.state_id', '=', 'states.id')
        ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
        ->leftJoin('marital_statuses', 'users.marital_status_id', '=', 'marital_statuses.id')
        ->leftJoin('industries', 'users.industry_id', '=', 'industries.id')
        ->leftJoin('genders', 'users.gender_id', '=', 'genders.id')
        ->leftJoin('functional_areas', 'users.functional_area_id', '=', 'functional_areas.id')
        ->leftJoin('job_experiences', 'users.job_experience_id', '=', 'job_experiences.id')
        ->leftJoin('countries as nationality', 'users.nationality_id', '=', 'nationality.id')
        ->select('users.*', 'countries.country', 'states.state', 'cities.city', 'marital_statuses.marital_status', 'industries.industry', 'genders.gender', 'functional_areas.functional_area', 'job_experiences.job_experience', 'nationality.country as nationality')
        ->findOrFail(Auth::user()->id);
      // dd($user);
        $user_meta = DB::table('users as u')
            ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
            ->join('cities as c', 'u.city_id', '=', 'c.id')
            ->join('countries as cc', 'u.country_id', '=', 'cc.id')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                'c.city',
                'cc.country',
                'cl.career_level'
                )
            ->where('u.id', Auth::user()->id)->first();
        $user_experience = DB::table('profile_experiences as pe')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->select('pe.*', 'c.city as city_name')
                            ->where('user_id', $user->id)
                            ->get();

        $user_educations = DB::table('profile_educations as pe')
                            ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                            ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                            ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                            ->select(
                                'pe.*',
                                'dl.degree_level',
                                'dt.degree_type',
                                'c.city',
                                'ms.major_subject'
                                )
                            ->where('user_id', $user->id)
                            ->get();

        $user_skills = DB::table('profile_skills as ps')
                            ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                            ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                            ->select('ps.id', 'js.job_skill', 'je.job_experience')
                            ->where('user_id', $user->id)
                            ->get();


        $user_languages = DB::table('profile_languages as pl')
                          ->join('languages as l', 'pl.language_id', '=', 'l.id', 'left')
                          ->join('language_levels as ll', 'pl.language_level_id', '=', 'll.id', 'left')
                          ->select('pl.*', 'l.lang', 'language_level')
                          ->where('user_id', $user->id)
                          ->get();

        $user_projects = DB::table('profile_projects')->where('user_id', $user->id)->get();

        
        $html = '';
        $download_resume = '';
        if($req->temp_id){
            $temp_id = base64_decode($req->temp_id);
            $checks = [];
            for($i=1; $i<=12; $i++){
              if($i==2 || $i==10){
                continue;
              }   
              $checks[$i]=DB::table('manage_resumes')->where(['resume_id'=>$i,'status'=>'free'])->get()->count();
              if($checks[$i]>0 && $temp_id==$i){
                if($req->format=="docx"){
                  $download_resume = 'resume.premium.word-template-'.$i;
                }
                else{
                  $download_resume = 'resume.premium.template-'.$i;
                }
              }
              elseif($temp_id == $i && auth()->user()->package_id != '0' && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now()))){
                if($req->format=="docx"){
                  $download_resume = 'resume.premium.word-template-'.$i;
                }
                else{
                  $download_resume = 'resume.premium.template-'.$i;
                }
              }
              else{
              }
            }                    
        }else{
            for($i=1; $i<=12; $i++){
              if($i==2 || $i==10){
                continue;
              } 
              if($user->resume_temp === 'temp_'.$i){
                if($req->format=="docx"){
                  $download_resume = 'resume.premium.word-template-'.$i;
                }
                else{
                  $download_resume = 'resume.premium.template-'.$i;
                }
              }
            }
        }
        
        $view = view($download_resume)->with(compact('user', 'user_meta', 'user_experience', 'user_educations', 'user_skills', 'user_languages', 'user_projects'));
      //  return $view;
        $html.= $view->render(); 
        if($req->format=="docx"){
          $purifier = new HTMLPurifier();
          $html = str_replace('&', 'and', $html);
          $html = str_replace('amp;', '', $html);
          $cleanHtml = $purifier->purify($html);
          $phpWord = new PhpWord();
          $section = $phpWord->addSection(array(
            'marginLeft'   => 0,
            'marginRight'  => 0,
            'marginTop'    => 250,
            'marginBottom' => 180,
          ));
          \PhpOffice\PhpWord\Shared\Html::addHtml($section, $cleanHtml);
          $wordFilePath = storage_path('app/public/Resume.docx');
          $writer = IOFactory::createWriter($phpWord, 'Word2007');
          $writer->save($wordFilePath);
          return response()->download($wordFilePath)->deleteFileAfterSend(true);
        }
        else{
          $pdf = PDF::loadHTML($html);
          return $pdf->download('Resume.pdf');  
        }
     }
    public function downloadResumeTemp($temp_id){
      
      $user = User::findOrFail(Auth::user()->id);        

      $user_meta = DB::table('users as u')
          ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
          ->join('cities as c', 'u.city_id', '=', 'c.id')
          ->join('countries as cc', 'u.country_id', '=', 'cc.id')
          ->select(
              'u.id as user_id', 
              'u.first_name', 
              'u.last_name', 
              'u.email', 
              'u.date_of_birth', 
              'u.phone', 
              'u.street_address',
              'c.city',
              'cc.country',
              'cl.career_level'
              )
          ->where('u.id', Auth::user()->id)->first();


      $user_experience = DB::table('profile_experiences as pe')
                          ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                          ->select('pe.*', 'c.city as city_name')
                          ->where('user_id', $user->id)
                          ->get();

      $user_educations = DB::table('profile_educations as pe')
                          ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                          ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                          ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                          ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                          ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                          ->select(
                              'pe.*',
                              'dl.degree_level',
                              'dt.degree_type',
                              'c.city',
                              'ms.major_subject'
                              )
                          ->where('user_id', $user->id)
                          ->get();

      $user_skills = DB::table('profile_skills as ps')
                          ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                          ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                          ->select('ps.id', 'js.job_skill', 'je.job_experience')
                          ->where('user_id', $user->id)
                          ->get();

      $user_languages = DB::table('profile_languages as pl')
                          ->join('languages as l', 'pl.language_id', '=', 'l.id', 'left')
                          ->join('language_levels as ll', 'pl.language_level_id', '=', 'll.id', 'left')
                          ->select('pl.*', 'l.lang', 'language_level')
                          ->where('user_id', $user->id)
                          ->get();
      // dd($user_languages);
      

      // update resume exist & resume template only when temp-* file is selected
      if($temp_id === 'temp-1' || $temp_id === 'temp-2' || $temp_id === 'temp-3'){
        // update for resume exist
        $is_resume_update = User::where('id', Auth::user()->id)->update(['is_resume' => '1']);

        // update resume template
        $resume_temp = User::where('id', Auth::user()->id)->update(['resume_temp' => $temp_id]);
      }


      // load selected template
      $html = '';
      $download_resume = '';
      if($temp_id === 'temp-1'){
          $download_resume = 'resume.download-resume-1';
      }
    //   else if($temp_id === 'temp-2'){
    //       $download_resume = 'resume.download-resume-2';
    //   }
      else if($temp_id === 'temp-3'){
          $download_resume = 'resume.download-resume-3';
      }else{
          return redirect()->back();
      }

      $view = view($download_resume)->with(compact('user', 'user_meta', 'user_experience', 'user_educations', 'user_skills', 'user_languages'));
      $html .= $view->render();
      
      $pdf = PDF::loadHTML($html);

      return $pdf->stream('Resume.pdf');
    //   return $pdf->download('Resume.pdf');
    }


    public function setResumeTemp(Request $req){

      // update resume exist & resume template only when temp-* file is selected
      if($req->temp_id === 'temp_1' || $req->temp_id === 'temp_9' || $req->temp_id === 'temp_3' || $req->temp_id === 'temp_4' || $req->temp_id === 'temp_5' || $req->temp_id === 'temp_6' || $req->temp_id === 'temp_7' || $req->temp_id === 'temp_8' || $req->temp_id === 'temp_10'|| $req->temp_id === 'temp_11'|| $req->temp_id === 'temp_12'){

        // Remove the "temp_" prefix from $req->temp_id
        $cleanTemplateId = str_replace('temp_', '', $req->temp_id);

        // Fetch the corresponding resume_id values from the database where status is 'free'
        $resumeIds = DB::table('manage_resumes')
            ->where('status', 'free')
            ->pluck('resume_id')
            ->toArray();
          if (in_array($cleanTemplateId, $resumeIds)) {
            $resume_exist = '1';

          // check & set resume existence for first time
          // update only once for resume exist
          $is_resume = User::where('id', Auth::user()->id)->first(['is_resume']);

          if($is_resume->is_resume == '0'){
            $is_resume_update = User::where('id', Auth::user()->id)->update(['is_resume' => '1']);
            $resume_exist = '0';
          }

          // update resume template
          $resume_temp = User::where('id', Auth::user()->id)->update(['resume_temp' => $req->temp_id]);

          echo json_encode($resume_exist);
        }else{
          
          if($req->temp_id === 'temp_4' || $req->temp_id === 'temp_5' || $req->temp_id === 'temp_6' || $req->temp_id === 'temp_7' || $req->temp_id === 'temp_8'  || $req->temp_id === 'temp_9'|| $req->temp_id === 'temp_11' || $req->temp_id === 'temp_12'){

            // dd(auth()->user()->package_id);

            if( auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) ){
             
              $resume_exist = '1';

              // check & set resume existence for first time
              // update only once for resume exist
              $is_resume = User::where('id', Auth::user()->id)->first(['is_resume']);

              if($is_resume->is_resume == '0'){
                $is_resume_update = User::where('id', Auth::user()->id)->update(['is_resume' => '1']);
                $resume_exist = '0';
              }

              // update resume template
              $resume_temp = User::where('id', Auth::user()->id)->update(['resume_temp' => $req->temp_id]);

              echo json_encode($resume_exist);
            }else{
              echo false;  
            }

          }else{
            echo false;
          }

        }
      
      }
      
    }

}
