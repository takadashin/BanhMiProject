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
     @if($errors->any())
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
     @endif
    <div>
    {!! Form::open(['url' => 'admin/editcontentrecipe/'.$recipe->id,'files' => true]) !!}
    <div>{!! Form::label('lbl_id', 'Recipe id : '.$recipe->id) !!}</div>

    <div>{!! Form::label('lbl_user', 'User Post id : '.$recipe->user->username) !!}</div>
    
    <div>
    {!! Form::label('lbl_title', 'Title : ') !!}
    {!! Form::text('txt_title',$recipe->name,['class'=>'textboxinput']) !!} 
    </div>
    
    <div>
    {!! Form::label('lbl_serve', 'Serving : ') !!}
    {!! Form::text('txt_serve',$recipe->servings,['class'=>'textboxinput']) !!} 
    </div>
    
    <div>
    {!! Form::label('lbl_des', 'Description : ',['style'=>'float:left;']) !!}
    {!! Form::textarea('txt_des',$recipe->Description,['class'=>'textareainput']) !!} 
    </div>
    
    <div>
    {!! Form::label('lbl_img', 'Image : ') !!}
    {!! Form::file('fileupload', ['id'=>'imgInp','accept'=>'.jpg,.png']) !!}
    <img id="blah" style="height:100px;width:auto;" onError="this.onerror=null;this.src='{{ asset('assets/images/No_Image_Available.png') }}';" src="{{ asset('assets/images/article_pic/'.$recipe->img) }}" /> 
    </div>
    <hr>
    <div>
        <h2>Ingredient</h2>
        <div id="gridingre">
        <table border="1" style=" border-collapse: collapse;">
            <tr>
                <th>#</th>
                <th>Ingredient Name</th>
                <th>Ingredient Detail</th>
                <th>Save</th>
                <th>Delete</th>
            </tr>
            <?php $countid = 0; ?>
            @foreach($recipe->recept_ingre as $row)
            <?php $countid++; ?>
            <tr>
                <td>{{$countid}}</td>
                <td>{{$row->ingredient->name}}</td>
                <td>{!! Form::text('txt_ingre'.$row->ingredient->id,$row->detail,['class'=>'textboxinput','id'=>'textboxdetail_'.$row->id]) !!}</td>
                <td><a onClick="editingre({{$row->recipeid}},{{$row->id}},'{{ url()}}');"  >Save</a></td>
                <td><a  onClick="deleteingre({{$row->recipeid}},{{$row->id}},'{{ url()}}');" >Delete</a></td>
                
               
            </tr>
            @endforeach
            
        </table>
            </div>
        <hr>
        <div>
        <div style="margin-top:10px;">
            {!! Form::label('lbl_ingrename', 'Ingredient Name : ',['style'=>'float:left;']) !!}
            {!! Form::select('ddl_ingrename', $ingre)!!}
            <div class="clear"></div>
        </div>
        <div>
            {!! Form::label('lbl_ingre_detail', 'Ingredient detail : ',['style'=>'float:left;']) !!}
            {!! Form::textarea('txt_ingre_detail',null,['class'=>'textareainput']) !!} 
        </div>
            {!! Form::button('Create Ingredient for recipe',['class'=> 'main_button','onClick'=>'addingre('.$recipe->id.',"'.url().'")']) !!}
        </div>
        <hr>
    </div>
    <div>
        <h2>Steps</h2>
       <div id="gridstep">
        <table border="1" style=" border-collapse: collapse;">
            <tr>
                <th>#</th>
                <th>Step Order</th>
                <th>Step Content</th>
                <th>Step Picture</th>
                <th>Save</th>
                <th>Delete</th>
            </tr>
            <?php $countid = 0; ?>
            @foreach($step as $row)
            <?php $countid++; ?>
            <tr>
                <td>{{$countid}}</td>
                <td>{!! Form::text('txt_steporder'.$row->id,$row->steporder,['class'=>'textboxinput','id'=>'txtorder_'.$row->id]) !!}</td>
                <td>{!! Form::text('txt_stepcontent'.$row->id,$row->content,['class'=>'textboxinput','id'=>'txtcontent_'.$row->id]) !!}</td>
                <td><img style="height:100px;width:auto;"  src="{{ asset('assets/images/article_pic/'.$row->picture) }}" /></td>
                <td><a onClick="editstep({{$row->recipeid}},{{$row->id}},'{{ url()}}');"  >Save</a></td>
                <td><a  onClick="deletestep({{$row->recipeid}},{{$row->id}},'{{ url()}}');" >Delete</a></td>
                
               
            </tr>
            @endforeach
            
        </table>
            
            </div>
        <div class="clear"></div>
           <a href="{{ url('/admin/recipe/edit/addstep', $recipe->id) }}"  >Add step for recipe</a>
        
    </div>
    <div>
        <h2>Comment</h2>
       <div id="gridcomment">
        <table border="1" style=" border-collapse: collapse;">
            <tr>
                <th>#</th>
                <th>Comment detail</th>
                <th>User Post</th>
                <th>Create Date</th>
                <th>Save</th>
                <th>Delete</th>
            </tr>
            <?php $countid = 0; ?>
            @foreach($comment as $row)
            <?php $countid++; ?>
            <tr>
                <td>{{$countid}}</td>
                <td>{!! Form::textarea('txt_comment'.$row->id,$row->content,['style'=>'height:50px;','class'=>'textboxinput','id'=>'txtcomment_'.$row->id]) !!}</td>
                <td>{{$row->user->username}}</td>
                <td>{{$row->created_at}}</td>
                <td><a onClick="editcomment({{$row->recipeid}},{{$row->id}},'{{ url()}}');"  >Save</a></td>
                <td><a  onClick="deletecomment({{$row->recipeid}},{{$row->id}},'{{ url()}}');" >Delete</a></td>
                
               
            </tr>
            @endforeach
            
        </table>
            
            </div>
        <div class="clear"></div>
          
        
    </div>
    <div style="float:right;">
        {!! Form::submit('Save',['class'=> 'main_button']) !!}
        {!! Form::button('Cancel',['class'=> 'main_button']) !!}
    </div>
    <div class="clear"></div>
    {!! Form::close() !!}
    </div>
</div>


@stop

