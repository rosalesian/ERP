<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\VendorBillRepository as VendorBill;
use Nixzen\Http\Requests\CreateVendorBillRequest;
use Nixzen\Commands\CreateVendorBillCommand;
use Nixzen\Commands\UpdateVendorBillCommand;

use Datatables;
use DB;



class VendorBillController extends Controller {

	private $vendorbill;

	function __construct(VendorBill $vendorbill){
		$this->vendorbill = $vendorbill;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vendorbills = $this->vendorbill->all();

		return view('vendorbill.index')
						->with('vendorbills',$vendorbills);
	}

	public function anyData()
	{
		$vendorbills = DB::table('vendor_bills')
						->leftjoin('vendors', 'vendor_bills.vendor_id', '=', 'vendors.id')
						->leftjoin('departments', 'vendor_bills.department_id', '=', 'departments.id')
						->select(
								'vendor_bills.id',
								'vendors.name as vendor_name',
								'departments.name as department_name',
								'vendor_bills.created_at',
								'vendor_bills.transno',
								'vendor_bills.suppliers_inv_no',
								'vendor_bills.duedate',
								'vendor_bills.billtype_id',
								'vendor_bills.billtype_nontrade_subtype_id'
							);

		return Datatables::of($vendorbills)
							 ->addColumn('action', function ($vendorbills) {
                                return
                                '<a href="vendorbill/'.$vendorbills->id.'/edit">Edit |</a>
                                <a href="vendorbill/'.$vendorbills->id.'"">View</a>';
                            })
							->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('vendorbill.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateVendorBillRequest $request)
	{
		dd($request->all());
	  	$vendorbill = $this->dispatchFrom(CreateVendorBillCommand::class, $request);
	   
		return redirect()->route('vendorbill.show', $vendorbill->id);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vendorbill = $this->vendorbill->with('items')->find($id);
		return view('vendorbill.show')-> with('vendorbill',$vendorbill);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vendorbill = $this->vendorbill->find($id);
		
		return view('vendorbill.edit')-> with('vendorbill',$vendorbill);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreateVendorBillRequest $request, $id)
	{
		dd(\Input::all());
		$vendorbill = $this->vendorbill->find($id);

		$this->dispatchFrom(UpdateVendorBillCommand::class, $request, ['vendorbill' => $vendorbill->id]);
		
		return redirect()->route('vendorbill.show', $id);
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->vendorbill->delete($id);
		return redirect()->route('vendorbill.index');
	}

}
