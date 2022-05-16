<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\View\View;
use MyFuncs;
use Auth;
use Closure;
use App;
use Config;
use Validator;
use Datatables;
use CRUDBooster;
use Collective\Html\FormFacade as Form;
class ItaliaController extends Controller
{
    public function index(){

		Session::put('italia','italia');
        Session::put('nazione','11');
        App::setLocale('it');
      $menu =  CRUDBooster::sidebarMenu();

		if ( CRUDBooster::myPrivilegeName() !== NULL )
	{
				return view('user.italia')->with('arrayMenu',$menu);
		}else{

		return view('login');

	}

    }
}
