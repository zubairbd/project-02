<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>

    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @include('backend.partials.styles')
    
    @stack('styles')
    @yield('styles')
  
</head>

<body class="bg-dark">
    
    @yield('login-content')

    <!-- Scripts -->
    @include('backend.partials.scripts')
    @yield('scripts')
    <!--Local Stuff-->
</body>
</html>
