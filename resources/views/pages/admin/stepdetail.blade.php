@extends('layouts.admin')

@section('title')
    Home Page
@stop

@section('headerTitle')
    Home Page
@stop

@section('content')

<script src="{{ asset('assets/javascript/ajaxcall.js') }}" type="text/javascript"></script>
<div class="form_recipe">
    <div>
        {!! Form::open(['url' => 'admin/editrecipe/addstep/'.$recipeid, 'files' => true]) !!}
         <div style="margin-top:10px;">
            {!! Form::label('lbl_steporder', 'Step Order : ',['style'=>'float:left;']) !!}
            {!! Form::text('txt_step_order',null,['class'=>'textareainput']) !!} 
            
        </div>
    
        <div style="margin-top:10px;">
            {!! Form::label('lbl_step_content', 'Step Content : ',['style'=>'float:left;']) !!}
            {!! Form::textarea('txt_step_content',null,['class'=>'textareainput']) !!} 
        </div>
        <div style="margin-top:10px;">
        {!! Form::label('lbl_img', 'Image : ') !!}
        {!! Form::file('picture', ['id'=>'imgInp','accept'=>'.jpg,.png']) !!}
        <img id="blah" style="height:100px;width:auto;" onError="this.onerror=null;this.src='{{ asset('assets/images/No_Image_Available.png') }}';" /> 
        </div>
            {!! Form::submit('Create Step for recipe',['class'=> 'main_button']) !!}
        </div>
        <hr>
        {!! Form::close() !!}
    </div>
</div>


@stop

