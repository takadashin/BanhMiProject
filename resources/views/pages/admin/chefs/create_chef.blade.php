@extends('layouts.admin')

@section('title')
    Manage Chefs
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="{{ asset("assets/css/main.css") }}" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Create new chef</h3>    
@stop

@section('content')   
    @include('flash::message')     
    <div style="margin: 0 150px; width: 70%; background-color: lavenderblush; text-align: left;">        
        <div style="margin: 20px;">
            <br/>
            {!! Form::open(['url' => 'admin/chefs/create', 'method' => 'POST', 'file' => true]) !!}
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
                {!! Form::label('address', 'Address : ') !!}
                <br />
                <span class="errors">{{ $errors->first('address') }}</span>
                {!! Form::text('address', null, array('class' => 'form-control')) !!}                    
            </div>
            <br/>
            <div>
                {!! Form::label('email', 'Email Address : ') !!}
                <br />
                <span class="errors">{{ $errors->first('email') }}</span>
                {!! Form::text('email', null, array('class' => 'form-control')) !!}                    
            </div>
            <br />
            <div>
                {!! Form::label('phone', 'Phone : ') !!}
                <br />
                <span class="errors">{{ $errors->first('phone') }}</span>
                {!! Form::text('phone', null, array('class' => 'form-control')) !!}                    
            </div>
            <br/>
            <div>
                {!! Form::label('role', 'Role : ') !!}
                <br />
                <span class="errors">{{ $errors->first('role') }}</span>
                {!! Form::select('role', ['admin' => 'admin', 'user' => 'user', 'twitter' => 'twitter'], null, array('class' => 'form-control')) !!}                   
            </div>
            <br/>
            <div>
                {!! Form::label('avatar', 'Profile Picture : ') !!}
                <br />   
                {!! Form::file('avatar', null, array('class' => 'file')) !!}                    
            </div>
            <br/>
            <div>
                {!! Form::label('confirmed', 'Confirmed : ') !!}
                <br />
                <span class="errors">{{ $errors->first('confirmed') }}</span>
                {!! Form::select('confirmed', [0, 1], null, array('class' => 'form-control')) !!}                  
            </div>
            <br/>
            <center>
                {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
                <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/admin/chefs/list") }}'">Cancel</button>
            </center>
            {!! Form::close() !!}
        </div>
        
    </div>
    
    
    
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();        
    </script>
@stop

