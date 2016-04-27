<?php

namespace Nixzen\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nixzen\Repositories\WorkflowStateRepository as State;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;

class WorkflowStateController extends Controller
{
    protected $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($workflowId)
    {
        $states = $this->state->findAllBy('workflow_id', $workflowId);
        return response()->json($states, 200);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //maybe not necesary
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $state = $this->state->create($request->all());
        return response()->json($state, 200);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($workflowId, $stateid)
    {
        $state = $this
                ->state
                ->findWhere([
                    'workflow_id'=>$workflowId, 
                    'id'=>$stateid])->first();
        
        return response()->json([
            'state'=>$state,
            'position'=>$state->position
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //maybe not necesary
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->state->update($id, $request->all());
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
