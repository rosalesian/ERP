<?php namespace Nixzen\Http\Controllers\Admin;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\WorkflowRepository as Workflow;

use Illuminate\Http\Request;
use Nixzen\RecordType;

class WorkflowController extends Controller {

	protected $workflow;

	public function __construct(Workflow $workflow)
	{
		$this->workflow = $workflow;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$workflows = $this->workflow->all();
		return view('workflow.index')->with('workflows', $workflows);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(RecordType $recordtype)
	{
		return view('workflow.create')->with('recordtypes', $recordtype->all()->lists('name', 'id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$workflow = $this->workflow->create($request->all());
		return redirect()->route('workflow.show', $workflow->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, RecordType $recordtype)
	{
		$workflow = $this->workflow->find($id);
		
		return view('workflow.show')
				->with('workflow', $workflow)
				->with('recordtypes', $recordtype->all()->lists('name', 'id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$workflow = $this->workflow->find($id);
		return view('workflow.edit')->with('workflow', $workflow);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$workflow = $this->workflow->update($request, $id);
		return redirect()->route('workflow.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->workflow->delete($id);
		return redirect()->route('workflow.index');
	}

}
