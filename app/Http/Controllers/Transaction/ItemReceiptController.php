<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemReceiptRepository;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Commnads\CreateItemReceiptCommand;

use Illuminate\Http\Request;

class ItemReceiptController extends Controller {


	public $itemreceipt;

	public $purchaseorder;

	public function __construct(ItemReceiptRepository $itemreceipt, PurchaseOrderRepository $purchaseorder)	{
		$this->itemreceipt		= $itemreceipt;
		$this->purchaseorder	= $purchaseorder;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($poId)
	{
		$itemreceipts = $this->itemreceipts->all();
		
		return view('itemreceipt.index')->with('itemreceipts', $itemreceipts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($poId)
	{
		$purchaseorder = $this->purchaseorder->find($poId);
		return view('itemrecept.create')->with('purchaseorder', $purchaseorder);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($poId, ItemReceiptRequest $request)
	{
		//create IR
		//update PO
		//update inventory
		$remarks= $request->only('remarks');
		$date		= $request->only('date');
		$items	= $request->only('items');

		$createItemReceipt = new CreateItemReceiptCommand(
			$poId,
			$date,
			$remarks,
			$items
		);

		$this->dispatch($createItemReceipt);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($poId, $irId)
	{
		$itemreceipt = $this->itemreceipt->find($irId);

		return view('itemreceipt.show')->with('itemreceipt', $itemreceipt);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($poId, $irId)
	{
		$itemreceipt = $this->itemreceipt->find($irId);

		return view('itemreceipt.edit')->with('itemreceipt', $itemreceipt);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($poId, $irId)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($poId, $irId)
	{
		//
	}

}
