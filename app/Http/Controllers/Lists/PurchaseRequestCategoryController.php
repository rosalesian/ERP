<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\PurchaseRequestCategoryRepository as PurchaseRequestCategory;

use Illuminate\Http\Request;
use Response;

class PurchaseRequestCategoryController extends Controller {

	private $purchaserequetcategory;

	public function __construct(PurchaseRequestCategory $purchaserequetcategory){
		$this->purchaserequetcategory = $purchaserequetcategory;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$purchaserequetcategories = $this->purchaserequetcategory->all();
		//return view('', $purchaserequetcategories);
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
		$this->purchaserequetcategory->create(Input::all());
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
		$purchaserequetcategory = $this->purchaserequetcategory->find($id);
		//return view('',$purchaserequetcategory);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$purchaserequetcategory = $this->purchaserequetcategory->find($id);
		//return view('',$purchaserequetcategory);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->purchaserequetcategory->update(Input::all(), $id);
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
		$this->purchaserequetcategory->delete($id);
		//return view('');
	}

	public function getPurchase() {
      	$type = $this->purchaserequetcategory->lists('name', 'id');
        return Response::json($type); 
    }

}
