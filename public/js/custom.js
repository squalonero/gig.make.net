const APPDOMAIN = location.protocol + "//" + location.hostname;

function check()
{
    var emptyFields = 0;
    if (emailObb == 'bigliettiF')
    {
        var arrayCampi = [
            'nome',
            'cognome',
            'qtbiglietti'
        ];
    } else
    {
        var arrayCampi = [
            'nome',
            'cognome',
            'qtbiglietti',
            'email'
        ];
    }
    if (nazioneId != 11)
    {
        var arrayCampi = [
            'nome',
            'cognome',
            //'job',
            'address',
            'email'
        ];
    }
    for (var key in arrayCampi)
    {
        if ($('#' + arrayCampi[key]).val() == '')
        {
            $('#check-' + arrayCampi[key]).css({ 'display': 'block', 'color': 'red' });
            emptyFields++;
        }
    }
    return emptyFields;
}

$('input').blur(function ()
{
    var id = this.id;
    $('#check-' + id).css({ 'display': 'none', 'color': 'black' });

});

var _validFileExtensions = [".jpg", ".jpeg", ".png"];
function validateFileExtension(oForm)
{
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++)
    {
        var oInput = arrInputs[i];
        if (oInput.type == "file")
        {
            var sFileName = oInput.value;
            if (sFileName.length > 0)
            {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++)
                {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase())
                    {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid)
                {
                    alert("Attenzione, l'immagine di sponsor deve essere in uno dei seguenti formati: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }

    return true;
}

function validateFileSize(oForm)
{
    var fi = document.getElementById('sponsor_image');
    // Check if any file is selected.
    if (fi != null && fi.files.length > 0)
    {
        for (var i = 0; i <= fi.files.length - 1; i++)
        {
            var fsize = fi.files.item(i).size;
            var file = Math.round((fsize / 1024));
            // The size of the file.
            if (file > 400)
            {
                alert("Attenzione, l'immagine di sponsor non deve superare le dimensioni di 400 kB.");
                return false;
            } else
            {
                return true;
            }
        }
    }
    return true;
}

$('#caf').on('click', function ()
{
    var error = check();
    var tipoFirma = $('#tipoFirma').val();
    var req = $(this).attr('id');

    //console.log(check());
    if (error == 0)
    {
        //var dati = $("#formPers1").serialize();
        // nicpaola 07-2020
        var form = $('#formPers1')[0];

        if (tipoFirma != "bigliettiP" && tipoFirma != "bigliettiF")
        {
            // VALIDATE FILE
            if (!validateFileExtension(form))
            {
                return false;
            }
            else if (!validateFileSize(form))
            {
                return false;
            }
        }

        var dati = new FormData(form);
        let _getData = [...dati.entries()];
        //build http query
        _getData = _getData.map(x => `${ encodeURIComponent(x[0]) }=${ encodeURIComponent(x[1]) }`).join('&');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "getlayout",
            data: dati,
            cache: false,
            dataType: 'html',
            processData: false,
            contentType: false,
            timeout: 10000,
            success: function (msg)
            {
                $('#stampa').attr('href', APPDOMAIN + '/getlayout?' + _getData);
                $('#scarica').attr('href', APPDOMAIN + '/getlayout?' + _getData);
                $('#scarica').attr('download', 'signature.html');

                $('.field-stampa').css('display', 'block');

                if (req == 'caf')
                {
                    $('#embedDiv').html(msg).show();
                }

            },
            error: function (xhr, status, error)
            {
                alert(xhr.responseText);
            }
        });
    } else
    {
        $('#divFirma').css('display', 'none');
    }
});

$('#email').focusout(function ()
{
    var str = $('#email').val();
    var n = str.indexOf("@");
    if (n > 0)
    {
        alert('Inserire solo il nome utente senza il simbolo della chiocciola  "@"');
        $('#email').val('');
    }
});

$('a').on('click', function ()
{
    var idSocieta = this.id;
    idSocieta = idSocieta.replace('soc_', '');
    $('#societa').val(idSocieta);
    getnazioni(idSocieta);

});

$('select').on('change', function ()
{
    var campoId = this.id;

    if (campoId == 'societa_id')
    {

        getdivisioni(this.value);
        getfiliali(this.value);
        getregioni(this.value);

    } else if (campoId == 'divisioni_id')
    {

        getLogoDiv(this.value);
        if ($('#filiali_id').val() != null && $('#filiali_id').val() != undefined && $('#filiali_id').val() != "")
            getField($('#filiali_id').val());

    } else if (campoId == 'regioni_id')
    {

        getfiliali(this.value);

    } else if (campoId == 'filiali_id')
    {

        getField(this.value);

    } else if (campoId == 'nazioni_id')
    {

        getSocieta(this.value);

    } else if (campoId == 'societa_idE')
    {
        /* nicpaola 07-2020 */
        $('#divisioni_idE').val('');
        $('#divisioni_idE').html('');
        getdivisioniEstero(this.value);
        getFieldEstero(campoId, this.value);

    } else if (campoId == 'divisioni_idE')
    {
        /* nicpaola 07-2020 */
        getFieldEstero(campoId, this.value);

    } else
    {
        return false;
    }

});

function getFieldEstero(campoId, val)
{
    if (campoId == 'societa_idE')
    {
        var divisione_id = $('#divisioni_idE').val();
    } else
    {
        var divisione_id = val;
        var val = $('#societa_idE').val();
    }
    if (divisione_id == null || divisione_id == undefined || divisione_id == "")
        divisione_id = 0;

    console.log(divisione_id);
    console.log(val);
    $.ajax({
        type: "get",
        url: "getfieldE",
        data: { 'id': val, 'divisione_id': divisione_id },
        success: function (data)
        {
            console.log(data[0]);
            //alert(data[0].email);
            var nazioni_id = $('#nazioni_id').val();
            $('#layout').val(data[0].layoutS);
            $('#prefnaz').val(data[0].prefisso);
            $('#prefnaz1').val(data[0].prefisso);
            $('#cellnaz').val(data[0].prefisso);
            //creo menu a tendina con ordine domini default email
            var str = '';
            str = data[0].urlweb1;
            /*   if(data[0].urlweb1 != '' ){
                str +='<option value="'+data[0].urlweb1+'">'+data[0].urlweb1+'</option>';
            }
            if(data[0].dominio != ''){
                str +='<option value="'+data[0].dominio+'">'+data[0].dominio+'</option>';
            }
            if(data[0].urlweb !=''  ){
                str +='<option value="'+data[0].urlweb+'">'+data[0].urlweb+'</option>';
            }*/
            $("#emaildomain").val(str);
            var str = '';
            str = data[0].dominio;
            /*  if(data[0].dominio != ''){
                  str +='<option value="'+data[0].dominio+'">'+data[0].dominio+'</option>';
              }
              if(data[0].urlweb1 != '' ){
                  str +='<option value="'+data[0].urlweb1+'">'+data[0].urlweb1+'</option>';
              }
              if(data[0].urlweb !=''  ){
                  str +='<option value="'+data[0].urlweb+'">'+data[0].urlweb+'</option>';
              }*/
            $('#societaC').val(data[0].id);
            $("#domain").val(str);
            $('.layout1').css('display', 'block');

            $("#logoSC").val(data[0].logoS);
            $("#logo_width").val(data[0].logo_width);
            $("#endorsement").val(data[0].endorsement);
            $("#endorsement_width").val(data[0].endorsement_width);
            $("#endorsementLink").val(data[0].endorsementLink);
            $("#sponsor").val(data[0].sponsorFilePath);
            $("#sponsor_width").val(data[0].sponsor_width);
            $("#sponsorLink").val(data[0].sponsorLink);

            $('#privacyC').val(data[0].privacy);

            // nicpaola 07-2020 - add social
            // if (data[0].layoutS == "2")
            // {
            //     $('#sponsorContainer').hide();
            //     //$('#container-field-fax').show();
            //     $('#container-field-skype').hide();
            // } else
            // {
                $('#sponsorContainer').show();
                //$('#container-field-fax').hide();
                $('#container-field-skype').show();
            // }

            $('#socialCount').val(data[0].socialArray.length);
            $('#socialContainer').html('');
            $('#socialContainer').hide();
            var socialStringHtml = "";
            if (data[0].socialArray.length > 0)
            {
                for (var socialIndex = 0; socialIndex < data[0].socialArray.length; socialIndex++)
                {
                    if (data[0].socialArray[socialIndex].url == null)
                        data[0].socialArray[socialIndex].url = "";
                    socialStringHtml += '<div class="fb-text form-group field-email col-md-1">';
                    if (data[0].socialArray[socialIndex].url != null && data[0].socialArray[socialIndex].url.trim() != "")
                    {
                        socialStringHtml += '<img class="socialImage" src="' + data[0].socialArray[socialIndex].image + '" />';
                    } else
                    {
                        socialStringHtml += '<img class="socialImage" src="' + data[0].socialArray[socialIndex].image + '" style="margin-bottom:22px" />';
                    }
                    socialStringHtml += '<input type="hidden" name="socialImage_' + socialIndex + '" id="socialImage_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].image + '" />' +
                        '<input type="hidden" name="socialLabel_' + socialIndex + '" id="socialLabel_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].label + '" />' +
                        '</div>' +
                        '<div class="fb-text form-group field-email-domain col-md-11">' +
                        '<label for="social_' + socialIndex + '"  class="fb-text-label">' + data[0].socialArray[socialIndex].label + '</label>';
                    if (data[0].socialArray[socialIndex].url != null && data[0].socialArray[socialIndex].url.trim() != "")
                    {
                        socialStringHtml += '<input type="text" class="form-control" name="social_' + socialIndex + '" id="social_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].url + '">' +
                            '</div>';
                    } else
                    {
                        socialStringHtml += '<input type="text" class="form-control" name="social_' + socialIndex + '" id="social_' + socialIndex + '" value="">';
                        if (data[0].socialArray[socialIndex].label.toLowerCase() == "youtube")
                        {
                            socialStringHtml += '<div style="color:red;font-size:11pt">e.g. https://www.youtube.com/GiGroupSpa</div>';
                        } else if (data[0].socialArray[socialIndex].label.toLowerCase() == "twitter")
                        {
                            socialStringHtml += '<div style="color:red;font-size:11pt">e.g. https://twitter.com/gigroupspa</div>';
                        } else if (data[0].socialArray[socialIndex].label.toLowerCase() == "facebook")
                        {
                            socialStringHtml += '<div style="color:red;font-size:11pt">e.g. https://www.facebook.com/GiGroupSpa</div>';
                        } else if (data[0].socialArray[socialIndex].label.toLowerCase() == "linkedin")
                        {
                            socialStringHtml += '<div style="color:red;font-size:11pt">e.g. https://www.linkedin.com/company/gi-group</div>';
                        } else
                        {
                            socialStringHtml += '<div style="color:red;font-size:11pt">e.g. https://www.website.com/Company-Name</div>';
                        }
                        socialStringHtml += '</div>';
                    }
                }
                $('#socialContainer').html(socialStringHtml);
                $('#socialContainer').show();
            }
        }
    });
}

function getField(val)
{
    var divisione_id = $('#divisioni_id').val();
    $.ajax({
        type: "get",
        url: "getfield",
        data: { 'id': val, 'divisione_id': divisione_id },
        success: function (data)
        {
            console.log(data[0]);
            //alert(data[0].email);
            $('#prefnaz').val(data[0].prefisso);
            $('#prefnaz1').val(data[0].prefisso);
            $('#cellnaz').val(data[0].prefisso);
            var numTel = '';
            var numFax = '';
            if (data[0].tel !== null)
            {
                numTel = data[0].tel.split(' ');
            }
            if (data[0].fax !== null)
            {
                numFax = data[0].fax.split(' ');
            }

            $('#preftel').val(numTel[0]);
            $('#prefax').val(numFax[0]);
            $('#telefono').val(numTel[1]);
            $('#fax').val(numFax[1]);
            // if (data[0].layoutS == "2")
            // {
            //     //$('#container-field-fax').show();
            //     $('#container-field-skype').hide();
            // } else
            // {
            //     //$('#container-field-fax').hide();
            //     $('#container-field-skype').show();
            // }
            $('#mail').val(data[0].email);
            $('#emailBF').val(data[0].email);
            //firma Filiale
            $('#cmailF').val(data[0].email);
            $('#dominioF').val(data[0].urlweb);
            // fine firma filiale
            $('#societaC').val(data[0].idSocieta);
            $('#societaN').val(data[0].societa);
            $('#divisioneC').val(data[0].idDivisione);

            $('#layout').val(data[0].layoutS);

            $('#codice').val(data[0].codice);
            $('#nomefiliale').val(data[0].nomefiliale);

            if ($('#divisioni_id').val() > 0)
            {
                $('.societa').html(data[0].idDivisionie);
                //	$("#logoSC").val(data[0].logoD);
            } else
            {
                $('.societa').html(data[0].idSocieta);
            }

            $("#logoSC").val(data[0].logoS);
            $("#logo_width").val(data[0].logo_width);
            $("#endorsement").val(data[0].endorsement);
            $("#endorsement_width").val(data[0].endorsement_width);
            $("#endorsementLink").val(data[0].endorsementLink);
            $("#sponsor").val(data[0].sponsorFilePath);
            $("#sponsor_width").val(data[0].sponsor_width);
            $("#sponsorLink").val(data[0].sponsorLink);
            //creo menu a tendina con ordine domini default email

            var str = '';
            if (data[0].urlweb1 != '')
            {
                str += '<option value="' + data[0].urlweb1 + '">' + data[0].urlweb1 + '</option>';
            }
            if (data[0].dominio != '')
            {
                str += '<option value="' + data[0].dominio + '">' + data[0].dominio + '</option>';
            }
            if (data[0].urlweb != '')
            {
                str += '<option value="' + data[0].urlweb + '">' + data[0].urlweb + '</option>';
            }

            $("#emaildomain").html(str);

            //creo menu a tendina con ordine domini default sito web

            var str = '';
            if (data[0].dominio != '')
            {
                str += '<option value="' + data[0].dominio + '">' + data[0].dominio + '</option>';
            }
            if (data[0].urlweb1 != '')
            {
                str += '<option value="' + data[0].urlweb1 + '">' + data[0].urlweb1 + '</option>';
            }
            if (data[0].urlweb != '')
            {
                str += '<option value="' + data[0].urlweb + '">' + data[0].urlweb + '</option>';
            }

            // nicpaola 07-2020 - add social
            // if (data[0].layoutS == "2")
            // {
            //     $('#sponsorContainer').hide();
            //     $('.field-sponsor_image_link').hide();

            // } else
            // {
                $('#sponsorContainer').show();
                $('.field-sponsor_image_link').show();
                $('#sponsorPreview').remove();
                if (data[0].sponsorFilePath)
                {
                    $('#sponsorContainer label').after(`
								<div style="margin-bottom:20px;" id="sponsorPreview">
								<span><img data-backend-sponsor="/${ data[0].sponsorFilePath }" src="/${ data[0].sponsorFilePath }" style="max-width:100px;"></span>
								<span style="margin-left:20px;">${ trans.currentSponsor }</span>
								</div>
								`);
                }
            // }

            $('#socialCount').val(data[0].socialArray.length);
            $('#socialContainer').html('');
            $('#socialContainer').hide();
            var socialStringHtml = "";
            if (data[0].socialArray.length > 0)
            {
                for (var socialIndex = 0; socialIndex < data[0].socialArray.length; socialIndex++)
                {
                    if (data[0].socialArray[socialIndex].url == null)
                        data[0].socialArray[socialIndex].url = "";
                    socialStringHtml += '<div class="fb-text form-group field-email col-md-1">' +
                        '<img class="socialImage" src="' + data[0].socialArray[socialIndex].image + '" />' +
                        '<input type="hidden" name="socialImage_' + socialIndex + '" id="socialImage_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].image + '" />' +
                        '<input type="hidden" name="socialLabel_' + socialIndex + '" id="socialLabel_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].label + '" />' +
                        '</div>' +
                        '<div class="fb-text form-group field-email-domain col-md-11">' +
                        '<label for="social_' + socialIndex + '"  class="fb-text-label">' + data[0].socialArray[socialIndex].label + '</label>' +
                        '<input type="text" class="form-control" name="social_' + socialIndex + '" id="social_' + socialIndex + '" value="' + data[0].socialArray[socialIndex].url + '">' +
                        '</div>';
                }
                $('#socialContainer').html(socialStringHtml);
                $('#socialContainer').show();
            }


            $("#domain").html(str);
            $("#cdominio").val(data[0].dominio);
            $("#sitoweb").val(data[0].dominio);
            $('.layout1').css('display', 'block');

            $("#endorsement").val(data[0].endorsement);
            $("#endorsementLink").val(data[0].endorsementLink);
            //$(".privacy").html(data[0].privacy);
            var provincia = '';

            if (data[0].fprovincia != null)
            {
                provincia = data[0].fprovincia;
            }

            $('#indirizzoC').val(data[0].indirizzo + ' - ' + data[0].cap1 + ' ' + data[0].citta + ' ' + provincia);
            /* nicpaola 07-2020 */
            $('#indirizzoC1').val(data[0].indirizzo);
            $('#indirizzoC2').val(data[0].cap1 + ' ' + data[0].citta + ' ' + provincia);
            $('#privacyC').val(data[0].privacy);
        }
    });
}

$('#sponsor_image').on('change', function ()
{
    let input = this;
    let $sponsorPreviewImg = $(document).find('#sponsorPreview img');
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e)
        {
            $sponsorPreviewImg.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    else
    {
        $sponsorPreviewImg.attr('src', $sponsorPreviewImg.attr('data-backend-sponsor'));
    }

});


function getLogoDiv(val)
{
    /*$.ajax({
        type: "get",
        url: "getLogoDivisione",
        data:{'id':val},
        success: function(data){

            if($('#divisioni_id').val() > 0){
                alert($('#divisioni_id').val());
                //$("#logoSC").val(data[0].logoDv);

            }

        }

    });*/
}
function getregioni(val)
{
    $.ajax({
        type: "get",
        url: "getregioni",
        data: { 'id': val },
        success: function (data)
        {
            $("#regioni_id").html(data);
        }
    });
}
function getdivisioni(val)
{
    $.ajax({
        type: "get",
        url: "getdivisioni",
        data: { 'id': val },
        success: function (data)
        {
            $("#divisioni_id").html(data);
        }
    });
}
function getSocieta(val)
{
    $.ajax({
        type: "get",
        url: "getsocieta",
        data: { 'id': val },
        success: function (data)
        {
            $("#societa_idE").html(data);
        }
    });
}

// nicpaola 07-2020
function getdivisioniEstero(val)
{
    $.ajax({
        type: "get",
        url: "getdivisioni",
        data: { 'id': val },
        success: function (data)
        {
            $("#divisioni_idE").html(data);
        }
    });
}

function getfiliali()
{
    var societa_id = 0;
    var divisioni_id = 0;
    var regioni_id = 0;


    if ($('#societa_id').val() > 0) societa_id = $('#societa_id').val();
    //if($('#divisioni_id').val() > 0) divisioni_id = $('#divisioni_id').val();
    if ($('#regioni_id').val() > 0) regioni_id = $('#regioni_id').val();


    $.ajax({
        type: "get",
        url: "getfiliali",
        data: { 'societa_id': societa_id, 'regioni_id': regioni_id },
        success: function (data)
        {
            $("#filiali_id").html(data);
        }
    });
}

$('#okStampa').click(function ()
{
    if ($('#qtbiglietti').val() > 0)
    {
        var qta = $('#qtbiglietti').val();
        var professione = $('#professione').val();
        var nome = $('#nome').val();
        var cognome = $('#cognome').val();
        var societa = $('#societa_id').val();
        var filiale = $('#filiali_id').val();
        $.ajax({
            type: "get",
            url: "setqta",
            data: { 'qta': qta, 'professione': professione, 'nome': nome, 'cognome': cognome, 'societa': societa, 'filiale': filiale },
            success: function (data)
            {
                console.log(data);
                //   alert('creata nuova professione:'+professione);
            }
        });
    }
});





(function ($)
{
    $.fn.uncheckableRadio = function ()
    {
        return this.each(function ()
        {
            var radio = this,
                label = $('label[for="' + radio.id + '"]');
            if (label.length === 0)
            {
                label = $(radio).closest("label");
            }
            var label_radio = label.add(radio);
            label_radio.mousedown(function ()
            {
                $(radio).data('wasChecked', radio.checked);
            });
            label_radio.click(function ()
            {
                if ($(radio).data('wasChecked'))
                {
                    radio.checked = false;
                }
            });
        });
    };
})(jQuery);

$('input[type=radio]').uncheckableRadio();

function copiaContenuto(containerid)
{
    var range = document.getSelection().getRangeAt(0);
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
}

$('#okCopia').click(function ()
{
    copiaContenuto('firma');
});