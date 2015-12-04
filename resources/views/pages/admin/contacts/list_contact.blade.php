@extends('layouts.admin')

@section('title')
    Manage Contact
@stop

@section('css')
     <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Contacts</h3>
@stop

@section('content')

@include('flash::message')
{{ Session::forget('flash_notification.message')}}


<div>
    {!! Form::open(array('url'=>'admin/contacts/search','method'=>'POST')) !!}
        <table>
            <tr>
                <td><span class="errors">{{ $errors->first('keyword') }}</span></td>
                <td>{!! Form::text('keyword', null, array('class' => 'form-control')) !!}</td>
                <td style="padding: 5px;">
                    <button type="submit" class="btn btn-info">
                        <i class='glyphicon glyphicon-search'> Search </i>
                    </button>
                </td>
            </tr>
        </table>
    {!! Form::close() !!}
</div>
    {!! Form::open() !!}
        <table class="Datagrid" border="0" cellspacing="0" cellpadding="0">
            <tr style="text-align: center;">                
                <th>Name</th>
                <th>User ID</th>
                <th>Subject</th>
                <th style="width:10px;">Comment</th>
                <th style="width:10%;">Send Date</th>
                <th style="width:10%;">Reply Date</th>                
                <th>Status</th>
                <th></th>
            </tr>
            @foreach($contact as $row)
            <tr>                
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->name}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->usersid}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->subject}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->comment}}</td>
                <td style="text-align: center;cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->senddate}}</td>
                <td style="text-align: center;cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->replydate}}</td>
                
                <td style="text-align: center;cursor: pointer;" onclick="window.location='{{url('admin/contacts/detail',$row->id)}}'">{{$row->status}}</td>
                
                <td> 
                    <button class='btn btn-xs btn-danger' type='button' 
                            onclick="if (confirm('Are you sure want to delete this contact?')) 
                                        window.location='{{url('admin/contacts/delete', $row->id)}}'; 
                                         return false">
                        <i class='glyphicon glyphicon-trash'> Delete </i>
                    </button>


                </td>
            </tr>
            @endforeach 
        </table>
            
    <?php echo $contact->render(); ?>
    {!! Form::close() !!}

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();
               
    </script>
@stop

