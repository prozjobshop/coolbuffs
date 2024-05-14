<?php

namespace App\Http\Controllers;

use App\Job;
use App\Country;
use App\FunctionalArea;
use App\Industry;
use App\JobType;
use App\Total_jobs;
use App\Company;
use App\State;
use App\SiteSetting;
use App\City;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use SimpleXMLElement;
use DB;

class Job8Controller extends Controller
{
    public function __construct()
    {
        ini_set('memory_limit', '10244M');
        set_time_limit(3000);
    }

    public function job8()
    {
        //exit;
        $siteSetting = SiteSetting::where('id',1272)->first();
        $reference_array = array();
        //dd($reference_array);
        $all_jobs = Job::get();
        if (null !== ($all_jobs)) {
            foreach ($all_jobs as $jo) {
                $reference_array[] = $jo->reference;
            }
        }
        //dd($reference_array);
        $destinationPath = asset('xml/');
        $fileName = '/jobs.xml';
        $data = file_get_contents("https://www.jobg8.com/fileserver/jobs.aspx?username=".$siteSetting->username_jobg8."&password=".$siteSetting->password_jobg8."&accountnumber=".$siteSetting->accountnumber_jobg8."&filename=Jobs.xml");
        file_put_contents(public_path("xml/jobs.xml"), $data);
       // echo '<pre>';
        //print_r($data);
       //exit;
       
        //exit;
        $xmlobj = simplexml_load_file(public_path("xml/jobs.xml"), 'SimpleXMLElement', LIBXML_NOCDATA);
        $i = 1;

        foreach ($xmlobj as $key => $value) {
            if(!isset($value->attributes()['Action'][0])){
                echo 'An error has occurred, please contact JobG8 Customer Support if this problem persists';
                exit;
            }
            if ($value->attributes()['Action'][0] == 'Post') {
                if (!in_array(trim($value->SenderReference), $reference_array)) {
                    //dd($value->Duration);
                    $company = Company::where('name', 'LIKE', '%' . $value->AdvertiserName . '%')->orWhere('slug', str_slug($value->AdvertiserName))->first();
                    if (!empty($company)) {
                        $company_id = $company->id;
                       
                       // $company->update();
                    } else {

                        $com = new Company();
                        $com->name = $value->AdvertiserName;
                        $com->email = str_slug(mb_substr($value->AdvertiserName, 0, 10)) . '@'.isset($_SERVER['SSL_SERVER_S_DN_CN'])?$_SERVER['SSL_SERVER_S_DN_CN']:'yourdomain.com';
                        $com->password = Hash::make(str_replace(' ', '', $value->AdvertiserName) . '6252');

                        $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                        if (!empty($country) && $country->id != '') {
                            $com->country_id = $country->id;
                        }
                        $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                        if ($state && $state->id != '') {
                            $com->state_id = $state->id;
                        }

                        if ($value->Area != '') {
                            $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                            if ($city && $city->id != '') {
                                $com->city_id = $city->id;
                            }
                        }
                        $com->location = $value->Area . ',' . $value->Location . '' . $value->Country;
                        $com->logo = $value->LogoURL;
                        $com->slug = str_slug($value->AdvertiserName);
                        $com->is_active = 1;
                        $com->is_featured = 1;
                        $com->verified = 1;
                        $com->is_subscribed = 1;
                        $com->type = 'job8';
                        $com->save();
                        $company_id = $com->id;
                    }
                    $job = new Job();
                    $job->company_id = $company_id;
                    $co = Company::findorfail($company_id);
                    //$co->logo = $value->LogoURL;
                    $co->update();
                    $job->title = ucfirst($value->Position);
                    $job->description = $value->Description;
                    if (trim($value->Classification) == 'Mining / Oil / Gas') {
                        $functional_id = 13;
                    } else if (trim($value->Classification) == 'Banking & Financial Services') {
                        $functional_id = 18;
                    } else if (trim($value->Classification) == 'Consulting & Corporate Strategy') {
                        $functional_id = 10;
                    } else if (trim($value->Classification) == 'Advert / Media / Entertainment') {
                        $functional_id = 14;
                    } else if (trim($value->Classification) == 'Healthcare & Medical') {
                        $functional_id = 21;
                    } else if (trim($value->Classification) == 'Government & Defence') {
                        $functional_id = 20;
                    } else if (trim($value->Classification) == 'Hospitality & Tourism') {
                        $functional_id = 22;
                    } else if (trim($value->Classification) == 'Community & Sport') {
                        $functional_id = 44;
                    } else if (trim($value->Classification) == 'Call Centre / CustomerService') {
                        $functional_id = 11;
                    } else if (trim($value->Classification) == 'I.T. & Communications') {
                        $functional_id = 26;
                    } else if (trim($value->Classification) == 'Insurance & Superannuation') {
                        $functional_id = 23;
                    } else if (trim($value->Classification) == 'Manufacturing Operations') {
                        $functional_id = 34;
                    } else if (trim($value->Classification) == 'Real Estate & Property') {
                        $functional_id = 37;
                    } else if (trim($value->Classification) == 'HR / Recruitment') {
                        $functional_id = 38;
                    } else if (trim($value->Classification) == 'Retail & Consumer Products') {
                        $functional_id = 39;
                    } else if (trim($value->Classification) == 'Sales & Marketing') {
                        $functional_id = 40;
                    } else if (trim($value->Classification) == 'Science & Technology') {
                        $functional_id = 41;
                    } else if (trim($value->Classification) == 'Transport & Logistics') {
                        $functional_id = 47;
                    } else {
                        $industry = Industry::where('industry', 'LIKE', '%' . $value->Classification . '%')->first();
                        if (!empty($industry) && $industry->id != '') {
                            $functional_id = $industry->id;
                        } else {
                            $fun = new Industry();
                            $fun->industry = $value->Classification;
                            $fun->is_default = 1;
                            $fun->is_active = 1;
                            $fun->lang = 'en';
                            $fun->save();
                            $fun->industry_id = $fun->id;
                            $fun->sort_order = $fun->id;
                            $fun->update();
                            $functional_id = $fun->id;
                        }
                    }

                    $indus = Industry::findorfail($functional_id);
                    $jobss = Job::active()->where('industry_id', $functional_id)->count();
                    $indus->update();
                    $job->industry_id = $functional_id;
                    $job->postal_code = $value->PostalCode;


                    $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                    if (!empty($country) && $country->id != '') {
                        $country_id = $country->id;
                    } else {
                        $coun = new Country();
                        $coun->country = $value->Country;
                        $coun->is_default = 1;
                        $coun->is_active = 1;
                        $coun->lang = 'en';
                        $coun->save();
                        $coun->country_id = $fun->id;
                        $coun->sort_order = $fun->id;
                        $coun->update();
                        $country_id = $coun->id;
                    }
                    $job->country_id = $country_id;
                    $cou = Country::findorfail($country_id);

                    $cou->update();


                    $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                    if ($state && $state->id != '') {
                        $job->state_id = $state->id;
                    }

                    if ($value->Area != '') {
                        $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                        if ($city && $city->id != '') {
                            $job->city_id = $city->id;
                        }
                    }

                    $job->salary_from = $value->SalaryMinimum;
                    $job->salary_to = $value->SalaryMaximum;

                    $currency = explode('.', $value->SalaryCurrency);
                    if (isset($currency[1])) {
                        $curr = trim($currency[1]);
                    } else {
                        $curr = trim($currency[0]);
                    }
                    if ($curr == 'AUD') {
                        $sign = "A$";
                    } else if ($curr == 'GBP') {
                        $sign = "£";
                    } else if ($curr == 'CAD') {
                        $sign = "C$";
                    } else if ($curr == 'CNY') {
                        $sign = "¥";
                    } else if ($curr == 'CZK') {
                        $sign = "‎Kč";
                    } else if ($curr == 'DKK') {
                        $sign = "Øre";
                    } else if ($curr == 'EEK') {
                        $sign = "kr";
                    } else if ($curr == 'HKD') {
                        $sign = "HK$";
                    } else if ($curr == 'HUF') {
                        $sign = "Ft";
                    } else if ($curr == 'INR') {
                        $sign = "₹";
                    } else if ($curr == 'ILS') {
                        $sign = "₪";
                    } else if ($curr == 'JPY') {
                        $sign = "JP¥";
                    } else if ($curr == 'LVL') {
                        $sign = "Ls";
                    } else if ($curr == 'LTL') {
                        $sign = "Lt";
                    } else if ($curr == 'MYR') {
                        $sign = "RM";
                    } else if ($curr == 'MTL') {
                        $sign = "₤ and Lm";
                    } else if ($curr == 'NZD') {
                        $sign = "NZD";
                    } else {
                        $sign = $curr;
                    }


                    $job->salary_currency = $sign;

                    $j_type = JobType::where('job_type', 'LIKE', '%' . $value->EmploymentType . '%')->first();
                    if (!empty($j_type) && $j_type->id != '') {
                        $job_type = $j_type->id;
                    } else {
                        $job_ty = new JobType();
                        $job_ty->job_type = $value->EmploymentType;
                        $job_ty->is_default = 1;
                        $job_ty->is_active = 1;
                        $job_ty->lang = 'en';
                        $job_ty->save();
                        $job_ty->job_type_id = $job_ty->id;
                        $job_ty->sort_order = $job_ty->id;
                        $job_ty->update();
                        $job_type = $job_ty->id;
                    }
                    $job->job_type_id = $job_type;
                    $jobTyp = JobType::findorfail($job_type);
                    $jobTyp->update();


                    $salary_period_id = 0;
                    if ($value->SalaryPeriod == 'Annual') {
                        $salary_period_id = 2;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Monthly') {
                        $salary_period_id = 1;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Daily') {
                        $salary_period_id = 4;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Hourly') {
                        $salary_period_id = 5;
                        $job->salary_period_id = $salary_period_id;
                    }


                    //dd($value->Duration);

                    $expire = date('Y-m-d', strtotime('+1 month'));

                    $job->expiry_date = $expire;
                    $job->is_active = 1;
                    //$job->slug = $value->DisplayReference;
                    $job->reference = trim($value->SenderReference);
                    $job->location = $value->Area . ', ' . $value->Location . ', ' . $value->Country;
                    $job->job_advertiser = $value->AdvertiserName;
                    $job->application_url = $value->ApplicationURL;
                    $job->json_object = json_encode($value);
                    $job->save();
                    $reference_array[] = trim($value->SenderReference);
                    $job->slug = str_slug($job->title, '-') . '-' . $job->id;
                    $job->update();

                }
            } else if ($value->attributes()['Action'][0] == 'Delete') {
                if (in_array(trim($value->SenderReference), $reference_array)) {
                    if (trim($value->Classification) == 'Mining / Oil / Gas') {
                        $functional_id = 13;
                    } else if (trim($value->Classification) == 'Banking & Financial Services') {
                        $functional_id = 18;
                    } else if (trim($value->Classification) == 'Consulting & Corporate Strategy') {
                        $functional_id = 10;
                    } else if (trim($value->Classification) == 'Advert / Media / Entertainment') {
                        $functional_id = 14;
                    } else if (trim($value->Classification) == 'Healthcare & Medical') {
                        $functional_id = 21;
                    } else if (trim($value->Classification) == 'Government & Defence') {
                        $functional_id = 20;
                    } else if (trim($value->Classification) == 'Hospitality & Tourism') {
                        $functional_id = 22;
                    } else if (trim($value->Classification) == 'Community & Sport') {
                        $functional_id = 44;
                    } else if (trim($value->Classification) == 'Call Centre / CustomerService') {
                        $functional_id = 11;
                    } else if (trim($value->Classification) == 'I.T. & Communications') {
                        $functional_id = 26;
                    } else if (trim($value->Classification) == 'Insurance & Superannuation') {
                        $functional_id = 23;
                    } else if (trim($value->Classification) == 'Manufacturing Operations') {
                        $functional_id = 34;
                    } else if (trim($value->Classification) == 'Real Estate & Property') {
                        $functional_id = 37;
                    } else if (trim($value->Classification) == 'HR / Recruitment') {
                        $functional_id = 38;
                    } else if (trim($value->Classification) == 'Retail & Consumer Products') {
                        $functional_id = 39;
                    } else if (trim($value->Classification) == 'Sales & Marketing') {
                        $functional_id = 40;
                    } else if (trim($value->Classification) == 'Science & Technology') {
                        $functional_id = 41;
                    } else if (trim($value->Classification) == 'Transport & Logistics') {
                        $functional_id = 47;
                    } else {
                        $industry = Industry::where('industry', 'LIKE', '%' . $value->Classification . '%')->first();
                        if (!empty($industry) && $industry->id != '') {
                            $functional_id = $industry->id;
                        } else {
                            $functional_id = 0;
                        }
                    }

                    $job_id = Job::where('reference', trim($value->SenderReference))->first();

                    $job = Job::where('reference', trim($value->SenderReference))->delete();

                    $co = Company::findorfail($job_id->company_id);

                    $co->update();

                    $indus = Industry::findorfail($functional_id);
                    $jobss = Job::active()->where('industry_id', $functional_id)->count();

                    $indus->update();


                    $j_type = JobType::where('job_type', 'LIKE', '%' . $value->EmploymentType . '%')->first();
                    $jobTyp = JobType::findorfail($j_type->id);

                    $jobTyp->update();

 
                   
                }
            } else if ($value->attributes()['Action'][0] == 'Amend') {
                //dd($value->Duration);
                if (in_array(trim($value->SenderReference), $reference_array)) {
                    $company = Company::where('name', 'LIKE', '%' . $value->AdvertiserName . '%')->orWhere('slug', str_slug($value->AdvertiserName))->first();
                    if (!empty($company)) {
                        $company_id = $company->id;
                    } else {

                        $com = new Company();
                        $com->name = $value->AdvertiserName;
                        $com->email = str_slug(mb_substr($value->AdvertiserName, 0, 10)) . '@boardrm.com';
                        $com->password = Hash::make(str_replace(' ', '', $value->AdvertiserName) . '6252');

                        $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                        if (!empty($country) && $country->id != '') {
                            $com->country_id = $country->id;
                        }
                        $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                        if ($state && $state->id != '') {
                            $com->state_id = $state->id;
                        }

                        if ($value->Area != '') {
                            $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                            if ($city && $city->id != '') {
                                $com->city_id = $city->id;
                            }
                        }
                        $com->location = $value->Area . ',' . $value->Location . '' . $value->Country;
                        $com->logo = $value->LogoURL;
                        $com->slug = str_slug($value->AdvertiserName);
                        $com->is_active = 1;
                        $com->is_featured = 1;
                        $com->verified = 1;
                        $com->is_subscribed = 1;
                        $com->type = 'job8';
                        $com->save();
                        $company_id = $com->id;
                    }
                    $job = Job::where('reference', trim($value->SenderReference))->first();
                    $job->company_id = $company_id;
                    $co = Company::findorfail($company_id);
                    //$co->logo = $value->LogoURL;
                    $co->update();
                    $job->title = ucfirst($value->Position);
                    $job->description = $value->Description;
                    if (trim($value->Classification) == 'Mining / Oil / Gas') {
                        $functional_id = 13;
                    } else if (trim($value->Classification) == 'Banking & Financial Services') {
                        $functional_id = 18;
                    } else if (trim($value->Classification) == 'Consulting & Corporate Strategy') {
                        $functional_id = 10;
                    } else if (trim($value->Classification) == 'Advert / Media / Entertainment') {
                        $functional_id = 14;
                    } else if (trim($value->Classification) == 'Healthcare & Medical') {
                        $functional_id = 21;
                    } else if (trim($value->Classification) == 'Government & Defence') {
                        $functional_id = 20;
                    } else if (trim($value->Classification) == 'Hospitality & Tourism') {
                        $functional_id = 22;
                    } else if (trim($value->Classification) == 'Community & Sport') {
                        $functional_id = 44;
                    } else if (trim($value->Classification) == 'Call Centre / CustomerService') {
                        $functional_id = 11;
                    } else if (trim($value->Classification) == 'I.T. & Communications') {
                        $functional_id = 26;
                    } else if (trim($value->Classification) == 'Insurance & Superannuation') {
                        $functional_id = 23;
                    } else if (trim($value->Classification) == 'Manufacturing Operations') {
                        $functional_id = 34;
                    } else if (trim($value->Classification) == 'Real Estate & Property') {
                        $functional_id = 37;
                    } else if (trim($value->Classification) == 'HR / Recruitment') {
                        $functional_id = 38;
                    } else if (trim($value->Classification) == 'Retail & Consumer Products') {
                        $functional_id = 39;
                    } else if (trim($value->Classification) == 'Sales & Marketing') {
                        $functional_id = 40;
                    } else if (trim($value->Classification) == 'Science & Technology') {
                        $functional_id = 41;
                    } else if (trim($value->Classification) == 'Transport & Logistics') {
                        $functional_id = 47;
                    } else {
                        $industry = Industry::where('industry', 'LIKE', '%' . $value->Classification . '%')->first();
                        if (!empty($industry) && $industry->id != '') {
                            $functional_id = $industry->id;
                        } else {
                            $fun = new Industry();
                            $fun->industry = $value->Classification;
                            $fun->is_default = 1;
                            $fun->is_active = 1;
                            $fun->lang = 'en';
                            $fun->save();
                            $fun->industry_id = $fun->id;
                            $fun->sort_order = $fun->id;
                            $fun->update();
                            $functional_id = $fun->id;
                        }
                    }
                    $indus = Industry::findorfail($functional_id);
                    $jobss = Job::active()->where('industry_id', $functional_id)->count();
                    $indus->update();
                    $job->industry_id = $functional_id;
                    $job->postal_code = $value->PostalCode;

                    $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                    if (!empty($country) && $country->id != '') {
                        $country_id = $country->id;
                    } else {
                        $coun = new Country();
                        $coun->country = $value->Country;
                        $coun->is_default = 1;
                        $coun->is_active = 1;
                        $coun->lang = 'en';
                        $coun->save();
                        $coun->country_id = $fun->id;
                        $coun->sort_order = $fun->id;
                        $coun->update();
                        $country_id = $coun->id;
                    }
                    $job->country_id = $country_id;



                    $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                    if ($state && $state->id != '') {
                        $job->state_id = $state->id;
                    }

                    if ($value->Area != '') {
                        $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                        if ($city && $city->id != '') {
                            $job->city_id = $city->id;
                        }
                    }

                    $job->salary_from = $value->SalaryMinimum;
                    $job->salary_to = $value->SalaryMaximum;

                    $currency = explode('.', $value->SalaryCurrency);
                    if (isset($currency[1])) {
                        $curr = trim($currency[1]);
                    } else {
                        $curr = trim($currency[0]);
                    }
                    if ($curr == 'AUD') {
                        $sign = "A$";
                    } else if ($curr == 'GBP') {
                        $sign = "£";
                    } else if ($curr == 'CAD') {
                        $sign = "C$";
                    } else if ($curr == 'CNY') {
                        $sign = "¥";
                    } else if ($curr == 'CZK') {
                        $sign = "‎Kč";
                    } else if ($curr == 'DKK') {
                        $sign = "Øre";
                    } else if ($curr == 'EEK') {
                        $sign = "kr";
                    } else if ($curr == 'HKD') {
                        $sign = "HK$";
                    } else if ($curr == 'HUF') {
                        $sign = "Ft";
                    } else if ($curr == 'INR') {
                        $sign = "₹";
                    } else if ($curr == 'ILS') {
                        $sign = "₪";
                    } else if ($curr == 'JPY') {
                        $sign = "JP¥";
                    } else if ($curr == 'LVL') {
                        $sign = "Ls";
                    } else if ($curr == 'LTL') {
                        $sign = "Lt";
                    } else if ($curr == 'MYR') {
                        $sign = "RM";
                    } else if ($curr == 'MTL') {
                        $sign = "₤ and Lm";
                    } else if ($curr == 'NZD') {
                        $sign = "NZD";
                    } else {
                        $sign = $curr;
                    }


                    $job->salary_currency = $sign;

                    $j_type = JobType::where('job_type', 'LIKE', '%' . $value->EmploymentType . '%')->first();
                    if (!empty($j_type) && $j_type->id != '') {
                        $job_type = $j_type->id;
                    } else {
                        $job_ty = new JobType();
                        $job_ty->job_type = $value->EmploymentType;
                        $job_ty->is_default = 1;
                        $job_ty->is_active = 1;
                        $job_ty->lang = 'en';
                        $job_ty->save();
                        $job_ty->job_type_id = $job_ty->id;
                        $job_ty->sort_order = $job_ty->id;
                        $job_ty->update();
                        $job_type = $job_ty->id;
                    }
                    $job->job_type_id = $job_type;

                    $salary_period_id = 0;
                    if ($value->SalaryPeriod == 'Annual') {
                        $salary_period_id = 2;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Monthly') {
                        $salary_period_id = 1;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Daily') {
                        $salary_period_id = 4;
                        $job->salary_period_id = $salary_period_id;
                    } else if ($value->SalaryPeriod == 'Hourly') {
                        $salary_period_id = 5;
                        $job->salary_period_id = $salary_period_id;
                    }


                    //dd($value->Duration);

                    $expire = date('Y-m-d', strtotime('+1 month'));

                    $job->expiry_date = $expire;
                    $job->is_active = 1;
                    //$job->slug = $value->DisplayReference;
                    $job->reference = trim($value->SenderReference);
                    $job->location = $value->Area . ', ' . $value->Location . ', ' . $value->Country;
                    $job->job_advertiser = $value->AdvertiserName;
                    $job->application_url = $value->ApplicationURL;
                    $reference_array[] = trim($value->SenderReference);
                    $job->slug = str_slug($job->title, '-') . '-' . $job->id;
                    $job->json_object = json_encode($value);
                    $job->update();



                    $jobs = Job::active()->where('company_id', $company_id)->count();

                }
            }
        }

        //print_r($xmlobj);
        exit;
    }

    public function delete_jobs()
    {
        $destinationPath = asset('xml/');
        $fileName = '/Jobs.xml';
        /*  $data = file_get_contents("https://www.jobg8.com/fileserver/jobs.aspx?username=709D67EAD4&password=CD2F1E5A38&accountnumber=818498&filename=Jobs.xml");
        file_put_contents(public_path("xml/Jobs.xml"), $data);
        exit; */
        $xmlobj = simplexml_load_file($destinationPath . $fileName, 'SimpleXMLElement', LIBXML_NOCDATA);
        foreach ($xmlobj as $key => $value) {
            if ($value->attributes()['Action'][0] == 'Delete') {
                $job = Job::where('reference', trim($value->SenderReference))->delete();
            }
        }
        //$this->remove_duplicates();
        echo 'Done';
        exit;
    }
    public function amend_jobs()
    {
        //dd($reference_array);
        $all_jobs = Job::get();
        if (null !== ($all_jobs)) {
            foreach ($all_jobs as $jo) {
                $reference_array[] = $jo->reference;
            }
        }
        $destinationPath = asset('xml/');
        $fileName = '/Jobs.xml';
        /*  $data = file_get_contents("https://www.jobg8.com/fileserver/jobs.aspx?username=709D67EAD4&password=CD2F1E5A38&accountnumber=818498&filename=Jobs.xml");
        file_put_contents(public_path("xml/Jobs.xml"), $data);
        exit; */
        $xmlobj = simplexml_load_file($destinationPath . $fileName, 'SimpleXMLElement', LIBXML_NOCDATA);
        foreach ($xmlobj as $key => $value) {
            if ($value->attributes()['Action'][0] == 'Amend') {
                //dd($value->Duration);
                $company = Company::where('name', 'LIKE', '%' . $value->AdvertiserName . '%')->where('slug', str_slug($value->AdvertiserName))->first();
                if (!empty($company)) {
                    $company_id = $company->id;
                } else {

                    $com = new Company();
                    $com->name = $value->AdvertiserName;
                    $com->email = str_slug(mb_substr($value->AdvertiserName, 0, 10)) . '@boardrm.com';
                    $com->password = Hash::make(str_replace(' ', '', $value->AdvertiserName) . '6252');

                    $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                    if (!empty($country) && $country->id != '') {
                        $com->country_id = $country->id;
                    }
                    $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                    if ($state && $state->id != '') {
                        $com->state_id = $state->id;
                    }

                    if ($value->Area != '') {
                        $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                        if ($city && $city->id != '') {
                            $com->city_id = $city->id;
                        }
                    }
                    $com->location = $value->Area . ',' . $value->Location . '' . $value->Country;
                    $com->logo = $value->LogoURL;
                    $com->slug = str_slug($value->AdvertiserName);
                    $com->is_active = 1;
                    $com->is_featured = 1;
                    $com->verified = 1;
                    $com->is_subscribed = 1;
                    $com->type = 'job8';
                    $com->save();
                    $company_id = $com->id;
                }
                $job = Job::where('reference', trim($value->SenderReference))->first();
                $job->company_id = $company_id;
                $co = Company::findorfail($company_id);
                $co->update();
                $job->title = ucfirst($value->Position);
                $job->description = $value->Description;
                if (trim($value->Classification) == 'Mining / Oil / Gas') {
                    $functional_id = 13;
                } else if (trim($value->Classification) == 'Banking & Financial Services') {
                    $functional_id = 18;
                } else if (trim($value->Classification) == 'Consulting & Corporate Strategy') {
                    $functional_id = 10;
                } else if (trim($value->Classification) == 'Advert / Media / Entertainment') {
                    $functional_id = 14;
                } else if (trim($value->Classification) == 'Healthcare & Medical') {
                    $functional_id = 21;
                } else if (trim($value->Classification) == 'Government & Defence') {
                    $functional_id = 20;
                } else if (trim($value->Classification) == 'Hospitality & Tourism') {
                    $functional_id = 22;
                } else if (trim($value->Classification) == 'Community & Sport') {
                    $functional_id = 44;
                } else if (trim($value->Classification) == 'Call Centre / CustomerService') {
                    $functional_id = 11;
                } else if (trim($value->Classification) == 'I.T. & Communications') {
                    $functional_id = 26;
                } else if (trim($value->Classification) == 'Insurance & Superannuation') {
                    $functional_id = 23;
                } else if (trim($value->Classification) == 'Manufacturing Operations') {
                    $functional_id = 34;
                } else if (trim($value->Classification) == 'Real Estate & Property') {
                    $functional_id = 37;
                } else if (trim($value->Classification) == 'HR / Recruitment') {
                    $functional_id = 38;
                } else if (trim($value->Classification) == 'Retail & Consumer Products') {
                    $functional_id = 39;
                } else if (trim($value->Classification) == 'Sales & Marketing') {
                    $functional_id = 40;
                } else if (trim($value->Classification) == 'Science & Technology') {
                    $functional_id = 41;
                } else if (trim($value->Classification) == 'Transport & Logistics') {
                    $functional_id = 47;
                } else {
                    $industry = Industry::where('industry', 'LIKE', '%' . $value->Classification . '%')->first();
                    if (!empty($industry) && $industry->id != '') {
                        $functional_id = $industry->id;
                    } else {
                        $fun = new Industry();
                        $fun->industry = $value->Classification;
                        $fun->is_default = 1;
                        $fun->is_active = 1;
                        $fun->lang = 'en';
                        $fun->save();
                        $fun->industry_id = $fun->id;
                        $fun->sort_order = $fun->id;
                        $fun->update();
                        $functional_id = $fun->id;
                    }
                }
                $indus = Industry::findorfail($functional_id);

                $indus->update();
                $job->industry_id = $functional_id;
                $job->postal_code = $value->PostalCode;

                $country = Country::where('country', 'LIKE', '%' . $value->Country . '%')->first();
                if (!empty($country) && $country->id != '') {
                    $country_id = $country->id;
                } else {
                    $coun = new Country();
                    $coun->country = $value->Country;
                    $coun->is_default = 1;
                    $coun->is_active = 1;
                    $coun->lang = 'en';
                    $coun->save();
                    $coun->country_id = $fun->id;
                    $coun->sort_order = $fun->id;
                    $coun->update();
                    $country_id = $coun->id;
                }
                $job->country_id = $country_id;
                $cou = Country::findorfail($country_id);

                $cou->update();


                $state = State::where('state', 'LIKE', '%' . $value->Location . '%')->first();
                if ($state && $state->id != '') {
                    $job->state_id = $state->id;
                }

                if ($value->Area != '') {
                    $city = City::where('city', 'LIKE', '%' . $value->Area . '%')->first();
                    if ($city && $city->id != '') {
                        $job->city_id = $city->id;
                    }
                }

                $job->salary_from = $value->SalaryMinimum;
                $job->salary_to = $value->SalaryMaximum;

                $currency = explode('.', $value->SalaryCurrency);
                if (isset($currency[1])) {
                    $curr = trim($currency[1]);
                } else {
                    $curr = trim($currency[0]);
                }
                if ($curr == 'AUD') {
                    $sign = "A$";
                } else if ($curr == 'GBP') {
                    $sign = "£";
                } else if ($curr == 'CAD') {
                    $sign = "C$";
                } else if ($curr == 'CNY') {
                    $sign = "¥";
                } else if ($curr == 'CZK') {
                    $sign = "‎Kč";
                } else if ($curr == 'DKK') {
                    $sign = "Øre";
                } else if ($curr == 'EEK') {
                    $sign = "kr";
                } else if ($curr == 'HKD') {
                    $sign = "HK$";
                } else if ($curr == 'HUF') {
                    $sign = "Ft";
                } else if ($curr == 'INR') {
                    $sign = "₹";
                } else if ($curr == 'ILS') {
                    $sign = "₪";
                } else if ($curr == 'JPY') {
                    $sign = "JP¥";
                } else if ($curr == 'LVL') {
                    $sign = "Ls";
                } else if ($curr == 'LTL') {
                    $sign = "Lt";
                } else if ($curr == 'MYR') {
                    $sign = "RM";
                } else if ($curr == 'MTL') {
                    $sign = "₤ and Lm";
                } else if ($curr == 'NZD') {
                    $sign = "NZD";
                } else {
                    $sign = $curr;
                }


                $job->salary_currency = $sign;

                $j_type = JobType::where('job_type', 'LIKE', '%' . $value->EmploymentType . '%')->first();
                if (!empty($j_type) && $j_type->id != '') {
                    $job_type = $j_type->id;
                } else {
                    $job_ty = new JobType();
                    $job_ty->job_type = $value->EmploymentType;
                    $job_ty->is_default = 1;
                    $job_ty->is_active = 1;
                    $job_ty->lang = 'en';
                    $job_ty->save();
                    $job_ty->job_type_id = $job_ty->id;
                    $job_ty->sort_order = $job_ty->id;
                    $job_ty->update();
                    $job_type = $job_ty->id;
                }
                $job->job_type_id = $job_type;
                $jobTyp = JobType::findorfail($job_type);
                $jobTyp->update();


                $salary_period_id = 0;
                if ($value->SalaryPeriod == 'Annual') {
                    $salary_period_id = 2;
                    $job->salary_period_id = $salary_period_id;
                } else if ($value->SalaryPeriod == 'Monthly') {
                    $salary_period_id = 1;
                    $job->salary_period_id = $salary_period_id;
                } else if ($value->SalaryPeriod == 'Daily') {
                    $salary_period_id = 4;
                    $job->salary_period_id = $salary_period_id;
                } else if ($value->SalaryPeriod == 'Hourly') {
                    $salary_period_id = 5;
                    $job->salary_period_id = $salary_period_id;
                }


                //dd($value->Duration);

                $expire = date('Y-m-d', strtotime('+1 month'));

                $job->expiry_date = $expire;
                $job->is_active = 1;
                //$job->slug = $value->DisplayReference;
                $job->reference = trim($value->SenderReference);
                $job->location = $value->Area . ', ' . $value->Location . ', ' . $value->Country;
                $job->job_advertiser = $value->AdvertiserName;
                $job->application_url = $value->ApplicationURL;
                $reference_array[] = trim($value->SenderReference);
                $job->slug = str_slug($job->title, '-') . '-' . $job->id;
                $job->update();
            }
        }
        echo 'Done';
        exit;
    }
    public function remove_duplicates()
    {
        DB::select(DB::raw("DELETE FROM jobs WHERE id NOT IN (SELECT * FROM (SELECT MAX(n.id) FROM jobs n GROUP BY n.reference) x)"));
    }
    public function remove_duplicate_companies()
    {
        DB::select(DB::raw("DELETE FROM companies WHERE id NOT IN (SELECT * FROM (SELECT MAX(n.id) FROM companies n GROUP BY n.name) x)"));
    }
    public function set_count_industry()
    {
        $industries = Industry::get();
        if (null !== ($industries)) {
            foreach ($industries as $key => $value) {
                $jobs = Job::active()->where('industry_id', $value->id)->count();
                $indus = Industry::findorfail($value->id);
                $indus->update();
            }
        }
    }
   
    public function set_count_country()
    {
        $countries = Country::get();
        if (null !== ($countries)) {
            foreach ($countries as $key => $value) {
                $jobs = Job::where('country_id', $value->id)->count();
                $indus = Country::findorfail($value->id);

                $indus->update();
            }
        }
    }
    public function recover_companies()
    {
        $jobs = Job::get();
        //dd($jobs);
        $count = 1;
        foreach ($jobs as $key => $value) {

            $company = Company::where('name', 'LIKE', '%' . $value->job_advertiser . '%')->orWhere('slug', str_slug($value->job_advertiser))->orWhere('email',str_slug(mb_substr($value->job_advertiser, 0, 10)) . '@boardrm.com')->first();
            //dd($company);
            if (null == ($company)) {
                //echo'yes';
                //exit;
                $com = new Company();
                $com->id = $value->company_id;
                $com->name = $value->job_advertiser;
                $com->email = str_slug(mb_substr($value->job_advertiser, 0, 10)) . '@boardrm.com';
                $com->password = Hash::make(str_replace(' ', '', $value->job_advertiser) . '6252');
                $com->country_id = $value->country_id;
                if (null !== ($value->state_id))
                    $com->state_id = $value->state_id;

                if (null !== ($value->city_id))
                    $com->city_id = $value->city_id;

                $com->location = $value->location;
                //$com->logo = $value->LogoURL;
                $com->slug = str_slug($value->job_advertiser);
                $com->is_active = 1;
                $com->is_featured = 1;
                $com->verified = 1;
                $com->is_subscribed = 1;
                $com->type = 'job8';
                //dd($com);
                $com->save();
                //exit;
            }
        }
    } 

    public function recover_jobs()
    {
        $jobs = Job::get();
        //dd($jobs);
        $count = 1;
        foreach ($jobs as $key => $value) {
            $company = Company::where('name', 'LIKE', '%' . $value->job_advertiser . '%')->first();
            if(null!==($company)){
            $job = Job::findorfail($value->id);
            $job->company_id = $company->id;
            $job->update();
        }

        }
    }
    public function set_count_jobType()
    {
        $countries = JobType::get();
        if (null !== ($countries)) {
            foreach ($countries as $key => $value) {
                $jobs = Job::active()->where('job_type_id', $value->id)->count();
                $indus = JobType::findorfail($value->id);
                $indus->update();
            }
        }
    }
    public function set_count_company()
    {
        $countries = Company::select('id')->get();
        if (null !== ($countries)) {
            foreach ($countries as $key => $value) {
                $jobs = Job::active()->where('company_id', $value->id)->count();
                $indus = Company::findorfail($value->id);
                $indus->update();
            }
        }
    }

    public function set_total_count()
    {
        //DB::select(DB::raw("DELETE FROM jobs WHERE id NOT IN (SELECT * FROM (SELECT MAX(n.id) FROM jobs n GROUP BY n.reference) x)"));
        $total_jobs = Job::active()->count();
        $weekjobs = Job::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 1 DAY'))->active()->count();
        $three_days = Job::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 3 DAY'))->active()->count();
        $seven_days = Job::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 7 DAY'))->active()->count();
        $two_weeks = Job::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 14 DAY'))->active()->count();
        $count = Total_jobs::findorfail(1);
        $count->week_count = $weekjobs;
        $count->last_three_days = $three_days;
        $count->last_week = $seven_days;
        $count->two_weeks = $two_weeks;
        $count->save();
    }
    public function set_location()
    {
        $total_jobs = Job::active()->get();
        foreach ($total_jobs as $key => $value) {
            $location = $value->getLocation();
            $job = Job::where('id', $value->id)->first();
            $job->location = $location;
            $job->update();
        }
    }
}
