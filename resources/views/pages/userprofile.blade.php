@extends('layouts.main')

@section('title')
    User Profile
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content') 
    
    <div class="innerwrap">
        <div class="header_title">
            <h1>Profile</h1>
        </div>
        <div class="profile_left">
            <div> 
                <div>
                    @include('flash::message')
                </div>
                <div class="article_about" style="height: 860px;">
                    <div class="article_content">            

                        {!! Form::open(array('url'=>'userprofile','method'=>'POST', 'files'=>true)) !!}
                        <div style="width:300px;text-align: center"> 
                            <div style="padding-top: 10px;">                           
                            <img src="{{asset('assets/images/user_pic/'.$userinfo->avatar) }}"
                                style="width: 180px;height: 180px"
                                onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';">
                            </div>                            
                            <h3>                    
                                {!! Form::label('username', $userinfo->username) !!}
                                {!! Form::hidden('id', $userinfo->id) !!}
                                {!! Form::hidden('username', $userinfo->username) !!}
                            </h3>
                            
                            @if(Auth::check()&& $userinfo->username == Auth::user()->username)
                            
                            <div style="padding-left:45px;">
                                {!! Form::file('avatar', null, array('accept'=>'.jpg, .png')) !!}
                                <span class="errors">{{ $errors->first('avatar') }}</span>
                            </div>  
                            <br/>
                            <div class="form-group">  
                                {!! Form::label('firstname', 'First Name : ') !!}
                                <br />
                                <span class="errors">{{ $errors->first('firstname') }}</span>
                                {!! Form::text('firstname', $userinfo->firstname, array(
                                            'class' => 'form-control')) !!} 
                            </div>

                            <div class="form-group">                    
                                {!! Form::label('lastname', 'Last Name : ') !!}
                                <br />
                                <span class="errors">{{ $errors->first('lastname') }}</span>
                                {!! Form::text('lastname', $userinfo->lastname, array(
                                            'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email Address : ') !!}
                                <br />
                                <span class="errors">{{ $errors->first('email') }}</span>
                                {!! Form::text('email', $userinfo->email, array(
                                            'class' => 'form-control')) !!}                    
                            </div>

                            <div class="form-group">
                                {!! Form::label('address', 'Address : ') !!}
                                <br />
                                <span class="errors">{{ $errors->first('address') }}</span>
                                {!! Form::text('address', $userinfo->address, array(
                                            'class' => 'form-control')) !!}                    
                            </div>

                            <div class="form-group">
                                {!! Form::label('phone', 'Phone : ') !!}
                                <br />
                                <span class="errors">{{ $errors->first('phone') }}</span>
                                {!! Form::text('phone', $userinfo->phone, array(
                                            'class' => 'form-control')) !!}                    
                            </div>
                            <br />
                        </div>
                        <div class="clear" ></div>
                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                        
                        {!! Form::close() !!}   
                        @endif
                    </div> 
                </div>
            </div>
        </div>
        <div class="profile_right">
            <div class="article_content">
                @if($recipe->count()==0)
                    <h3>You have no recipe yet.</h3>
                @else
                    @foreach($recipe as $row)
                    <div class="article" style="width:21%;">
                        <center>
                            <div>
                                <img src="{{ asset('assets/images/article_pic/'.$row->img) }}" 
                                     onError="this.onerror=null;this.src='{{ asset('assets/images/No_Image_Available.png') }}';"/>
                            </div>

                            <div class="article_content mid_content" >
                                <h3 style='font-weight: bold'>{{$row->name}}</h3>
                                <p>{{$row->Description}}</p>
                            </div>
                            <div><hr></div>
                            <div class="article_content foot_content" >
                                <a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countfollow}}</a>
                                <a href="http://google.com"><img src="{{ asset('assets/images/spoon.jpg') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countmade}}</a>
                                <a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  style="width: 15px;height:15px;vertical-align: -3px;" /> {{$row->countlike}}</a>

                                <div style="margin-top:10px;text-align: right;">Made by 
                                    <a href="{{ url('/user', $row->userpostid) }}"><img src="{{ asset('assets/images/user_pic/'.$row->avatar) }}" 
                                  onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';" style="width: 46px;height:46px;vertical-align: -19px;" /> </a>
                                </div>
                                @if(Auth::check()&& $userinfo['username']==Auth::user()->username)
                                <div class="navbar_action" style="text-align: center;position: relative;">
                                    
                                    <button type="button" class="btn btn-s btn-primary" onclick="window.location='{{url('/postRecipe?id='. $row->id)}}'">
                                        <i class='glyphicon glyphicon-pencil'></i>
                                    </button>                                    

                                    <button class='btn btn-s btn-danger' type='button' 
                                            onclick="if (confirm('Are you sure want to delete this recipe?')) 
                                                        window.location='{{url('userprofile/delete', $row->id)}}'; 
                                                         return false">
                                        <i class='glyphicon glyphicon-trash'></i>
                                    </button>


                                    {!! Form::close() !!}
                                </div>
                                @endif
                        </center>
                    </div>
                    @endforeach
                @endif
            </div>
            <?php echo $recipe->render(); ?>
        </div>
        
      
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();        
    </script>
    

@stop
