
    <meta charset="UTF-8">
    <title> @yield('title') </title>
    <meta name='generator' content='CRUDBooster'/>
    <meta name='robots' content='noindex,nofollow'/>
    <link rel="shortcut icon"
          href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <!--<link href="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>-->
	    <!-- Bootstrap 4 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap-4.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css"/>
	<!-- custom css mirco // nicpaola 07-2020-->
	<link href="{{asset('css/mycustom.css')}}?time=<?php echo filemtime('css/mycustom.css') ?>" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/demo.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
<!--Carico Open Sans -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <link href="{{ asset('vendor/crudbooster/assets/rtl.css')}}" rel="stylesheet" type="text/css"/>
@endif

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}'/>
    <style type="text/css">
        .login-page, .register-page {
            /*background: {{ CRUDBooster::getSetting("login_background_color")?:'#dddddd'}} url('{{ CRUDBooster::getSetting("login_background_image")?asset(CRUDBooster::getSetting("login_background_image")):asset('vendor/crudbooster/assets/bg_blur3.jpg') }}');*/
            color: {{ CRUDBooster::getSetting("login_font_color")?:'#ffffff' }}  !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .login-box, .register-box {
            margin: 2% auto;
        }

        .login-box-body {
            box-shadow: unset;
    		background: rgba(255, 255, 255, 0);
            color: {{ CRUDBooster::getSetting("login_font_color")?:'#666666' }}  !important;
        }

        html, body {
			overflow-y:auto;
            overflow: hidden;
        }
        .container {
                width: 100%;
            }
    </style>

<!--<body class="login-page">-->
	