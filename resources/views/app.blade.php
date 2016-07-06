<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('dist/img/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist/img/favicon.ico') }}" type="image/x-icon"/>
    @yield('meta')
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    {!! Html::style('bootstrap/css/bootstrap.css') !!}
    <!-- Font Awesome -->
    {!! Html::style('font-awesome/css/font-awesome.min.css') !!}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   @yield('style')
    <!-- Theme style -->
    {!! Html::style('dist/css/AdminLTE.css') !!}
    {!! Html::style('dist/css/skins/_all-skins.css') !!}
    {!! Html::style('dist/css/custom.css') !!}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="sidebar-mini wysihtml5-supported skin-green">
    <div class="wrapper">
        @include('includes.header')
    @if(Sentinel::inRole('admin'))
        @include('includes.sidebar')
    @elseif(Sentinel::inRole('user'))
        @include('includes.userSidebar')
    @elseif(Sentinel::inRole('teacher'))
        @include('includes.teacherSidebar')
    @endif
        @yield('content')
        @include('includes.footer')
        @include('includes.controlSidebar')
    </div>
  
    <!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    {!! Html::script('plugins/jQueryUI/jquery-ui.min.js') !!}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
@yield('script')
    <script>
        $(function(){
            $('.alert-success').delay(5000).slideUp();
        });
    </script>
    </body>
</html>