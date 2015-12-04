@extends('layouts.main')

@section('title')
    Search List
@stop

@section('css')
     <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content') 

<div class="innerwrap">
    <div class="header_title">
        <h1>Results</h1>        
    </div>
    @include('flash::message')
    {{Session::forget('recipes')}}
    {{Session::forget('users')}}
    {{ Session::forget('flash_notification.message')}}
    
@if($users != null && $recipe_quantity!=null)
    @foreach($users as $row_u)
    <div class="article" style="width: 1000px;" >
        <div style="float:left; width: 200px;text-align: center;border-right: 2px solid lightgray;cursor: pointer;"
             onclick="window.location='{{ url("/userprofile", $row_u->username) }}'">
            <img src="{{asset('assets/images/user_pic/'.$row_u->avatar) }}"
                     style="width: 150px;height: 150px;"
                     onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';">
            <h3>{{$row_u->username}}</h3>
        </div>        
        <div style="float:left; padding: 10px;">           
            @foreach($recipe_quantity as $row_r)
                @if ($row_r['rec']->userpostid == $row_u['id'])                    
                <dl>
                    <dt style="cursor: pointer" onclick="window.location='{{ url("/recipe", $row_r['rec']->id) }}'">
                        <img style="width: 50px;height: 50px;float:left" 
                             src="{{ asset('assets/images/article_pic/'.$row_r['rec']->img) }}" 
                             onError="this.onerror=null;this.src='{{ asset('assets/images/No_Image_Available.png') }}';"/>
                        <a href="{{ url('/recipe', $row_u['id']) }}"><h3>{{$row_r['rec']->name}}</h3></a>
                        <strong>Posted: </strong><span>{{$row_r['rec']->datepost}}</span>
                    </dt>
                    <dd>
                        <div> 
                            <a><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_r['follow']}}</a>                       
                            <a><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_r['made']}}</a>
                            <a><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_r['vote']}}</a>
                        </div>
                        <div class="ingre_box">
                            @foreach($row_r['comments'] as $row_c)
                            <div class="ingre_step"><img onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';" src="{{ asset('assets/images/user_pic/'.$row_c->avatar) }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> {{$row_c->user->username}} comment
                                <div style="border-top:1px solid #dedede;margin:15px;">
                                  <?php echo $row_c->content; ?>
                                </div>
                            </div>
                            @endforeach
                       </div>
                    </dd>
                </dl>
                @endif                               
            @endforeach
        </div>
    </div>        
    @endforeach   
@endif
</div>
@stop
