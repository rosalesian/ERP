<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','LoginController@login');
Route::post('login','LoginController@post');

Route::group(['namespace' => 'Lists'], function(){
	Route::resource('branch', 'BranchController');
	Route::resource('department', 'DepartmentController');
	Route::resource('division', 'DivisionController');
	Route::resource('employee', 'EmployeeController');
	Route::resource('expensecategory', 'ExpenseCategoryController');
	Route::resource('item', 'ItemController');
	Route::resource('itemtype', 'ItemTypeController');
	Route::resource('jobordertype', 'JobOrderTypeController');
	Route::resource('stocklocation', 'StockLocationController');
	Route::resource('maintenancetype', 'MaintenanceTypeController');
	Route::resource('paymenttype', 'PaymentTypeController');
	Route::resource('taxcode', 'TaxcodeController');
	Route::resource('term', 'TermsController');
	Route::resource('unittype', 'UnitTypeController');
	Route::resource('vendor', 'VendorController');
	Route::resource('vendorcategory', 'VendorCategoryController');
});

Route::group(['namespace' => 'Transaction'], function(){
	Route::resource('canvass', 'CanvassController');
	Route::resource('joborder', 'JobOrderController');
	Route::resource('purchaseorder', 'PurchaseOrderController');
	Route::resource('purchaserequest', 'PurchaseRequestController');
});

Route::group(['namespace' => 'Admin'], function(){
	Route::resource('workflow', 'WorkflowController');
	Route::resource('workflow/state', 'WorkflowStateController');
});
Route::get('dashboard', function(){
	
	return view('dashboard');

});

Route::get('test', function(){
	
	$purchaserequest = Nixzen\PurchaseRequest::find(1);
	Event::fire(new Nixzen\Events\PurchaseRequestWasCreated($purchaserequest));
});

Route::get('testwf', function(){
	return view('layouts.dashboard');
});