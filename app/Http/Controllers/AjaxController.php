<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Form;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\CountryStateCity;
use App\Seo;
use App\Cms;
use App\Job;
use App\JobSkill;
use App\FunctionalArea;
use App\Company;
use App\User;
use App\CmsContent;
use App\MajorSubject;

class AjaxController extends Controller
{

    use CountryStateCity;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function filterDefaultStates(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::defaultStatesArray($country_id);
        $dd = Form::select('state_id', ['' => __('Select State')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }

    public function filterDefaultStatesJob(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::defaultStatesArray($country_id);
        $dd = Form::select('state_id', ['' => __('All States')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }

    public function filterDefaultCities(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::defaultCitiesArray($state_id);
        $dd = Form::select('city_id', ['' => 'Select City'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }
    
    public function filterDefaultCitiesJob(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::defaultCitiesArray($state_id);
        $dd = Form::select('city_id', ['' => 'All Cities'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }

    /*     * ***************************************** */

    public function filterLangStates(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::langStatesArray($country_id);
        $dd = Form::select('state_id', ['' => __('Select State')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }
    
    public function filterLangStatesJob(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::langStatesArray($country_id);
        $dd = Form::select('state_id', ['' => __('All States')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }
    public function filterLangStatesJobAd(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::langStatesArray($country_id);
        $dd = Form::select('state_id[]', ['' => __('All States')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }

    public function filterLangCities(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::langCitiesArray($state_id);

        $dd = Form::select('city_id', ['' => 'Select City'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }
    
    public function filterLangCitiesJob(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::langCitiesArray($state_id);

        $dd = Form::select('city_id', ['' => 'All Cities'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }
    public function filterLangCitiesJobAd(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::langCitiesArray($state_id);

        $dd = Form::select('city_id[]', ['' => 'All Cities'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }

    /*     * ***************************************** */

    public function filterStates(Request $request)
    {
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');
        $new_state_id = $request->input('new_state_id', 'state_id');
        $states = DataArrayHelper::langStatesArray($country_id);
        $dd = Form::select('state_id[]', ['' => __('Select State')] + $states, $state_id, array('id' => $new_state_id, 'class' => 'form-control'));
        echo $dd;
    }

    public function filterCities(Request $request)
    {
        $state_id = $request->input('state_id');
        $city_id = $request->input('city_id');
        $cities = DataArrayHelper::langCitiesArray($state_id);

        $dd = Form::select('city_id[]', ['' => 'Select City'] + $cities, $city_id, array('id' => 'city_id', 'class' => 'form-control'));
        echo $dd;
    }

    /*     * ***************************************** */

    public function filterDegreeTypes(Request $request)
    {
        $degree_level_id = $request->input('degree_level_id');
        $degree_type_id = $request->input('degree_type_id');

        $degreeTypes = DataArrayHelper::langDegreeTypesArray($degree_level_id);

        $dd = Form::select('degree_type_id', ['' => 'Select degree type'] + $degreeTypes, $degree_type_id, array('id' => 'degree_type_id', 'class' => 'form-control'));
        echo $dd;
    }
    
    public function term_conditions(Request $request) {
        $cms = Cms::where('page_slug', 'like', "terms-of-use")->first();
        if (null === $cmsContent = CmsContent::getContentByPageId($cms->id)) {
            echo 'No Content';
            exit;
        }
        return $cmsContent;
    }

    public function filterJobTitle($q = null){
        $job_title = new Job();

        if ($q != null) {
            $job_title = $job_title->where('title','LIKE','%'.$q.'%')->distinct('title')->get('title');
        } else{
            $job_title = Job::distinct('title')->get('title');
        }

        return response()->json($job_title);
    }

    public function filterCompanyName($q = null){
        $company = new Company();

        if ($q != null) {
            $company = $company->where('name','LIKE','%'.$q.'%')->distinct('name')->get('name');
        } else{
            $company = Company::distinct('name')->get('name');
        }

        return response()->json($company);
    }

    public function filterUserName($q = null){
        $user = new User();

        if ($q != null) {
            $user = $user->select('first_name','last_name')
                    ->where('first_name','LIKE','%'.$q.'%')
                    ->orWhere('last_name','LIKE','%'.$q.'%')
                    ->where('is_active', 1)
                    ->where('country_id','!=', '')
                    ->distinct('first_name')
                    ->get();
        } else{
            $user = User::select('first_name','last_name')->where('is_active', 1)->distinct('first_name')->get('first_name');
        }

        return response()->json($user);
    }
    public function filterFunctionalArea($q = null)
    {
        $functional_area = new FunctionalArea();
        
        if ($q != null) {
            $functional_area = $functional_area->where('functional_area', 'LIKE', '%'.$q.'%')
                                    ->where('is_active', 1)
                                    ->get();
        } else {
            $functional_area = $functional_area->where('is_active', 1)->get();
        }

        return response()->json($functional_area);
    }

    public function filterDefaultSubjectJob(Request $request){
        $degree_level_id = $request->input('degree_level_id');
        $subject_id  = $request->input('subject_id');
        $new_subject_id = $request->input('new_subject_id', 'subject_id');
        $subjects = MajorSubject::select('major_subjects.major_subject', 'major_subjects.major_subject_id')->where('degree_level_id',$degree_level_id)
                ->lang()->active()->sorted()->pluck('major_subjects.major_subject', 'major_subjects.major_subject_id')->toArray();
        $dd = Form::select('major_subject_id', ['' => __('Major Subjects')] + $subjects, $subject_id , array('id' => $new_subject_id, 'class' => 'form-control'));
        echo $dd;
    }
    public function filterDefaultSubjectJobProfile(Request $request){
        $degree_level_id = $request->input('degree_level_id');
        $subject_id  = $request->input('subject_id');
        $new_subject_id = $request->input('new_subject_id', 'subject_id');
        $subjects = MajorSubject::select('major_subjects.major_subject', 'major_subjects.major_subject_id')->where('degree_level_id',$degree_level_id)
                ->lang()->active()->sorted()->pluck('major_subjects.major_subject', 'major_subjects.major_subject_id')->toArray();
        $dd = Form::select('major_subjects[]', ['' => __('Major Subjects')] + $subjects, $subject_id , array('id' => $new_subject_id, 'class' => 'form-control'));
        echo $dd;
    }
}
