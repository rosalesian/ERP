<?php

namespace Nixzen\Http\Controllers\Transaction;

use Illuminate\Http\Request;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ListRepository;
use Nixzen\Http\Requests\ListsRequest;

class ListsController extends Controller
{
		protected $lists;

		public function __construct(ListRepository $lists)
		{
			$this->lists = $lists;
		}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->lists->all();
				return view('lists.index')->with('lists', $lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListsRequest $request)
    {
				$lists = $this->lists->create($request->all());
				$inputs = $request->all();
				$items = json_decode(array_pull($inputs, 'items'));

				foreach($items as $item){
					$lists->items()->create((array)$item);
				}
        return redirect()->route('lists.show', $lists->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lists = $this->lists->with('items')->find($id);
				return view('lists.show')->with('lists', $lists);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$lists = $this->lists->with('items')->find($id);
			return view('lists.edit')->with('lists', $lists);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListsRequest $request, $id)
    {
				$inputs = $request->all();
				$items = json_decode(array_pull($inputs, 'items'));
        $lists = $this->lists->find($id);
				$lists->update($inputs);
				foreach($items as $item){
					$lists->items()->update((array)$item);
				}
				return redirect()->route('lists.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->lists->delete($id);
				return redirect()->route('lists.index');
    }
}
