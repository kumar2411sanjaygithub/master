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
   // Route::get('/ppa/addppadetails',['as'=>'addppadetails','uses'=>'PpaDetailsController@addppadetails']);
  Route::post('/ppa/addppadetails',['as'=>'addppadetails','uses'=>'PpaDetailsController@saveppa']);
 	Route::get('/ppa/addppadetails',['as'=>'addppadetailss','uses'=>'PpaDetailsController@ppadetails']);
  Route::get('/ppa/editppa/{id}',['as'=>'ppa.editppa','uses'=>'PpaDetailsController@editppa']);
  Route::post('/ppa/updateppadata/{id}',['as'=>'ppa.updateppadata','uses'=>'PpaDetailsController@updateppadata']);
  Route::get('/ppa/deleteppa/{id}',['as'=>'deleteppa','uses'=>'PpaDetailsController@deleteppa']);

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
Route::get('/noc_discom_s',['as'=>'noc_discom_s','uses'=>'ClientDeatilsController@search_discom']);
Route::post('/client/saveclient',['as'=>'clientsave','uses'=>'ClientDeatilsController@saveclient']);

//CLIENT-BANK----SHALU//
Route::get('/bankdetails/{id}',['as'=>'bankdetails','uses'=>'ClientDeatilsController@bankdetails']);
Route::post('/bank_create',['as'=>'bank_create','uses'=>'ClientDeatilsController@add_bankdetails']);
Route::get('/editbankdetail/{id}/eid/{eid}',['as'=>'editbankdetail','uses'=>'ClientDeatilsController@edit_bankdetails']);
Route::post('/bank_edit/{id}',['as'=>'bank_edit','uses'=>'ClientDeatilsController@update_bankdetails']);
Route::get('/delete/bank/{id}',['as'=>'bankdelete','uses'=>'ClientDeatilsController@delete_bankdetails']);


//EXCHANGE----SHALU//
Route::get('/exchangedetails/{id}',['as'=>'exchangedetails','uses'=>'ExchangeController@exchangedetails']);
Route::post('/exchange_create',['as'=>'exchange_create','uses'=>'ExchangeController@add_exchangedetails']);
Route::get('/editexchangedetail/{id}/eid/{eid}',['as'=>'editexchangedetail','uses'=>'ExchangeController@edit_exchangedetails']);
Route::post('/exchange_edit/{id}',['as'=>'exchange_edit','uses'=>'ExchangeController@update_exchangedetails']);
Route::get('/delete/exchange/{id}',['as'=>'exchangedelete','uses'=>'ExchangeController@delete_exchangedetails']);

//CONTACT----SHALU//
Route::get('/contactdetails/{id}',['as'=>'contactdetails','uses'=>'ContactController@contactdetails']);
Route::post('/contact_create',['as'=>'contact_create','uses'=>'ContactController@add_contactdetails']);
Route::get('/editcontactdetail/{id}/eid/{eid}',['as'=>'editcontactdetail','uses'=>'ContactController@edit_contactdetails']);
Route::post('/contact_edit/{id}',['as'=>'contact_edit','uses'=>'ContactController@update_contactdetails']);
Route::get('/delete/contact/{id}',['as'=>'contactdelete','uses'=>'ContactController@delete_contactdetails']);









Route::get('/dam',['as'=>'dam','uses'=>'ClientDetailsController@damdetails']);
Route::get('/tem',['as'=>'tem','uses'=>'ClientDetailsController@temdetails']);
Route::get('/rec',['as'=>'rec','uses'=>'ClientDetailsController@recdetails']);
Route::get('/escerts',['as'=>'escerts','uses'=>'ClientDetailsController@escertsdetails']);
Route::get('/agsetting',['as'=>'agsetting','uses'=>'ClientDetailsController@agsettingdetails']);
Route::get('/barred',['as'=>'bared.client','uses'=>'ClientDetailsController@barreddetails']);
//APPROVAL FOR CLIENT//
Route::get('/client/new',['as'=>'approve.newclient','uses'=>'ClientApprovalController@approvenew']);

Route::get('/client/existing',['as'=>'approve.existingclient','uses'=>'ClientApprovalController@approveexisting']);

Route::get('/status/{id}/{type}',['as'=>'approve.status','uses'=>'ClientApprovalController@status']);
Route::get('/bankapproval/{id}',['as'=>'bankapproval','uses'=>'ClientApprovalController@bankapproval']);
Route::get('/add/{id}/{type}/{type2}',['as'=>'add.approve','uses'=>'ClientApprovalController@addapprove']);
Route::get('/modified/{id}/{type}/',['as'=>'modified.approve','uses'=>'ClientApprovalController@modified']);
Route::get('/deletebank/{id}/{type}/{type2}',['as'=>'deletebank.approve','uses'=>'ClientApprovalController@deletebank']);


Route::get('/exchangeapproval/{id}',['as'=>'exchangeapproval','uses'=>'ExchangeApprovalController@exchangeapproval']);
Route::get('/addexchange/{id}/{type}/{type2}',['as'=>'addexchange.approve','uses'=>'ExchangeApprovalController@addapprove']);
Route::get('/exchange/modified/{id}/{type}/',['as'=>'modifiedexchange.approve','uses'=>'ExchangeApprovalController@modified']);
Route::get('/delete_exchange/{id}/{type}/{type2}',['as'=>'deleteexchange.approve','uses'=>'ExchangeApprovalController@delete_exchange']);

Route::get('/contact/approval/{id}',['as'=>'contactapproval','uses'=>'ContactApprovalController@contactapproval']);
Route::get('/addcontact/{id}/{type}/{type2}',['as'=>'addcontact.approve','uses'=>'ContactApprovalController@addapprove']);
Route::get('/contact/modified/{id}/{type}/',['as'=>'modifiedcontact.approve','uses'=>'ContactApprovalController@modified']);
Route::get('/delete_contact/{id}/{type}/{type2}',['as'=>'deletecontact.approve','uses'=>'ContactApprovalController@delete_contact']);









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

