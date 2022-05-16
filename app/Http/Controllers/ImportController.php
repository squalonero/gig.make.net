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


class ImportController extends Controller
{
    public function index()
    {

        return View('importtriplette')
            ->with('inserimento', 'ko');
    }

    public function store(Request $request)
    {
        //caricamento file csv nel dp attraverso menu in sezione admin
        $tmpName = $_FILES['filecsv']['tmp_name'];
        $csvAsArray = array_map('str_getcsv', file($tmpName));
        DB::table('dipendentis')->truncate();
        $count = 0;
        foreach ($csvAsArray as $csv)
        {
            if ($count > 0)
            {
                $arrayStr = explode(';', $csv[0]);

                $dati = array(
                    'ditta' => $arrayStr[0],
                    'dipendente' => $arrayStr[1],
                    'cognome' => $arrayStr[2],
                    'nome' => $arrayStr[3],
                    'natura' => $arrayStr[4],
                    'assunzione' => $arrayStr[5],
                    'codsocieta' => $arrayStr[6],
                    'location' => $arrayStr[7],
                    'conclocation' => $arrayStr[8],
                    'cdc' => $arrayStr[9],
                    'conccdc' => $arrayStr[10],
                    'business' => $arrayStr[11],
                    'concbusiness' => substr($arrayStr[12], 1),
                    'tripprincipale' => $arrayStr[13],
                    'tripsecondaria' => $arrayStr[14],
                    'percentuale' => $arrayStr[15]
                );
                DB::table('dipendentis')->insert($dati);
            }
            $count++;
        }
        return View('importtriplette')
            ->with('inserimento', 'ok');
    }
    public function ordina(Request $request)
    {
        //inserisco ordine nella tabella ordinis
        if (count(Session::get('arrayOrdine')) > 0)
        {
            $lastId = DB::table('ordinis')->insertGetId(Session::get('arrayOrdine'));
            $select = DB::select('select coalesce(location,"") as location,coalesce(cdc,"") as cdc,coalesce(concbusiness,"") as concbusiness,file,pathFile from ordinis where id =' . $lastId);
            $file = '<a href="http://' . $_SERVER['HTTP_HOST'] . '/viewbigli/' . $lastId . '" target="_blank">Vedi Biglietto</a>';
            // unlink($_SERVER["DOCUMENT_ROOT"] . '/' . $select[0]->pathFile);
            if ($select[0]->location != '' &&  $select[0]->cdc != '' &&  $select[0]->concbusiness != '')
            {
                $data = array('file' => $file, 'tripletta' => $select[0]->location . '-' . $select[0]->cdc . '-' . $select[0]->concbusiness, 'tripexist' => 'Esiste');
            }
            else
            {
                $data = array('file' => $file, 'tripletta' => '', 'tripexist' => 'Non esiste');
            }
            DB::table('ordinis')->where('id', $lastId)->update($data);
            // $select = DB::select('select id * from ordinis where tripprincipale="'.$select[0]->location.'-'.$select[0]->cdc.'-'.$select[0]->concbusiness.'"');
            $numOrdini = DB::select('select id from ordinis where intEvaso = "Nuovo"');
            file_put_contents('mlogs.txt', "\n" . 'Ordini: Creato nuovo ordine, ordini nuovi:' . count($numOrdini) . "\n", FILE_APPEND | LOCK_EX);
            if (count($numOrdini) == 30)
            {
                file_put_contents('mlogs.txt', "\n" . 'Invio Mail per numero biglietti = 30 - ' . date("F j, Y, g:i a") . "\n", FILE_APPEND | LOCK_EX);
                return redirect('sendhtmlemail');
            }
            else
            {
                //file_put_contents('mlogs.txt', "\n".'Invio mail di test - '.date("F j, Y, g:i a")."\n", FILE_APPEND | LOCK_EX);
                //return redirect('sendtestemail');
            }
        }
        if (Session::get('nazione') == 11)
        {
            return redirect('/italia');
        }
        else
        {
            return redirect('/world');
        }
    }
}
