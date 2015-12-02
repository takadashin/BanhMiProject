@extends('layouts.main')

@section('title')
    Confirmation Page
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content')  
    
    <div class="innerwrap">
        <div class="header_title">            
            <h1>Confirmation</h1>
        </div>        
        <div>
            @include('flash::message')
        </div> 
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    

@stop
