<?php 
namespace Modules\JobOrder\Controller;

use App\Http\Controllers\Controller;

class JobOrderController extends Controller
{
	public function index(){
		return view('JobOrder::test')->with('name', 'Redem');
	}
}