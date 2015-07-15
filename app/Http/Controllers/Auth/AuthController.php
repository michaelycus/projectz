<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Support\Facades\Auth as Auth;

class AuthController extends Controller
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

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/dashboard';
    protected $redirectAfterLogout = '/auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['first_name'] .' '. $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return $this->socialite->with($provider)->redirect();
    }

    public function getSocialAuthCallback2($provider=null)
    {
        $socialize_user = $this->socialite->with($provider)->user();

        $provider_user_id = $socialize_user->getId(); // unique provider user id

        $profile = Profile::where('provider_user_id', $provider_user_id)->first();

        // register (if no user)
        if (!$profile) {

            $profile = new Profile;
            $profile->provider_user_id =  $provider_user_id;



            $user = new User;
            $user->facebook_user_id = $provider_user_id;
            $user->email = $socialize_user->user['email'];
            $user->first_name = $socialize_user->user['first_name'];
            $user->last_name = $socialize_user->user['last_name'];
            $user->name = $socialize_user->user['name'];
            $user->save();
        }

        // login
        Auth::loginUsingId($user->id);

        return redirect('dashboard');
    }

    public function getSocialAuthCallback($provider=null)
    {
        $socialize_user = $this->socialite->with($provider)->user();

        $facebook_user_id = $socialize_user->getId(); // unique facebook user id

        $user = User::where('facebook_user_id', $facebook_user_id)->first();

        // register (if no user)
        if (!$user) {
            $user = new User;
            $user->facebook_user_id = $facebook_user_id;
            $user->email = $socialize_user->user['email'];
            $user->first_name = $socialize_user->user['first_name'];
            $user->last_name = $socialize_user->user['last_name'];
            $user->name = $socialize_user->user['name'];
            $user->save();
        }

        // login
        Auth::loginUsingId($user->id);

        return redirect('dashboard');
    }
}
