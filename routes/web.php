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

//Noc Application & Bill Setting & Approval
//Route::resource('noc-application', 'NocAppController');
Route::get('/noc-applications',['as'=>'noc-applications.index','uses'=>'NocAppController@index']);

 Route::post('/noc-applicationn',['as'=>'noc-applicationn.nocstore','uses'=>'NocAppController@nocstore']);
Route::get('/client/search',['as'=>'clientSearch','uses'=>'NocAppController@clientSearch']);
Route::get('/getclientData/{id}',['as'=>'getclientData','uses'=>'NocAppController@clientData']);

Route::get('/noc-application-approval',['as'=>'nocapplicationapproval','uses'=>'NocAppController@nocApproval']);
Route::delete('/noc-approval-request/{id}/status/{status_id}',['as'=>'nocapprovalRequest','uses'=>'NocAppController@nocApprovalReq']);
Route::post('/add-payment',['as'=>'add-payment','uses'=>'NocAppController@addPayment']);
Route::get('/generateNocPDF/{id}',['as'=>'NocPdf','uses'=>'NocAppController@generateNocPdf']);
Route::delete('/noc-pdf-delete/{id}',['as'=>'nocpdfdelete','uses'=>'NocAppController@nocPdfDelete']);
Route::get('/noc/edit/{id}',['as'=>'nocedit','uses'=>'NocAppController@editnoc']);
Route::post('/noc/update/{id}',['as'=>'nocupdate','uses'=>'NocAppController@updatenoc']);
Route::get('/noc/email/{id}/client/{c_id}',['as'=>'nocemail','uses'=>'NocAppController@emailnoc']);
Route::get('/generatesldcPDF/{id}/client/{c_id}',['as'=>'NocPdf','uses'=>'NocAppController@generateSldcPdf']);
Route::get('/generatediscomPDF/{id}/client/{c_id}',['as'=>'NocDisocmPdf','uses'=>'NocAppController@generateDiscomPdf']);

Route::delete('/noc-request/{id}/status/{status_id}',['as'=>'nocRequest','uses'=>'NocAppController@nocReq']);
Route::get('/noc/email-debit/{id}/client/{c_id}',['as'=>'noc-debit-email','uses'=>'NocAppController@emailDebitNoc']);


Route::get('/noc/billingsetting',['as'=>'billsetting.nocbilllist','uses'=>'NocAppController@nocbilllist']);
Route::get('/noc_discom_search',['as'=>'noc_discom_search','uses'=>'NocAppController@nocbillsearch']);
Route::post('/noc-billing/create',['as'=>'noc_billing.nocbillingcreate','uses'=>'NocAppController@nocbillingcreate']);
Route::delete('/noc-billing-setting/{id}',['as'=>'noc-billing-setting.nocbillingdelete','uses'=>'NocAppController@nocbillingdelete']);
Route::get('/noc-billing/edit/{id}',['as'=>'noc_billing.nocbillingedit','uses'=>'NocAppController@nocbillingedit']);
Route::post('/noc-billing-update/{id}',['as'=>'noc_billing.nocbillingupdate','uses'=>'NocAppController@nocbillingupdate']);

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

