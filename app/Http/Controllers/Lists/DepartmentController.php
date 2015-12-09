<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\DepartmentRepository as Department;

use Illuminate\Http\Request;

class DepartmentController extends Controller {

	private $department;

	public function __construct(Department $department){
		$this->department = $department;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = $this->department->all();

		//return view('department.index', $departments);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return view('department.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$department = $this->department->create($request->all());

		//return redirect('deparment.show', $department);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$branch = $this->department->find($id);

		//return view('department.show', $branch);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$department = $this->department->find($id);

		//return view('department.edit', $department);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$department = $this->department->update($request->all(), $id);

		//return redirect('department.show', $department);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->department->delete($id);

		//return redirect('department.index');
	}

}
