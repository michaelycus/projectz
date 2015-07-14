<?php

Route::resource('videos', 'VideoController');
Route::resource('articles', 'ArticleController');
Route::resource('posts', 'PostController');
Route::resource('comments', 'CommentController');
Route::resource('profiles', 'ProfileController');
Route::resource('reviews', 'ReviewController');
Route::resource('teams', 'TeamController');

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

Route::get('testes', function(){

    class Teste{

        function imprime(){
            echo 'testando...';
        }
    }

    $str = 'Teste';

    $teste = new $str;

    echo $teste->imprime();
});
