@extends('layouts.main')

@section('title')
    Home Page
@stop

@section('content')

    <div class="login-box">
    <div class="login-error-msg">{{ Session::get('login_error') }} </div>
       {!! Form::open(['route' => 'sessions.store']) !!}
    <div class="login-field-space">
        {!! Form::label('username', 'Username : ',['class'=>'label_search','style'=>'width:80px;']) !!}
        {!! Form::text('username',null,['class'=>'textbox_seach']) !!}     
    </div>
    <div class="login-field-space">
        {!! Form::label('password', 'Password : ',['class'=>'label_search','style'=>'width:80px;']) !!}
        {!! Form::password('password',['class'=>'textbox_seach']); !!}      
    </div>

    <div class="login-field-space, login-submit">
        {!! Form::submit('Log In',['class'=> 'main_button']) !!}
    </div>

    {!! Form::close() !!}
   </div>

@stop

