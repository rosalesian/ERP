<?php

namespace Nixzen\Http\Controllers;

use Illuminate\Http\Request;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemRepository as Item;
use Response;

class ItemController extends Controller
{
    private $item;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Item $item) {
        $this->item = $item;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getItems()
    {
<<<<<<< HEAD
        $items = $this->item->lists('description', 'id');
        dd($this->item);
        // return Response::json($items);

=======
        $data = [];
       // $items = $this->item->lists('description', 'id');
        $items = $this->item->all();
       //for($i = 0; $i<sizeof($item); $i) {
        foreach($items as $item)
            echo $tem->description;
        }
        //return Response::json($items);  
>>>>>>> 7b2fd6aa8361fea3579bd555c2892acb63b2f327
    }
}
