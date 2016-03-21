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

Route::get('test', function(){
	return 'hello world';
});

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
	Route::resource('customer', 'CustomerController');
});

Route::group(['namespace' => 'Transaction'], function(){
	Route::resource('joborder', 'JobOrderController');
	Route::resource('purchaseorder', 'PurchaseOrderController');
	Route::resource('purchaseorder.itemreceipt', 'ItemReceiptController');
	Route::resource('purchaserequest', 'PurchaseRequestController');
	Route::resource('vendorpayment', 'VendorPaymentController');
});

Route::group(['namespace' => 'API', 'prefix' => 'api/1.0'], function(){
	//canvass api routes
	Route::get('pritem/{id}/canvass', 'CanvassController@index');
	Route::post('pritem/{id}/canvass', 'CanvassController@save');
});

Route::group(['namespace' => 'Admin'], function(){
	Route::resource('workflow', 'WorkflowController');
	Route::resource('workflow.state', 'WorkflowStateController');
});

//ajax request for select in joborder
Route::group(['prefix' => 'ajax','namespace' => 'Lists'], function(){
	Route::get('getItems', 'ItemController@getItems');
	Route::get('getEmployees','EmployeeController@getEmployees');
	Route::get('getMaintenance','MaintenanceTypeController@getMaintenance');
	Route::get('getPurchase','PurchaseRequestCategoryController@getPurchase');
});

Route::get('/', function(){
	return view('app');
});
