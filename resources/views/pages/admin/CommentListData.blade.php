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