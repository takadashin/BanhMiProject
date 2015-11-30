@extends('layouts.main')

@section('title')
    Home Page
@stop

@section('content')

    <div class="login-box">
    <div class="login-error-msg">{{ Session::get('login_error') }} </div>
       {!! Form::open(['route' => 'sessions.store']) !!}
    <div class="login-field-space">
        {!! Form::label('username', 'Username : ') !!}
        {!! Form::text('username') !!}     
    </div>
    <div class="login-field-space">
        {!! Form::label('password', 'Password : ') !!}
        {!! Form::password('password'); !!}      
    </div>

    <div class="login-field-space, login-submit">
        {!! Form::submit('Log In') !!}
    </div>

    {!! Form::close() !!}
   </div>

@stop

