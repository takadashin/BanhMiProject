@extends('layouts.main')

@section('title')
    Register Page
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="innerwrap">
        <div class="header_title">            
            <h1>Create a new Account</h1>
        </div>        
        <div class="container" style="width:50%;background-color: lavenderblush;">
            <div>
                @include('flash::message')
            </div>
            <div class="article_content">
                @if (Session::has('success'))
                    <ul class="success">
                        <li>{{ Session::get('success') }}</li>
                    </ul>
                @endif
                <br/>
                {!! Form::open(['url' => 'register']) !!}
                <div>
                    {!! Form::label('firstname', 'First Name : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('firstname') }}</span>
                    {!! Form::text('firstname', null, array('class' => 'form-control')) !!} 
                </div>
                <br />
                <div>                    
                    {!! Form::label('lastname', 'Last Name : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('lastname') }}</span>
                    {!! Form::text('lastname', null, array('class' => 'form-control')) !!} 
                </div>
                <br />
                <div>                    
                    {!! Form::label('username', 'User Name : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('username') }}</span>
                    {!! Form::text('username', null, array('class' => 'form-control')) !!} 
                </div>
                <br />
                <div>                    
                    {!! Form::label('password', 'Password : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('password') }}</span>
                    {!! Form::password('password', array('class' => 'form-control')) !!} 
                </div>
                <br />
                <div>                    
                    {!! Form::label('confirmpassword', 'Confirm Password : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('confirmpassword') }}</span>
                    {!! Form::password('confirmpassword', array('class' => 'form-control')) !!} 
                </div>
                <br />
                <div>
                    {!! Form::label('email', 'Email Address : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('email') }}</span>
                    {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'example@gmail.com')) !!}                    
                </div>
                <br />
                <center>
                    {!! Form::submit('Register', array('class' => 'btn btn-primary')) !!}
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/index") }}'">Cancel</button>
                </center>

                {!! Form::close() !!}
            </div> 
        </div>
        
    </div>

    

@stop
