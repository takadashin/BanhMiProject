@foreach($ingredients as $ingredient)
      <li id="{{$ingredient->id}}">
          <span id="span_{{$ingredient->id}}">{{$ingredient->name}}</span> 
          <a href="#" onClick="delete_ingredient('{{$ingredient->id}}');" class="icon-delete">Delete</a> 
          <a href="#" onClick="edit_ingredient('{{$ingredient->id}}','{{$ingredient->name}}');" class="icon-edit">Edit</a>
      </li>
@endforeach

