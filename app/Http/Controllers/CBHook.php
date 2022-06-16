<?php

namespace App\Http\Controllers;



use DB;

use Session;

use Request;



class CBHook extends Controller {



	/*

	| --------------------------------------

	| Please note that you should re-login to see the session work

	| --------------------------------------

	|

	*/
	public function afterLogin() {



		if(Session::get('admin_name') === 'user')

		{

			return redirect()->to('/user')->send();

		}

	}

}