<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderRepository as JobOrderRepo;
use Nixzen\Repositories\PurchaseRequestRepository as PurchaseRequestRepo;
use Nixzen\Http\Requests\CreateJobOrderRequest;
use Nixzen\Commands\CreatePurchaseRequestCommand;

use Nixzen\Models\Item\JobOrder;
use Nixzen\Models\MaterialCost;
use Nixzen\Models\LaborItem;
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


		DB::beginTransaction();

		$data_result = [];
		$data = $request->all();
		$data['transnumber'] = rand();
		//adding joborder
		$joborder = $this->joborder->create($data);
		if($joborder != null && $joborder != '' ) {
			$this->_id = $joborder->id;
			$data_items = $data['items'];
			$data_labor_costs = $data['labor_costs'];
			//adding material cost
			$value = MaterialCost::addMaterialCost($data_items, $this->_id);

			//add laborItem
			$value_labor = LaborItem::addLaborItem($data_labor_costs, $this->_id);

			$result_data = $this->dispatchFrom(CreatePurchaseRequestCommand::class, $request, [
				'requester' => $request->input('requested_by'),
				'date' => $request->input('transdate'),
				'deliver_to' => $request->input('deliver_to'),
				'remarks' => $request->input('memo')
			]);
		}
		else {
			DB::rollback();
		}

		DB::commit();
		
		return redirect()->route('joborder.show',$this->_id);
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
		//return Response::json($joborder->laborCost);
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
	public function update($id)
	{
		$data = $this->joborder->find($id);
		$data->update(Input::all(), $id);
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
