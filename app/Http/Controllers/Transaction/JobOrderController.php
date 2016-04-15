<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderRepository as JobOrderRepo;
use Nixzen\Repositories\PurchaseRequestRepository as PurchaseRequestRepo;
use Nixzen\Http\Requests\CreateJobOrderRequest;
use Nixzen\Commands\CreatePurchaseRequestCommand;
use Nixzen\Commands\CreateJobOrderCommand;
use Nixzen\Commands\UpdateJobOrderCommand;

use Nixzen\Models\Item\JobOrder;
use Nixzen\Models\MaterialCost;

use Nixzen\Models\PurchaseRequest;

use Input;
use Datatables;
use DB;
use Response;


class JobOrderController extends Controller {

	private $joborder;
	private $_id;
	private $purchaserequest;

	public function __construct(JobOrderRepo $joborder){
		$this->joborder = $joborder;
		//$this->purchaserequest = $purchaserequest;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('joborder.index');
	}

	/* public function getIndex()
    {
        return view('joborder.index');
    }*/

	public function anyData()
    {
       return JobOrder::getIndex();
    }

	/**
	 *
 Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('joborder.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateJobOrderRequest $request)
	{
		$joborder = $this->dispatchFrom(CreateJobOrderCommand::class, $request, ['purchaserequest_id' => NULL]);
		return redirect()->route('joborder.show', $joborder);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$joborder = $this->joborder->with('materialCost','laborItems')->find($id);
		return view('joborder.show')->with('joborder',$joborder);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$joborder = $this->joborder->find($id);
		return view('joborder.edit')->with('joborder',$joborder);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateJobOrderRequest $request)
	{
		$joborder = $this->joborder->find($id);
		$this->dispatchFrom(UpdateJobOrderCommand::class, $request, ['joborder' => $id, 'purchaserequest_id' => NULL]);
		return redirect()->route('joborder.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->joborder->delete($id);
		return redirect()->route('joborder.index');
	}

}
