<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Package;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;

use App\Mail\UserRegisteredMailable;
use Mail;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function register(UserFrontRegisterFormRequest $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = 1;
        $user->verified = 0;

        $package = Package::find(7);

        if ($package) {
            $user['package_id'] = $package->id;
            $user['package_start_date'] = now(); 
            $user['package_end_date'] = now()->addDays($package->package_num_days);
            $user['jobs_quota'] = $package->package_num_listings;
        }
        $user->save();
        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        /*         * *********************** */
        event(new Registered($user));
        event(new UserRegistered($user));

        Mail::to($user->email)->send(new UserRegisteredMailable($user));

        $this->guard()->login($user);
        UserVerification::generate($user);
        UserVerification::send($user, 'User Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

}
