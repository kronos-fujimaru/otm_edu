<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class OpsAuthController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // /**
    //  * Handle a login request to the application.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function postLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         $this->loginUsername() => 'required', 'password' => 'required',
    //     ]);
    //
    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.
    //     $throttles = $this->isUsingThrottlesLoginsTrait();
    //
    //     if ($throttles && $this->hasTooManyLoginAttempts($request)) {
    //         return $this->sendLockoutResponse($request);
    //     }
    //
    //     $credentials = $this->getCredentials($request);
    //     if (Auth::attempt($credentials, $request->has('remember'))) {
    //         return $this->handleUserWasAuthenticated($request, $throttles);
    //     }
    //
    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     if ($throttles) {
    //         $this->incrementLoginAttempts($request);
    //     }
    //     return redirect($this->loginPath())
    //         ->withInput($request->only($this->loginUsername(), 'remember'))
    //         ->withErrors([
    //             $this->loginUsername() => $this->getFailedLoginMessage(),
    //         ]);
    // }


    // /**
    //  * Send the response after the user was authenticated.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  bool  $throttles
    //  * @return \Illuminate\Http\Response
    //  */
    // protected function handleUserWasAuthenticated(Request $request, $throttles)
    // {
    //     if ($throttles) {
    //         $this->clearLoginAttempts($request);
    //     }
    //
    //     if (method_exists($this, 'authenticated')) {
    //         return $this->authenticated($request, Auth::user());
    //     }
    //     return redirect()->intended($this->redirectPath());
    // }


    protected $redirectAfterLogout = "/auth/login";
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if(Auth::user() == null){
            return "/auth/login";
        }
        $redirectPath = "/participant";
        if(Auth::user()->isAdmin()){
            $redirectPath = "/admin";
        }else if(Auth::user()->isManager()){
            $redirectPath = "/manager";
        }
        return $redirectPath;
    }

}
