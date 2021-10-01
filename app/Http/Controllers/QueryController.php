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
use Illuminate\Database\Eloquent;
use Collective\Html\FormFacade as Form;
use CRUDBooster;
use Excel;
use App;
use App\Ordini; // nicpaola 07-2020
use App\Libraries\SimpleImage; // nicpaola 07-2020

class QueryController extends Controller
{


    public function secondSelect(Request $request){
        $arrayCampi = array(
            'societas'=>'societa',
            'divisionis'=>'divisione',
            'filialis'=>'filiale',
            'nazionis'=>'nazione',
            'regionis'=>'regione',
            'provinces'=>'provincia'
        );

        $table = $request->table;
        $campo = $arrayCampi[$table];
        $id = $request->campoId;
        $valore = $request->valore;
        $result = MyFuncs::getCombo($table,$campo,$id,$valore);
        return $result;
    }
    public function socnaz(Request $request){
        $idSocieta = $request->id;
        $result = DB::select("select distinct nazioni_id from filialis where societa_id =".$idSocieta);
       return $result;

    }
    public function getsoc(Request $request){
        $id = $request->id;
        $result = DB::select("select id,societa from societas where nazioni_id =".$id." order by societa");
        $str = array();
        foreach($result as $r){
            $str[]= $r;
        }
        return $str;
    }
    public function getlayout(Request $request){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        //$var = $request->all();
     //   $noHtml = 0;
        $idProf = 0;
        if(isset($request->professione) && $request->professione !='') {
            $prof = DB::select('select * from professionis where LOWER(professione) = "' . strtolower($request->professione) . '"');
            if (count($prof) == 0) {
                $dati = array('professione' => $request->professione, 'intAttivo' => 'No');
                $idProf = DB::table('professionis')->insertGetId($dati);
            }
        }
        if($request->layout > 0)
					//gigroup layout: 2
            $tipo_layout_prova = $request->layout;
        else
            $tipo_layout_prova = 1;
        /*mirco add*/
        if ($tipo_layout_prova == 1){
            $display="style='display:inline-block'";
            //$next_20="<div ".$display."><img src='http://".$_SERVER['SERVER_NAME']."/img/next20-b.png'></div>";
        }else{
            $display="";
            $next_20="";
        }

        // nicpaola 07-2020 - upload sponsor file
        if ( 0 < $_FILES['sponsor_image']['error'] ) {
            $sponsorFilePath = null;
        } else {
            $sponsorFileName = time()."_".$_FILES['sponsor_image']['name'];
            if(move_uploaded_file($_FILES['sponsor_image']['tmp_name'], storage_path().'/app/uploads/sponsor_images/'.$sponsorFileName)) {
                // RESIZE IMAGE TO FIT
                $imageResized = new SimpleImage();
                $imageResized
                    ->fromFile(storage_path().'/app/uploads/sponsor_images/'.$sponsorFileName)
                    ->autoOrient()
                    ->bestFit(160, 160)
                    ->toFile(storage_path().'/app/uploads/sponsor_images/r_'.$sponsorFileName, null, 80);

                @unlink(storage_path().'/app/uploads/sponsor_images/'.$sponsorFileName);

                $sponsorFilePath = 'uploads/sponsor_images/r_'.$sponsorFileName;
            } else {
                $sponsorFilePath = null;
            }
        }

 // $privacy =  DB::select('select privacy from societas where id='.$request->societaC);
$testo_prova ="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
    <!--<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />-->
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"Content-type\" content=\"text/html; charset=UTF-8\">
    <title>Firma</title>
</head>
<body>";
		

if($request->tipoFirma == 'firmaP' || $request->tipoFirma == 'firmaF') {
    //layout 1 inizio
    if ($tipo_layout_prova == 1) {
		
        $testo_prova .= "<div style=\"text-align:left;\">";
		
        if ($request->tipoFirma == 'firmaP') {
			
            $testo_prova .= "<span style=\"font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"nome\">" . $request->nome . " " . $request->cognome . "</span><br />";
            //estero
            if($request->job != '') $testo_prova .= "<span style=\"font-weight:normal; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"job\">" . $request->job . "</span>";
            //fine estero
			if($request->professione != ''){
				
            $testo_prova .= "<span style=\"font-weight:normal; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"professione\">" . ucwords(strtolower($request->professione)) . "</span>";
				
				if($request->tipologia == '' && $request->place == '' || $request->tipologia == '' || $request->place == '') $testo_prova .= '<div style="font-size:10pt"><br /></div>';
				
			}
			
			if($request->professione == '' && $request->tipologia == '' && $request->place == '') $testo_prova .= '<div style="font-size:10pt"><br /></div>';
        }


        if ($request->tipologia != '' && $request->place != '') {
            if($request->tipologia == 'filiale')  $tipo = trans('campi.filialedi');
            if($request->tipologia == 'ufficio')  $tipo = trans('campi.ufficiodi');
            if ($request->tipoFirma == 'firmaP') {

                $testo_prova .= "<i><span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"tipologia\">" . ucfirst($tipo) . ucfirst($request->place) . "</span>
                                                <span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"comune\"></span></i><br />";
				
            } else {
				
                $testo_prova .= "<span style=\"font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"tipologia\">" . ucfirst($tipo) .  ucfirst($request->place) . "</span>
                                                <span style=\"font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"comune\"></span><br />";
				//$testo_prova .= '<br />';
            }
			
        } else {
            //$testo_prova .= '<br />';
        }
        // if ($request->societaC==1){
		
        $testo_prova .= "<span style=\"font-weight:bold; font-size:13pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\"><div " . $display . ">
                                <img class=\"logoS\" src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->logoSC . "\" alt='' title=\"\"  >
                                </div>" /*$next_20*/ . "
                            </span>";
        //}else{
        /*  $testo_prova .= "<div ".$display."><span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
          <img src=\"http://www.abgrafica.it/biglietti/area_admin/documenti/societa/$logo_prova\" alt=\"$ragsoc_prova\" title=\"$ragsoc_prova\" >
          </div>".$next_20."
      </span>";

      }*/

        /* nicpaola 07-2020
        $testo_prova .= "</div>
                        <div style=\"text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" ><img src=\"http://" . $_SERVER['HTTP_HOST'] . "/img/Linea_273_8px.gif\" width=\"305px\" height=\"16px\" ></div>";
        */

        $testo_prova .= "<div style=\"text-align:left;\">";
				

        //estero
        if($request->address != '') {
            $testo_prova .= "<div style=\"font-size:10pt\"><br /></div><span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"address\">" . $request->address . "</span><br/>";
            /* nicpaola 07-2020 */
            if(isset($request->address_2) && $request->address_2 != '')
                $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"address\">" . $request->address_2 . "</span><br/>";
            if(isset($request->address_3) && $request->address_3 != '')
                $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"address\">" . $request->address_3 . "</span><br/>";
        }
        //end estero
        /* nicpaola 07-2020 */
        else if ($request->indirizzoC1!='' && $request->indirizzoC2!='')  {
            $testo_prova .= "<br/><span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"indirizzo\">" . $request->indirizzoC1 . "</span><br />";
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"indirizzo\">" . $request->indirizzoC2 . "</span><br />";
        }
        else
             $testo_prova .= "<br/><span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"indirizzo\">" . $request->indirizzoC . "</span><br />";


        if ($request->cell != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"cell\"><span style=\"display:inline-block;width:16px\"><b style=\"letter-spacing:7px\">M</b></span> " . $request->cellnaz . " " . $request->precell . " " . $request->cell . "</span><br />";
        }
        if ($request->telefono != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"telefono\"><span style=\"display:inline-block;width:16px\"><b style=\"letter-spacing:10px;\">T</b></span> " . $request->prefnaz . " " . $request->preftel . " " . $request->telefono . "</span><br />";
        }

        if ($request->skype != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"skype\"><b>Skype</b> " . $request->skype . "</span><br />";
        }

        /* nicpaola 07-2020
        if ($request->fax != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"fax\">".trans('campi.fax').": " . $request->prefnaz1 . " " . $request->prefax . " " . $request->fax . "</span><br />";
        }
        if (isset($request->email) && $request->email != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\">E-mail: " . strtolower($request->email) . $request->at . $request->emaildomain . "</span><br />";
        } else {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\">E-mail: " . strtolower($request->cmailF) . "</span><br />";
        }
        */

        /* nicpaola 07-2020 - new email */
        if (isset($request->email) && $request->email != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\"><b>E-mail</b> " . strtolower($request->email) . $request->at . $request->emaildomain . "</span><br />";
        } else {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\"><b>E-mail</b> " . strtolower($request->cmailF) . "</span><br />";
        }
        $testo_prova .= "<div style=\"font-size:8pt;\"><br/></div>";
        $testo_prova .= "<div style=\"font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"domain\"><a href=\"http://www.". $request->domain ."\" style=\"font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;text-decoration:none;\" target=\"_blank\">www." . $request->domain . "</a></div>";

        if($request->socialCount>0) {
            $totalSocial = $request->socialCount;
            // check almeno un social compilato
            $oneSocialCompiled=false;
            for($socialIndex=0;$socialIndex<$totalSocial;$socialIndex++) {
                $socialHrefVarNameCheck = "social_".$socialIndex;
                if(trim($request->$socialHrefVarNameCheck)!="") {
                    $oneSocialCompiled=true;
                    break;
                }
            }

            if($oneSocialCompiled) {
                $testo_prova .= "<div style=\"font-size:10pt\"><br /></div>";
                $testo_prova .= "<div style=\"text-align:left;height:30px;\">";
                for($socialIndex=0;$socialIndex<$totalSocial;$socialIndex++) {
                    $socialHrefVarName = "social_".$socialIndex;
                    $socialImgVarName = "socialImage_".$socialIndex;
                    $socialLabelVarName = "socialLabel_".$socialIndex;
                    if(trim($request->$socialHrefVarName)!="")
                        $testo_prova .= "<a href=\"" . $request->$socialHrefVarName . "\" target=\"_blank\" style=\"text-decoration:none\"><img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->$socialImgVarName . "\" style=\"width:30px\" width=\"30\" alt=\"".$socialLabelVarName."\" /></a><span style=\"color:#fff\">&nbsp;</span>";
                }
                $testo_prova .= "</div>";
            }
        }
				
			//mirco 05-05-2021 use endorsment image (DB: firma) in Layout 2 (GiGroup) as sponsor if loaded, add sponsor link
        if(!is_null($sponsorFilePath) || (isset($request->firmaImg) && $request->firmaImg)) {
            $testo_prova .= "<div style=\"font-size:10pt\"><br /></div>";
            $testo_prova .= "<div style=\"text-align:left;\">";
					
						if(isset($request->firmaImgLink) && trim($request->firmaImgLink)!="") {
							$testo_prova .= "<a href='".$request->firmaImgLink."' alt='Sponsor Url'>"; //link immagine sponsor
						}
						
						$img = ($sponsorFilePath) ? $sponsorFilePath : $request->firmaImg;
            $testo_prova .= "<img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $img . "\" style=\"width:166px\" alt=\"sponsorImage\" />";
					
						if(isset($request->firmaImgLink) && trim($request->firmaImgLink)!="") {
							$testo_prova .= "</a>";
						}
						
            //$testo_prova .= "<img src=\"http://" . $_SERVER['HTTP_HOST'] . "/checkSponsorImage?id=1\" style=\"width:160px\" alt=\"sponsorImage\" />";
            $testo_prova .= "</div>";   
        }

        $testo_prova .= "</div>";

        /* nicpaola 07-2020        
        $testo_prova .= "<div style=\"text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\"><img src=\"http://" . $_SERVER['HTTP_HOST'] . "/img/Linea_273_8px.gif\" width=\"305px\" height=\"16px\" ></div>";
        */

        $testo_prova .= "<div style=\"text-align:left;\"><div style=\"font-size:10pt\"><br /></div>
                        <span style=\"text-align:left; font-size:7pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class='privacy'>" . $request->privacyC . "<br/></span>
                    </div>";

        //fine layout 1 (Gigroup)
    } else {
        //inizio layout 2 (Altre società)
        $testo_prova .= "<div style=\"text-align:left;\">";
		
        if ($request->tipoFirma == 'firmaP') {
			
			
             $testo_prova .= "<span style=\"font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"nome\">" . $request->nome . " " . $request->cognome . "</span><br />";

            //estero
            if($request->job != '') $testo_prova .= "<span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"job\">" . $request->job . "</span><br />";
            //fine estero

			if($request->professione != ''){
				
            $testo_prova .= "<span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"professione\">" . ucwords(strtolower($request->professione)) . "</span><br />";
				
				if($request->tipologia == '' && $request->place == '' || $request->tipologia == '' || $request->place == '') $testo_prova .= '<br />';
			}
			
			if($request->professione == '' && $request->tipologia == '' && $request->place == '') $testo_prova .= '<br />';
        }
		
        if ($request->tipologia != '' && $request->place != '') {
            if($request->tipologia == 'filiale')  $tipo = trans('campi.filialedi');
            if($request->tipologia == 'ufficio')  $tipo = trans('campi.ufficiodi');
            if ($request->tipoFirma == 'firmaP') {
				
                $testo_prova .= "<i><span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"tipologia\">" . ucfirst($tipo) . ucfirst($request->place) . "</span>
                                                <span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"comune\"></span></i><br /><br />";
				
            } else {
				
                $testo_prova .= "<span style=\"font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"tipologia\">" . ucfirst($tipo) .  ucfirst($request->place) . "</span>
                                                <span style=\"font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"comune\"></span><br /><br />";
            }
			
        } else {
            //$testo_prova .= '<br />';
        }
		
        if ($societa_prova != 13) {
			
            $testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
                    <img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->logoSC . "\" alt=\"$ragsoc_prova\" title=\"$ragsoc_prova\"  > 
                </span>";
			
        } else {
			
            $testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
                    <img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->logoSC . "\" alt=\"$ragsoc_prova\" title=\"$ragsoc_prova\"   >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"http://" . $_SERVER['HTTP_HOST'] . "/img/star-logo.gif\" alt=\"Career Star Group\"    > 
                </span>";
			
        }
		
        $testo_prova .= "</div>
            <div style=\"text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\"><img src=\"http://" . $_SERVER['HTTP_HOST'] . "/img/Linea_273_8px.gif\" width=\"305px\" height=\"16px\" /></div>";
        $testo_prova .= "<div style=\"text-align:left;\">";
        if($request->address != '')
            //estero
            $testo_prova .= "<span style=\"font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class=\"address\">" . $request->address . "</span><br />";
        //end estero
        else
             $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"indirizzo\">" . $request->indirizzoC . "</span><br />";



        if ($request->telefono != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"telefono\">".trans('campi.tel').": " . $request->prefnaz . " " . $request->preftel . " " . $request->telefono . "</span><br />";
        }
        if ($request->cell != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"cell\">".trans('campi.cell').": " . $request->cellnaz . " " . $request->precell . " " . $request->cell . "</span><br />";
        }
        if ($request->fax != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"fax\">".trans('campi.fax').": " . $request->prefnaz1 . " " . $request->prefax . " " . $request->fax . "</span><br />";
        }
        if (isset($request->email) && $request->email != '') {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\">E-mail: " . strtolower($request->email) . $request->at . $request->emaildomain . "</span><br />";
        } else {
            $testo_prova .= "<span style=\"font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"mail\">E-mail: " . strtolower($request->cmailF) . "</span><br />";
        }
        $testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;\" class=\"domain\">www." . $request->domain . "</span>";

        $testo_prova .= "</div>";
        $testo_prova .= "<div style=\"text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\"><img src=\"http://" . $_SERVER['HTTP_HOST'] . "/img/Linea_273_8px.gif\" width=\"305px\" height=\"16px\" /></div>";
				
				
        if(isset($request->firmaImg) && trim($request->firmaImg)!="") {
            $testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
                    <img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->firmaImg . "\" alt=\"Gi Group\" title=\"$ragsoc_prova\" > 
                </span>";
        }
				
        $testo_prova .= "<div style=\"text-align:left;\">
                <span style=\"text-align:left; font-size:7pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\" class='privacy'><br />" . $request->privacyC . "</span>
        
            </div>";
			
        //fine layout 2
    }
}else{
    //biglietti
	$trattino = '';
//	$noHtml = 1;
    if ($request->tipoFirma == 'bigliettiP') {
		
        $testo_prova .= '<p>';
		$testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
                    <img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->logoSC . "\" alt=\"$ragsoc_prova\" title=\"$ragsoc_prova\"  > 
                </span><br/><br/>";
        $testo_prova .= strtoupper($request->nome) . ' ' . strtoupper($request->cognome);
		
		if( $request->professione != '') $testo_prova .= '<br />' . ucwords(strtolower($request->professione));
        
        $testo_prova .= '<br /><br />' . $request->societaN;
        $testo_prova .= '<br />' . $request->indirizzoC . '<br/>';

        if ($request->telefono != '') {
            $testo_prova .= "Tel. " . $request->prefnaz . " " . $request->preftel . " " . $request->telefono;
        }
        
		$trattino = '';
        if ($request->fax != '') {
			
			if($request->telefono != '' ) $trattino = ' - ';
            $testo_prova .= $trattino . "Fax " . $request->prefnaz1 . " " . $request->prefax . " " . $request->fax;
        }
		$trattino = '';
		if ($request->cell != '' ) {
			
			if($request->telefono != '' || $request->fax != '') $trattino = ' - ';
            $testo_prova .= $trattino . "Cell. " . $request->cellnaz . " " . $request->precell . " " . $request->cell;
        }
       // $testo_prova .= substr($testo_prova, 0, -2);
        $trattino = '';
		
		if($request->emailBF != '' || $request->email) $trattino = ' - ';
		$mail = ($request->emailBF !='')? $request->emailBF : $request->email;
            $testo_prova .= '<br />' . $mail . $request->at . $request->emaildomain . $trattino . 'www.' . $request->domain;        
       // $testo_prova .= '<br />' . $request->email . $request->at . $request->emaildomain . '  www.' . $request->cdominio;
      //  $testo_prova .= substr($testo_prova, 0, -2);
        $testo_prova .= '<br /></p>';
    }else{
		
        $testo_prova .= '<p>';
		$testo_prova .= "<span style=\"font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;\">
                    <img src=\"http://" . $_SERVER['HTTP_HOST'] . "/" . $request->logoSC . "\" alt=\"$ragsoc_prova\" title=\"$ragsoc_prova\"  > 
                	</span><br/><br/>";
        $testo_prova .= $request->societaN;
        $testo_prova .= '<br />' . $request->indirizzoC;
         if ($request->telefono != '') {
            $testo_prova .= "<br />Tel. " . $request->prefnaz . " " . $request->preftel . " " . $request->telefono;
        }
        
		$trattino = '';
        if ($request->fax != '') {
			
			if($request->telefono != '' ) {
				$trattino = ' - ';
			}else{
				$testo_prova .= '<br />'; 
			};
            $testo_prova .= $trattino . "Fax " . $request->prefnaz1 . " " . $request->prefax . " " . $request->fax;
        }
		$trattino = '';
		if ($request->cell != '' ) {
			
			if($request->telefono != '' || $request->fax != '') $trattino = ' - ';
            $testo_prova .= $trattino . "Cell. " . $request->cellnaz . " " . $request->precell . " " . $request->cell;
        }
      //  $testo_prova .= substr($testo_prova, 0, -2);
		
		$trattino = '';
		
		if($request->emailBF != '') $trattino = ' - ';
       
            $testo_prova .= '<br />' . $request->emailBF . $trattino . 'www.' . $request->domain;        

      //  $testo_prova .= substr($testo_prova, 0, -2);
        $testo_prova .= '<br /></p>';
    }
}
    $testo_prova .= "</body></html>";
$file = '';
   // if($noHtml == 0){
        $data = date('ymd');
        $nome = $data.substr(mt_rand(1,9999),0,4).substr(mt_rand(1,9999999),3,4).'.html';
        $identificatore_prova = fopen("filehtml/".$nome, "w");
        fwrite($identificatore_prova, $testo_prova);
        fclose($identificatore_prova);
        $file = '<p><a href="http://'.$_SERVER['HTTP_HOST'].'/filehtml/'.$nome. '" target="_blank">'.$nome.'</a><br></p>';
 //   }
        if($request->divisioneC !=''){
            $divisione = DB::select("select divisione from divisionis where id=".$request->divisioneC);
        }
        //codsocieta e codice
        if($request->nome !='' && $request->cognome !=''){
            $codSocieta = 0;
            if($request->societaC != '')  $codSocieta = DB::select('select codice from societas where id='.$request->societaC);
            $codice = '';
            if(count($codSocieta) > 0){
                $codice = ' codsocieta ='. $codSocieta[0]->codice.' and ';
            }

            $triplette = DB::select('select id,dipendente,business,conccdc,conclocation,location,cdc,concbusiness from dipendentis where '.$codice.' LOWER(nome) = "'.strtolower($request->nome).'" and LOWER(cognome) = "'.strtolower($request->cognome).'"');
        }
        $profess = DB::select('select intAttivo from professionis where professione ="'.$request->professione.'"');
        $intAttivo = '';
        if($profess[0]->intAttivo == 'No') $intAttivo = '***';
        
        $codSocieta = DB::select('select codice from societas where id='.$request->societaC);
        
        $arrayPost = array(
            'coddipendente' => $triplette[0]->dipendente,
            'cognome' => $request->cognome,
            'nome' => $request->nome,
            'idProf'   => $idProf,
            'professione' => $intAttivo.$request->professione.$intAttivo,
            'codsocieta' => $codSocieta[0]->codice,
           // 'codsocieta' => $request->societaC,
            'societa' => $request->societaN,
            'divisione' => $divisione[0]->divisione,
            'codfiliale' => $request->codice,
            'filiale' => $request->nomefiliale,
            'qt' => $request->qtbiglietti,
            'business' => $triplette[0]->business,
            'concacdc' => $triplette[0]->conccdc,
            'location' => $triplette[0]->location,
            'cdc' => $triplette[0]->cdc,
            'concbusiness' => substr($triplette[0]->concbusiness,1),
            'concalocation' =>$triplette[0]->conclocation,
            'indirizzo'=> $request->indirizzoC,
            'prefnaz'=>$request->prefnaz,
            'preftel'=> $request->preftel,
            'telefono'=>$request->telefono,
            'prefnaz1'=>$request->prefnaz1,
            'prefax'=>$request->prefax,
            'fax'=>$request->fax,
            'cellnaz'=>$request->cellnaz,
            'prefcell'=>$request->precell,
            'cell'=>$request->cell,
            'emailBF'=>$request->emailBF,
            'email'=>$request->email,
            'at'=>$request->at,
            'emaildomain'=>$request->emaildomain,
            'cdominio'=>$request->domain,
			
        //    'file' => '<p><a href="http://'.$_SERVER['HTTP_HOST'].'/filehtml/'.$nome. '" target="_blank">'.$nome.'</a><br></p>'
            'file' => $file,
            'pathFile' => "filehtml/".$nome
			
        );
        Session::put('arrayOrdine', $arrayPost);
        Session::put('linkordine', '/filehtml/'.$nome.'"');
        return "/filehtml/".$nome;
    }
    public function getnazioni(Request $request){
        $id = $request->id;
        $result = DB::select("select distinct id,nazione from nazionis where id IN (select distinct nazioni_id from filialis where societa_id =".$id."  group by nazioni_id ) order by nazione");
        $str= '';
        $str = '<option value disabled selected>Seleziona la Nazione</option>';
        foreach($result as $r){
            $str .= '<option value ="'.$r->id.'">'.$r->nazione.'</option>';
        }
        return $str;
}
    public function getsocieta(Request $request){
        $id = $request->id;
        $result = DB::select("select distinct id,societa from societas where nazioni_id =".$id .' AND intAttivo="Si" order by societa');
        $str= '';
        $str = '<option value disabled selected>Select Company</option>';
        foreach($result as $r){
            $str .= '<option value ="'.$r->id.'">'.$r->societa.'</option>';
        }
        return $str;
    }
    public function getregioni(Request $request){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        $id = $request->id;
       // $result = DB::select("select distinct id,regione from regionis where id  IN (select distinct regioni_id from filialis where societa_id=".$id."  group by regioni_id ) order by regione");
        $result = DB::select('select distinct r.id,r.regione from filialis as f inner join regionis as r on r.id = f.regioni_id where f.societa_id = '.$id.' group by r.id,r.regione order by regione');
        $str= '';
        $str = '<option value disabled selected>'.trans("campi.selreg").'</option>';
        foreach($result as $r){
            $str .= '<option value ="'.$r->id.'">'.$r->regione.'</option>';
        }
        return $str;

    }
    public function getprovince(Request $request){
        $id = $request->id;

        $result = DB::select("select distinct id,provincia from provinces where id IN (select province_id from filialis where regioni_id=".$id." group by province_id ) order by provincia");
        $str= '';
        $str = '<option value disabled selected>Seleziona la Provincia</option>';
        foreach($result as $r){
            $str .= '<option value ="'.$r->id.'">'.$r->provincia.'</option>';
        }
        return $str;

    }
    public function getdivisioni(Request $request){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        $id = $request->id;
       // $result = DB::select("select distinct id,divisione from divisionis where id IN (select  divisioni_id from filialis where province_id=".$id."  group by divisioni_id ) order by divisione");
        //$result = DB::select('select  distinct d.id,d.divisione from filialis f inner join divisionis d on d.id=f.divisioni_id where f.societa_id = '.$id .' group by d.id,d.divisione');
		$result = DB::select('select d.id,d.divisione from divisionis d where d.societa_id = '.$id .' group by d.id,d.divisione order by d.divisione');
        $str= '';
        if(count($result) > 0 ) {
            $str = '<option value disabled selected>'.trans("campi.seldiv").'</option>';
            foreach ($result as $r) {
                $str .= '<option value ="' . $r->id . '">' . $r->divisione . '</option>';
            }
        }else{
            $str = '<option value disabled selected>'.trans("campi.NessunaDivisioneTrovata").'</option>'; // nicpaola 07-2020
        }
        return $str;

    }
    public function getfiliali(Request $request){
        if(Session::get('nazione') == 11){
            App::setLocale('it');
        }else{
            App::setLocale('en');
        }
        $societa_id = $request->societa_id;
		$divisioni_id = $request->divisioni_id;
        $regioni_id = $request->regioni_id;
        

        $where = '';

        if($societa_id > 0 ) $where .= ' societa_id = '.$societa_id;
		//if($divisioni_id > 0 ) $where .= ' and divisioni_id = '.$divisioni_id;
        if($regioni_id > 0 ) $where .= ' and regioni_id = '.$regioni_id;

        if($where!='') {
            $where .= ' and intAttivo = "Si"';
        } else {
            $where = ' intAttivo = "Si"';
        }
        

    //  $result = DB::select("select  * from filialis where societa_id =".$societa_id." and nazioni_id =  ".$nazioni_id." and regioni_id=".$regioni_id);
        $result = DB::select('select id,nomefiliale from filialis where '.$where.' order by nomefiliale asc');

      //$test= "select  * from filialis where societa_id =".$societa_id." and nazioni_id =  ".$nazioni_id." and regioni_id=".$regioni_id;
        $str= '';
        $str = '<option value disabled selected>'.trans("campi.selfil").'</option>';
        foreach($result as $r){
            $str .= '<option value ="'.$r->id.'">'.$r->nomefiliale.'</option>';
        }

        return $str;

    }

    public function getfield(Request $request){
        $id = $request->id;
        $flagDiv = 0;
        if($request->divisione_id > 0){
            $resultDiv = DB::select("select 
							coalesce(d.logo,'') as logoDv,coalesce(d.divisione,'') as divisione,coalesce(d.id,'') as idDivisione
							from divisionis d
							where
							d.id=".$request->divisione_id);
            $flagDiv = 1;
        }
        // coalesce(d.layout_id,1) as layoutD,coalesce(d.logo,'') as logoDv,coalesce(d.divisione,'') as divisione,coalesce(d.id,'') as idDivisioni,
		$result = DB::select("select 
                                f.*,
																f.cap as cap1,
                                s.societa,
																coalesce(s.layout_id,1) as layoutS,
																coalesce(s.urlweb,'') as urlweb,
																coalesce(s.urlweb1,'') as urlweb1,
																coalesce(s.dominio,'') as dominio,
                                coalesce(s.logo,'') as logoS,
																coalesce(s.firma,'') as firmaImg,
																coalesce(s.firmalink,'') as firmaImgLink,
																coalesce(s.id,'') as idSocieta,
                                s.privacy,
                               
                                coalesce(p.id,'') as idProvincia,coalesce(p.provincia,'') as provincia,coalesce(p.siglapv,'') as provincia,
								coalesce(f.provincia) as fprovincia,
                                coalesce(r.id,'') as idRegione,coalesce(r.regione,'') as regione,
                                coalesce(n.prefisso,'') as prefisso
                                from filialis as f 
                                inner join societas as s on f.societa_id = s.id
                                left join divisionis as d on f.divisioni_id = d.id
                                left join provinces as p on f.province_id = p.id
                                inner join regionis as r on f.regioni_id = r.id
                                inner join nazionis as n on r.nazioni_id = n.id
                                where f.intAttivo = 'Si' and f.id =".$id);

        // nicpaola 07-2020 
        $resultSocial = DB::select("SELECT
				id,
				label,url,
				image 
				FROM societa_social 
				WHERE societa_id = ".$result[0]->societa_id." 
				ORDER BY sort_order");
			
        $result[0]->socialArray = $resultSocial;

        if($flagDiv == 1){
            $result[0]->logoS = $resultDiv[0]->logoDv;
            $result[0]->divisione = $resultDiv[0]->divisione;
            $result[0]->idDivisione = $resultDiv[0]->idDivisione;
        }

        return $result;
    }
	
	public function getLogoDivisione(Request $request){
		$id = $request->id;
		
		$result = DB::select("select 
							coalesce(d.logo,'') as logoDv,coalesce(d.divisione,'') as divisione,coalesce(d.id,'') as idDivisioni
							from divisionis d
							where
							d.id=".$id);
		return $result;
		
	}
	
    public function getfieldE(Request $request){
        $id = $request->id;
        // nicpaola 07-2020 
        $flagDiv = 0;
        if($request->divisione_id > 0){
            $resultDiv = DB::select("select 
                            coalesce(d.logo,'') as logoDv,coalesce(d.divisione,'') as divisione,coalesce(d.id,'') as idDivisione
                            from divisionis d
                            where
                            d.id=".$request->divisione_id);
            $flagDiv = 1;
        }
        $result = DB::select("SELECT 
				s.societa,
				coalesce(s.layout_id,1) as layoutS,
				coalesce(s.urlweb,'') as urlweb,
				coalesce(s.urlweb1,'') as urlweb1,
				coalesce(s.dominio,'') as dominio,
        coalesce(s.logo,'') as logoS,
				coalesce(s.firma,'') as firmaImg,
				coalesce(s.firmalink,'') as firmaImgLink,
				coalesce(s.id,'') as idSocieta,s.privacy,
        n.* 
				FROM societas as s 
        INNER JOIN nazionis as n ON s.nazioni_id = n.id 
				WHERE s.id=".$id);

        // nicpaola 07-2020 
        $resultSocial = DB::select("select id,label,url,image from societa_social WHERE societa_id = ".$result[0]->idSocieta);
        $result[0]->socialArray = $resultSocial;

        if($flagDiv == 1){
            $result[0]->logoS = $resultDiv[0]->logoDv;
            $result[0]->divisione = $resultDiv[0]->divisione;
            $result[0]->idDivisione = $resultDiv[0]->idDivisione;
        }

        return $result;
    }
    public function professione(Request $request){
        $prof = $request->professione;
        $sel = DB::select('select id from professionis where LOWER(professione) LIKE "'.strtolower($prof).'"');
        if(count($sel) < 1){
          $insert =   DB::table('professionis')->insert(['professione'=>$prof]);
            return $insert;
        }else{
            return;
        }
    }
    public function wfirma(Request $request){
        var_dump($request->all());
        exit;
    }
    public function setqta(Request $request){
        $data = array(
        'datapres' => date('Y-m-d H:i:s'),
        'professione' => $request->professione,
        'qta' => $request->qta,
        'nome' => $request->nome.' '.$request->cognome,
        'societa_id' => $request->societa,
        'filiali_id' => $request->filiale,
        'file' => date('YmdHis').$request->nome.' '.$request->cognome.'.html'
    );
      $data =  DB::table('bigliettis')->insert($data);
        return json_encode($data);
    }

    public function duplica(Request $request){
        $id = $request->id;
        $record = DB::select('select * from filialis where id = '.$id);
        $data = array(
            'cap'           =>$record[0]->cap,
            'citta'         =>$record[0]->citta,
            'codfiliale'    =>$record[0]->codfiliale,
            'codice'        =>$record[0]->codice,
            'codtrip'       =>$record[0]->codtrip,
            'created_at'    =>date('Y-m-d H:i:s'),
            'divisioni_id'  =>$record[0]->divisioni_id,
            'email'         =>$record[0]->email,
            'fax'           =>$record[0]->fax,
            'indirizzo'     =>$record[0]->indirizzo,
            'intAttivo'     =>$record[0]->intAttivo,
            'nazioni_id'    =>$record[0]->nazioni_id,
            'nomefiliale'   =>$record[0]->nomefiliale,
            'province_id'   =>$record[0]->province_id,
            'provincia'     =>$record[0]->provincia,
            'regioni_id'    =>$record[0]->regioni_id,
            'societa_id'    =>$record[0]->societa_id,
            'tel'           =>$record[0]->tel,
            'updated_at'    =>date('Y-m-d H:i:s')
            );
        $insert = DB::table('filialis')->insert($data);
        return json_encode($insert);
    }
    public function esporta(Request $request){
        $id_selected = implode(',',$request->id);
      //  DB::table('ordinis')->whereIn('id',$id_selected)->update(['intEvaso'=>'In Lavorazione']);
        $arrayHeaders = array(
            'Codice Dipendente',
            'Cognome',
            'Nome',
            'Professione',
            'Società',
            'Divisione',
            'Filiale',
            'Quantità',
            'Business',
            'cocncacdc',
            'concalocation',
            'Data Richiesta'
        );
        $data = Ordini::select('coddipendente','cognome','nome','professione','societa','divisione','filiale','qt','business','concacdc','concalocation','datapres')->whereIn('id',$id_selected)->get()->toArray();
        return Excel::create('ordini', function($excel) use ($data) {
            $excel->sheet('sheet1', function($sheet) use ($data)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Codice Dipendente');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Cognome');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Nome');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Professione');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Società');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('Divisione');   });
                $sheet->cell('G1', function($cell) {$cell->setValue('Filiale');   });
                $sheet->cell('H1', function($cell) {$cell->setValue('Quantità');   });
                $sheet->cell('I1', function($cell) {$cell->setValue('Business');   });
                $sheet->cell('J1', function($cell) {$cell->setValue('cocncacdc');   });
                $sheet->cell('K1', function($cell) {$cell->setValue('concalocation');   });
                $sheet->cell('L1', function($cell) {$cell->setValue('Data Richiesta');   });
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value['coddipendente']);
                        $sheet->cell('B'.$i, $value['cognome']);
                        $sheet->cell('C'.$i, $value['nome']);
                        $sheet->cell('D'.$i, $value['professione']);
                        $sheet->cell('E'.$i, $value['societa']);
                        $sheet->cell('F'.$i, $value['divisione']);
                        $sheet->cell('G'.$i, $value['filiale']);
                        $sheet->cell('H'.$i, $value['qt']);
                        $sheet->cell('I'.$i, $value['business']);
                        $sheet->cell('J'.$i, $value['concacdc']);
                        $sheet->cell('K'.$i, $value['concalocation']);
                        $sheet->cell('L'.$i, $value['datapres']);

                    }
                }
                //  $sheet->fromArray($data, '', '', '', $arrayHeaders);
            });
        })->export('xlsx');
        rerturn;
    }


    // nicpaola 07-2020 - nuova export CSV
    public function esportaOrdini(Request $request){
        if(isset($request->id)) {
            $id_selected = implode(',',$request->id);
            $data = Ordini::select('*')->where('intEvaso','Nuovo')->whereIn('id',$id_selected)->get()->toArray();
        } else {
            $data = Ordini::select('*')->where('intEvaso','Nuovo')->get()->toArray();
        }

        header('Set-Cookie: fileDownload=true; path=/');
        header('Cache-Control: max-age=60, must-revalidate');
        header("Content-type: text/csv");
        header('Content-Disposition: attachment; filename="EsportazioneOrdini-'.time().'.csv"');
        
        $fp = fopen('php://output', 'wb');
        $headerArray = explode(";", "Codice Dipendente;Cognome;Nome;Professione;Codice Societa;Societa;Divisione;Codice Filiale;Filiale;Qt.a;Business;Concatena CDC;Concatena Location;Data Presentazione;File;Stato;Tripletta;Tripletta esiste;Nome Cognome;Professione;m.;Mobile;t.;Tel.;Indirizzo;CAP;Città;Prov;Mail;Sito");
        fputcsv($fp, $headerArray, ";");

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $i= $key+2;

                $rowArray = array();
                $rowArray[0] = $value['coddipendente'];
                $rowArray[1] = $value['cognome'];
                $rowArray[2] = $value['nome'];
                $rowArray[3] = $value['professione'];
                $rowArray[4] = $value['codsocieta'];
                $rowArray[5] = $value['societa'];
                $rowArray[6] = $value['divisione'];
                $rowArray[7] = $value['codfiliale'];
                $rowArray[8] = $value['filiale'];
                $rowArray[9] = $value['qt'];
                $rowArray[10] = $value['business'];
                $rowArray[11] = $value['concacdc'];
                $rowArray[12] = $value['concalocation'];
                $rowArray[13] = $value['datapres'];
                //$rowArray[14] = $value['file'];
                $rowArray[14] = 'http://'.$_SERVER['HTTP_HOST'].'/viewbigli/'.$value['id'];
                $rowArray[15] = $value['intEvaso'];
                $rowArray[16] = $value['tripletta'];
                $rowArray[17] = $value['tripexist'];
                $rowArray[18] = ucwords(strtolower($value['nome']))." ".ucwords(strtolower($value['cognome']));
                $rowArray[19] = $value['professione'];
                if(!is_null($value['cell']) && trim($value['cell'])!="") {
                    $rowArray[20] = "m.";
                    $rowArray[21] = $value['cellnaz']." ".$value['prefcell']." ".$value['cell'];
                } else {
                    $rowArray[20] = "";
                    $rowArray[21] = "";
                }
                if(!is_null($value['telefono']) && trim($value['telefono'])!="") {
                    $rowArray[22] = "t.";
                    $rowArray[23] = $value['prefnaz']." ".$value['preftel']." ".$value['telefono'];
                } else {
                    $rowArray[22] = "";
                    $rowArray[23] = "";
                }
                // separate address
                $indirizzo="";
                $cap="";
                $citta="";
                $prov="";
                if(!is_null($value['indirizzo']) && trim($value['indirizzo'])!="") {
                    $arrayIndirizzo = explode(" - ", $value['indirizzo']);
                    if($arrayIndirizzo && isset($arrayIndirizzo[0])) {
                        if(count($arrayIndirizzo)>2) {
                            $indirizzo = trim($arrayIndirizzo[0])." - ".trim($arrayIndirizzo[1]);
                            if(isset($arrayIndirizzo[2])) {
                                $posCap = strpos($arrayIndirizzo[2], " ");
                                if($posCap) {
                                    $cap = substr($arrayIndirizzo[2],0,$posCap);
                                }

                                $posProv = strpos($arrayIndirizzo[2], "(");
                                if($posProv) {
                                    $prov = substr($arrayIndirizzo[2],$posProv);
                                }

                                if($posCap)
                                    $citta = substr($arrayIndirizzo[2],$posCap+1);
                                else
                                    $citta = $arrayIndirizzo[2];

                                if($prov!="")
                                    $citta = str_replace($prov, "", $citta);
                            }
                        } else {
                            $indirizzo = trim($arrayIndirizzo[0]);
                            if(isset($arrayIndirizzo[1])) {
                                $posCap = strpos($arrayIndirizzo[1], " ");
                                if($posCap) {
                                    $cap = substr($arrayIndirizzo[1],0,$posCap);
                                }

                                $posProv = strpos($arrayIndirizzo[1], "(");
                                if($posProv) {
                                    $prov = substr($arrayIndirizzo[1],$posProv);
                                }

                                if($posCap)
                                    $citta = substr($arrayIndirizzo[1],$posCap+1);
                                else
                                    $citta = $arrayIndirizzo[1];

                                if($prov!="")
                                    $citta = str_replace($prov, "", $citta);
                            }
                        }
                    }
                }
                $rowArray[24] = $indirizzo;
                $rowArray[25] = $cap;
                $rowArray[26] = $citta;
                $rowArray[27] = $prov;
                if(!is_null($value['email']) && trim($value['email'])!="") {
                    $rowArray[28] = $value['email'].$value['at'].$value['emaildomain'];
                } elseif(!is_null($value['emailBF']) && trim($value['emailBF'])!="") {
                    $rowArray[28] = $value['emailBF'];
                } else {
                    $rowArray[28] = "";
                }
                if(!is_null($value['cdominio']) && trim($value['cdominio'])!="") {
                    $rowArray[29] = "www.".$value['cdominio'];
                } else {
                    $rowArray[29] = "";
                }

                fputcsv($fp, $rowArray, ";");
            }

            // UPDATE IN LAVORAZIONE
            DB::table('ordinis')->where('intEvaso','Nuovo')->update(['intEvaso'=>'In Lavorazione']);
        }

        fclose($fp);
    }

    public function approva(Request $request){
        $id = $request->id;
        DB::table('professionis')->where('id',$id)->update(['intAttivo'=>"Si"]);
         DB::statement('update ordinis set professione = REPLACE(professione,"*","") where idProf = '.$id);
         return redirect('/admin/professionis');
        
    }

    // nicpaola 07-2020
    public function checkSponsorImage(Request $request){
        $idImage = $request->id;
        if($idImage==1) {
            header('Content-type: image/jpeg');
            readfile(storage_path().'/app/uploads/sponsor_images/1596187255_s-l1600.jpg');
            exit;
        } else {
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/uploads/sponsor_images/1596028417_Schermata 2020-07-28 alle 14.20.53.png');
            exit;
        }
    }
}
