<?php


//Route::get('videos/state/{?state}', [
//    'as' => 'profile', 'uses' => 'UserController@showProfile'
//]);

Route::resource('videos', 'VideoController');
//Route::get('videos/state/{state}', 'VideoController@getByState');

Route::resource('articles', 'ArticleController');
Route::resource('posts', 'PostController');
Route::resource('comments', 'CommentController');
Route::resource('profiles', 'ProfileController');


Route::get('dashboard', 'DashboardController@index');

Route::get('logout', function()
{
    Auth::logout();

    return redirect('/');
});

Route::get('/', function(){
    if (Auth::check()){
        return redirect('dashboard');
    }else{
        return redirect('auth/login');
    }
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Social Login
Route::get('/login/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);

Route::get('/login/callback/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);

//Route::get('/', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
//{
//    if (Auth::check())
//    {
//        return redirect('dashboard');
//    }
//    else
//    {
//        // Send an array of permissions to request
//        $login_url = $fb->getLoginUrl(['email']);
//
//        // Obviously you'd do this in blade :)
//        //echo '<a href="' . $login_url . '">Login with Facebook</a>';
//
//        return view('sign.signin')->with('login_url', $login_url);
//    }
//});


// Endpoint that is redirected to after an authentication attempt
//Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
//{
//    // Obtain an access token.
//    try
//    {
//        $token = $fb->getAccessTokenFromRedirect();
//    }
//    catch (Facebook\Exceptions\FacebookSDKException $e)
//    {
//        dd($e->getMessage());
//    }
//
//
//    // Access token will be null if the user denied the request
//    // or if someone just hit this URL outside of the OAuth flow.
//    if (! $token)
//    {
//        // Get the redirect helper
//        $helper = $fb->getRedirectLoginHelper();
//
//        if (! $helper->getError())
//        {
//            abort(403, 'Unauthorized action.');
//        }
//
//        // User denied the request
//        dd(
//            $helper->getError(),
//            $helper->getErrorCode(),
//            $helper->getErrorReason(),
//            $helper->getErrorDescription()
//        );
//    }
//
//
//    if (! $token->isLongLived())
//    {
//        // OAuth 2.0 client handler
//        $oauth_client = $fb->getOAuth2Client();
//
//        // Extend the access token.
//        try
//        {
//            $token = $oauth_client->getLongLivedAccessToken($token);
//        } catch (Facebook\Exceptions\FacebookSDKException $e) {
//            dd($e->getMessage());
//        }
//    }
//
//
//    $fb->setDefaultAccessToken($token);
//
//    // Save for later
//    Session::put('fb_user_access_token', (string) $token);
//
//    // Get basic info on the user from Facebook.
//    try
//    {
//        $response = $fb->get('/me?fields=id,name,first_name,last_name,email');
//
//    }
//    catch (Facebook\Exceptions\FacebookSDKException $e)
//    {
//        dd($e->getMessage());
//    }
//
//
//    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
//    $facebook_user = $response->getGraphUser();
//
//    // Create the user if it does not exist or update the existing entry.
//    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
//    $user = App\User::createOrUpdateGraphNode($facebook_user);
//
//    // Log the user into Laravel
//    Auth::login($user);
//
//    return redirect('/dashboard');
//});



