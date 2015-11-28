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
            <th>Title</th>
            <th>Last edited</th>
            <th>User Post</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <tr>
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
            <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
        <tr class="even">
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
             <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
        <tr>
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
            <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
        <tr class="even">
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
             <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
        <tr>
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
             <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
        <tr class="even">
            <td>Cookie French Made</td>
            <td>2016-10-15 10:15 P.M</td>
            <td>Maria</td>
             <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
            <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
        </tr>
    </table>
@stop

