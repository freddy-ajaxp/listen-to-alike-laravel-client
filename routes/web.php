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

//VIEW ONLY START

Route::get('/', function () {
    // return view('welcome');
    return redirect("/landing");
});

Route::get('/landing', function () {
    // return view('layouts/dummy')->with('components', ['data'=>'dmmmyy']);
    return view('components/user/view/landing');
});

Route::get('/dashboard', function () {
    return view('components/user/view/dashboard');
})->middleware('sessionvalidator');

Route::get('/login', function () {
    return view('components/user/view/login');
})->name('view.login');

Route::get('/register', function () {
    return view('components/user/view/register');
});

Route::get('/logout', function (Request $request) {
    $request->session()->forget('email');
    return redirect('/landing');
});

//admin
Route::get('/admin', function () {
    $data['main'] = 'links';
    return view('components/admin/view/links')->with('components', $data);
    // return view('components/admin/view/datatables')->with('components', $data);
})->middleware('sessionvalidator');

Route::get('/admin/userList', function () {
    $data['main'] = 'links';
    return view('components/admin/view/users')->with('components', $data);
})->middleware('sessionvalidator');

Route::get('/admin/setting', function () {
    $data['main'] = 'links';
    return view('components/admin/view/setting')->with('components', $data);
})->middleware('sessionvalidator');

//VIEW ONLY END




Route::get('/preview/{short_link}', 'ListPlatformController@preview');

// Route::get('dynamic-field', 'ListPlatformController@index');

Route::post('dynamic-field/insert', 'ListPlatformController@insert')->name('dynamic-field.insert');
Route::post('dynamic-field/upsert', 'ListPlatformController@upsert')->name('dynamic-field.upsert');

Route::get('links/platforms', 'ListPlatformController@getAllPlatforms');
Route::post('user/login', 'UserController@login');
Route::post('user/register', 'UserController@register');
Route::get('user/logout', 'UserController@logout');

//AJAX TABLE
Route::get('table/getAllLinks', 'TableController@getAllLinks')->name('table.all-links');
Route::post('table/getLinksById', 'TableController@getLinksById')->name('table.get-link-by-platform');
Route::post('table/deleteLinkById', 'ListPlatformController@deleteLinkById')->name('table.delete-link');
Route::post('table/custom', 'TableController@patchCustomLink')->name('table.custom-link');


//ADMIN
Route::post('admin/addPlatform', 'AdminController@addPlatform')->name('admin.add-platform');
Route::post('admin/deletePlatform', 'AdminController@deletePlatform')->name('admin.delete-platform');
Route::get('admin/getAllLinks', 'AdminController@getAllLinks')->name('admin.all-links');
Route::get('admin/datatables', 'AdminController@datatables')->name('admin.datatables');
Route::post('admin/deleteLink', 'AdminController@deleteLink')->name('admin.delete-link');
Route::post('admin/deleteUser', 'AdminController@deleteUser')->name('admin.delete-user');
Route::get('admin/getAllUsers', 'AdminController@getAllUsers')->name('admin.all-users');
Route::get('admin/getAllPlatforms', 'AdminController@getAllPlatforms')->name('admin.all-platforms');
