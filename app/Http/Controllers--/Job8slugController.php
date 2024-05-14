<?php

namespace App\Http\Controllers;

use App\Job;
use App\Country;
use App\FunctionalArea;
use App\JobType;
use App\State;
use App\City;
use App\Http\Controllers\Controller;
use SimpleXMLElement;

class Job8slugController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
}
public function checklogin($url)
{
   // dd($url);
    $job = Job::where('reference',$url)->first();
   // dd($job);
    return redirect($job->application_url);
}

}
