@extends('22signatures.index')
@section('content')
    <div style="text-align:left;">

        @yield('signature-specific')

        <span
            style="font-weight:bold; font-size:13pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
            <div style='display:inline-block'>
                <img class="logoS" src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" alt=''
                    title="">
            </div>
        </span>

        <div style="text-align:left;">

            {{-- Estero @notverified --}}
            @if ($viewData['address'])
                <div style="font-size:10pt">
                    <br />
                </div>

                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;"
                    class="address">
                    {{ $viewData['address'] }}
                </span>

                @if ($viewData['address_2'])
                    <span
                        style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;"
                        class="address">
                        {{ $viewData['address_2'] }}
                    </span>
                @endif

                @if ($viewData['address_3'])
                    <span
                        style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;"
                        class="address">
                        {{ $viewData['address_3'] }}
                    </span>
                @endif
            @endif
            {{-- End Estero @notverified --}}

            @if ($viewData['address_it_1'] && $viewData['address_it_2'])
                <br />
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="indirizzo">
                    {{ $viewData['address_it_1'] }}
                </span>
                <br />
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="indirizzo">
                    {{ $viewData['address_it_2'] }}
                </span>

            @else

                <br />
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="indirizzo">
                    {{ $viewData['address_it'] }}
                </span><br />
            @endif

            @if ($viewData['cell'])
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="cell">
                    <span style="display:inline-block;width:16px">
                        <b style="letter-spacing:7px">M </b>
                    </span>
                </span>
                <br />
            @endif

            @if ($viewData['tel'])
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="telefono">
                    <span style="display:inline-block;width:16px">
                        <b style="letter-spacing:10px;">T </b>
                    </span>
            @endif

            @if ($viewData['skype'])
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="skype">
                    <b>Skype</b>
                </span><br />
            @endif

            @if ($viewData['email'])
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="mail">
                    <b>E-mail</b> {{ $viewData['email'] }}
                </span>
                <br />
            @endif

            @if ($viewData['email_company'])
                <span
                    style="font-weight:normal; font-size:9pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                    class="mail">
                    <b>E-mail</b> {{ $viewData['email_company'] }}
                </span>
                <br />
            @endif

            <div style="font-size:8pt;"><br /></div>
            <div style="font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;"
                class="domain">
                <a href="http://www.{{ $viewData['domain'] }}"
                    style="font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;text-decoration:none;"
                    target="_blank">
                    www.{{ $viewData['domain'] }}
                </a>
            </div>

            {{-- Social @toimprove --}}
            @if ($viewData['socialCount'] > 0)
                <?php
                $totalSocial = $viewData['socialCount'];
                $social_output = '';
                // check if at least a social has been compiled
                $oneSocialCompiled = false;
                for ($socialIndex = 0; $socialIndex < $totalSocial; $socialIndex++) {
                    $socialHrefVarNameCheck = 'social_' . $socialIndex;
                    if (trim($viewData['request']->$socialHrefVarNameCheck) != '') {
                        $oneSocialCompiled = true;
                        break;
                    }
                }

                if ($oneSocialCompiled) {
                    $social_output .= '<div style="font-size:10pt"><br /></div>';
                    $social_output .= '<div style="text-align:left;height:30px;">';
                    for ($socialIndex = 0; $socialIndex < $totalSocial; $socialIndex++) {
                        $socialHrefVarName = 'social_' . $socialIndex;
                        $socialImgVarName = 'socialImage_' . $socialIndex;
                        $socialLabelVarName = 'socialLabel_' . $socialIndex;
                        if (trim($viewData['request']->$socialHrefVarName) != '') {
                            $social_output .= '<a href="' . $viewData['request']->$socialHrefVarName . '" target="_blank" style="text-decoration:none"><img src="http://' . $_SERVER['HTTP_HOST'] . '/' . $viewData['request']->$socialImgVarName . '" style="width:30px" width="30" alt="" /></a><span style="color:#fff">&nbsp;</span>';
                        }
                    }
                    $social_output .= '</div>';
                }
                echo $social_output;
                ?>
            @endif
            {{-- End Social --}}

            {{-- Sponsor image --}}
            @if ($viewData['sponsorFilePath'] || $viewData['firmaImg'])
                <div style="font-size:10pt">
                    <br />
                </div>
                <div style="text-align:left;">
                    @if ($viewData['firmaImgLink'])
                        <a href="{{ $viewData['firmaImgLink'] }}" alt="Sponsor Url">
                    @endif

                    <img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['sponsorFilePath'] ? $viewData['sponsorFilePath'] : $viewData['firmaImg'] }} "
                        style="width:166px" alt="sponsorImage" />

                    @if ($viewData['firmaImgLink'])
                        </a>
                    @endif
                </div>
            @endif
            {{-- End Sponsor image --}}

        </div>

        @if ($viewData['privacyC'])
            <div style="text-align:left;">
                <div style="font-size:10pt">
                    <br />
                </div>
                <span
                    style="text-align:left; font-size:7pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;"
                    class='privacy'>
                    {{ $viewData['privacyC'] }}<br />
                </span>
            </div>
        @endif
    </div>

    @endsection
