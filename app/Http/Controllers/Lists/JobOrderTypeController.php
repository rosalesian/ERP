<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderTypeRepository as JobOrderType;

use Illuminate\Http\Request;
use Response;

class JobOrderTypeController extends Controller {

	private $jobordertype;

	public function __construct(JobOrderType $jobordertype){
		$this->jobordertype = $jobordertype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jobordertypes = $this->jobordertype->all();
		//return view('', $jobordertypes);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return view('');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->jobordertype->create(Input::all());
		//return view('');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jobordertype = $this->jobordertype->find($id);
		//return view('',$jobordertype);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jobordertype = $this->jobordertype->find($id);
		//return view('',$jobordertype);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->jobordertype->update(Input::all(), $id);
		//return view('');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->jobordertype->delete($id);
		//return view('');
	}

	public function getJoborderType() {
		
		$data_jobordertypes = [];
		$jobordertypes = $this->jobordertype->all();
		foreach($jobordertypes as $data_jobordertype) {
			$result = [];
			$result['value'] = $data_jobordertype->id;
			$result['label'] = $data_jobordertype->name;
			$data_jobordertypes[] = $result;
		}

		return Response::json($data_jobordertypes);
	}

}
