<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use PDF;
use Redirect;
use Input;
use Config;
use App\Package;
use App\User;
use Carbon\Carbon;
use Cake\Chronos\Chronos;
use App\Traits\CompanyPackageTrait;
use App\Traits\JobSeekerPackageTrait;
/** All Stripe Details class * */
use Stripe\Stripe;
use Stripe\Charge;

class StripeOrderController extends Controller
{

    use CompanyPackageTrait;
    use JobSeekerPackageTrait;

    private $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*         * ****************************************** */
        // $this->middleware(function ($request, $next) {
        //     if (Auth::guard('company')->check()) {
        //         $this->redirectTo = 'company.home';
        //     }
        //     return $next($request);
        // });
        $this->middleware(function ($request, $next) {
          if (Auth::guard('company')->check()) {
            $this->redirectTo = 'company.home';
            return $next($request);
          }elseif(Auth::guard('web')->check()){
            $this->redirectTo = 'home';
            return $next($request);
          }else{
            return redirect(route('login'));
          }
        });
        /*         * ****************************************** */
    }

    // public function stripeOrderForm($package_id, $new_or_upgrade)
    // {
    //     $package = Package::findOrFail($package_id);
    //     $user = auth()->user();
    
    //     if ($user) {
    //         if (
    //             $user->package_id !== null &&
    //             $user->package_end_date !== null &&
    //             $user->package_end_date->gt(Carbon::now()) &&
    //             $new_or_upgrade === 'upgrade'
    //         ) {
    //             $sub_package = Package::findOrFail($user->package_id);
                
    //             flash(__('You are already subscribed to ' . $sub_package->package_title . ' package'))->success();
    //             return redirect()->route('home');
    //         }
    //     }
    
    //     return view('order.pay_with_stripe')
    //         ->with('package', $package)
    //         ->with('package_id', $package_id)
    //         ->with('new_or_upgrade', $new_or_upgrade);
    // }
    

    public function stripeOrderForm(Request $request, $package_id, $new_or_upgrade)
{
    $package = Package::findOrFail($package_id);

    // check to see if any package is already subscribed & not expired 
    // on condition true send back with custom alert message.
    if($new_or_upgrade == 'upgrade' && $package->package_price == 0){

      $current_pckg_end_date = Auth::guard('company')->user()->package_end_date;
      $today_date = date('Y-m-d');

      if($current_pckg_end_date > $today_date){
        flash(__('You have already subscribed to a package'));
        return Redirect::route($this->redirectTo);
      }


    }

    return view('order.pay_with_stripe')
        ->with('package', $package)
        ->with('package_id', $package_id)
        ->with('new_or_upgrade', $new_or_upgrade);
}

    /**
     * Store a details of payment with paypal.
     *
     * @param IlluminateHttpRequest $request
     * @return IlluminateHttpResponse
     */
    // public function stripeOrderPackage(Request $request)
    // {
    //     $package = Package::findOrFail($request->package_id);

    //     $order_amount = $package->package_price;

    //     /*         * ************************ */
    //     $buyer_id = '';
    //     $buyer_name = '';
    //     if (Auth::guard('company')->check()) {
    //         $buyer_id = Auth::guard('company')->user()->id;
    //         $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
    //     }
    //     if (Auth::check()) {
    //         $buyer_id = Auth::user()->id;
    //         $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
    //     }
    //     $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
    //     $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
    //     /*         * ************************ */
    //     Stripe::setApiKey(Config::get('stripe.stripe_secret'));
    //     try {
    //         $charge = Charge::create(array(
    //                     "amount" => $order_amount * 100,
    //                     "currency" => "USD",
    //                     "source" => $request->input('stripeToken'), // obtained with Stripe.js
    //                     "description" => $description
    //         ));
    //         if ($charge['status'] == 'succeeded') {
    //             /**
    //              * Write Here Your Database insert logic.
    //              */
    //             if (Auth::guard('company')->check()) {
    //                 $company = Auth::guard('company')->user();
    //                 if($package->package_for=='cv_search'){
    //                     $this->addCompanySearchPackage($company, $package,'Stripe');
    //                 }else{
    //                     $this->addCompanyPackage($company, $package,'Stripe');
    //                 }
    //             }
    //             if (Auth::check()) {
    //                 $user = Auth::user();
    //                 $user->transaction = $charge['balance_transaction'];
    //                 $user->update();
    //                 $this->addJobSeekerPackage($user, $package);
    //             }

    //             flash(__('You have successfully subscribed to selected package'))->success();
    //             return Redirect::route($this->redirectTo);
    //         } else {
    //             flash(__('Package subscription failed'));
    //             return Redirect::route($this->redirectTo);
    //         }
    //     } catch (Exception $e) {
    //         flash($e->getMessage());
    //         return Redirect::route($this->redirectTo);
    //     }
    // }

    public function stripeOrderPackage(Request $request)
{
    $package = Package::findOrFail($request->package_id);

    $order_amount = $package->package_price;

    /* ************************ */
    $buyer_id = '';
    $buyer_name = '';
    if (Auth::guard('company')->check()) {
        $buyer_id = Auth::guard('company')->user()->id;
        $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
    }
    if (Auth::check()) {
        $buyer_id = Auth::user()->id;
        $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
    }
    $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
    $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
    /* ************************ */
    Stripe::setApiKey(Config::get('stripe.stripe_secret'));
    try {
        $charge = Charge::create([
            "amount" => $order_amount * 100,
            "currency" => "USD",
            "source" => $request->input('stripeToken'), // obtained with Stripe.js
            "description" => $description,
        ]);
        if ($charge['status'] == 'succeeded') {
            /**
             * Write Here Your Database insert logic.
             */
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                if ($package->package_for == 'cv_search') {
                    $this->addCompanySearchPackage($company, $package, 'Stripe');
                } else {
                    $this->addCompanyPackage($company, $package, 'Stripe');
                }
            }
            if (Auth::check()) {
                $user = Auth::user();
                $user->transaction = $charge['balance_transaction'];
                $user->update();
                $this->addJobSeekerPackage($user, $package);
            }

            // Redirect to the "invoice" route with the package details
            flash(__('You have successfully subscribed to selected package'))->success();
            //  return redirect()->route('invoice', ['id' => $package->id]);
             return Redirect::route($this->redirectTo);
        } else {
            flash(__('Package subscription failed'));
            return redirect()->route($this->redirectTo);
        }
    } catch (Exception $e) {
        flash($e->getMessage());
        return redirect()->route($this->redirectTo);
    }
}


    public function getInvoice($package_id)
    {
        $package = Package::findOrFail($package_id);
        if(auth()->user()->id){
            $user = Auth::user();
            if($user->package_id !=NULL){
                // $sub_package = Package::findOrFail($user->package_id);
                // if (
                //     ($user->package_end_date != null) &&
                //     ($user->package_end_date->gt(Carbon::now()))
                // ) {
                //     flash(__('You are already Subscribed to '.$sub_package->package_title).' package')->success();
                //     return \Redirect::route('home');
                //     exit;
                // }
            }
        }
        return view('order.invoice')
                        ->with('package', $package)
                        ->with('package_id', $package_id)
                        ->with('user', $user);
    }

    function download($package_id)
    {
        $package = Package::findOrFail($package_id);

        // Load the PDF view and pass the package data
        $pdf = PDF::loadView('order.download', compact('package'));
    
        // Generate a unique filename for the PDF
        $filename = 'invoice_' . $package_id . '.pdf';
    
        // Download the PDF with a specific filename
        return $pdf->download($filename);
    }

    // public function download($package_id){
    //     // $html ='<p>okkokoko</p>';
    //     $html ='';

    //     $package = Package::findOrFail($package_id);
    //     return view('order.invoice',compact('package'));

    //     $package = Package::findOrFail($package_id);
    //     $view = view('order.invoice')->with(compact('package'));
    //     $html .= $view->render();
        
    //     $pdf = PDF::loadHTML($html);


    //     return $pdf->stream('Resume.pdf');
    // }
    public function StripeOrderUpgradePackage(Request $request)
    {

        $package = Package::findOrFail($request->package_id);

        $order_amount = $package->package_price;

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        /*         * ************************* */

        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Upgrade Package') . ':' . $package->package_title;
        /*         * ************************ */
        Stripe::setApiKey(Config::get('stripe.stripe_secret'));
        try {
            $charge = Charge::create(array(
                        "amount" => $order_amount * 100,
                        "currency" => "USD",
                        "source" => $request->input('stripeToken'), // obtained with Stripe.js
                        "description" => $description
            ));
            if ($charge['status'] == 'succeeded') {
                /**
                 * Write Here Your Database insert logic.
                 */
                if (Auth::guard('company')->check()) {
                    $company = Auth::guard('company')->user();
                    if($package->package_for=='cv_search'){
                        $this->updateCompanySearchPackage($company, $package);
                    }else{
                        $this->updateCompanyPackage($company, $package,'Stripe');
                    }
                }
                if (Auth::check()) {
                    $user = Auth::user();              
                    $user->transaction = $charge['balance_transaction'];
                    $user->update();
                    $this->updateJobSeekerPackage($user, $package,'Stripe');
                }
                flash(__('You have successfully subscribed to selected package'))->success();
                // return redirect()->route('invoice', ['id' => $package->id]);
                return Redirect::route($this->redirectTo);
            } else {
                flash(__('Package subscription failed'));
                return Redirect::route($this->redirectTo);
            }
        } catch (Exception $e) {
            flash($e->getMessage());
            return Redirect::route($this->redirectTo);
        }
    }

}
