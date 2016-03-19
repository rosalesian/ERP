<?php namespace Nixzen\Http\Controllers\API;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\PurchaseRequestItemRepository;

use Illuminate\Http\Request;

class CanvassController extends Controller {

	protected $prItem;

	public function __construct(PurchaseRequestItemRepository $prItem)
	{
		$this->prItem = $prItem;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$prItem = $this->prItem->find($id);

		return response()->json([
			'canvasses' => $prItem->canvasses()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function save($id, Request $request)
	{
		$prItem = $this->prItem->find($id);
		$canvasses = json_decode($request->input('canvasses'));

		foreach($canvasses as $data){

			$canvass = $prItem->canvasses()->where('vendor_id', $data->vendor_id)->first();
			if($canvass == null){
				$prItem->canvasses()->create((array)$data);
			}else {
				$canvass->update((array)$data);
			}

		}

		return response()->json([
			'message' => 'canvass was created'
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
