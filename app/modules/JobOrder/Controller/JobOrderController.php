<?php 
namespace Modules\JobOrder\Controller;

use Nixzen\Http\Controllers\Controller;

class JobOrderController extends Controller
{
	public function index(){
		return view('JobOrder::test')->with('name', 'Redem');
	}
}