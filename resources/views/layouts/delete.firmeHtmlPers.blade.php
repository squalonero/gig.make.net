html
@if(Session::get('tipoFlag') == 'bigliettiP')
    <div style="align:center;">
        <p><span class="nome"></span><br />
            <span class="professione"></span><br />
            <span class="societa"></span><br />
            <span class="indirizzo"></span><br />
            Telefono:<span class="telefono"></span><br />
            Cellulare:<span class="cell"></span><br />
            Fax:<span class="fax"></span><br />
            <span class="mail"></span><br />
    </div>
    @elseif(Session::get('tipoFlag') == 'bigliettiF')
    <div style="lign:center;">
        <p>
            <span class="societa"></span><br />
            <span class="indirizzo"></span><br />
            Telefono:<span class="telefono"></span><br />
            Fax:<span class="fax"></span><br />
            <span class="domain"></span><br />
    </div>
    @else

    <div>
        <div style="text-align:left;">
            <span class="nome" style="line-height:7pt;font-weight:bold; font-size:10pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
            <span class="professione" style="font-weight:normal; font-size:10pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
            <span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
			<i><span class="tipologia" style="font-weight:normal; font-size:10pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span> <span class="comune" style="font-weight:normal; font-size:10pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span></i>
            </span>
            <span style="font-weight:bold; font-size:9pt; color:#015379; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
			<img class="logoS" src="img/test.jpg" alt="" title=""  >
            </span>
        </div>
        <div style="text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
            <img src="http://www.abgrafica.it/biglietti/area_admin/images/Linea_273_8px.gif" width="305px" height="16px" />
        </div>
        <div style="text-align:left;">
            <span style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
                <span class="indirizzo" style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
                Telefono: <span class="telefono" style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
                Fax: <span class="fax" style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
                E-mail:<span class="mail" style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"> </span>
                <span class="domain" style="line-height:7pt;font-weight:normal; font-size:9pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;"></span>
            </span>
        </div>
        <div style="text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
            <img src="http://www.abgrafica.it/biglietti/area_admin/images/Linea_273_8px.gif" width="305px" height="16px" />
        </div>
        <span style="font-weight:bold; font-size:9pt; color:#015379; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
			<img src="http://www.abgrafica.it/biglietti/area_admin/documenti/societa/2018-01 - 15  Firma Mail_Asset Data.png" alt="Gi Group" title="Asset Data srl" >
		</span>
        <div style="text-align:left;">
		<span id="privacy" style="text-align:left; font-size:7pt; color:#65656A; font-family:helvetica,Futura,Tahoma,Arial,sans-serif;">
		</span>
    </div>
@endif
@if(Session::get('tipoFlag') == 'firmaP' || Session::get('tipoFlag') == 'firmaF')
    <div class="fb-button form-group field-caf">
        <button type="button" class="btn btn-info" name="caf" style="info" id="okCopia">Copia firma e poi incolla nella posta elettronica</button>
        <button type="button" class="btn btn-info" name="caf" style="info" id="okDownload">Download firma</button>
    </div>
@endif
@if(Session::get('tipoFlag') == 'bigliettiP' || Session::get('tipoFlag') == 'bigliettiF')
<div class="fb-button form-group field-caf">
    <button type="button" class="btn btn-info" name="caf" style="info" id="okStampa">Conferma</button>
</div>
@endif