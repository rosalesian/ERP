<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdateVendorBillCommand extends Command
{

	public $vendor_id;

    public $transno;

	public $suppliers_inv_no;

	public $date;

	public $duedate;

	public $billtype_id;

	public $billtype_nontrade_subtype_id;

	public $coa_id;

	public $terms_id;

	public $posting_period_id;

	public $department_id;

	public $division_id;

	public $branch_id;

	public $memo;

	public $vendorbill;

    public $items;

    public $expenses;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
            $vendor_id,
            $transno, 
    		$suppliers_inv_no, 
    		$date, 
    		$duedate, 
    		$billtype_id, 
    		$billtype_nontrade_subtype_id,
    		$coa_id,
    		$terms_id,
    		$posting_period_id,
    		$department_id,
    		$division_id,
    		$branch_id,
    		$memo,
    		$vendorbill,
            $items,
            $expenses)
    {

        $this->vendor_id = $vendor_id;

        $this->transno = $transno;
        
        $this->suppliers_inv_no = $suppliers_inv_no;

        $this->date = $date;

        $this->duedate = $duedate;

        $this->billtype_id = $billtype_id;

        $this->billtype_nontrade_subtype_id = $billtype_nontrade_subtype_id;

        $this->coa_id = $coa_id;

        $this->terms_id = $terms_id;

        $this->posting_period_id = $posting_period_id;

        $this->department_id = $department_id;

        $this->division_id = $division_id;

        $this->branch_id = $branch_id;

        $this->memo = $memo;

        $this->vendorbill = $vendorbill;

        if(gettype($items) == "string"){
            $this->items = json_decode($items);
        }
        else{
            $this->items = $items;
        }

        if(gettype($expenses) == "string"){
            $this->expenses = json_decode($expenses);
        }
        else{
            $this->expenses = $expenses;
        }
    }
}
