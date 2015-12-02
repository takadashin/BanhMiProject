@extends('layouts.admin')

@section('title')
    Manage Chefs
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Detail Chef</h3>
@stop

@section('content') 
    <div style="margin: 0 150px; width: 70%; background-color: lavenderblush; text-align: left;">  
        <div style="margin: 20px;padding:10px;">
            <div>               
                <img src="{{asset('assets/images/user_pic/'.$user->avatar) }}"
                     style="width: 180px;height: 180px"
                     onError="this.onerror=null;this.src='{{ asset('assets/images/mystery_person.png') }}';">
            </div>
            <div>
                <strong>Name: </strong><span>{{ $user->firstname }} </span><span>{{ $user->lastname }}</span>
            </div>
            <div>
                <strong>Username: </strong><span>{{ $user->username }}</span>
            </div>
            <div>
                <strong>Password: </strong><span>{{ $user->password }}</span>
            </div>
            <div>
                <strong>Address: </strong><span>{{ $user->address }}</span>
            </div>
            <div>
                <strong>Email: </strong><span>{{ $user->email }}</span>
            </div>
            <div>
                <strong>Phone: </strong><span>{{ $user->phone }}</span>
            </div>
            <div>
                <strong>Role: </strong><span>{{ $user->role }}</span>
            </div>
            <div>
                <strong>Remember_token: </strong><span>{{ $user->remember_token }}</span>
            </div>
            <div>
                <strong>Confirmation_code: </strong><span>{{ $user->confirmation_code }}</span>
            </div>
            <div>
                <strong>Confirmed: </strong><span>{{ $user->confirmed }}</span>
            </div>
            <div>
                <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/admin/chefs/list") }}'">Close</button>
            </div>
        </div> 
    </div>
@stop

