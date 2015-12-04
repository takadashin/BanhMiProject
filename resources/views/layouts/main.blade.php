<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @yield('css')
        <link href="{{ asset("assets/css/main.css") }}" rel="stylesheet">
        <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}">
        <script src="{{ asset("assets/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
    <div id="body_main">
        <div id="header">
            @include('includes.header')
        </div>
        
        <div class="clear" ></div>  
        
        <div id="Content">
            @yield('content')
        </div>
        
        <div class="clear" ></div>
        
        <div id="footer">
            @include('includes.footer')
        </div>
    </div>
    </body>
</html>

