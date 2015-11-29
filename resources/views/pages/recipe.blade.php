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
             <div style="cursor: pointer;" class="article" onclick="location.href='{{ url('/recipe', $row->id) }}';">
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
                        <a><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countfollow}}</a>
                        <a><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countmade}}</a>
                        <a><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countlike}}</a>
                    

                        <div style="margin-top:10px;text-align: right;">Made by 
                            <a href="{{ url('/user', $row->userpostid) }}"><img src="{{ asset('assets/images/user_pic/'.$row->avatar) }}" 
                          onError="this.onerror=null;this.src='{{ asset('assets/images/user_pic/minicons2-14-512.png') }}';" style="width: 46px;height:auto;vertical-align: -19px;" /> </a></div>
                    </div>
                </center>
            </div>
            @endforeach
            <div class="clear" ></div>
            <?php echo $recipe->render(); ?>
      
            <div class="clear" ></div>

        </div>
      
    </div>

@stop

