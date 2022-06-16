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
use Collective\Html\FormFacade as Form;

class BiglfilialeController extends Controller
{
    public function index(){

        Session::forget('tipoFlag');
        Session::put('tipoFlag', 'bigliettiF');
        return redirect('gestfirme');
    }
}