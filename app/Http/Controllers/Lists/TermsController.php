<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\TermRepository as Term;

use Illuminate\Http\Request;

class TermsController extends Controller {

	private $term;

	public function __construct(Term $term){
		$this->term = $term;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$terms = $this->term->all();
		//return view('', $terms);
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
		$this->term->create(Input::all());
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
		$term = $this->term->find($id);
		//return view('',$term);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$term = $this->term->find($id);
		//return view('',$term);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->term->update(Input::all(), $id);
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
		$this->term->delete($id);
		//return view('');
	}

}
