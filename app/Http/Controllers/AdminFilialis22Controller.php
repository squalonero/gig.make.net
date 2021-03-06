<?php namespace App\Http\Controllers;



	use Session;

	use Request;

	use DB;

	use CRUDBooster;



	class AdminFilialis22Controller extends \crocodicstudio\crudbooster\controllers\CBController {



	    public function cbInit() {



			# START CONFIGURATION DO NOT REMOVE THIS LINE

			$this->title_field = "codice";

			$this->limit = "20";

			$this->orderby = "nomefiliale,desc";

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

			$this->button_export = true;

			$this->table = "filialis";

			# END CONFIGURATION DO NOT REMOVE THIS LINE



			# START COLUMNS DO NOT REMOVE THIS LINE

			$this->col = [];

			$this->col[] = ["label"=>"Codice Filiale","name"=>"codice"];

			$this->col[] = ["label"=>"Nomefiliale","name"=>"nomefiliale"];

			$this->col[] = ["label"=>"Codtrip","name"=>"codtrip"];

			$this->col[] = ["label"=>"Nazione","name"=>"nazioni_id","join"=>"nazionis,nazione"];

			$this->col[] = ["label"=>"Società","name"=>"societa_id","join"=>"societas,societa"];

			$this->col[] = ["label"=>"Divisioni","name"=>"divisioni_id","join"=>"divisionis,divisione"];

			$this->col[] = ["label"=>"Regione","name"=>"regioni_id","join"=>"regionis,regione"];

			$this->col[] = ["label"=>"Indirizzo","name"=>"indirizzo"];

			$this->col[] = ["label"=>"Cap","name"=>"cap"];

			$this->col[] = ["label"=>"Città","name"=>"citta"];

			$this->col[] = ["label"=>"Provincia","name"=>"provincia"];

			$this->col[] = ["label"=>"Telefono","name"=>"tel"];

			$this->col[] = ["label"=>"Fax","name"=>"fax"];

			$this->col[] = ["label"=>"E Mail","name"=>"email"];

			$this->col[] = ["label"=>"Attivo","name"=>"intAttivo"];

			# END COLUMNS DO NOT REMOVE THIS LINE



			# START FORM DO NOT REMOVE THIS LINE

			$this->form = [];

			$this->form[] = ['label'=>'Codice filiale','name'=>'codice','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Nomefiliale','name'=>'nomefiliale','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Codtrip','name'=>'codtrip','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Nazione','name'=>'nazioni_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'nazionis,nazione'];

			$this->form[] = ['label'=>'Società','name'=>'societa_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'societas,societa'];

			$this->form[] = ['label'=>'Regione','name'=>'regioni_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'regionis,regione'];

			$this->form[] = ['label'=>'Divisione','name'=>'divisioni_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'divisionis,divisione'];

			$this->form[] = ['label'=>'Indirizzo','name'=>'indirizzo','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Cap','name'=>'cap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Citta','name'=>'citta','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Provincia','name'=>'provincia','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Tel','name'=>'tel','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Fax','name'=>'fax','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Attivo','name'=>'intAttivo','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Si;No'];

			# END FORM DO NOT REMOVE THIS LINE



			# OLD START FORM

			//$this->form = [];

			//$this->form[] = ['label'=>'Codice filiale','name'=>'codice','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Nomefiliale','name'=>'nomefiliale','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Codtrip','name'=>'codtrip','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Nazione','name'=>'nazioni_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'nazionis,nazione'];

			//$this->form[] = ['label'=>'Società','name'=>'societa_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'societas,societa'];

			//$this->form[] = ['label'=>'Regione','name'=>'regioni_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'regionis,regione'];

			//$this->form[] = ['label'=>'Divisione','name'=>'divisioni_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'divisionis,divisione'];

			//$this->form[] = ['label'=>'Indirizzo','name'=>'indirizzo','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Cap','name'=>'cap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Citta','name'=>'citta','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Provincia','name'=>'provincia','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Tel','name'=>'tel','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Fax','name'=>'fax','type'=>'text','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','width'=>'col-sm-10'];

			//$this->form[] = ['label'=>'Attivo','name'=>'intAttivo','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Si;No'];

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

            $this->index_button[] = ['label'=>'Duplica','url'=>"#","icon"=>"fa fa-copy"];







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

            $this->script_js = "$(document).ready(function() {

                $('#nazioni_id').change(function(){

                    var nazioneId = $('#nazioni_id').val();

                    // console.log(nazioneId);

                    $.ajax({

                        type:'get',

                        url: '/getsoc',

                        data:{'id':nazioneId},

                        success: function(data){

                            $('#societa_id').empty();

                            for (var i = 0; i < data.length; i++) {

                                $('#societa_id').append('<option value=\"'+data[i].id+'\">'+data[i].societa+'</option>');

                            }

                        }

                    });

                });

                $('#duplica').click(function(){

                    var checked = []

                    $(\"input[name='checkbox[]']:checked\").each(function ()

                    {

                        checked.push(parseInt($(this).val()));

                    });



                    if(checked.length > 0){

                        // for(i=0; i< checked.length; i++){

                        //     $.ajax({

                        //         type:'get',
                        //         url: '/duplicarec',
                        //         data:{'id':checked[i]},
                        //         success: function(data){
                        //         //console.log(data);
                        //         }

                        //     });

                        // }

						Promise.all(checked.map(function(val){
							return new Promise(function(res, rej){
								$.ajax({

									type:'get',
									url: '/duplicarec',
									data:	{'id':val},
									success: function(data){
										res(data)
									}

								})
							})

						})) //promise All
						.then(function(data){
							console.log(`Duplicate done. Result below:`)
							console.log(data)
							location.reload()
						})

                        //$(window.location).attr(\"href\", \"/admin/filialis22\");

                    }else{

                    alert(\"ATTENZIONE selezionare almeno una riga\");

                        return false;

                        }

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

    max-width: none;

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

	    public function actionButtonSelected($id_selected,$button_name) {

	        //Your code here



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



	    }



	    /*

	    | ----------------------------------------------------------------------

	    | Hook for manipulate row of index table html

	    | ----------------------------------------------------------------------

	    |

	    */

	    public function hook_row_index($column_index,&$column_value) {

	    	//Your code here

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

            if(!isset($postdata['tel']))
				$postdata['tel'] = '';

			if(!isset($postdata['fax']))
				$postdata['fax'] = '';

			if(!isset($postdata['email']))
				$postdata['email'] = '';

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

            if(!isset($postdata['tel']))
				$postdata['tel'] = '';

			if(!isset($postdata['fax']))
				$postdata['fax'] = '';

			if(!isset($postdata['email']))
				$postdata['email'] = '';

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