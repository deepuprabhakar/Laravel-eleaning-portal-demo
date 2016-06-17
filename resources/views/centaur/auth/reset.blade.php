@extends('Centaur::auth.layout')

@section('title', 'Password Reset Activation')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>E-Learning</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg"><b>Forgot Password?</b></h4>
    @if (session('status'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ session('status') }}
      </div>
    @endif
    <form role="form" method="POST" action="{{ route('auth.password.request.attempt') }}">
      {!! csrf_field() !!}
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                {{ $errors->first('email') }}
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-12 form-group">
          <button type="submit" class="btn btn-primary btn-flat btn-block">
              <i class="fa fa-btn fa-envelope"></i> &nbsp;Send Password Reset Link
          </button>
        </div><!-- /.col -->
      </div>
    </form>
    <a class="btn btn-block btn-info btn-flat" href="{{ route('auth.login.form') }}" >Login</a>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@stop