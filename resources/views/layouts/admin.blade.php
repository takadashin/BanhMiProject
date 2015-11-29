<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset("assets/css/admin.css") }}" rel="stylesheet">
        <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}">
        <script src="{{ asset("assets/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
    </head>
    <body>
        <div id="body">
            <div id="control_panel">
                <div id="user_stat">
                    @if(Auth::check())
                        Welcome  {{ Auth::user()->username }}<br/>
                        <a class='log' href="{{ url('/logout') }}">Log out</a>
                    @endif
                </div>
                <div id="control_box">
                    <ul>
                        <li class="active"><a>Recipe</a></li>
                        <li><a>User</a></li> 
                        <li><a href="admin/ingredient">Ingredient</a></li> 
                    </ul>
                </div>
            </div>
            <div id="main_panel" >
                <div class="header_title">@yield('headerTitle')</div>
                @yield('content')
            </div>
        </div>
    </body>
</html>
