<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Request;
use DB;
use CRUDBooster;
class GfirmeController extends Controller
{
    public function index(){
        return view('gfirme');
    }
}
