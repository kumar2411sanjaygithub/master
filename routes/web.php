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

//Route::get('/home', 'HomeController@index')->name('home');

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


	// Employee


	Route::get('/manageofficials/employeeview',['as'=>'employee','uses'=>'ManageOfficialsController@employeeview']);
	Route::get('/manageofficials/officialsadd',['as'=>'officialsadd','uses'=>'ManageOfficialsController@employeepermissionview']);
	Route::get('/manageofficials/employeeview',['as'=>'employee','uses'=>'ManageOfficialsController@employeeview']);
	Route::get('/manageofficials/officialsadd',['as'=>'officialsadd','uses'=>'ManageOfficialsController@employeepermissionview']);
	Route::post('/manageofficials/saveofficialsdata',['as'=>'saveofficialsdata','uses'=>'ManageOfficialsController@saveemployeesdata']);

	Route::get('/manageofficials/viewoneoffiicals/{id}',['as'=>'viewofficialsdata','uses'=>'ManageOfficialsController@viewoneoemployeepermission']);

	Route::get('/manageofficials/editofficials/{id}',['as'=>'editofficialsdata','uses'=>'ManageOfficialsController@editemployee']);
	Route::post('/manageofficials/updateofficialsdata/{id}',['as'=>'updateofficialsdata','uses'=>'ManageOfficialsController@updateemployee']);

	Route::get('/manageofficials/deleteofficialsdetail/{id}',['as'=>'deleteofficialsdata','uses'=>'ManageOfficialsController@deleteemployee']);


		// PPA Bid Setting
  Route::post('/ppa/addppadetails',['as'=>'addppadetails','uses'=>'PpaDetailsController@saveppa']);
 	Route::get('/ppa/addppadetails',['as'=>'addppadetailss','uses'=>'PpaDetailsController@ppadetails']);
  Route::get('/ppa/editppa/{id}',['as'=>'ppa.editppa','uses'=>'PpaDetailsController@editppa']);
  Route::post('/ppa/updateppadata/{id}',['as'=>'ppa.updateppadata','uses'=>'PpaDetailsController@updateppadata']);
  Route::get('/ppa/deleteppa/{id}',['as'=>'deleteppa','uses'=>'PpaDetailsController@deleteppa']);

// ValidationSetting
Route::get('/validationSetting/validationSetting',['as'=>'validationSetting','uses'=>'ValidationSettingController@validationsettingview']);
Route::post('/validationSetting/validationSetting',['as'=>'addppadetails','uses'=>'ValidationSettingController@savevalidationsetting']);
Route::get('/deleteeditvalidationsetting/{id}',['as'=>'deleteeditvalidationsetting','uses'=>'ValidationSettingController@deletevalidation']);
Route::get('/editvalidationsetting/{id}',['as'=>'editvalidationsetting','uses'=>'ValidationSettingController@editvalidationsetting']);
Route::post('updateValidationSetting/{id}',['as'=>'updateValidationSetting','uses'=>'ValidationSettingController@updateValidationSetting']);

// PSM
Route::get('/psm/psmdetails',['as'=>'psmdetials','uses'=>'PsmdetailsController@viewclient']);
Route::post('/psm/psmdetails/{id}',['as'=>'addpsmdetails','uses'=>'PsmdetailsController@addpsmdetailssubmit']);
Route::get('/deletepsmdetails/{id}',['as'=>'deletepsm','uses'=>'PsmdetailsController@deletepaymentsecuritymargin']);
Route::get('/editpsmdetails/{id}/{client_id}',['as'=>'editpsmdetails','uses'=>'PsmdetailsController@editpsmdetails']);
Route::post('updatepsm/{id}',['as'=>'updatepsm','uses'=>'PsmdetailsController@updatepsm']);
Route::get('/psm/psmdetails/{id}',['as'=>'psmdata','uses'=>'PsmdetailsController@findPsmData']);
Route::post('addpsmexposure/{id}',['as'=>'addpsmexposure','uses'=>'PsmdetailsController@addpsmexposure']);
Route::get('/editexposure/{id}/{client_id}',['as'=>'editexposure','uses'=>'PsmdetailsController@editexposure']);




  // bid setting
  Route::get('/ppa/bidsetting',['as'=>'bid.bidview','uses'=>'PpaDetailsController@viewbidsetting']);
  Route::post('/ppa/bidsetting',['as'=>'addbidsetting','uses'=>'PpaDetailsController@addbidsetting']);
  Route::get('/ppa/biddata',['as'=>'biddata','uses'=>'PpaDetailsController@findBidData']);

  // POC & DISCOM LOSSES
  Route::get('/poc',['as'=>'pocdetails','uses'=>'PocController@viewpocdetails']);
  Route::post('/poc',['as'=>'addpoc','uses'=>'PocController@savepoc']);
  Route::get('/poc/{id}',['as'=>'poc.editpoc','uses'=>'PocController@editpoc']);
  Route::post('/updatepoc/{id}',['as'=>'poc.updatepoc','uses'=>'PocController@updateppadata']);
  Route::get('/poc/deleteppa/{id}',['as'=>'deletepoc','uses'=>'PocController@deletepoc']);

  Route::get('/discom',['as'=>'discomdetails','uses'=>'DiscomController@viewdiscomdetails']);
  Route::post('/discom',['as'=>'adddiscom','uses'=>'DiscomController@savediscom']);
  Route::get('/discom/{id}',['as'=>'discom.editdiscom','uses'=>'DiscomController@editdiscom']);
  Route::post('/updatediscom/{id}',['as'=>'poc.updatediscom','uses'=>'DiscomController@updatediscomdata']);
  Route::get('/discom/deletediscom/{id}',['as'=>'deletediscom','uses'=>'DiscomController@deletediscom']);

	 Route::resource('lead', 'LeadController');
	 Route::post('/task-lead','LeadController@taskadd');
	 Route::get('/task-delete/{id}','LeadController@taskdelete');
	 Route::post('/task-update/{id}','LeadController@taskupdate');
	 Route::post('/product-lead','LeadController@productadd');
	 Route::get('/leadproduct-delete/{id}','LeadController@leadproduct_delete');
	 Route::post('/lead-email-add','LeadController@lead_email_add');
	 Route::get('/lead-email-delete/{id}','LeadController@lead_email_delete');
	 Route::resource('discom-sldc-state', 'DiscomSLDCController');
	 Route::get('/discom-sldc-state/delsldc/{id}/e_del/{eid}','DiscomSLDCController@delsldc');
	 Route::get('/discom-sldc-state/deldiscom/{id}/e_del/{eid}','DiscomSLDCController@deldiscom');
	 Route::get('/discom-sldc-state/delvoltage/{id}/e_del/{eid}','DiscomSLDCController@delvoltage');

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



});

	// Client Login

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
