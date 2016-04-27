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
	Route::resource('lists', 'ListsController');
	Route::resource('joborder', 'JobOrderController');
	Route::resource('purchaseorder', 'PurchaseOrderController');
	Route::resource('purchaseorder.itemreceipt', 'ItemReceiptController');
	Route::resource('purchaserequest', 'PurchaseRequestController');
	Route::resource('vendorpayment', 'VendorPaymentController');

	//Datatables
	Route::controller('jobordertable', 'JobOrderController', [
		'anyData'  => 'jobordertable.data',
		'index' => 'jobordertable',
	]);
	Route::resource('vendorbill', 'VendorBillController');

	//Datatables for Vendorbill
	//Datatables
	Route::controller('vendortable', 'VendorBillController', [
		'anyData'  => 'vendortable.data',
		'index' => 'vendortable',
	]);

	//GET DATA FOR PURCHASE REQUEST
	//Route::get('getPurchaseRequest', 'PurchaseRequestController@getPurchaseRequest');

	Route::controller('prtable', 'PurchaseRequestController', [
		'anyData'  => 'prtable.data',
		'index' => 'prtable',
	]);

	/*
	*	IAN ROSALES
	*	Ajax Request For VendorBill Line-Item
	*	April 16, 2016 1:51PM
	*
	*/
	Route::get('ajax/transactions/getVendorBill/items', 'VendorBillController@getVendorBillItems');
	Route::get('ajax/transactions/getVendorBill/expenses', 'VendorBillController@getVendorBillexpenses');

});

Route::group(['namespace' => 'API', 'prefix' => 'api/1.0'], function(){
	//canvass api routes
	Route::get('pritem/{id}/canvass', 'CanvassController@index');
	Route::post('pritem/{id}/canvass', 'CanvassController@save');
	//lists
	Route::resource('list', 'ListsController');

});

Route::group(['namespace' => 'Admin'], function(){
	Route::resource('workflow', 'WorkflowController');
	Route::resource('workflow.state', 'WorkflowStateController');
});

//ajax request for select in joborder
Route::group(['prefix' => 'ajax','namespace' => 'Lists'], function(){
	Route::get('getItems', 'ItemController@getItems');
	Route::get('getDescription/{id}', 'ItemController@getDescription');
	/*Route::get('getEmployees','EmployeeController@getEmployees');*/
	Route::get('getMaintenance','MaintenanceTypeController@getMaintenance');
	Route::get('getPurchase','PurchaseRequestCategoryController@getPurchase');

	//job order request
	Route::get('job/request','UserController@getJObRequest');
	Route::get('getPurchseRequest', 'UserController@getPurchseRequest');
	Route::get('getEmployee', 'UserController@getEmployee');
	Route::get('getMaintenancetype', 'UserController@getMaintenancetype');
	Route::get('getVendorBill', 'UserController@getVendorBill');
	Route::get('getDepartment', 'UserController@getDepartment');
	//get request for taxcode_id in vendor bill line-item
	Route::get('getTaxCode', 'UserController@getTaxCode');
	//route for expenses
	Route::get('getCoa', 'UserController@getCoa');
	Route::get('getDivision', 'UserController@getDivision');
	Route::get('getBranch', 'UserController@getBranch');
	Route::get('getVendor', 'UserController@getVendor');

	//lists for jobordertype
	Route::get('getJoborderType', 'JobOrderTypeController@getJoborderType');

});

/*ADDED BY BRIAN*/
Route::get('ajax/getUOM/{id}', function ($id){
	$data = Nixzen\Models\UnitType::find($id)->units;
	$units=[];
	foreach($data as $val) {
		array_push($units,[
			'value'=>$val->id,
			'label'=>$val->abbreviation
		]);
	}
	return Response::json($units);
});
Route::get('getVendorBills/{id}', function ($id) {
	$bills = Nixzen\Models\VendorBill::where('vendor_id',$id)->with('items')->get();
	$vendorbills=[];
	foreach($bills as $bill) {
		array_push($vendorbills,[
			'id'=>$bill->id,
			'vendor_id'=>$bill->vendor_id,
			'duedate'=>$bill->duedate,
			'transno'=>$bill->transno,
			'amount'=>$bill->amount
			]);
	}
	return Response::json($vendorbills);
});

Route::get('api/items', function (){ //THIS ROUTE IS USE FOR QUERYING ITEMS FOR PR
	$lineitems = [];
	$items = Nixzen\Models\Item::all();
      foreach($items as $item) {
        array_push($lineitems, [
          'value'=>$item->id,
          'label'=>$item->itemcode,
          'description'=>$item->description,
          'units'=>$item->unitType->units()->get(['id as value','abbreviation as label'])->toArray()
          ]);        
      }
      return Response::json($lineitems);
});
Route::get('api/getCanvassLists', function () { // THIS ROUTE IS USE FOR QUERYING CANVASS LISTS FOR PR CANVASS
	$vendors = Nixzen\Models\Vendor::get(['id as value','name as label'])->toArray();
	$terms = Nixzen\Models\Term::get(['id as value','name as label'])->toArray();
	return Response::json(['vendors'=>$vendors, 'terms'=>$terms]);
});
/***********************************/
Route::get('/', function(){
	return view('app');
});

