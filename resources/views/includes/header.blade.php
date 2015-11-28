<div class="innerwrap">
    <div class="login_box"> 
        @if(Auth::check())
            Welcome  {{ Auth::user()->username }}
            <a class='log' href="{{ url('/logout') }}">Log out</a>
        @else
            <a href="/twitterLogin">
                <img src="{{ asset('assets/images/sign-in-with-twitter-l.png') }}" width="151" height="24" border="0" />
            </a>
        <div class='login'><a class='log' href="{{ url('/login') }}">Log In</a></div>
        @endif
    </div>
    <div class="clear"></div>
    <div style="margin-top:7px;">
        <div class="logo_box">
            <img src="{{ asset('assets/images/logo.png') }}" />
        </div>
        <div class="search_box">
            <input id="search_box" type="text" name="search_box" />
            <input id="btn_search" type="button" name="btn_search" />
        </div>
        <div class="menu_box">
            <div class="menu_bar">
            <div style="float: left;height:100%;width:16px;background: url(images/head_menu.png) repeat-x;"></div>
            <ul>
                <li><a href="/index">Home page</a></li>
                <li><a href="/recipe">Recipe</a></li>
                <li><a href="/chef">Chef</a></li>
                <li><a>About Us</a></li>
            </ul>
            <div style="float: right;height:100%;width:16px;background: url(images/footer_menu.png) repeat-x;"></div>

            </div>
        </div>
    </div>
</div>
 


