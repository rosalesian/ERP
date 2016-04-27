<?php namespace Nixzen\Http\Controllers\Transaction;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;
use Nixzen\Repositories\JobOrderRepository as JobOrderRepo;
use Nixzen\Repositories\PurchaseRequestRepository as PurchaseRequestRepo;
use Nixzen\Http\Requests\CreateJobOrderRequest;
use Nixzen\Commands\CreatePurchaseRequestCommand;
use Nixzen\Commands\CreateJobOrderCommand;
use Nixzen\Commands\UpdateJobOrderCommand;

use Nixzen\Models\Item\JobOrder;
use Nixzen\Models\MaterialCost;

use Nixzen\Models\PurchaseRequest;

use Input;
use Datatables;
use DB;
use Response;


class JobOrderController extends Controller {

	private $joborder;
	private $_id;
	private $purchaserequest;

	public function __construct(JobOrderRepo $joborder){
		$this->joborder = $joborder;
		//$this->purchaserequest = $purchaserequest;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return view('joborder.index');


/*
		$LIMIT = 10;
	  for ($row = 1; $row <= $LIMIT; $row++)
	  {
	     for ($star = 1; $star <= $LIMIT-$row+1; $star++)
	        echo "*";
	    	echo "<br/>";
	 	}*/

	 	// int length = original.length();
		
	/*$word = "level";  // declare a varibale
	echo "String: " . $word . "<br>";
	$reverse = strrev($word); // reverse the word
	if ($word == $reverse) // compare if  the original word is same as the reverse of the same word
	    echo 'Output: This string is a palindrome';
	else
	    echo 'Output: This is not a palindrome';*/
	    $arr = array(7, 3, 9, 6, 5, 1, 2, 0, 8, 4);
$sortedArr = bubbleSort($arr);
var_dump($sortedArr);
 
function bubbleSort(array $arr) {
    $sorted = false;
    while (false === $sorted) {
        $sorted = true;
        for ($i = 0; $i < count($arr)-1; ++$i) {
            $current = $arr[$i];
            $next = $arr[$i+1];
            if ($next < $current) {
                $arr[$i] = $next;
                $arr[$i+1] = $current;
                $sorted = false;
            }
        }
    }
    return $arr;
}

   	

	       
	}

	/* public function getIndex()
    {
        return view('joborder.index');
    }*/

	public function anyData()
    {
       return JobOrder::getIndex();
    }

	/**
	 *
 Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('joborder.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateJobOrderRequest $request)
	{
		$joborder = $this->dispatchFrom(CreateJobOrderCommand::class, $request, ['purchaserequest_id' => NULL]);
		return redirect()->route('joborder.show', $joborder);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$joborder = $this->joborder->with('materialCost','laborItems')->find($id);
		return view('joborder.show')->with('joborder',$joborder);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$joborder = $this->joborder->find($id);
		return view('joborder.edit')->with('joborder',$joborder);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateJobOrderRequest $request)
	{
		$joborder = $this->joborder->find($id);
		$this->dispatchFrom(UpdateJobOrderCommand::class, $request, ['joborder' => $id, 'purchaserequest_id' => NULL]);
		return redirect()->route('joborder.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->joborder->delete($id);
		return redirect()->route('joborder.index');
	}

}
