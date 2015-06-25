<?php namespace Nixzen\Http\Controllers;

use Nixzen\Http\Requests;
use Nixzen\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;
use Hash;

class LoginController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 //GET
	public function login()
	{

		return view('login');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	 //POST
	public function post()
	{
		$input = Input::all();
		
        if (Auth::attempt(['username' => $input['email'], 'password' => $input['password']]))
        {
            dd(Auth::user());
        }
        else
        {
        		dd('error');	
        }
	}
}
