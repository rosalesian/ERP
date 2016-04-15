<?php

namespace Nixzen\Http\Controllers\Lists;

use Illuminate\Http\Request;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemRepository as Item;
use Nixzen\Repositories\PurchaseRequestCategoryRepository as PurchaseRequestCategory;
use Nixzen\Repositories\EmployeeRepository as Employee;
use Nixzen\Repositories\MaintenanceTypeRepository as MaintenanceType;

use Nixzen\Models\Vendor;
use Nixzen\Models\Lists\Department;
use Nixzen\Models\TaxCode;
use Nixzen\Models\ChartOfAccount;
use Nixzen\Models\Lists\Division;
use Nixzen\Models\Lists\Branch;


use Response;

class UserController extends Controller
{
    private $item;
    private $employee;
    private $purchaserequetcategory;
    private $maintenancetype;

    public function __construct(Item $item, PurchaseRequestCategory $purchaserequetcategory, Employee $employee, MaintenanceType $maintenancetype)
    {
        $this->item = $item;
        $this->purchaserequetcategory = $purchaserequetcategory;
        $this->employee = $employee;
        $this->maintenancetype = $maintenancetype;
    }
  
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getJObRequest() 
	{
		//data for items
		$data_items = [];
		$items = $this->item->all();
		foreach($items as $item) {
			$result = [];
			$result['value'] = $item->id;
			$result['label'] = $item->description;
			$data_items[]= $result;
		}

		//data for purchase request
		$data_purchase_request = [];
		$purchase_requests = $this->purchaserequetcategory->all();
		foreach($purchase_requests as $purchase_request) {
			$result = [];
			$result['value'] = $purchase_request->id;
			$result['label'] = $purchase_request->description;
			$data_purchase_request[]= $result;
		}

		 //data for employee
		$data_employee = [];
		$employees = $this->employee->all();
		foreach($employees as $employee) {
			$result = [];
			$result['value'] = $employee->id;
			$result['label'] = $employee->full_name;
			$data_employee[]= $result;
		}

		//data for maintenace
		$data_maintenancetype = [];
		$maintenancetypes = $this->maintenancetype->all();
		foreach($maintenancetypes as $maintenancetype) {
			$result = [];
			$result['value'] = $maintenancetype->id;
			$result['label'] = $maintenancetype->name;
			$data_maintenancetype[] = $result;
		}

		//data for vendor bills
		$data_vendor_bill = [];
		$vendor_types = Vendor::all();
		foreach($vendor_types as $vendor_type) {
			$result = [];
			$result['value'] = $vendor_type->id;
			$result['label'] = $vendor_type->name;
			$data_vendor_bill[] = $result;
		}


		$data_department = [];
		$department_types = Department::all();
		foreach($department_types as $department_type) {
			$result = [];
			$result['value'] = $department_type->id;
			$result['label'] = $department_type->name;
			$data_department[] = $result;
		}


		return Response::json([
			'typelist' => $data_items, 
			'listspurchase' => $data_purchase_request,
			'listemployee' => $data_employee,
			'listmaintenancetype' => $data_maintenancetype,
			'listvedorbills' => $data_vendor_bill,
			'listdepartment' => $data_department
		]);
	}

	public function getPurchseRequest()
	{
		 //data for purchase request
		$data_purchase_request = [];
		$purchase_requests = $this->purchaserequetcategory->all();
		foreach($purchase_requests as $purchase_request) {
			$result = [];
			$result['value'] = $purchase_request->id;
			$result['label'] = $purchase_request->description;
			$data_purchase_request[]= $result;

			return Response::json($data_purchase_request);
		}
	}

	public function getEmployee()
	{
		 //data for employee
		$data_employee = [];
		$employees = $this->employee->all();
		foreach($employees as $employee) {
			$result = [];
			$result['value'] = $employee->id;
			$result['label'] = $employee->full_name;
			$data_employee[]= $result;
		}

		return Response::json($data_employee);
	}

	public function getMaintenancetype()
	{
		 //data for maintenace
		$data_maintenancetype = [];
		$maintenancetypes = $this->maintenancetype->all();
		foreach($maintenancetypes as $maintenancetype) {
			$result = [];
			$result['value'] = $maintenancetype->id;
			$result['label'] = $maintenancetype->name;
			$data_maintenancetype[] = $result;
		}

		return Response::json($data_maintenancetype);
	}

	public function getVendorBill()
	{
		//data for vendor bills
		$data_vendor_bill = [];
		$vendor_types = Vendor::all();
		foreach($vendor_types as $vendor_type) {
			$result = [];
			$result['value'] = $vendor_type->id;
			$result['label'] = $vendor_type->name;
			$data_vendor_bill[] = $result;
		}

		return Response::json($data_vendor_bill);
	}

	public function getDepartment()
	{

		$data_department = [];
		$department_types = Department::all();
		foreach($department_types as $department_type) {
			$result = [];
			$result['value'] = $department_type->id;
			$result['label'] = $department_type->name;
			$data_department[] = $result;
		}

		return Response::json($data_department);
	}

	public function getTaxCode() {

		$data_taxcode = [];
		$taxcode_types = TaxCode::all();
		foreach($taxcode_types as $taxcode_type) {
			$result = [];
			$result['value'] = $taxcode_type->id;
			$result['label'] = $taxcode_type->name;
			$data_taxcode[] = $result;
		}

		return Response::json($data_taxcode);
	}

	public function getCoa() {

		$data_coa = [];
		$coa_types = ChartOfAccount::all();
		foreach($coa_types as $coa_type) {
			$result = [];
			$result['value'] = $coa_type->id;
			$result['label'] = $coa_type->title;
			$data_coa[] = $result;
		}

		return Response::json($data_coa);
	}

	public function getDivision() {

		$data_division = [];
		$division_types = Division::all();
		foreach($division_types as $division_type) {
			$result = [];
			$result['value'] = $division_type->id;
			$result['label'] = $division_type->name;
			$data_division[] = $result;
		}

		return Response::json($data_division);
	}

	public function getBranch() {
		$data_branch = [];
		$branch_types = Branch::all();
		foreach($branch_types as $branch_type) {
			$result = [];
			$result['value'] = $branch_type->id;
			$result['label'] = $branch_type->name;
			$data_branch[] = $result;
		}

		return Response::json($data_branch);
	}

	public function getVendor() {

		$data_vendor = [];
		$vendor_types = Vendor::all();
		foreach($vendor_types as $vendor_type) {
			$result = [];
			$result['value'] = $vendor_type->id;
			$result['label'] = $vendor_type->name;
			$data_vendor[] = $result;
		}

		return Response::json($data_vendor);
	}
}
