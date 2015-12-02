@extends('layouts.admin')

@section('title')
    Manage Chefs
@stop

@section('css')
     <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('headerTitle')
    <h3>Chefs</h3>
@stop

@section('content')
@include('flash::message')

<div>
    {!! Form::open(array('url'=>'admin/chefs/search','method'=>'POST')) !!}
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
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Confirmed</th>
                <th colspan="2"></th>
            </tr>
            @foreach($user as $row)
            <tr>
                <td style="text-align: center">{{$row->id}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->username}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->email}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->address}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->phone}}</td>
                <td style="cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->role}}</td>
                <td style="text-align: center;cursor: pointer;" onclick="window.location='{{url('admin/detail_chef',$row->id)}}'">{{$row->confirmed}}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-primary" onclick="window.location='{{url('admin/edit_chef', $row->id)}}'">
                        <i class='glyphicon glyphicon-pencil'> Edit </i>
                    </button>
                </td>
                <td> 
                    <button class='btn btn-xs btn-danger' type='button' 
                            onclick="if (confirm('Are you sure want to delete this user?')) 
                                        window.location='{{url('admin/chefs/delete', $row->id)}}'; 
                                         return false">
                        <i class='glyphicon glyphicon-trash'> Delete </i>
                    </button>


                </td>
            </tr>
            @endforeach 
        </table>
            
    <?php echo $user->render(); ?>
    {!! Form::close() !!}
<br/>
<br/>
<button type="button" class="btn btn-success btn-md" onclick="window.location='{{url('admin/create_chef')}}'">
    <i class='glyphicon glyphicon-plus'> Add New User</i>
</button>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();
               
    </script>
@stop

