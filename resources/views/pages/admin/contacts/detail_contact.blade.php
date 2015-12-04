@extends('layouts.admin')

@section('title')
    Manage Contacts
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset("assets/css/main.css") }}" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Detail Contact</h3>
@stop

@section('content')   
    @include('flash::message')  
    <div style="margin: 0 150px; width: 70%; background-color: lavenderblush; text-align: left;">  
        <div style="margin: 20px;">
        {!! Form::open(array('url'=>'admin/contacts/reply','method'=>'POST'))!!}
        <div class="form-group">
            {!! Form::hidden('id', $contact->id) !!} 
            <br/>        
            {!! Form::label('name', 'Name : ') !!}        
            <br />
            <span class="errors">{{ $errors->first('name') }}</span>
            {!! Form::text('name', $contact->name, array('class' => 'form-control')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('email', 'Email : ') !!}
            <br />
            <span class="errors">{{ $errors->first('email') }}</span>
            {!! Form::text('email', $contact->email, array('class' => 'form-control', 'readonly')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('subject', 'Subject : ') !!}
            <br />
            <span class="errors">{{ $errors->first('subject') }}</span>
            {!! Form::text('subject', $contact->subject, array('class' => 'form-control', 'readonly')) !!} 
        </div>
        <br />
        <div class="form-group">                    
            {!! Form::label('comment', 'Comment : ') !!}
            <br />
            <span class="errors">{{ $errors->first('comment') }}</span>
            {!! Form::textarea('comment', $contact->comment, array('class' => 'form-control','readonly')) !!} 
        </div>
        <br />
        <div class="form-group">
            {!! Form::label('reply_content', 'Reply : ') !!}
            <br />
            <span class="errors">{{ $errors->first('reply_content') }}</span>
            {!! Form::textarea('reply_content', $contact->reply_content, array('class' => 'form-control')) !!}                    
        </div>
        <br/>
        <div class="form-group">
            {!! Form::submit('Reply', array('class' => 'btn btn-primary')) !!}
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/admin/contacts/list") }}'">Cancel</button>
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

