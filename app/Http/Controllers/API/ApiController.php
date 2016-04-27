<?php

namespace Nixzen\Http\Controllers\API;

use Illuminate\Http\Request;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;

use Nixzen\Models\Taxcode;
use Nixzen\Models\Item;
use Nixzen\Models\Lists\Employee;
use Nixzen\Models\ChartOfAccount;
use Nixzen\Models\Lists\Division;
use Nixzen\Models\Lists\Branch;
use Nixzen\Models\Item\JobOrderType;
use Nixzen\Models\Vendor;
use Nixzen\Models\Lists\Department;

use Response;

class ApiController extends Controller
{
    public $data = [];
    public $lineite;

    public function __construct() {
    }

    public function get($class_name) {
        
        switch ($class_name) {
            
            case 'Item':

                $items = Item::all();
                foreach($items as $item) {
                    $result = [];
                    $result['value'] = $item->id;
                    $result['label'] = $item->itemcode;
                    $result['description'] = $item->description;
                    $this->data[]= $result;
                }
                return $this->returnJSON($this->data);
                break;

             case 'VendorBill':
                    if($this->lineitem === 'item') {
                        $this->data['items'] = $this->getItem();
                        $this->data['jobtypes'] = $this->getJobType();
                        $this->data['taxcodes'] = $this->getTaxCode();
                        return $this->returnJSON($this->data);
                    }
                    else if($this->lineitem === 'expenses') {
                        $this->data['employees'] = $this->getEmployee();
                        $this->data['chartOfAccounts'] = $this->getCoa();
                        $this->data['vendors'] = $this->getVendor();
                        $this->data['branches'] = $this->getBranch();
                        $this->data['taxcodes'] = $this->getTaxCode();
                        $this->data['departments'] = $this->getDepartment();
                        $this->data['divisions'] = $this->getDivision();
                        return $this->returnJSON($this->data);
                    }
               

                break;
            default:
                # code...
                break;
        }
    }

    public function returnJSON($data) {
        return Response::json($data);
    }

    public function Test()
    {
        return "Hello World";
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
        return $data_coa;
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
        return $data_division;
    }

    public function getEmployee()
    {
        $data_employee = [];
        $employees = Employee::all();
        foreach($employees as $employee) {
            $result = [];
            $result['value'] = $employee->id;
            $result['label'] = $employee->full_name;
            $data_employee[]= $result;
        }
       return $data_employee;
    }

    public function getItem() 
    {
        $data_item = [];
        $items = Item::all();
        foreach($items as $item) {
            $result = [];
            $result['value'] = $item->id;
            $result['label'] = $item->itemcode;
            $result['description'] = $item->description;
            $result['units'] = $item->unitType->units()->get(['id as value','abbreviation as label'])->toArray();
            $data_item[] = $result;
        }
        return $data_item;
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
        return $data_branch;
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
        return $data_vendor;
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
        return $data_taxcode;
    }

    public function getJobType() {
        $data_job_order_type = [];
        $jo_types = JobOrderType::all();
        foreach($jo_types as $jo_type) {
            $result = [];
            $result['value'] = $jo_type->id;
            $result['label'] = $jo_type->name;
            $data_job_order_type[] = $result;
        }
        return $data_job_order_type;
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
        return $data_department;
    }
}
