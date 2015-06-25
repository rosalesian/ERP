<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\MaintenanceTypeRepository as MaintenanceType;

use Illuminate\Http\Request;

class MaintenanceTypeController extends Controller {

	private $maintenancetype;

	public function __construct(MaintenanceType $maintenancetype){
		$this->maintenancetype = $maintenancetype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$maintenancetypes = $this->maintenancetype->all();
		//return view('', $maintenancetypes);
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
		$this->maintenancetype->create(Input::all());
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
		$maintenancetype = $this->maintenancetype->find($id);
		//return view('',$maintenancetype);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$maintenancetype = $this->maintenancetype->find($id);
		//return view('',$maintenancetype);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->maintenancetype->update(Input::all(), $id);
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
		$this->maintenancetype->delete($id);
		//return view('');
	}

}
