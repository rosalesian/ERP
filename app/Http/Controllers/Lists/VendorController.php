<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\VendorRepository as Vendor;
use Nixzen\Http\Requests\VendorRequest;
use Nixzen\Commands\CreateVendorCommand;
use Nixzen\Commands\UpdateVendorCommand;

class VendorController extends Controller {

	private $vendor;

	public function __construct(Vendor $vendor){
		$this->vendor = $vendor;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vendors = $this->vendor->all();
		return view('vendor.index')->with('vendors', $vendors);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('vendor.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VendorRequest $request)
	{
		//$vendor = $this->vendor->create($request->all());
		$vendor = $this->dispatchFrom(CreateVendorCommand::class, $request);
		return redirect()->route('vendor.show', $vendor->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vendor = $this->vendor->find($id);
		return view('vendor.show')->with('vendor', $vendor);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vendor = $this->vendor->find($id);
		return view('vendor.edit')->with('vendor', $vendor);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, VendorRequest $request)
	{
		//$this->vendor->update(Input::all(), $id);
		$vendor = $this->vendor->find($id);
		$this->dispatchFrom(UpdateVendorCommand::class, $request, ['vendor' => $vendor]);
		return redirect()->route('vendor.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->vendor->delete($id);
		return redirect()->route('vendor.index');
	}

}
