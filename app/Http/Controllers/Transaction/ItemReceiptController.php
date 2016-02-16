<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemReceipt;
use Nixzen\Repositories\PurchaseOrder;

use Illuminate\Http\Request;

class ItemReceiptController extends Controller {


	public $itemreceipt;

	public function __construct(ItemReceipt $itemreceipt)	{
		$this->itemreceipt = $itemreceipt;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$itemreceipts = $this->itemreceipts->all();
		return view('itemreceipt.index')->with('itemreceipts', $itemreceipts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(PurchaseOrder $purchaseorder)
	{
		return view('itemrecept.create')->with('purchaseorder', $purchaseorder);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//create IR
		//update PO
		//update inventory
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
