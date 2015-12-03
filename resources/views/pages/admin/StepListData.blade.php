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