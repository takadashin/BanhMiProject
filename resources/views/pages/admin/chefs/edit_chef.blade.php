@extends('layouts.admin')

@section('title')
    Manage Chefs
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset("assets/css/main.css") }}" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Edit a Chef</h3>
@stop

@section('content')   
    @include('flash::message')  
    <div style="margin: 0 150px; width: 70%; background-color: lavenderblush; text-align: left;">  
        <div style="margin: 20px;">
        {!! Form::open(array('url'=>'admin/chefs/update','method'=>'POST', 'files'=>true))!!}
        <div class="form-group">
            {!! Form::hidden('id', $user->id) !!} 
            <br/>        
            {!! Form::label('firstname', 'First Name : ') !!}        
            <br />
            <span class="errors">{{ $errors->first('firstname') }}</span>
            {!! Form::text('firstname', $user->firstname, array('class' => 'form-control')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('lastname', 'Last Name : ') !!}
            <br />
            <span class="errors">{{ $errors->first('lastname') }}</span>
            {!! Form::text('lastname', $user->lastname, array('class' => 'form-control')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('username', 'User Name : ') !!}
            <br />
            <span class="errors">{{ $errors->first('username') }}</span>
            {!! Form::text('username', $user->username, array('class' => 'form-control', 'disabled' => 'disable')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('password', 'Password : ') !!}
            <br />
            <span class="errors">{{ $errors->first('password') }}</span>
            {!! Form::text('password', $user->password, array('class' => 'form-control')) !!} 
        </div>
        <br />
        <div class="form-group">
            {!! Form::label('address', 'Address : ') !!}
            <br />
            <span class="errors">{{ $errors->first('address') }}</span>
            {!! Form::text('address', $user->address, array('class' => 'form-control')) !!}                    
        </div>
        <br/>
        <div class="form-group">
            {!! Form::label('email', 'Email Address : ') !!}
            <br />
            <span class="errors">{{ $errors->first('email') }}</span>
            {!! Form::text('email', $user->email, array('class' => 'form-control')) !!}                    
        </div>
        <br />
        <div class="form-group">
            {!! Form::label('phone', 'Phone : ') !!}
            <br />
            <span class="errors">{{ $errors->first('phone') }}</span>
            {!! Form::text('phone', $user->phone, array('class' => 'form-control')) !!}                    
        </div>
        <br/>
        <div class="form-group">
            {!! Form::label('role', 'Role : ') !!}
            <br />
            <span class="errors">{{ $errors->first('role') }}</span>
            {!! Form::select('role', ['admin' => 'admin', 'user' => 'user', 'twitter' => 'twitter'], $user->role, array('class' => 'form-control')) !!}                   
        </div>
        <br/>
        <div>
            {!! Form::label('avatar', 'Profile Picture : ') !!}
            <br />        
            <img src="{{asset('assets/images/user_pic/'.$user->avatar) }}"
                     style="width: 180px;height: 180px"
                     onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';">
            <span class="errors">{{ $errors->first('avatar') }}</span>
            {!! Form::file('avatar', null, array('class'=>'file')) !!}                 
        </div>
        <br/>
        <div class="form-group">
            {!! Form::label('confirmed', 'Confirmed : ') !!}
            <br />
            <span class="errors">{{ $errors->first('confirmed') }}</span>
            {!! Form::select('confirmed', [0, 1], $user->confirmed, array('class' => 'form-control')) !!}                  
        </div>
        <br/>
        <div class="form-group">
            {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/admin/chefs/list") }}'">Cancel</button>
        </div>
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

