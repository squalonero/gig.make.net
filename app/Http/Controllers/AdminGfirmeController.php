<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Request;
use DB;
use CRUDBooster;
class AdminGfirmeController extends Controller
{
    public function index(){
        return view('gfirme');
    }
}
