<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemReceiptRepository;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Commands\CreateItemReceiptCommand;
use Nixzen\Commands\UpdateItemReceiptCommand;
use Nixzen\Http\Requests\ItemReceiptRequest;

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
		$itemreceipts = $this->itemreceipt->all();

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
		return view('itemreceipt.create')->with('purchaseorder', $purchaseorder);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($poId, ItemReceiptRequest $request)
	{
		$purchaseorder = $this->purchaseorder->find($poId);
		$itemreceipt = $this->dispatchFrom(CreateItemReceiptCommand::class, $request, ['purchaseorder' => $purchaseorder]);
		return redirect()->route('purchaseorder.itemreceipt.show', $itemreceipt->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($poId, $irId)
	{
		$itemreceipt = $this->itemreceipt->with('items')->find($irId);
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
		$itemreceipt = $this->itemreceipt->with('items')->find($irId);
		return view('itemreceipt.edit')->with('itemreceipt', $itemreceipt);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($poId, $irId, ItemReceiptRequest $request)
	{
		$itemreceipt = $this->itemreceipt->find($irId);
		$this->dispatchFrom(UpdateItemReceiptCommand::class, $request, ['itemreceipt' => $itemreceipt]);
		return redirect()->route('purchaseorder.itemreceipt.show', $irId);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($poId, $irId)
	{
		$this->itemreceipt->delete($irId);
		return redirect()->route('purchaseorder.itemreceipt.index');
	}

}
