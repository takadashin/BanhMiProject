<table>
<tr>
    <th>Ingredient Name</th>
    <th>Ingredient Detail</th>
    <th>Save</th>
    <th>Delete</th>
</tr>

@foreach($recipe->recept_ingre as $row)
<tr>
    <td>{{$row->ingredient->name}}</td>
    <td>{!! Form::text('txt_ingre'.$row->ingredient->id,$row->detail,['class'=>'textboxinput']) !!}</td>
    <td><a href="#" >Save</a></td>
    <td><a  onClick="deletetesting({{$row->ingredientId}},{{$row->recipeid}});" >Delete</a></td>

   
</tr>
@endforeach

</table>