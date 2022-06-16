<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WfirmaController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $dati = $request->all();
        return View('wfirma')
            ->('parametri',$dati);

    }
}
