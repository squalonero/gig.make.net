@extends( 'layouts.user' )
@section('title', 'Landing')
@section('container', 'container')

@section('content')

<div class="d-flex justify-content-center align-items-center flex-direction">
	<div class="boxes">
		<a id="creafirme" class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5 text-center" href="#">{!! trans('campi.creazione_firme')  !!}</a>
	</div>
	<div id="selType-creafirme" class="d-none">
	<div class="d-flex justify-content-center align-items-center">
		<div>
			<a class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5" href="firpersonalizzate">{!! trans('campi.firme_personalizzate')  !!}</a>
		</div>
		<div>
			<a class="mbox rightbox d-flex justify-content-center align-items-center p-5" href="firfiliale">{!! trans('campi.firme_per_filiale')  !!}</a>
		</div>
	</div>
	<!--<a href="firpersonalizzate" class="btn btn-primary w-100 mb-3">{!! trans('campi.firme_personalizzate')  !!}</a>
	<a href="firfiliale" class="btn btn-primary w-100 mb-3">{!! trans('campi.firme_per_filiale')  !!}</a>-->
	<a href="#" class="goback w-100">{!! trans('campi.indietro')  !!}</a>
	</div>
	
	<div class="boxes">
		<a id="creabiglietti" class="mbox rightbox d-flex justify-content-center align-items-center p-5 text-center" href="#">{!! trans('campi.creazione_biglietti') !!}</a>
	</div>
	<div id="selType-creabiglietti" class="d-none">
		<div class="d-flex justify-content-center align-items-center">
		<div>
			<a class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5" href="biglpersonalizzati">{!! trans('campi.biglietti_personalizzati')  !!}</a>
		</div>
		<div>
			<a class="mbox rightbox d-flex justify-content-center align-items-center p-5" href="biglfiliali">{!! trans('campi.biglietti_per_filiale')  !!}</a>
		</div>
	</div>
	<!--<a href="biglpersonalizzati" class="btn btn-primary w-100 mb-3">{!! trans('campi.biglietti_personalizzati')  !!}</a>
	<a href="biglfiliale" class="btn btn-primary w-100 mb-3">{!! trans('campi.biglietti_per_filiale')  !!}</a>-->
	<a href="#" class="goback w-100">{!! trans('campi.indietro')  !!}</a>
	</div>
	
</div>
@endsection
@section('scripts')
<script>
	jQuery( function($){
		
		$("a.mbox").click(function(){
				var id = $(this).attr("id");
				$(".boxes").addClass("d-none");
				$("#selType-"+id).removeClass("d-none");
		});
		
		
		$("a.goback").click(function(){
			$(this).parent().addClass("d-none");
			$(".boxes").removeClass("d-none");
		});
		
		});//endJquery
</script>
@endsection
