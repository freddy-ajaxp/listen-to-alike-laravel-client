<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect("/landing");
});

Route::get('/landing', function () {
    return view('layouts/landing');
});

Route::get('/dashboard', function () {
    return view('layouts/dashboard');
})->middleware('sessionvalidator');

Route::get('/login', function () {
    return view('layouts/login');
})->name('view.login')->middleware('sessionvalidator');

Route::get('/register', function () {
    return view('layouts/register');
})->middleware('sessionvalidator');

Route::get('/logout', function (Request $request) {
    $request->session()->forget('email');
    return redirect('/landing');
});

Route::get('/preview', function () {
    return view('layouts/preview');
});
Route::get('/previewData/{short_link}', 'ListPlatformController@preview');

// Route::get('dynamic-field', 'ListPlatformController@index');

Route::post('dynamic-field/insert', 'ListPlatformController@insert')->name('dynamic-field.insert');
Route::post('dynamic-field/upsert', 'ListPlatformController@upsert')->name('dynamic-field.upsert');


//
Route::get('links/platforms', 'ListPlatformController@getAllPlatforms');
// Route::get('links/user/{id}', 'ListPlatformController@postLink'); done
// Route::post('links/userP/{id}', 'ListPlatformController@patchLink'); done
// Route::post('links/submit', 'ListPlatformController@patchCustomLink');
// Route::patch('links/custom/{id}', 'ListPlatformController@getLink');
// Route::delete('links/link/{id}', 'ListPlatformController@deleteLink');
// Route::patch('links/link/{id}', 'ListPlatformController@getLinksByUserId');
// Route::get('links/linkSlug', 'ListPlatformController@getLinksByUserIdPagination');
// Route::get('/', 'ListPlatformController@getAllPlatforms');   

//dummy 
Route::post('dummy/checkvalue','ListPlatformController@dummy')->name('dummy');

Route::post('user/login','UserController@login');
Route::post('user/register','UserController@register');
Route::get('user/logout','UserController@logout');

//AJAX TABLE
Route::get('table/getAllLinks','TableController@getAllLinks')->name('table.all-links');
Route::post('table/getLinksById','TableController@getLinksById')->name('table.get-link-by-platform');
Route::post('table/deleteLinkById','ListPlatformController@deleteLinkById')->name('table.delete-link');
Route::post('table/custom', 'TableController@patchCustomLink')->name('table.custom-link');