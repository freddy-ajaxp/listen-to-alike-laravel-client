<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\List_platform;
use App\Http\Middleware;
use Illuminate\Support\Facades\View;
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

//USER


Route::group(['middleware' => 'revalidate'], function()
{
     
    Route::get('/login', function () {
        return view('components/user/view/login');
    })->name('view.login')->middleware('sessionvalidator');


    Route::get('/dashboard', function (Request $request) {
        // dd($request->session()->get('newNotification'));
        return view('components/user/view/dashboard');
    })->middleware(['sessionvalidator', 'notificationchecker']);

    Route::get('/admin', function () {
        $data['main'] = 'links';
        $data['platforms'] = List_platform::get();
        return view('components/admin/view/links')->with('components', $data);
    })->middleware('sessionvalidator');
});

Route::get('/', function () {
    return redirect("/landing");
});

Route::get('/landing', function (Request $request) {    
    // $view = (string)View::make('users.index',$data);
    return view('components/user/view/landing')->with(['userIsLoggedIn' => $request->session()->get('email')]);
})->middleware(['notificationchecker']);

Route::get('/register', function () {
    return view('components/user/view/register');
})->middleware('sessionvalidator');

Route::get('/logout', function (Request $request) {
    $request->session()->forget('email');
        $request->session()->forget('id');
        $request->session()->forget('admin');
        return redirect('/landing');
});

Route::get('/preview/{short_link}', 'ListPlatformController@preview');
Route::get('/detail/{short_link}', 'ListPlatformController@detail')->middleware('sessionvalidator');
Route::get('/getCountLinkChart', 'ListPlatformController@getCountLinkChart')->middleware('sessionvalidator');
Route::post('/click', 'ListPlatformController@viewCtr');
Route::post('/savePreSignup', 'ListPlatformController@savePreSignup');
Route::post('/report', 'ListPlatformController@report');


// Route::get('dynamic-field', 'ListPlatformController@index');

Route::post('dynamic-field/insert', 'ListPlatformController@insert')->name('dynamic-field.insert');
Route::post('dynamic-field/upsert', 'ListPlatformController@upsert')->name('dynamic-field.upsert');

Route::get('links/platforms', 'ListPlatformController@getAllPlatforms');
Route::post('user/login', 'UserController@login');
Route::post('user/register', 'UserController@register');
Route::get('user/logout', 'UserController@logout');
Route::get('user/profile', 'ListPlatformController@profile')->middleware('sessionvalidator');
Route::get('user/notifikasi', 'ListPlatformController@notifikasi')->middleware('sessionvalidator');
Route::post('user/changePassword', 'UserController@changePassword');
Route::post('user/changeUsername', 'UserController@changeUsername');

//PARTIAL VIEW
Route::get('table/delete-confirmation', 'ListPlatformController@deleteModal')->name('table.modal-delete');
Route::get('table/custom-confirmation', 'ListPlatformController@customModal')->name('table.modal-custom');
Route::get('table/add-modal', 'ListPlatformController@addModal')->name('table.modal-add');
Route::get('partial/view-select', 'ListPlatformController@viewSelect');

//AJAX TABLE
Route::get('table/getAllLinks', 'TableController@getAllLinks')->name('table.all-links');
Route::get('table/getAllNotifications', 'TableController@getAllNotifications')->name('table.all-notifications');
Route::post('table/getLinksById', 'TableController@getLinksById')->name('table.get-link-by-id');
Route::post('table/dummy', 'TableController@dummy')->name('table.dummy');
Route::post('table/deleteLinkById', 'ListPlatformController@deleteLinkById')->name('table.delete-link');
Route::post('table/custom', 'TableController@patchCustomLink')->name('table.custom-link');


//ADMIN

Route::get('/admin/userList', function () {
    $data['main'] = 'links';
    return view('components/admin/view/users')->with('components', $data);
})->middleware('sessionvalidator');

Route::get('/admin/reportList', function () {
    $data['main'] = 'links';
    return view('components/admin/view/reports');
})->middleware('sessionvalidator');

Route::get('/admin/reportConfig', function () {
    return view('components/admin/view/report-config');
})->middleware('sessionvalidator');

Route::get('/admin/setting', function () {
    return view('components/admin/view/setting');
})->middleware('sessionvalidator');

Route::get('/admin/platform', function () {
    return view('components/admin/view/platform');
})->middleware('sessionvalidator');

Route::get('/admin/text', function () {
    return view('components/admin/view/text');
})->middleware('sessionvalidator');


Route::post('admin/addPlatform', 'AdminController@addPlatform')->name('admin.add-platform');
Route::post('admin/addText', 'AdminController@addText')->name('admin.add-text');
Route::post('admin/addReason', 'AdminController@addReason')->name('admin.add-reason');
Route::post('admin/deletePlatform', 'AdminController@deletePlatform')->name('admin.delete-platform');
Route::post('admin/deleteReason', 'AdminController@deleteReason')->name('admin.delete-reason');
Route::get('admin/getAllLinks', 'AdminController@getAllLinks')->name('admin.all-links');
Route::get('admin/getUserDataById/{id}', 'AdminController@getUserDataById')->name('admin.user-data');
Route::get('admin/getUserLinkList/{id_user}', 'AdminController@getUserLinkList')->name('admin.user-datatable');
Route::get('admin/datatables', 'AdminController@datatables')->name('admin.datatables');
Route::post('admin/deleteLink', 'AdminController@deleteLink')->name('admin.delete-link');
Route::post('admin/banLink', 'AdminController@banLink')->name('admin.ban-link');
Route::post('admin/pulihkanLink', 'AdminController@pulihkanLink')->name('admin.pulihkan-link');
Route::post('admin/deleteUser', 'AdminController@deleteUser')->name('admin.delete-user');

Route::get('admin/getAllUsers', 'AdminController@getAllUsers')->name('admin.all-users');
Route::get('admin/getAllReports', 'AdminController@getAllReports')->name('admin.all-reports');
Route::get('admin/getReportByLink', 'AdminController@getReportByLink')->name('admin.reports-by-link');
Route::get('admin/getAllPlatforms', 'AdminController@getAllPlatforms')->name('admin.all-platforms');
Route::get('admin/getAllReasons', 'AdminController@getAllReasons')->name('admin.all-reasons');
Route::post('admin/publishPlatform', 'AdminController@publishPlatform');
Route::post('admin/hidePlatform', 'AdminController@hidePlatform');



Route::get('admin/getAllTexts', 'AdminController@getAllTexts')->name('admin.all-texts');
Route::get('admin/modal/delete-link', 'AdminController@deleteLinkModal');
Route::get('admin/modal/delete-platform', 'AdminController@deletePlatformModal');
Route::get('admin/modal/delete-reason', 'AdminController@deleteReasonModal');
Route::get('admin/modal/delete-user', 'AdminController@deleteUserModal');
Route::get('admin/modal/reset-pwd', 'AdminController@resetPwdModal');
Route::get('admin/modal/edit-platform', 'AdminController@editPlatformModal');
Route::get('admin/modal/edit-reason', 'AdminController@editReasonModal');
Route::get('admin/modal/edit-text', 'AdminController@editTextModal');
Route::get('admin/modal/delete-text', 'AdminController@deleteTextModal');
Route::get('admin/modal/ban-link', 'AdminController@banLinkModal');
Route::get('admin/modal/report-info', 'AdminController@reportInfoModal');
Route::post('admin/deleteText', 'AdminController@deleteText');
Route::post('admin/editPlatform', 'AdminController@editPlatform');
Route::post('admin/editReason', 'AdminController@editReason');
Route::get('admin/editText', 'AdminController@editText');
Route::post('admin/resetPassword', 'AdminController@resetPassword')->name('admin.reset-pwd');
Route::post('admin/setPrivilege', 'AdminController@setPrivilege');




Route::get('dummy', 'ListPlatformController@dummy');
Route::get('dummysoftdelete', 'ListPlatformController@dummysoftdelete');
Route::get('dummyshowsoftdelete', 'ListPlatformController@dummyshowsoftdelete');
