<?php

namespace App\Http\Controllers\user;
use App;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\View\View;
use MyFuncs;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use CRUDBooster;
//use Illuminate\Contracts\Auth\Authenticatable as Auth;


class UserController extends Controller
{
	
	
	
    public function index(){
		//var_dump(CRUDBooster::myPrivilegeName());exit();
		
		if ( CRUDBooster::myPrivilegeName() == "User" || CRUDBooster::myPrivilegeName() == "Admin")
	{
			
     	return view('user.nazioni');
			
	}else{
			
		return view('login');
		
	}
        
    }
	
	
}
