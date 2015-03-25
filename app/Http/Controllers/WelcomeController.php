<?php namespace App\Http\Controllers;

use Request;
use anlutro\cURL\Laravel\cURL;

class WelcomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Xhprof Performance Analysis(virus)
	 *
	 * @return Response
	 */
	public function index($id = 0) {
		$response = cURL::get(parent::DEV_HOST . '/2.0/order/xhprof_list?type=virus&page=' . $id);
		$data = json_decode($response->body);
		return view('xhprof', ['xhprofData' => $data->data, 'current' => 'Virus analysis', 'tab' => 'virus']); 
	}

	/**
	 * Xhprof Performance Analysis(snake)
	 *
	 * @return Response
	 */
	public function snake_xhprof($page = 0) {
		$response = cURL::get(parent::DEV_HOST . '/2.0/order/xhprof_list?type=snake&page=' . $page);
		$data = json_decode($response->body);
		return view('xhprof_snake', ['xhprofData' => $data->data, 'current' => 'Snake analysis', 'tab' => 'snake']); 
	}

}
