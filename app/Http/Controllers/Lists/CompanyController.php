<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Models\List\Company;

use Illuminate\Http\Request;

class CompanyController extends Controller {

	protected $company;

	public function __construct(Company $company){
		$this->company = $company;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companies = $this->company->all();

		//return view('company.index', $companies);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return view('company.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$company = $this->company->create($request->all());

		//return company view in here
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = $this->company->find($id);

		//return redirect('company.show', $company);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company = $this->company->find($id);
		
		//return redirect('company.show', $company);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$company = $this->company->update($request->all(), $id);

		//return redirect('company.show', $company);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->company->delete($id);

		//return redirect('company.index');
	}

}
