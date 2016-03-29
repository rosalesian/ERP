<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderRepository as JobOrderRepo;

use Nixzen\Models\Item\JobOrder;

use Illuminate\Http\Request;
use Input;
use Datatables;

class JobOrderController extends Controller {

	private $joborder;

	public function __construct(JobOrderRepo $joborder){
		$this->joborder = $joborder;
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
	public function store()
	{
		$data = Input::all();
		$data['transnumber'] = rand();
		$joborder = $this->joborder->create($data);
		return  view('joborder.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$joborder = $this->joborder->find($id);
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
		$this->joborder->update(Input::all(), $id);
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
