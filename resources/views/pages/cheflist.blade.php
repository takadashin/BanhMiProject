@extends('layouts.main')

@section('title')
    Chef List
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content')  
<div class="innerwrap">
    <div class="header_title">
        <h1>Chefs</h1>        
    </div>
    <?php echo $users->render(); ?>
    @foreach($users as $row_u)
    <div class="article" style="width: 1000px;" >
        <div style="float:left; width: 200px;text-align: center;border-right: 2px solid lightgray;">
            <img src="{{asset('assets/images/user_pic/'.$row_u->avatar) }}"
                     style="width: 150px;height: 150px;"
                     onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';">
            <h3>{{$row_u->username}}</h3>
        </div>        
        <div style="float:left; padding: 10px;">
            @foreach($recipes as $row_r)
                @if ($row_r['userpostid'] == $row_u['id'])
                <dl>
                    <dt>
                        <img style="width: 50px;height: 50px;float:left" 
                             src="{{ asset('assets/images/article_pic/'.$row_r->img) }}" 
                             onError="this.onerror=null;this.src='{{ asset('assets/images/No_Image_Available.png') }}';"/>
                        <a href="{{ url('/recipe', $row_u['id']) }}"><h3>{{$row_r->name}}</h3></a>
                        <strong>Posted: </strong><span>{{$row_r->datepost}}</span>
                    </dt>
                    <dd>
                        <div>
                            @foreach($recipe_quantity as $row_q)
                                @if($row_q['recId']==$row_r['id'])
                                    <a><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_q['follow']}}</a>                       
                                    <a><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_q['made']}}</a>
                                    <a><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row_q['vote']}}</a>                                    
                                @endif
                            @endforeach
                            </div>
                        <div class="ingre_box">
                            @foreach($comments as $row_c)
                                @if($row_c['recipeid']==$row_r['id'])                                    
                                    
                                    <div class="ingre_step"><img onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';" src="{{ asset('assets/images/user_pic/'.$row_c->user->avatar) }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> {{$row_c->user->username}} comment
                                        <div style="border-top:1px solid #dedede;margin:15px;">
                                          <?php echo $row_c->content; ?>
                                        </div>
                                    </div>
                                    
                               @endif                                           
                            @endforeach
                       </div>
                    </dd>
                </dl>
                @endif                               
            @endforeach
        </div>
    </div>        
    @endforeach    
</div>
    
                        

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    

@stop
