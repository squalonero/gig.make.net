@extends( 'layouts.user-login' )
@section('title', 'login')

@section('content')
<div class="mlogin d-flex">
<div class="login-box">
    <div class="login-logo">
LOGIN
    </div><!-- /.login-logo -->
    <div class="login-box-body">

        @if ( Session::get('message') != '' )
            <div class='alert alert-warning'>
                {{ Session::get('message') }}
            </div>
        @endif

       <!-- <p class='login-box-msg'>{{trans("crudbooster.login_message")}}</p>-->
        <form autocomplete='off' action="{{ route('postLogin') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group has-feedback">
                <input autocomplete='off' type="text" class="form-control" name='email' required placeholder="Email"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input autocomplete='off' type="password" class="form-control" name='password' required placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div style="margin-bottom:10px" class=''>
                <div class='col-xs-12'>
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class='fa fa-lock'></i> {{trans("crudbooster.button_sign_in")}}</button>
                </div>
            </div>

            <!--<div class=''>
                <div class='col-xs-12' align="center"><p style="padding:10px 0px 10px 0px">{{trans("crudbooster.text_forgot_password")}} <a
                                href='{{route("getForgot")}}'>{{trans("crudbooster.click_here")}}</a></p></div>
            </div>-->
        </form>


        <br/>
        <!--a href="#">I forgot my password</a-->

    </div><!-- /.login-box-body -->

</div><!-- /.login-box -->
</div>

@endsection
