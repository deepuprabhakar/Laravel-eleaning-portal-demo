@extends('Centaur::auth.layout')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">
      <br>
      <b>E-Learning</b>
    </a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg"><b>Log In</b></h4>
    <form role="form" method="POST" action="{{ route('auth.login.attempt') }}">
      {!! csrf_field() !!}
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                {{ $errors->first('email') }}
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                {{ $errors->first('password') }}
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input name="remember" type="checkbox" value="true" {{ old('remember') == 'true' ? 'checked' : ''}}> Remember Me
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div><!-- /.col -->
      </div>
    </form>

    <a class="" href="{{ route('auth.password.request.form') }}">Forgot Your Password?</a>
    
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@stop

@section('script')
  <!-- iCheck -->
  {!! Html::script('plugins/iCheck/icheck.min.js') !!}
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
@stop