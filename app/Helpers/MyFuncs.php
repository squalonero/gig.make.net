<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 26/09/18
 * Time: 01:36
 */

namespace App\Helpers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\View\View;
use Auth;
use Validator;
use Datatables;
use Illuminate\Database\Eloquent;
use Collective\Html\FormFacade as Form;
use CRUDBooster;
use Excel;
use App;
class MyFuncs
{

    public static function getCombo($table,$campo,$idForm,$valore = ''){
        $where = '';
        if($valore != '' && $valore > 0){
            switch($table){
                case 'nazionis' :
                    $table = 'regionis';
                    $campoWhere = 'nazioni_id';
                    break;
                case 'regionis' :
                    $table = 'provinces';
                    $campoWhere = 'regioni_id';
                    break;
                case 'provinces' :
                    $this->getDivisioni('province_id');
                    break;
                case 'nazionis' :
                    $table = 'regionis';
                    $campoWhere = 'nazioni_id';
                    break;
                case 'nazionis' :
                    $table = 'regionis';
                    $campoWhere = 'nazioni_id';
                    break;
                case 'societas' :
                    $table = 'societas';
                    $campoWhere = 'societa_id';
                    break;

            }

            $where = ' where id='.$valore;
        }
        $dati = DB::select('SELECT id as idRecord,'.$campo.' as campo FROM '.$table.$where.' ORDER BY '.$campo);
        $str .= '<option value="0">Seleziona</option>';
        $selected = '';
        foreach($dati as $d){
            if($d->idRecord == $valore ) $selected = ' selected';
            $str .='<option value="'.$d->idRecord.'" '.$selected.'>'.$d->campo.'</option>'."\n";
            $selected = '';
        }
        return $str;
    }

    public static function getComboSocieta(){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        $str = '';
        $dati = DB::select('SELECT id,societa FROM societas where nazioni_id = '.Session::get('nazione').' and intAttivo = "Si" ORDER BY societa');
        $str .= '<option value="0">'.trans("campi.selsoc").'</option>';
        $selected = '';
        foreach($dati as $d){
           // if($d->idRecord == $valore ) $selected = ' selected';
            $str .='<option value="'.$d->id.'" >'.$d->societa.'</option>'."\n";
        }
        return $str;
    }
    public static function getComboNazioni(){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        $str = '';
        $dati = DB::select('SELECT id,prefisso,nazione FROM nazionis where id <> 11 ORDER BY nazione');
        $str .= '<option value="0">Select '.trans("campi.nazioni").'</option>';
        $selected = '';
        foreach($dati as $d){
            // if($d->idRecord == $valore ) $selected = ' selected';
			//con prefisso
            //$str .='<option value="'.$d->id.'" >'.$d->prefisso.' '.$d->nazione.'</option>'."\n";
			//senza prefisso
			$str .='<option value="'.$d->id.'" >'.$d->nazione.'</option>'."\n";
		}
        return $str;
    }
    public static function getComboProf(){
            $dati = DB::select('select id,professione from professionis where intAttivo = "Si" order by professione');
        return $dati;
    }
   /* public static function getComboNazioni($id){
        $result = DB::select("select id,nazione from nazionis where id =(select distinct nazioni_id from filialis where societa_id =".$id.")");
        $str .= '<option value="0">Seleziona</option>';
        $selected = '';
        foreach($result as $d){
            if($d->id == $id ) $selected = ' selected';
            $str .='<option value="'.$d->id.'" '.$selected.'>'.$d->nazione.'</option>'."\n";
            $selected = '';
        }
        return $str;
    }*/




    public static function createTableImg($tableResult,$titles){

        $str = '';
        $str .='<table class="table">';
        $str .='<thead><tr>';
        for($i = 0; $i <= sizeof($titles); $i++){
            $str .='<th>'.$titles[$i].'</th>';
        }
        $str .='</tr></thead>';
        $str .="<tbody>";
        foreach($tableResult as $tb){
            $str .='<tr>';
            $str .='<td><a href="#" class="clsocieta" id="soc_'.$tb->id.'">'.$tb->societa.'</a></td>';
            $str .='<td>'.$tb->codice.'</td>';
            $str .='<td><img src="'.$tb->logo.'" width="80px" height="50px"></td>';
            $str .='</tr>';
        }
        $str .= '</tbody>';
        $str .='</table>';

        $str1='';
        $str1 .= '<div class="border-bottom">';
        foreach($tableResult as $tb) {
            $str1 .= '<div class="row table-hover">';
                $str1 .= '<div class="col-sm-4"><a href="#" class="clsocieta" id="soc_'.$tb->id.'" onClick="getnazioni('.$tb->id.');">'.$tb->societa.'</a></div>';
                $str1 .= '<div class="col-sm-4">' .$tb->codice.'</div>';
                $str1 .= '<div class="col-sm-4 img-fluid"><img src="'.$tb->logo.'" ></div>';
            $str1 .= ' </div>';
        }
        $str1 .= ' </div>';
        return $str1;
    }


}
