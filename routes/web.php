<?php

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/home', 'HomeController@index')->name('home');
	//shalu gupta manage officiaial
	Route::get('/departments', ['uses'=>'ManageOfficialsController@departmentview'])->name('departments');
	Route::post('/departments/create',['as'=>'departments_create','uses'=>'ManageOfficialsController@savedepartment']);
	Route::get('/departments/create',['as'=>'departments_create','uses'=>'ManageOfficialsController@savedepartment']);

	Route::get('/manageofficials/editdepartments/{id}',['as'=>'manageofficials.editdepartments','uses'=>'ManageOfficialsController@editdepartments']);

	Route::post('/manageofficials/updatedepartmentdata/{id}',['as'=>'manageofficials.updatedepartmentdata','uses'=>'ManageOfficialsController@updatedepartmentdata']);

	Route::get('/manageofficials/deletedepartments/{id}',['as'=>'manageofficials.deletedepartments','uses'=>'ManageOfficialsController@deletedepartments']);

	// Roles

	    Route::resource('roles', 'RolesController');
	    Route::get('/assignpermission/{id}',['as'=>'assignpermission','uses'=>'AssignPermissionController@index']);
	    Route::post('/assignpermission/store',['as'=>'assignpermission.store','uses'=>'AssignPermissionController@store']);

	// Permission    
	    Route::resource('permissionlist', 'PermissionListController');

	// Employee --SHALU //  

	Route::get('/manageofficials/employeeview',['as'=>'employee','uses'=>'ManageOfficialsController@employeeview']);
	Route::get('/manageofficials/officialsadd',['as'=>'officialsadd','uses'=>'ManageOfficialsController@employeepermissionview']);
	Route::get('/manageofficials/employeeview',['as'=>'employee','uses'=>'ManageOfficialsController@employeeview']);
	Route::get('/manageofficials/officialsadd',['as'=>'officialsadd','uses'=>'ManageOfficialsController@employeepermissionview']);
	Route::post('/manageofficials/saveofficialsdata',['as'=>'saveofficialsdata','uses'=>'ManageOfficialsController@saveemployeesdata']);

	Route::get('/manageofficials/viewoneoffiicals/{id}',['as'=>'viewofficialsdata','uses'=>'ManageOfficialsController@viewoneoemployeepermission']);

	Route::get('/manageofficials/editofficials/{id}',['as'=>'editofficialsdata','uses'=>'ManageOfficialsController@editemployee']);
	Route::post('/manageofficials/updateofficialsdata/{id}',['as'=>'updateofficialsdata','uses'=>'ManageOfficialsController@updateemployee']);

	Route::get('/manageofficials/deleteofficialsdetail/{id}',['as'=>'deleteofficialsdata','uses'=>'ManageOfficialsController@deleteemployee']);

	
});


Route::prefix('client')->group(function () {
Route::get('/', 'ClientController@index')->name('admin.dashboard');
Route::get('/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
Route::post('/login', 'Auth\ClientLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\ClientLoginController@logout')->name('admin.logout');

Route::get('password/reset', 'Auth\ClientForgotPasswordController@showLinkRequestForm')->name('client.password.reset');
Route::post('password/email', 'Auth\ClientForgotPasswordController@sendResetLinkEmail')->name('client.password.reset');
Route::get('password/reset/{token}', 'Auth\ClientResetPasswordController@showResetForm')->name('client.password.reset');
Route::post('password/reset', 'Auth\ClientResetPasswordController@reset')->name('client.password.reset');


});

// APPROVAL FOR EMPLOYEE---SHALU //
// Route::get('/employee/newemployeeclient',array('as'=>'approve.newemployee','uses'=>'EmployeeApprovalController@approveemployeeview'));
Route::get('/employee/newemployeeclient',['as'=>'approve.newemployee','uses'=>'EmployeeApprovalController@approveemployeeview']);

Route::get('/existemployeeclients',['as'=>'approve.existingemployee','uses'=>'EmployeeApprovalController@viewexistingemployee']);
Route::get('/approve/{id}',['as'=>'approve','uses'=>'EmployeeApprovalController@approvenew']);
Route::get('/reject/{id}',['as'=>'reject','uses'=>'EmployeeApprovalController@rejectnew']);
Route::get('/employee/approve/{id}',['as'=>'existing.approve','uses'=>'EmployeeApprovalController@existingApprove']);
Route::get('/employee/reject/{id}',['as'=>'existing.reject','uses'=>'EmployeeApprovalController@existingReject']);
//MANAGE CLIENT---SHALU//
Route::get('/basicdetails',['as'=>'basic.details','uses'=>'ClientDeatilsController@viewlist']);
Route::get('/clientadd',['as'=>'clientadd','uses'=>'ClientDeatilsController@addclient']);
Route::post('/client/saveclient',['as'=>'clientsave','uses'=>'ClientDeatilsController@saveclient']);




Route::get('/dam',['as'=>'dam','uses'=>'ClientDetailsController@damdetails']);
Route::get('/tem',['as'=>'tem','uses'=>'ClientDetailsController@temdetails']);
Route::get('/rec',['as'=>'rec','uses'=>'ClientDetailsController@recdetails']);
Route::get('/escerts',['as'=>'escerts','uses'=>'ClientDetailsController@escertsdetails']);
Route::get('/agsetting',['as'=>'agsetting','uses'=>'ClientDetailsController@agsettingdetails']);
Route::get('/barred',['as'=>'bared.client','uses'=>'ClientDetailsController@barreddetails']);
//APPROVAL FOR CLIENT//
Route::get('/client/new',['as'=>'approve.newclient','uses'=>'ClientApprovalController@approveemployeeview']);

Route::get('/client/existing',['as'=>'approve.existingclient','uses'=>'ClientApprovalController@viewexistingemployee']);


