@extends('layouts.admin')

@section('title')
    Home Page
@stop

@section('headerTitle')
    Home Page
@stop

@section('content')
<div class="form_recipe">
    {!! Form::open(['url' => 'admin/editrecipe']) !!}
    <div>{!! Form::label('lbl_id', 'Recipe id : '.$recipe->id) !!}</div>
    <div class="clear"></div>
    <div>{!! Form::label('lbl_user', 'User Post id : '.$recipe->user->username) !!}</div>
    <div class="clear"></div>
    <div>
    {!! Form::label('lbl_title', 'Title : ') !!}
    {!! Form::text('txt_title',$recipe->name,['class'=>'textboxinput']) !!} 
    </div>
    <div class="clear"></div>
    <div>
    {!! Form::label('lbl_serve', 'Serving : ') !!}
    {!! Form::text('txt_serve',$recipe->servings,['class'=>'textboxinput']) !!} 
    </div>
    <div class="clear"></div>
    <div>
    {!! Form::label('lbl_des', 'Description : ') !!}
    {!! Form::textarea('txt_des',$recipe->Description,['class'=>'textareainput']) !!} 
    </div>
    <div class="clear"></div>
    <div>
    {!! Form::label('lbl_img', 'Serving : ') !!}
    {!! Form::text('txt_img',$recipe->img,['class'=>'textboxinput']) !!} 
    </div>
   <div class="clear"></div>
    <div style="float:right;">
        {!! Form::submit('Save',['class'=> 'main_button']) !!}
        {!! Form::button('Cancel',['class'=> 'main_button']) !!}
    </div>
   <div class="clear"></div>
    {!! Form::close() !!}
    </div>
<div class="clear"></div>
@stop

