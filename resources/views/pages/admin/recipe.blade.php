@extends('layouts.admin')

@section('title')
    Home Page
@stop

@section('headerTitle')
    Home Page
@stop

@section('content')
    
    <table class="Datagrid" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Last edited</th>
            <th>User Post</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php $count=0; ?>
        @foreach($recipe as $row)
        <?php $count++; ?>
        <tr <?php echo $count%2 == 0?'class="even"':""; ?> >
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->datepost}}</td>
            <td>{{$row->user->username}}</td>
            <td><a href="{{ url('admin/recipe/delete',$row->id) }}"><img src="{{ asset('assets/images/delete.png') }}">Delete</a></td>
            <td><a href="{{ url('admin/recipe/edit',$row->id) }}"><img src="{{ asset('assets/images/edit.png') }}">Edit</a></td>
        </tr>
        @endforeach
    </table>
@stop

