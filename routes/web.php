<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/about', function() {
// 	return 'Hello Worls';
// });

// Route::get('/', 'PagesController@index');
Route::get('/', 'PostsController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

// Hack, after callback from RZP. Also, it returns multiple api calls to put dashboard
Route::put('/dashboard', function () {
    return redirect()->to('/dashboard');
});

Route::get('/user/{id}', 'UserController@show');

Route::get('/all_posts', 'PostsController@all_posts')->name('all_posts');

Route::resource('posts', 'PostsController');

// Route::get('/', function(){
// 	$visits = Redis::incr('visits'); 
//     return $visits;
// });


Route::get('/create_order', 'PaymentController@store');
Route::put('/create_payment', 'PaymentController@update');