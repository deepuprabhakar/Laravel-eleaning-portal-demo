@extends('Centaur::auth.layout')

@section('title', 'Create A New Password')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>E-Learning</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg"><b>Reset Your Password</b></h4>
    @if (session('status'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ session('status') }}
      </div>
    @endif
    <form role="form" method="POST" action="{{ route('auth.password.reset.attempt', $code) }}">
      {!! csrf_field() !!}
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Enter new password" value="{{ old('password') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                {{ $errors->first('password') }}
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" value="{{ old('password_confirmation') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                {{ $errors->first('password_confirmation') }}
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-flat btn-block">
              <i class="fa fa-btn fa-refresh"></i> &nbsp;Reset Password
          </button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@stop