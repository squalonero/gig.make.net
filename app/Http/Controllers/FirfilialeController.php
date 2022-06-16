<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\View\View;
use MyFuncs;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Datatables;
class FirfilialeController extends Controller
{
    public function index(){

        Session::forget('tipoFlag');
        Session::put('tipoFlag','firmaF');
        return redirect('gestfirme');

    }
}
