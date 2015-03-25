<?php namespace App\Http\Controllers;

use Request;
use anlutro\cURL\Laravel\cURL;

class ConfigController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * @return Response
	 */
	public function index() {
		/*
		$response = cURL::get('doota.chaoguo.rdlab.meilishuo.com/2.0/order/xhprof_list?page=' . $id);
		$data = array(
			'tab' => 'config',
			'current' => 'Xhprof Config',
		);
		return view('config', $data);
		 */

		return view('config', ['current' => 'Config analysis', 'tab' => 'config']);
	}


}
