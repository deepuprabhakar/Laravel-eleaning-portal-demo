@extends('Centaur::auth.layout')

@section('title', 'Under Maintenance - 503')

@section('content')
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ url('/') }}"><b>Coheart E-Learning</b></a>
        {!! Html::image('dist/img/maintenance.png', 'Under Maintenance', ['class' => 'img-responsive', 'style' => 'display: inline-block']) !!}
      </div><!-- /.login-logo -->
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="callout callout-warning text-center">
                    <h4 style="font-weight: normal; font-size: 20px;">Under Maintenance!</h4>
                    <p style="font-size: 15px;">Will be right back...</p>
                  </div>
            </div>
        </div>
    </div>
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