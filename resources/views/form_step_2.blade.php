<hr>

<form id="formPers1" name="formPers1" method="get" action="#">

<meta name="_token" content="{{ csrf_token() }}"/>
<script>
	var trans = {
		currentSponsor: "{!! trans('campi.currentSponsor') !!}"
	};
</script>

<div class=" ">
        <div class="col-md-12 ">
            <div class="rendered-form ">

                @if(Session::get('tipoFlag') != 'bigliettiF' && Session::get('tipoFlag') != 'firmaF')
                    <div class="fb-text form-group field-nome">
                        <label for="nome" class="fb-text-label">{!! trans('campi.nome') !!}<span class="red">*</span></label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                        <div style="display:none;" id="check-nome">{!! trans('campi.campo') !!} {!! trans('campi.nome') !!} {!! trans('campi.required') !!}!</div>
                    </div>
                    <div class="fb-text form-group field-cognome">
                        <label for="cognome" class="fb-text-label">{!! trans('campi.cognome') !!}<span class="red">*</span></label>
                        <input type="text" class="form-control" name="cognome" id="cognome" >
                        <div style="display:none;" id="check-cognome">{!! trans('campi.campo') !!} {!! trans('campi.cognome') !!} {!! trans('campi.required') !!}!</div>
                    </div>
                @endif
                <!--aggiungo campo quantità nei biglietti-->
                @if(Session::get('tipoFlag') == 'bigliettiP' || Session::get('tipoFlag') == 'bigliettiF')
                <div class="fb-text form-group field-biglietti">
                    <label for="qtbiglietti" class="fb-text-label">{!! trans('campi.qta') !!}
                        <span class="red">*</span>
                    </label>
                    <input type="text" class="form-control" name="qtbiglietti" id="qtbiglietti" value="200" readonly>
                    <div style="display:none;" id="check-qtbiglietti">{!! trans('campi.campo') !!} {!! trans('campi.qta') !!} {!! trans('campi.required') !!}!</div>
                </div>
                    <!-- fine aggiunta quantità-->
                @endif
                <!--mostro tipologia se sono firme-->
                    @if(Session::get('nazione') <> 11 && Session::get('tipoFlag') == 'firmaF')
                        <div class="fb-text form-group field-address">
                            <label for="address" class="fb-text-label">Address<span class="red">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" >
                        </div>
                        <div class="fb-text form-group field-address">
                            <!--<label for="address_2" class="fb-text-label">Address 2<span class="red">*</span></label>-->
                            <input type="text" class="form-control" name="address_2" id="address_2" >
                        </div>
                        <div class="fb-text form-group field-address">
                            <!--<label for="address_3" class="fb-text-label">Address 3<span class="red">*</span></label>-->
                            <input type="text" class="form-control" name="address_3" id="address_3" >
                            <div style="display:none;" id="check-address">{!! trans('campi.campo') !!} Address {!! trans('campi.required') !!}!</div>
                        </div>
                    @endif

                @if(Session::get('tipoFlag') != 'bigliettiP' && Session::get('tipoFlag') != 'bigliettiF')
                <!-- nicpaola 07-2020
				<div class="form-row">
                    <div class="fb-radio-group form-group field-tipologia col-md-2">

                        <div class="radio-group  form-check-inline mr-0 ">
                            <div class="radio-inline mr-3">
                                <input name="tipologia" id="tipologia-0" value="filiale" type="radio">
                                <label for="tipologia-0">{!! trans('campi.filialedi') !!}</label>
                            </div>
                            <div class="radio-inline">
                                <input name="tipologia" id="tipologia-1" value="ufficio" type="radio">
                                <label for="tipologia-1">{!! trans('campi.ufficiodi') !!}</label>
                            </div>
                        </div>
                    </div>
                    <div class="fb-text field-place col-md-10">
                        <input type="text" class="form-control" name="place" id="place">
                    </div>
				</div>
                -->
                @endif
            </div>


            <!-- fine mostra tipologia-->
            @if(Session::get('nazione') == 11)
                @if(Session::get('tipoFlag') != 'bigliettiF' && Session::get('tipoFlag') != 'firmaF')
                <div class="form-row">
                    <div class="fb-text form-group  col-md-12">
                            <div class="form-group">
                                <label for="professione">{!! trans('campi.professione') !!}</label>
                                <input  class="form-control" id="professione" name="professione" placeholder="Inserire la Professione" />
                               <!-- <div style="display:none;" id="check-professione">Campo Professionista Obbligatorio!</div>-->
                            </div>
                    </div>
                </div>
                @endif
            @endif
            @if(Session::get('nazione') != 11 && Session::get('tipoFlag') == 'firmaP')

                <div class="fb-text form-group field-job">

                    <label for="job" class="fb-text-label">Job title</label>
                    <input type="text" class="form-control" name="job" id="job" >
                    <div style="display:none;" id="check-job">{!! trans('campi.campo') !!} Job title {!! trans('campi.required') !!}!</div>
                </div>
                <div class="fb-text form-group field-address">
                    <label for="address" class="fb-text-label">Address<span class="red">*</span></label>
                    <input type="text" class="form-control" name="address" id="address" >
                    <!--<div style="display:none;" id="check-address">{!! trans('campi.campo') !!} Address {!! trans('campi.required') !!}!</div>-->
                </div>
                <div class="fb-text form-group field-address">
                    <!--<label for="address_2" class="fb-text-label">Address 2<span class="red">*</span></label>-->
                    <input type="text" class="form-control" name="address_2" id="address_2" >
                </div>
                <div class="fb-text form-group field-address">
                    <!--<label for="address_3" class="fb-text-label">Address 3<span class="red">*</span></label>-->
                    <input type="text" class="form-control" name="address_3" id="address_3" >
                    <div style="display:none;" id="check-address">{!! trans('campi.campo') !!} Address {!! trans('campi.required') !!}!</div>
                </div>
            @endif
            <div class="form-row">
                <div class="fb-text form-group field-email col-md-1">
                    <label for="prefnaz" class="fb-number-label">&nbsp;</label>

                    <input type="text" class="form-control" name="prefnaz" id="prefnaz" readonly>
                </div>
                <div class="fb-text form-group field-email col-md-2">
                    <label for="preftel" class="fb-number-label">{!! trans('campi.prefisso') !!}</label>
                    <input type="text" class="form-control" name="preftel" id="preftel">
                </div>
                <div class="fb-text form-group field-email col-md-9">
                    <label for="telefono" class="fb-number-label">{!! trans('campi.tel') !!}</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>
            </div>
            <div class="form-row" id="container-field-fax">
                <div class="fb-text form-group field-email col-md-1">
                    <label for="prefnaz" class="fb-number-label">&nbsp;</label>

                    <input type="text" class="form-control" name="prefnaz1" id="prefnaz1" readonly>
                </div>
                <div class="fb-text form-group field-email col-md-2">
                    <label for="prefax" class="fb-number-label">{!! trans('campi.prefisso') !!}</label>
                    <input type="text" class="form-control" name="prefax" id="prefax">
                </div>
                <div class="fb-text form-group field-email col-md-9">
                    <label for="fax" class="fb-number-label">{!! trans('campi.fax') !!}</label>
                    <input type="text" class="form-control" name="fax" id="fax">
                </div>
            </div>
            @if(Session::get('tipoFlag') != 'bigliettiF' && Session::get('tipoFlag') != 'firmaF')
            <div class="form-row">
                <div class="fb-text form-group field-email col-md-1">
                    <label for="prefnaz" class="fb-number-label">&nbsp;</label>
                    <input type="text" class="form-control" name="cellnaz" id="cellnaz" value="">
                </div>
                <div class="fb-text form-group field-email col-md-2">
                    <label for="prefax" class="fb-number-label">{!! trans('campi.prefisso') !!}</label>
                    <input type="text" class="form-control" name="precell" id="precell">
                </div>

                <div class="fb-text form-group field-email col-md-9">
                    <label for="cell" class="fb-number-label">{!! trans('campi.cell') !!}</label>
                    <input type="number" class="form-control" name="cell" id="cell" >
                </div>
            </div>
            @endif
            @if(Session::get('tipoFlag') != 'firmaF' )

                <div class="form-row">
                    @if(Session::get('tipoFlag') =='bigliettiF' )
                        <div class="fb-text form-group field-email col-md-12">
                            <label for="email"  class="fb-text-label">{!! trans('campi.email') !!} </label>
                            <input type="text" class="form-control" name="emailBF" id="emailBF" readonly>


                        </div>
                    @elseif(Session::get('nazione') == 11)
                        <div class="fb-text form-group field-email col-md-6">
                            <label for="email"  class="fb-text-label">{!! trans('campi.email') !!}<span class="red">*</span></label>
                            <input type="text" class="form-control" name="email" id="email">
                            <div style="display:none;" id="check-email">{!! trans('campi.campo') !!} {!! trans('campi.email') !!} {!! trans('campi.required') !!}!</div>
                        </div>
                        <div class="fb-text form-group field-at col-md-1">
                            <label for="at"  class="fb-text-label"></label>
                            <input type="text" readonly class="form-control-plaintext" name="at" id="at" required="required" aria-required="true" value="@">
                        </div>
                        <div class="fb-text form-group field-email-domain col-md-5">
                            <label for="email"  class="fb-text-label">{!! trans('campi.dominiomail') !!}<span class="red">*</span></label>
                            <select type="text" class="form-control" name="emaildomain" id="emaildomain"  aria-required="true" >
                                <option>{!! trans('campi.seldominio') !!}</option>
                            </select>
                        </div>
                        @else
                        <div class="fb-text form-group field-email col-md-6">
                            <label for="email"  class="fb-text-label">{!! trans('campi.email') !!}<span class="red">*</span></label>
                            <input type="text" class="form-control" name="email" id="email">
                            <div style="display:none;" id="check-email">{!! trans('campi.campo') !!} {!! trans('campi.email') !!} {!! trans('campi.required') !!}!</div>
                        </div>
                        <div class="fb-text form-group field-at col-md-1">
                            <label for="at"  class="fb-text-label"></label>
                            <input type="text" readonly class="form-control-plaintext" name="at" id="at" required="required" aria-required="true" value="@">
                        </div>
                        <div class="fb-text form-group field-email-domain col-md-5">
                            <label for="email"  class="fb-text-label">{!! trans('campi.dominiomail') !!}<span class="red">*</span></label>
                            <input type="text" class="form-control" name="emaildomain" id="emaildomain">
                        </div>
                    @endif
                </div>
                <input type="hidden"  class="form-control-plaintext" name="sitoweb" id="sitoweb"   value="">
            @else
            @endif

            @if(Session::get('nazione') != 11 && Session::get('tipoFlag') == 'firmaF')
                <div class="form-row">

                    <div class="fb-text form-group field-email col-md-6">
                        <label for="email"  class="fb-text-label">{!! trans('campi.email') !!}<span class="red">*</span></label>
                        <input type="text" class="form-control" name="email" id="email">
                        <div style="display:none;" id="check-email">{!! trans('campi.campo') !!} {!! trans('campi.email') !!} {!! trans('campi.required') !!}!</div>
                    </div>
                    <div class="fb-text form-group field-at col-md-1">
                        <label for="at"  class="fb-text-label"></label>
                        <input type="text" readonly class="form-control-plaintext" name="at" id="at" required="required" aria-required="true" value="@">
                    </div>
                    <div class="fb-text form-group field-email-domain col-md-5">
                        <label for="email"  class="fb-text-label">{!! trans('campi.dominiomail') !!}<span class="red">*</span></label>
                        <input type="text" class="form-control" name="emaildomain" id="emaildomain">
                    </div>
                </div>

             @endif

            <div class="form-row">
                <div class="fb-text form-group field-email col-md-1">
                    <label for="www" class="fb-number-label">&nbsp;</label>
                    <input type="text" class="form-control" name="www" id="www" value="www." readonly>
                </div>
                @if(Session::get('nazione') == 11)
                <div class="fb-text form-group field-email-domain col-md-11">
                    <label for="domain"  class="fb-text-label">{!! trans('campi.dominio') !!}</label>
                    <select type="text" class="form-control" name="domain" id="domain" required="required" aria-required="true">
                        <option>{!! trans('campi.seldominio') !!}</option>
                    </select>
                </div>
                    @else
                    <div class="fb-text form-group field-email-domain col-md-11">
                        <label for="domain"  class="fb-text-label">{!! trans('campi.dominio') !!}</label>
                        <input type="text" class="form-control" name="domain" id="domain">
                    </div>
                @endif
            </div>

            <!-- fine dominio -->
            @if(Session::get('tipoFlag') != 'bigliettiP' && Session::get('tipoFlag') != 'bigliettiF')
                        <!-- nicpaola 07-2020 - add campi skype -->
                        <div class="form-row" id="container-field-skype">
                            <div class="fb-text form-group field-email col-md-1">
                            </div>
                            <div class="fb-text form-group field-email-domain col-md-11">
                                <label for="skype"  class="fb-text-label">Skype</label>
                                <input type="text" class="form-control" name="skype" id="skype">
                            </div>
                        </div>

                        <!-- nicpaola 07-2020 - add campi social -->
                        <div class="form-row" id="socialContainer"></div>

                        <!-- nicpaola 07-2020 - add campo sponsor -->
                        <div class="form-row" id="sponsorContainer">
                            <div class="fb-text form-group field-email-domain col-md-12">
                                <label for="sponsor_image"  class="fb-text-label">{!! trans('campi.sponsorfileinput') !!}</label>
                                <input type="file" class="form-control" name="sponsor_image" id="sponsor_image" />
                                <div style="color:red;font-size:11pt">{!! trans('campi.sponsorrules') !!}</div>
                            </div>
                        </div>

						<!-- mirco 05-05-2021 - add campo Link Sponsor -->
						<div class="fb-text form-group field-sponsor_image_link">
							<label for="sponsor_image_link" class="fb-text-label">{!! trans('campi.firmalink') !!}</label>
							<input type="text" class="form-control" name="sponsorLink" id="sponsorLink">
						</div>
            @endif

            <div class="fb-button form-group field-caf">
				<div class="align-buttons">

                	<button type="button" class="btn btn-info" name="caf"  id="caf">{!! trans('campi.creaatntep') !!}</button>

					<div class="fb-button field-stampa" style="display:none;">
					@if(Session::get('tipoFlag') == 'firmaP' || Session::get('tipoFlag') == 'firmaF')
						<a href="#"  class="btn btn-info" name="stampa"  id="stampa" target="_blank">{!! trans('campi.apriinnuovapag') !!}</a>
						<a href="#"  class="btn btn-info" name="scarica"  id="scarica" target="_blank" download>Download</a>
					@else
						@if($permission == 3)
						<a href="#"  class="btn btn-info" name="stampa"  id="stampa" target="_blank">Visualizza Biglietto</a>
						@endif
						<a href="/ordina"  class="btn btn-info" name="ordina"  id="ordina" >Ordina</a>
					@endif
					 @if(Session::get('nazione') == 11)
						<a class="btn btn-danger" href="mailto:grafica@concreo.eu?subject=SEGNALAZIONE%20PER%20PORTALE%20FIRME%20E%20BIGLIETTI">Segnala una modifica</a>
					@endif
					</div>
				</div>
                @if(Session::get('tipoFlag') == 'bigliettiP' || Session::get('tipoFlag') == 'bigliettiF')
                    <div class="text-danger my-3">
                        ANTEPRIMA PER VERIFICA DATI INSERITI - LA GRAFICA SARÀ SECONDO LAYOUT DELLE RISPETTIVE SOCIETÀ
                    </div>
                @endif

				<iframe id="embed" src="" width="100%" height="580px" style="display: none"></iframe>
                <div id="embedDiv" width="100%" height="580px" style="display: none"></div>
            </div>

        </div>

    </div>

    <input type="hidden" id="tipoFirma" name="tipoFirma" value="{{ Session::get('tipoFlag') }}" />
    <input type="hidden" id="societaC" name="societaC" value="" />
    <input type="hidden" id="societaN" name="societaN" value="" />
    <input type="hidden" id="nazioneC" name="nazioneC" value="" />
    <input type="hidden" id="divisioneC" name="divisioneC" value="" />

    <input type="hidden" id="logoSC" name="logoSC" value="" />
    <input type="hidden" id="logo_width" name="logo_width" value="" />
    <input type="hidden" id="endorsement" name="endorsement" value="" />
    <input type="hidden" id="endorsement_width" name="endorsement_width" value="" />
    <input type="hidden" id="endorsementLink" name="endorsementLink" value="" />
    <input type="hidden" id="sponsor" name="sponsor" value="" />
    <input type="hidden" id="sponsor_width" name="sponsor_width" value="" />

    <input type="hidden" id="indirizzoC" name="indirizzoC" value="" />
    <input type="hidden" id="indirizzoC1" name="indirizzoC1" value="" />
    <input type="hidden" id="indirizzoC2" name="indirizzoC2" value="" />
    <input type="hidden" id="privacyC" name="privacyC" value="" />
    <input type="hidden" id="layout" name="layout" value="" />
    <input type="hidden" id="cmailF" name="cmailF" value="" />
    <input type="hidden" id="cdominio" name="cdominio" value="" />
    <input type="hidden" id="codice" name="codice" value="" />
    <input type="hidden" id="nomefiliale" name="nomefiliale" value="" />

    <!-- nicpaola 07-2020 - add campi social -->
    <input type="hidden" id="socialCount" name="socialCount" value="0" />

</form>

<hr>

