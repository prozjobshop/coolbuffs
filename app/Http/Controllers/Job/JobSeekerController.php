<?php

namespace App\Http\Controllers\Job;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobSeekers;

class JobSeekerController extends Controller
{

    //use Skills;
    use FetchJobSeekers;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

    public function jobSeekersBySearch(Request $request)
    {
        $search = $request->query('search', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $gender_ids = $request->query('gender_id', array());
        $industry_ids = $request->query('industry_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $current_salary = $request->query('current_salary', '');
        $expected_salary = $request->query('expected_salary', '');
        $salary_currency = $request->query('salary_currency', '');
        $order_by = $request->query('order_by', 'id');
        $limit = 10;
        
        $jobSeekers = $this->fetchJobSeekers($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $order_by, $limit);

        /*         * ************************************************** */

        $jobSeekerIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobSeekerIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.city_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.industry_id');

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.career_level_id');

        /*         * ************************************************** */

        $genderIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.gender_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.job_experience_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */
        $data = array();
        $data['countries'] = \App\Country::select('country_id','country')->lang()->active()->get();
        $data['functional_areas'] = \App\FunctionalArea::select('functional_area_id','functional_area')->lang()->active()->get();
        $data['currencies'] = DataArrayHelper::currenciesArray();
        $data['job_skill'] = \App\JobSkill::select('job_skill_id','job_skill')->lang()->active()->get();
        $data['industries'] = \App\Industry::select('id','industry')->lang()->active()->get();
        $data['job_careers'] = \App\CareerLevel::select('career_level_id','career_level')->lang()->active()->get();
        $data['job_experience'] = \App\JobExperience::select('job_experience_id','job_experience')->lang()->active()->orderBy('job_experience','DESC')->get();
        $data['cities'] = \App\City::select('city_id','city')->lang()->active()->get();
        $data['gender'] = \App\Gender::select('gender_id','gender')->lang()->active()->get();


        $seo = (object) array(
                    'seo_title' => $seoArray['description'],
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('user.list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobSeekers', $jobSeekers)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        ->with('stateIdsArray', $stateIdsArray)
                        ->with('cityIdsArray', $cityIdsArray)
                        ->with('industryIdsArray', $industryIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('genderIdsArray', $genderIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('data',$data)
                        ->with('seo', $seo);
    }
    public function applicantListAjax(Request $request)
    {
       $applicants = User::select('name',)->get();
    //    $functional_area_ids = $request->query('functional_area_id', array());
       $data = [];

       foreach ($applicants as $item){
        if (!in_array($item['name'],$data)){
                $data[] = $item['name'];
        }     
       }
       return $data;
    }

}
