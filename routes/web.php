<?php

use App\Mail\sendMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Notable Features In Laravel 7
 * 1.the route matching will be twice faster than laravel 6 when using route:cache 
 *   php artisan route:cache
 *   if your application using controller based routes. It help for fast execution. But remember "Closure based routes cannot be cached" So kindly convert your Closure routes to controller classes
 * 2.Customizable Stubs with command of stub:publish
 * 3.View Cache Optimization 
 *   there will be a new config option called expires inside view.php
 * 4.Dynamic Storage Links
 *   php artisan storage:link was liking to public directory by default . but in laravel 7 developers will define there own storage links dirs into config/filesystems.php file in links array.
 */


// 5. Blade X component syntax
Route::get('/', 'ProfileController@welcome');
Route::get('/author/{author?}', 'ProfileController@welcome');

// 6. Custom Cast Types 
Route::get('createProfile', 'ProfileController@store');

// 7. Guzzle Abstraction
Route::get('/http', 'ProfileController@httpGuzzle');

Route::get('/getProfile', 'ProfileController@getProfile');

// Route Model Binding Improvements
// Key Customization
Route::get('/users/{user}', function (App\User $user) {
   return $user;
});
// Automatic Scope
Route::get('/users/{user}/profiles/{profile}', function (App\User $user, App\Profile $profile) {
   return $user . ' ' . $profile;
});

Route::get('/fluentString','ProfileController@fluentString');
Route::get('/multipleMailer','ProfileController@multipleMailer');

Route::get('/mailMarkdown',function(){
   return new sendMail();
});
