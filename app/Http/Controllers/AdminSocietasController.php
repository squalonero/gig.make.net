<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Route;

class AdminSocietasController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "id";
		$this->limit = "20";
		$this->orderby = "societa,desc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = true;
		$this->button_action_style = "button_icon";
		$this->button_add = true;
		$this->button_edit = true;
		$this->button_delete = true;
		$this->button_detail = true;
		$this->button_show = true;
		$this->button_filter = true;
		$this->button_import = false;
		$this->button_export = false;
		$this->table = "societas";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
		$this->col[] = ["label" => "Societa", "name" => "societa"];
		$this->col[] = ["label" => "Nazione", "name" => "nazioni_id", "join" => "nazionis,nazione"];
		$this->col[] = ["label" => "Codice", "name" => "codice"];
		$this->col[] = ["label" => "Logo", "name" => "logo", "image" => true];
		$this->col[] = ["label" => "layout", "name" => "layout_id", "join" => "layouts,layout"];
		$this->col[] = ["label" => "Default Email", "name" => "urlweb1"];
		$this->col[] = ["label" => "Default Sito", "name" => "dominio"];
		$this->col[] = ["label" => "Dominio Alternativo", "name" => "urlweb"];
		$this->col[] = ["label" => "Endorsment-Img", "name" => "endorsement", "image" => true];
		$this->col[] = ["label" => "Privacy", "name" => "privacy"];
		$this->col[] = ["label" => "Attivo", "name" => "intAttivo"];
		# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Società','name'=>'societa','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Nazione','name'=>'nazioni_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-9','datatable'=>'nazionis,nazione'];
			$this->form[] = ['label'=>'Codice','name'=>'codice','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Logo','name'=>'logo','type'=>'upload','validation'=>'min:1|max:5000','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Larghezza Logo','name'=>'logo_width','type'=>'hidden','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			$this->form[] = ['label'=>'Layout','name'=>'layout_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-9','datatable'=>'layouts,layout'];
			$this->form[] = ['label'=>'Default Email','name'=>'urlweb1','type'=>'text','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Default Sito','name'=>'dominio','type'=>'text','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Dominio Alternativo','name'=>'urlweb','type'=>'text','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Endorsement','name'=>'endorsement','type'=>'upload','validation'=>'min:1|max:5000','width'=>'col-sm-3','help'=>'Solo Layout 1 (esce prima del logo "MTW"). Caricare logo "More than work" qui per layout 3'];
			$this->form[] = ['label'=>'Larghezza Endorsement','name'=>'endorsement_width','type'=>'hidden','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			$this->form[] = ['label'=>'Endorsement Link','name'=>'endorsement_link','type'=>'text','validation'=>'nullable','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Sponsor','name'=>'sponsor_img','type'=>'upload','width'=>'col-sm-3','help'=>'Nel layout 1 esce dopo al logo "MTW"'];
			$this->form[] = ['label'=>'Larghezza Sponsor','name'=>'sponsor_width','type'=>'hidden','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			$this->form[] = ['label'=>'Sponsor Link','name'=>'sponsor_img_link','type'=>'text','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Privacy','name'=>'privacy','type'=>'textarea','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Attivo','name'=>'intAttivo','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-9','dataenum'=>'Si;No'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Società','name'=>'societa','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Nazione','name'=>'nazioni_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-9','datatable'=>'nazionis,nazione'];
			//$this->form[] = ['label'=>'Codice','name'=>'codice','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Logo','name'=>'logo','type'=>'upload','validation'=>'min:1|max:5000','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Larghezza Logo','name'=>'logo_width','type'=>'number','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			//$this->form[] = ['label'=>'Layout','name'=>'layout_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-9','datatable'=>'layouts,layout'];
			//$this->form[] = ['label'=>'Default Email','name'=>'urlweb1','type'=>'text','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Default Sito','name'=>'dominio','type'=>'text','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Dominio Alternativo','name'=>'urlweb','type'=>'text','width'=>'col-sm-9','help'=>'Se inserito, l\'endorsement sarà incapsulato in questo link'];
			//$this->form[] = ['label'=>'Endorsement','name'=>'endorsement','type'=>'upload','validation'=>'min:1|max:5000','width'=>'col-sm-3','help'=>'Solo Layout 1'];
			//$this->form[] = ['label'=>'Larghezza Endorsement','name'=>'endorsement_width','type'=>'number','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			//$this->form[] = ['label'=>'Endorsement Link','name'=>'endorsement_link','type'=>'text','validation'=>'nullable','width'=>'col-sm-9','help'=>'Solo Layout 1'];
			//$this->form[] = ['label'=>'Sponsor','name'=>'sponsor_img','type'=>'upload','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Larghezza Sponsor','name'=>'sponsor_width','type'=>'number','validation'=>'integer','width'=>'col-sm-2','help'=>'Se lasciato a zero verrà usata la larghezza in pixel dell\'immagine'];
			//$this->form[] = ['label'=>'Sponsor Link','name'=>'sponsor_img_link','type'=>'text','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Privacy','name'=>'privacy','type'=>'textarea','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Attivo','name'=>'intAttivo','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-9','dataenum'=>'Si;No'];
			# OLD END FORM

			/*
	        | ----------------------------------------------------------------------
	        | Sub Module
	        | ----------------------------------------------------------------------
			| @label          = Label of action
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        |
	        */
		//$this->sub_module = array();

		// nicpaola 28-24-2020 - ADD SOCIAL
		$this->sub_module[] = ['label' => 'Link Social', 'path' => 'societa_social', 'parent_columns' => 'label,url,image', 'foreign_key' => 'societa_id', 'button_color' => 'success', 'button_icon' => 'fa fa-bars'];


		/*
	        | ----------------------------------------------------------------------
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        |
	        */
		$this->addaction = array();


		/*
	        | ----------------------------------------------------------------------
	        | Add More Button Selected
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button
	        | Then about the action, you should code at actionButtonSelected method
	        |
	        */
		$this->button_selected = array();


		/*
	        | ----------------------------------------------------------------------
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------
	        | @message = Text of message
	        | @type    = warning,success,danger,info
	        |
	        */
		$this->alert        = array();



		/*
	        | ----------------------------------------------------------------------
	        | Add more button to header button
	        | ----------------------------------------------------------------------
	        | @label = Name of button
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        |
	        */
		$this->index_button = array();



		/*
	        | ----------------------------------------------------------------------
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
	        |
	        */
		$this->table_row_color = array();


		/*
	        | ----------------------------------------------------------------------
	        | You may use this bellow array to add statistic at dashboard
	        | ----------------------------------------------------------------------
	        | @label, @count, @icon, @color
	        |
	        */
		$this->index_statistic = array();



		/*
	        | ----------------------------------------------------------------------
	        | Add javascript at body
	        | ----------------------------------------------------------------------
	        | javascript code in the variable
	        | $this->script_js = "function() { ... }";
	        |
	        */
		$this->script_js = NULL;


		/*
	        | ----------------------------------------------------------------------
	        | Include HTML Code before index table
	        | ----------------------------------------------------------------------
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
		$this->pre_index_html = null;



		/*
	        | ----------------------------------------------------------------------
	        | Include HTML Code after index table
	        | ----------------------------------------------------------------------
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
		$this->post_index_html = null;



		/*
	        | ----------------------------------------------------------------------
	        | Include Javascript File
	        | ----------------------------------------------------------------------
	        | URL of your javascript each array
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
		$this->load_js = array();



		/*
	        | ----------------------------------------------------------------------
	        | Add css style at body
	        | ----------------------------------------------------------------------
	        | css code in the variable
	        | $this->style_css = ".style{....}";
	        |
	        */
		$this->style_css = "td img{
   width: auto;
    height: auto;
    min-width: 0;
    max-width: 200px;
	            }";



		/*
	        | ----------------------------------------------------------------------
	        | Include css File
	        | ----------------------------------------------------------------------
	        | URL of your css each array
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
		$this->load_css = array();
	}


	/*
	    | ----------------------------------------------------------------------
	    | Hook for button selected
	    | ----------------------------------------------------------------------
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	public function actionButtonSelected($id_selected, $button_name)
	{
		//Your code here

	}


	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate query of index result
	    | ----------------------------------------------------------------------
	    | @query = current sql query
	    |
	    */
	public function hook_query_index(&$query)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate row of index table html
	    | ----------------------------------------------------------------------
	    |
	    */
	public function hook_row_index($column_index, &$column_value)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before add data is execute
	    | ----------------------------------------------------------------------
	    | @arr
	    |
	    */
	public function hook_before_add(&$postdata)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after add public static function called
	    | ----------------------------------------------------------------------
	    | @id = last insert id
	    |
	    */
	public function hook_after_add($id)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before update data is execute
	    | ----------------------------------------------------------------------
	    | @postdata = input post data
	    | @id       = current id
	    |
	    */
	public function hook_before_edit(&$postdata, $id)
	{
		//Your code here

		//mirco 04.05.2021 manage empty string for firmalink field
		//@laravel bug fixed with nullable fields in next versions Kernel.php
		if (!isset($postdata['endorsement']))
		{
			$postdata['endorsement'] = '';
		}
		if (!isset($postdata['sponsor_img']))
		{
			$postdata['sponsor_img'] = '';
		}
		if (!isset($postdata['logo']))
		{
			$postdata['logo'] = '';
		}
        
        if (!isset($postdata['endorsement_link']))
		{
			$postdata['endorsement_link'] = '';
		}
        
		if (!isset($postdata['sponsor_img_link']))
		{
			$postdata['sponsor_img_link'] = '';
		}
        
		if (!isset($postdata['urlweb1'])) //email
		{
			$postdata['urlweb1'] = '';
		}
        
        if (!isset($postdata['dominio'])) //default sito
		{
			$postdata['dominio'] = '';
		}
        
        if (!isset($postdata['urlweb'])) //dominio alternativo
		{
			$postdata['urlweb'] = '';
		}
		//end mirco

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	public function hook_after_edit($id)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	public function hook_before_delete($id)
	{
		//Your code here

	}

	/*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------

	    | @id       = current id
	    |
	    */
	public function hook_after_delete($id)
	{
		//Your code here

	}



	//By the way, you can still create your own method in here... :)

	public function getAdd()
	{
		//Create an Auth
		$this->cbLoader();
		if (!CRUDBooster::isCreate() && $this->global_privilege == false || $this->button_add == false)
		{
			CRUDBooster::insertLog(cbLang('log_try_add', ['module' => CRUDBooster::getCurrentModule()->name]));
			CRUDBooster::redirect(CRUDBooster::adminPath(), cbLang("denied_access"));
		}

		$page_title = cbLang("add_data_page_title", ['module' => CRUDBooster::getCurrentModule()->name]);
		$page_menu = Route::getCurrentRoute()->getActionName();
		$command = 'add';

		//Please use view method instead view method from laravel
		return $this->view('admin_form', compact('page_title', 'page_menu', 'command'));
	}

	public function getEdit($id)
	{
		$this->cbLoader();
		$row = DB::table($this->table)->where($this->primary_key, $id)->first();

		if (!CRUDBooster::isRead() && $this->global_privilege == false || $this->button_edit == false)
		{
			CRUDBooster::insertLog(cbLang("log_try_edit", [
				'name' => $row->{$this->title_field},
				'module' => CRUDBooster::getCurrentModule()->name,
			]));
			CRUDBooster::redirect(CRUDBooster::adminPath(), cbLang('denied_access'));
		}

		$page_menu = Route::getCurrentRoute()->getActionName();
		$page_title = cbLang("edit_data_page_title", ['module' => CRUDBooster::getCurrentModule()->name, 'name' => $row->{$this->title_field}]);
		$command = 'edit';
		Session::put('current_row_id', $id);

		return view('admin_form', compact('id', 'row', 'page_menu', 'page_title', 'command'));
	}
}