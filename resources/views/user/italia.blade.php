@extends( 'layouts.user' )
@section('title', 'Landing')
@section('container', 'container')

@section('content')

<div class="stepsContainer">
	<div id="step1" class="d-flex justify-content-center align-items-center flex-direction gap-default">
		<div class="boxes step-1">
			<a id="creafirme" class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5 text-center" href="#">{!! trans('campi.creazione_firme')  !!}</a>
		</div>
		<div class="boxes step-1">
			<a id="creabiglietti" class="mbox rightbox d-flex justify-content-center align-items-center p-5 text-center" href="#">{!! trans('campi.creazione_biglietti') !!}</a>
		</div>
	</div>
	<div id="selType-creafirme" class="d-none justify-content-center align-items-center  gap-default">
		<div class="boxes">
			<a class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5" href="firpersonalizzate">{!! trans('campi.firme_personalizzate')  !!}</a>
		</div>
		<div class="boxes">
			<a class="mbox rightbox d-flex justify-content-center align-items-center p-5" href="firfiliale">{!! trans('campi.firme_per_filiale')  !!}</a>
		</div>

	</div>


	<div id="selType-creabiglietti" class="d-none justify-content-center align-items-center gap-default">
		<div class="boxes">
			<a class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5" href="biglpersonalizzati">{!! trans('campi.biglietti_personalizzati')  !!}</a>
		</div>
		<div class="boxes">
			<a class="mbox rightbox d-flex justify-content-center align-items-center p-5" href="biglfiliali">{!! trans('campi.biglietti_per_filiale')  !!}</a>
		</div>
	</div>

	<!--<a href="biglpersonalizzati" class="btn btn-primary w-100 mb-3">{!! trans('campi.biglietti_personalizzati')  !!}</a>
	<a href="biglfiliale" class="btn btn-primary w-100 mb-3">{!! trans('campi.biglietti_per_filiale')  !!}</a>-->
	<a href="#" class="goback w-100 d-none"><i class="fa fa-arrow-left"></i>{!! trans('campi.indietro')  !!}</a>
</div>

@endsection
@section('scripts')
<script>
	jQuery( function($){

		$('#step1 a').on('click', function(){
			let id = $(this).attr('id');
			$('#selType-'+id).removeClass('d-none').addClass('d-flex');
			$('#step1').removeClass('d-flex').addClass('d-none');
			$('.goback').removeClass('d-none').addClass('d-block');
		});

		$('a.goback').on('click', function(){
			$(this).closest('.stepsContainer').find('[id^="selType"]').removeClass('d-flex').addClass('d-none');
			$('#step1').removeClass('d-none').addClass('d-flex');
			$('.goback').removeClass('d-block').addClass('d-none');
		});

	});//endJquery
</script>
@endsection
