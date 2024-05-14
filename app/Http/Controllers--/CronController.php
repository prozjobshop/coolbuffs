<?php

namespace App\Http\Controllers;

use App\Traits\Cron;
use App\Http\Controllers\Controller;
use App\User;
use App\Package;
use Carbon\Carbon;
class CronController extends Controller
{

    // use App\Traits\Cron;

    public function checkPackageValidity()
    {
        $this->runCheckPackageValidity();
    }
    public function freeMonthlyLimit(){
        
        $package = Package::find(7);
        User::query()
        ->where(function ($query) {
            $query->where('package_end_date', '<', Carbon::now())
                  ->orWhereNull('package_end_date');
        })
        ->update([
            'package_start_date'=>Carbon::now(),
            'package_end_date'=>Carbon::now()->addDays($package->package_num_days),
            'availed_jobs_quota' => 0,
            'jobs_quota' =>$package->package_num_listings,
            'package_id' => $package->id,
        ]);
     }
}
