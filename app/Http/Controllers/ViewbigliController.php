<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\View\View;
use MyFuncs;
use Auth;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use App;


class ViewbigliController extends Controller
{
    public function index($id){
        $select = DB::select('select * from ordinis where id='.$id);
      //  $layout = DB::select('select * from tblayout where id=1');
      //  $layout = $layout[0]->layout;

       return view('viewbigli')
          //  ->with('layout',$layout)
            ->with('request',$select);
    }
}
