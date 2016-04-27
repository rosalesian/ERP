<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\DivisionRepository as Division;

use Illuminate\Http\Request;

class DivisionController extends Controller {

	private $division;

	public function __construct(Division $division)
	{
		$this->division = $division;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$divisions = $this->division->all();

		//return view('division.index', $divisions);	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return view('division.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$division = $this->division->create($request->all());

		//return redirect('division.show', $division);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$division = $this->division->find($id);

		//return view('division.show', $division);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$division = $this->division->find($id);

		//return view('division.edit', $division);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$division = $this->division->update($request->all(), $id);

		//return redirect('division.show', $division);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->branch->delete($id);

		//return redirect('division.index');
	}

}
