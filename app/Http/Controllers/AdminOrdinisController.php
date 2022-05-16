<?php namespace App\Http\Controllers;

    use App\Ordini;

	use Session;

	use Request;

	use DB;

	use CRUDBooster;

	use Excel;



	class AdminOrdinisController extends \crocodicstudio\crudbooster\controllers\CBController {



	    public function cbInit() {



			# START CONFIGURATION DO NOT REMOVE THIS LINE

			$this->title_field = "codsocieta";

			$this->limit = "20";

			$this->orderby = "id,desc";

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

			//$this->button_export = true;

			$this->button_export = false; // nicpaola 07-2020

			$this->table = "ordinis";

			# END CONFIGURATION DO NOT REMOVE THIS LINE



			# START COLUMNS DO NOT REMOVE THIS LINE

			$this->col = [];

			$this->col[] = ["label"=>"Codice Dipendente","name"=>"coddipendente"];

			$this->col[] = ["label"=>"Cognome","name"=>"cognome"];

			$this->col[] = ["label"=>"Nome","name"=>"nome"];

          //  $this->col[] = ["label"=>"Professione","name"=>"professioni_id","join"=>"professionis,professione"];

			$this->col[] = ["label"=>"Professione","name"=>"professione"];

			$this->col[] = ["label"=>"Codice Societa","name"=>"codsocieta"];

			$this->col[] = ["label"=>"Societa","name"=>"societa"];

			$this->col[] = ["label"=>"Divisione","name"=>"divisione"];

			$this->col[] = ["label"=>"Codice Filiale","name"=>"codfiliale"];

			$this->col[] = ["label"=>"Filiale","name"=>"filiale"];

			$this->col[] = ["label"=>"Qt.a","name"=>"qt"];

			$this->col[] = ["label"=>"Business","name"=>"business"];

			$this->col[] = ["label"=>"Concatena CDC","name"=>"concacdc"];

			$this->col[] = ["label"=>"Concatena Location","name"=>"concalocation"];

			$this->col[] = ["label"=>"Data Presentazione","name"=>"datapres"];

			$this->col[] = ["label"=>"File","name"=>"file"];

			$this->col[] = ["label"=>"Stato","name"=>"intEvaso"];

			$this->col[] = ["label"=>"Tripletta","name"=>"tripletta"];

			$this->col[] = ["label"=>"Tripletta esiste","name"=>"tripexist"];

           // $this->col[] = ["label"=>"ProfAttiva","name"=>"profattiva"];

			# END COLUMNS DO NOT REMOVE THIS LINE



			# START FORM DO NOT REMOVE THIS LINE

			$this->form = [];

			$this->form[] = ['label'=>'Codice Dipendente','name'=>'coddipendente','type'=>'number','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Cognome','name'=>'cognome','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Nome','name'=>'nome','type'=>'text','width'=>'col-sm-10'];

           // $this->form[] = ['label'=>'Professione','name'=>'professioni_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'professionis,professioni'];

			$this->form[] = ['label'=>'Professione','name'=>'professione','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Codice Societa','name'=>'codsocieta','type'=>'number','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Societa','name'=>'societa','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			$this->form[] = ['label'=>'Divisione','name'=>'divisione','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			$this->form[] = ['label'=>'Codice Filiale','name'=>'codfiliale','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Filiale','name'=>'filiale','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			$this->form[] = ['label'=>'Qt.a','name'=>'qt','type'=>'number','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Business','name'=>'business','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Concatena CDC','name'=>'concacdc','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Concatena Location','name'=>'concalocation','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Data Presentazione','name'=>'datapres','type'=>'datetime','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'File','name'=>'file','type'=>'wysiwyg','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Stato','name'=>'intEvaso','type'=>'select','width'=>'col-sm-9','dataenum'=>'Nuovo;In Lavorazione;Evaso'];

			$this->form[] = ['label'=>'Tripletta','name'=>'tripletta','type'=>'text','width'=>'col-sm-9'];

			$this->form[] = ['label'=>'Tripletta esiste','name'=>'tripexist','type'=>'select','width'=>'col-sm-9','dataenum'=>'Esiste;Non esiste;'];

          //  $this->form[] = ['label'=>'ProfAttiva','name'=>'profattiva','type'=>'select','width'=>'col-sm-9','dataenum'=>'0;1'];

			# END FORM DO NOT REMOVE THIS LINE



			# OLD START FORM

			//$this->form = [];

			//$this->form[] = ['label'=>'Codice Dipendente','name'=>'coddipendente','type'=>'number','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Cognome','name'=>'cognome','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Nome','name'=>'nome','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Professione','name'=>'professione','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Codice Societa','name'=>'codsocieta','type'=>'number','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Societa','name'=>'societa','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			//$this->form[] = ['label'=>'Divisione','name'=>'divisione','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			//$this->form[] = ['label'=>'Codice Filiale','name'=>'codfiliale','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Filiale','name'=>'filiale','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			//$this->form[] = ['label'=>'Qt.a','name'=>'qt','type'=>'number','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Business','name'=>'business','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Concatena CDC','name'=>'concacdc','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Concatena Location','name'=>'concalocation','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Data Presentazione','name'=>'datapres','type'=>'datetime','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'File','name'=>'file','type'=>'wysiwyg','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Stato','name'=>'intEvaso','type'=>'select','width'=>'col-sm-9','dataenum'=>'Nuovo;In Lavorazione;Evaso'];

			//$this->form[] = ['label'=>'Tripletta','name'=>'tripletta','type'=>'text','validation'=>'required','width'=>'col-sm-9'];

			//$this->form[] = ['label'=>'Tripletta esiste','name'=>'tripexist','type'=>'select','validation'=>'required','width'=>'col-sm-9','dataenum'=>'1|Esiste;0|Non esiste;'];

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

	        $this->sub_module = array();





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

           $this->button_selected[] = ['label'=>'Evadi','icon'=>'fa fa-check','name'=>'evadi'];





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

	        //$this->index_button = array();

            $this->index_button[] = ['label'=>trans("crudbooster.button_export"),'url'=>"/esportaOrdini","icon"=>"fa fa-upload"]; // nicpaola 07-2020







	        /*

	        | ----------------------------------------------------------------------

	        | Customize Table Row Color

	        | ----------------------------------------------------------------------

	        | @condition = If condition. You may use field alias. E.g : [id] == 1

	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.

	        |

	        */

	        $this->table_row_color = array();

            $this->table_row_color[] = ["condition"=>"[tripexist] == 'Non esiste'","color"=>"danger"];





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

            $this->script_js = "$(document).ready(function() {

                    $('#btn_export_data').click(function(){

                       var checked = []

                        $(\"input[name='checkbox[]']:checked\").each(function (){

                            checked.push(parseInt($(this).val()));

                        });

                        checked = checked.toString();

                        $('#arrayID').val(checked);

                    });

                    $('#chiudi').click(function(){

                        window.location.href = \"/admin/ordinis\";

                    });

                })";





            /*

	        | ----------------------------------------------------------------------

	        | Include HTML Code before index table

	        | ----------------------------------------------------------------------

	        | html code to display it before index table

	        | $this->pre_index_html = "<p>test</p>";

	        |

	        */

	        $this->pre_index_html = NULL;







	        /*

	        | ----------------------------------------------------------------------

	        | Include HTML Code after index table

	        | ----------------------------------------------------------------------

	        | html code to display it after index table

	        | $this->post_index_html = "<p>test</p>";

	        |

	        */

	        $this->post_index_html = NULL;







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

	        $this->style_css = NULL;







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

	    public function actionButtonSelected($id_selected,$button_name) {

            if($button_name == 'evadi') {

                DB::table('ordinis')->whereIn('id',$id_selected)->update(['intEvaso'=>'Evaso']);

            }



	    }





	    /*

	    | ----------------------------------------------------------------------

	    | Hook for manipulate query of index result

	    | ----------------------------------------------------------------------

	    | @query = current sql query

	    |

	    */

	    public function hook_query_index(&$query) {

	        //Your code here

            $arrayID = '';

            $arrayID = Request::get('arrayID');

            if($arrayID !=''){

                $explode_id = array_map('intval', explode(',', $arrayID));

                $query->whereIn('id',$explode_id);

            }





	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for manipulate row of index table html

	    | ----------------------------------------------------------------------

	    |

	    */

	    public function hook_row_index($column_index,&$column_value) {



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for manipulate data input before add data is execute

	    | ----------------------------------------------------------------------

	    | @arr

	    |

	    */

	    public function hook_before_add(&$postdata) {

	        //Your code here



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for execute command after add public static function called

	    | ----------------------------------------------------------------------

	    | @id = last insert id

	    |

	    */

	    public function hook_after_add($id) {

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

	    public function hook_before_edit(&$postdata,$id) {

	        //Your code here



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for execute command after edit public static function called

	    | ----------------------------------------------------------------------

	    | @id       = current id

	    |

	    */

	    public function hook_after_edit($id) {

	        //Your code here



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for execute command before delete public static function called

	    | ----------------------------------------------------------------------

	    | @id       = current id

	    |

	    */

	    public function hook_before_delete($id) {

	        //Your code here



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for execute command after delete public static function called

	    | ----------------------------------------------------------------------

	    | @id       = current id

	    |

	    */

	    public function hook_after_delete($id) {

	        //Your code here



	    }







	    //By the way, you can still create your own method in here... :)





	}