<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\PurchaseRequestRepository as PurchaseRequest;
use Nixzen\Http\Requests\CreatePurchaseRequestRequest;
use Nixzen\Commands\CreatePurchaseRequestCommand;
use Nixzen\Commands\UpdatePurchaseRequestCommand;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller {

	public $purchaserequest;

	public function __construct(PurchaseRequest $purchaserequest){
		$this->purchaserequest = $purchaserequest;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$purchaserequests = $this->purchaserequest->all();

		return view('purchaserequest.index')
						->with('purchaserequests',$purchaserequests);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('purchaserequest.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreatePurchaseRequestRequest $request)
	{
		$purchaserequest = $this->dispatchFrom(CreatePurchaseRequestCommand::class, $request);
		return redirect()->route('purchaserequest.show', $purchaserequest->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$purchaserequest = $this->purchaserequest->find($id);
		return view('purchaserequest.show')-> with('purchaserequest',$purchaserequest);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$purchaserequest = $this->purchaserequest->find($id);
		return view('purchaserequest.edit')->with('purchaserequest',$purchaserequest);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreatePurchaseRequestRequest $request)
	{
		$purchaserequest = $this->purchaserequest->find($id);
		$this->dispatchFrom(UpdatePurchaseRequestCommand::class, $request, ['purchaserequest' => $purchaserequest]);
		return redirect()->route('purchaserequest.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->purchaserequest->delete($id);
		return redirect()->route('purchaserequest.index');
	}

}
