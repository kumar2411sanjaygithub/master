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
	Route::get('/manageofficials/deleteofficialsdetail/{id}',['as'=>'deleteofficialsdata','uses'=>'ManageOfficialsController@deleteemployee']);


		// PPA Bid Setting
   // Route::get('/ppa/addppadetails',['as'=>'addppadetails','uses'=>'PpaDetailsController@addppadetails']);
  Route::post('/ppa/addppadetails',['as'=>'addppadetails','uses'=>'PpaDetailsController@saveppa']);
 	Route::get('/ppa/addppadetails',['as'=>'addppadetailss','uses'=>'PpaDetailsController@ppadetails']);
  Route::get('/ppa/editppa/{id}',['as'=>'ppa.editppa','uses'=>'PpaDetailsController@editppa']);
  Route::post('/ppa/updateppadata/{id}',['as'=>'ppa.updateppadata','uses'=>'PpaDetailsController@updateppadata']);
  Route::get('/ppa/deleteppa/{id}',['as'=>'deleteppa','uses'=>'PpaDetailsController@deleteppa']);

  // Route::post('/ppa/addppadetails','PpaDetailsController@ppadetails');

	 Route::resource('lead', 'LeadController');
	 Route::post('/task-lead','LeadController@taskadd');
	 Route::get('/task-delete/{id}','LeadController@taskdelete');
	 Route::post('/task-update/{id}','LeadController@taskupdate');
	 Route::post('/product-lead','LeadController@productadd');
	 Route::get('/leadproduct-delete/{id}','LeadController@leadproduct_delete');
	 Route::post('/lead-email-add','LeadController@lead_email_add');
	 Route::get('/lead-email-delete/{id}','LeadController@lead_email_delete');


	 /*
    |--------------------------------------------------------------------------
    | Action     : Place Bid Routes
    | Created By : Piyush Kr Shukla <php11@cybuzzsc.com>
    |--------------------------------------------------------------------------
    */
    Route::get('/placebid/{trading}',['as'=>'placebid.index','uses'=>'PlacebidController@index']);
    Route::post('/placebid/addnewbid/{trading}',['as'=>'placebid.addnewbid','uses'=>'PlacebidController@addnewbid']);
    Route::post('/placebid/getallbid/{trading}',['as'=>'placebid.getallbid','uses'=>'PlacebidController@getallbid']);
    Route::get('/placebid/deletebid/{bid_id}',['as'=>'placebid.deletebid','uses'=>'PlacebidController@deletebid']);
    Route::post('/placebid/deleteallselectedbid',['as'=>'placebid.deleteallselectedbid','uses'=>'PlacebidController@deleteallselectedbid']);
    Route::post('/placebid/confirmplacebid',['as'=>'placebid.confirmplacebid','uses'=>'PlacebidController@confirmplacebid']);
    Route::get('/placebid/getbidsubmissiontime/{id}',['as'=>'placebid.getbidsubmissiontime','uses'=>'PlacebidController@getbidsubmissiontime']);
    Route::post('/placebid/getbiddetailsbybidtype/{trading}',['as'=>'placebid.getbiddetailsbybidtype','uses'=>'PlacebidController@getbiddetailsbybidtype']);
    Route::get('/placebid/getbiddetailsbyid/{id}',['as'=>'placebid.getbiddetailsbyid','uses'=>'PlacebidController@getbiddetailsbyid']);
    Route::post('/placebid/updatebiddata/{trading}/{id}',['as'=>'placebid.updatebiddata','uses'=>'PlacebidController@updatebiddata']);
    Route::post('/placebid/placesimilarearlierdatebid/{trading}',['as'=>'placebid.placesimilarearlierdatebid','uses'=>'PlacebidController@placesimilarearlierdatebid']);

    /*
    |--------------------------------------------------------------------------
    | Action     : Ajax Search Routes
    | Created By : Piyush Kr Shukla <php11@cybuzzsc.com>
    |--------------------------------------------------------------------------
    */
    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
    Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));

    /*
    |--------------------------------------------------------------------------
    | Orderbook Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/power/orderbook',['as'=>'orderbook.orderbook','uses'=>'OrderbookController@orderbook']);
    Route::post('/orderbook/orderbookdata',['as'=>'orderbook.orderbookdata','uses'=>'OrderbookController@orderbookdata']);
    Route::get('/orderbook/vieworderdetails/{orderno}/{bid_type}',['as'=>'orderbook.vieworderdetails','uses'=>'OrderbookController@vieworderdetails']);
    Route::get('/orderbook/downloadExcel/{type}', ['as'=>'orderbook.downloadExcel','uses'=>'OrderbookController@downloadExcel']);
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
