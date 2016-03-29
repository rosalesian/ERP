<?php namespace Nixzen\Http\Controllers\Lists;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\ItemRepository as Item;
use Nixzen\Repositories\PurchaseRequestCategoryRepository as PurchaseRequestCategory;
use Nixzen\Http\Requests\ItemRequest;
use Nixzen\Commands\CreateItemCommand;
use Nixzen\Commands\UpdateItemCommand;

use Illuminate\Http\Request;
use Response;

class ItemController extends Controller {

	private $item;
	private $purchaserequetcategory;

	public function __construct(Item $item, PurchaseRequestCategory $purchaserequetcategory){
		$this->item = $item;
		$this->purchaserequetcategory = $purchaserequetcategory;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = $this->item->all();
		return view('item.index')->with('items', $items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('item.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ItemRequest $request)
	{
		$item = $this->dispatchFrom(CreateItemCommand::class, $request);
		return redirect()->route('item.show', $item->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->item->find($id);
		return view('item.show')->with('item', $item);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = $this->item->find($id);
		return view('item.edit')->with('item', $item);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ItemRequest $request)
	{
		$item = $this->item->find($id);
		$this->dispatchFrom(UpdateItemCommand::class, $request, ['item' => $item]);
		//$this->item->update($request->all(), $id);
		return redirect()->route('item.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->item->delete($id);
		return redirect()->route('item.index');
	}

	public function getItems()
    {
     
        $data_items = [];
        $items = $this->item->all();
        foreach($items as $item) {
        	$result = [];
            $result['value'] = $item->id;
            $result['label'] = $item->description;
            $data_items[]= $result;
        }
        
        return Response::json(['typelist' => $data_items]);


    }

}
