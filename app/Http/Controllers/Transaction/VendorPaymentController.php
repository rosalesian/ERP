<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\VendorPaymentRepository;
use Nixzen\Http\Requests\VendorPaymentRequest;
use Nixzen\Commands\CreateVendorPaymentCommand;
use Nixzen\Commands\UpdateVendorPaymentCommand;

use Illuminate\Http\Request;

class VendorPaymentController extends Controller {

	public $vendorpayment;

	public function __construct(VendorPaymentRepository $vendorpayment)
	{
		$this->vendorpayment = $vendorpayment;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vendorpayments = $this->vendorpayment->all();
		return view('vendorpayment.index')
				->with('vendorpayments', $vendorpayments);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('vendorpayment.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VendorPaymentRequest $request)
	{
		$vendorpayment = $this->dispatchFrom(CreateVendorPaymentCommand::class, $request);
		return redirect()->route('vendorpayment.show', $vendorpayment);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vendorpayment = $this->vendorpayment->with('items')->find($id);
		return view('vendorpayment.show')
					->with('vendorpayment', $vendorpayment);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vendorpayment = $this->vendorpayment->with('items')->find($id);
		return view('vendorpayment.show')
					->with('vendorpayment', $vendorpayment);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, VendorPaymentRequest $request)
	{
		$vendorpayment = $this->vendorpayment->find($id);
		$this->dispatchFrom(UpdateVendorPaymentCommand::class, $request, ['vendorpayment' => $vendorpayment]);
		return redirect()->route('vendorpayment.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->vendorpayment->find($id);
		return redirect()->route('vendorpayment.index');
	}

}
