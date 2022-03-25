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
use App;
use CRUDBooster;



class GestfirmeController extends Controller
{
    public function index()
    {

        if (CRUDBooster::myPrivilegeName() !== NULL)
        {
            $permission = Session('admin_privileges');
            $comboSocieta = MyFuncs::getComboSocieta('societas', 'societa', 'societa_id');
            $comboNazione = MyFuncs::getComboNazioni('nazioni', 'nazione', 'nazioni_id');
            if (Session::get('nazione') == 11)
            {
                App::setLocale('it');
            }
            else
            {
                App::setLocale('en');
            }


            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/filehtml/*'); // get all file names

            foreach ($files as $file)
            { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
            $comboProf = MyFuncs::getComboProf();





            return View('form_step_1')
                ->with('societa', $comboSocieta)
                ->with('nazioni', $comboNazione)
                ->with('professioni', $comboProf)
                // ->with('tabella',$tableImg)
                ->with('permission', $permission);
        }
        else
        {

            return view('login');
        }
    }
}
