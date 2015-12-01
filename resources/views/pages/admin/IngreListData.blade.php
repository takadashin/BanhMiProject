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