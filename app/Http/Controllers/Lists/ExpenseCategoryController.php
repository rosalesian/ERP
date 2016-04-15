<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ExpenseCategoryRepository as ExpenseCategory;

use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller {

	private $expensecategory;

	public function __construct(ExpenseCategory $expensecategory){
		$this->expensecategory = $expensecategory;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$expensecategories = $this->expensecategory->all();
		//return view('', $expensecategories);
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
		$this->expensecategory->create(Input::all());
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
		$expensecategory = $this->expensecategory->find($id);
		//return view('',$expensecategory);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$expensecategory = $this->expensecategory->find($id);
		//return view('',$expensecategory);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->expensecategory->update(Input::all(), $id);
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
		$this->expensecategory->delete($id);
		//return view('');
	}

}
