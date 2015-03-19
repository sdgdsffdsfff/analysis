<?php namespace App\Http\Controllers;

use Request;
use anlutro\cURL\Laravel\cURL;

class WelcomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Xhprof Performance Analysis
	 *
	 * @return Response
	 */
	public function index($id = 0) {
		$response = cURL::get('doota.chaoguo.rdlab.meilishuo.com/2.0/order/xhprof_list?page=' . $id);
		$data = json_decode($response->body);
		return view('xhprof', ['xhprofData' => $data->data]); 
	}

}
