<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderRepository as JobOrder;

use Illuminate\Http\Request;
use Input;

class JobOrderController extends Controller {

	private $joborder;

	public function __construct(JobOrder $joborder){
		$this->joborder = $joborder;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$joborders = $this->joborder->all();
		//return view('joborder.index')->with('joborders',$joborders);
		return $joborders;
	}

	/**
	 * Show the form for creating a new resource.
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
		//$joborder = $this->joborder->create(Input::all());
		//return redirect()->route('joborder.show', $joborder->id);
		$joborder = Input::all();
		return $joborder;
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
