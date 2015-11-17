@extends('layouts.main')

@section('title')
    Home Page
@stop

@section('content')

    <div class="innerwrap">
        <div class="header_title">
            <h1>LASTEST RECIPE</h1>
        </div>
        <div>
             @foreach($recipe as $row)
            <div class="article">
                <center>
                    <div>
                        <img src="{{ asset('assets/images/article_pic/'.$row->img) }}" />
                    </div>

                    <div class="article_content mid_content" >
                        <h3>{{$row->name}}</h3>
                        <p>{{$row->Description}}</p>
                    </div>
                    <div><hr></div>
                    <div class="article_content foot_content" >
                        <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 105</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            @endforeach
      
            <div class="clear" ></div>

        </div>
<!--        <div class="header_title">
            <h1>POPULAR RECIPE</h1>
        </div>
        <div>
            <div class="article top_place">
                <img src="{{ asset('assets/images/first.png') }}" class="medal" />
                <center>
                    <div>
                        <img src="{{ asset('assets/images/article_pic/1826.jpg') }}" />
                    </div>

                    <div class="article_content mid_content" >
                        <h3>Italian Meatball Sandwich Casserole</h3>
                        <p>"All the ingredients for a meatball sandwich are here, just assembled in a different manner. This recipe is always a hit at our house. We NEVER have any leftovers, it is so good!"</p>
                    </div>
                    <div><hr></div>
                    <div class="article_content foot_content" >
                        <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 105</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            <div class="article">
                <img src="{{ asset('assets/images/second.png') }}" class="medal" />
                <center>
                    <div>
                        <img src="{{ asset('assets/images/article_pic/566024.jpg') }}" />
                    </div>

                    <div class="article_content mid_content" >
                        <h3>Cheesy Ham and Hash Brown Casserole</h3>
                        <p>"I mostly use this as a breakfast casserole, but it's great anytime. May be served with or without diced ham. Quick and easy to make, not to mention delicious!"</p>
                    </div>
                    <div><hr></div>
                    <div class="article_content foot_content" >
                        <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 105</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            <div class="article">
                <img src="{{ asset('assets/images/third.png') }}" class="medal" />
                <center>
                    <div>
                        <img src="{{ asset('assets/images/article_pic/788831.jpg') }}" />
                    </div>

                    <div class="article_content mid_content" >
                        <h3>Pumpkin Waffles with Apple Cider Syrup</h3>
                        <p>"A fall, winter and special occasion family favorite, these are fairly easy to make and delicious! They're sure to please even picky eaters."</p>
                    </div>
                    <div><hr></div>
                    <div class="article_content foot_content" >
                        <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 105</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            <div class="article">
                <center>
                    <div>
                        <img src="{{ asset('assets/images/article_pic/1826.jpg') }}" />
                    </div>

                    <div class="article_content mid_content" >
                        <h3>Italian Meatball Sandwich Casserole</h3>
                        <p>"All the ingredients for a meatball sandwich are here, just assembled in a different manner. This recipe is always a hit at our house. We NEVER have any leftovers, it is so good!"</p>
                    </div>
                    <div><hr></div>
                    <div class="article_content foot_content" >
                        <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 105</a>
                        <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> 42</a>

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            <div class="clear" ></div>

        </div>-->
    </div>

@stop

