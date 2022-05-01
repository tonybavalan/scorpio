<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
        <meta charset="utf-8">
        <meta name='viewport'
          content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @stack('styles')
    </head>
    <body>
         <!-- Content -->
         @yield('content')
        
        <!-- Scripts -->
        @stack('scripts')
    </body>
</html>