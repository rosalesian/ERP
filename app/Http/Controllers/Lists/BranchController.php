<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\BranchRepository as Branch;

use Illuminate\Http\Request;

class BranchController extends Controller {

	private $branch;

	public function __construct(Branch $branch){
		$this->branch = $branch;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$branches = $this->branch->all();

		//return view('branch.index', $branches);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return view('branch.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$branch = $this->branch->create($request->all());
		
		//return redirect('branch.show', $branch);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$branch = $this->branch->find($id);

		//return view('branch.show', $branch);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$branch = $this->branch->find($id);

		//return view('branch.edit', $branch);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$branch = $this->branch->update($request->all(), $id);

		//return redirect('branch.show', $branch);
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

		//return redirect('branch.index');
	}

}
