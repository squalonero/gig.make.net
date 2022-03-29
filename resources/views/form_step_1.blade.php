
@extends("layouts.user")
@if(Session::get('tipoFlag') == 'bigliettiP')
        @section('title', trans('campi.biglietti_personalizzati'))
@elseif(Session::get('tipoFlag') == 'firmaP')
        @section('title', trans('campi.firme_personalizzate') )
@elseif(Session::get('tipoFlag') == 'firmaF')
    @section('title', trans('campi.firme_per_filiale'))
@else
    @section('title', trans('campi.biglietti_per_filiale'))
@endif

@section('container', 'container')
@section("content")

    <div class="row">
        <div class="col-md-12">
			@if(Session::get('tipoFlag') == 'bigliettiP' || Session::get('tipoFlag') == 'bigliettiF')
			<!--<div class="alert alert-danger" role="alert">
  			<strong>ATTENZIONE</strong> L'ordine dei biglietti è in manutenzione. Riprovare più tardi.
			</div>-->
			@endif
            <h2 class="title text-center">@yield('title')</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form>
             @if( Session::get('nazione')  != 11)
                <div class="form-group">
                    <label for="societa_id">{!!  trans('campi.nazioni') !!}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="nazioni_id" id="nazioni_id" class="form-control select2-hidden-accessible " rel="select2" aria-hidden="true" data-placeholder="Select Countryes" >
                            {!! $nazioni !!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="societa_idE">{!!  trans('campi.societa') !!}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="societa_idE" id="societa_idE" class="form-control select2-hidden-accessible " rel="select2" aria-hidden="true" data-placeholder="Seleziona" >
                        </select>
                    </div>
                </div>
                <!-- nicpaola 07-2020 -->
                <div class="form-group">
                    <label for="divisioni_idE">{{ trans('campi.divisioni') }}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="divisioni_idE" id="divisioni_idE" class="form-control select2-hidden-accessible" rel="select2" aria-hidden="true" data-placeholder="Seleziona" >
                        </select>
                    </div>
                </div>
             @endif
              @if( Session::get('nazione')  == 11)
                <div class="form-group">
                    <label for="societa_id">{!!  trans('campi.societa') !!}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="societa_id" id="societa_id" class="form-control select2-hidden-accessible " rel="select2" aria-hidden="true" data-placeholder="Seleziona" >
                            {!! $societa !!}
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="divisioni_id">{{ trans('campi.divisioni') }}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="divisioni_id" id="divisioni_id" class="form-control select2-hidden-accessible" rel="select2" aria-hidden="true" data-placeholder="Seleziona" >

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="regioni_id">{{ trans('campi.regioni') }}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="regioni_id" id="regioni_id" class="form-control select2-hidden-accessible" rel="select2" aria-hidden="true" data-placeholder="Seleziona" >

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="filiali_id">{{ trans('campi.filiali') }}</label>
                    <div class="dropSelect mDropSel">
                        <select  name="filiali_id" id="filiali_id" class="form-control select2-hidden-accessible" rel="select2" aria-hidden="true" data-placeholder="Seleziona" >
                        </select>
                    </div>
                </div>
            @endif
            </form>
        </div>

    </div>

    <div class="row layout1" style="display:none;">
        <!-- firmePers1 = layout 1 -->
        @include('form_step_2')
    </div>

    <div id="divFirma" style="display:none">
        @include('layouts.firmeHtmlPers')
    </div>

    <hr>
   <script src="vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="js/custom.js?time=<?= time() ?>"></script>

<script>
    var emailObb = "<?php echo Session::get('tipoFlag');?>";
    var nazioneId = <?php echo Session::get('nazione');?>;
    $( function() {

        var availableTags = [
            <?php
                foreach($professioni as $prof){
                    echo '"'.ucwords(strtolower($prof->professione)).'",'."\n";
                }
                ?>
                ""
        ];
        $( "#professione" ).autocomplete({
            source: availableTags
        });
    } );
</script>
@endsection