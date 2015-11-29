@extends('layouts.main')

@section('title')
    Home Page
@stop
<?php $userid= 1; ?>
@section('content')
<script src="{{ asset('assets/javascript/ajaxcall.js')}}" type="text/javascript"></script>
    <div class="innerwrap">
        <div id="recipe_detail">
            <center>
                <div class="recipe_detail_top">
                    
                    <div style="float:left;text-align: center;width:60%;height:250px;overflow: hidden;position:relative;">
                        <h2 style="color:orange">{{$recipe->name}}</h2>
                        <div><a href="{{ url('/user', $recipe->userpostid) }}"><img onError="this.onerror=null;this.src='{{ asset('assets/images/user_pic/minicons2-14-512.png') }}';" src="{{ asset('assets/images/user_pic/'.$usercheck->avatar) }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a>Recipe by: {{$usercheck->username}}</div>
                        <div style="text-align: left;margin-top:20px;"><i>{{$recipe->Description}}</i></div>
                                <div><ul class="navbar_action" >
                                       
                                        <li style="display: table-cell;"><a <?php echo $follow>0?"class='active'":""; ?> id="followbutton" href="{{ url('/getfollow', [$recipe->userpostid,$recipe->id]) }}"><img src="{{ asset('assets/images/user-group-512.png') }}"  /> Follow</a></li>
                                        <li style="display: table-cell;"><a <?php echo $made>0?"class='active'":""; ?> id="madebutton" href="{{ url('/getmade', [$recipe->id]) }}"><img src="{{ asset('assets/images/spoon.png') }}"  /> Made</a></li>
                                        <li style="display: table-cell;"><a <?php echo $vote>0?"class='active'":""; ?> id="votebutton" href="{{ url('/getvote', [$recipe->id]) }}"><img src="{{ asset('assets/images/thumpup.png') }}"  /> Like</a></li>
                                      
                            </table> </div>
                    </div>
                <div  style="float:right;width:39%;">
                    <img style="height:auto;width:100%;" src="{{ asset('assets/images/article_pic/'.$recipe->img) }}" />
                </div>
                </div>
            </center>
            <div class="clear" style="height:5px; background: #23527c;"></div>
            <div class="recipe_detail_body"><div style="float:right;"><img src="{{ asset('assets/images/serving.png') }}" style="width:30px;vertical-align: -10px;" /> {{$recipe->servings}} servings</div></div>
            <div class="clear"></div>
            <div class="recipe_detail_body">
                <h1 style="border-bottom: 1px solid #dedede;">Ingredients</h1>
                <div class="ingre_box">
                    @foreach($ingre as $row)
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />{{$row->detail}}</div>
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <h1 style="border-bottom: 1px solid #dedede;">Directions</h1>
                <div class="ingre_box">
                    <?php $count = 0; ?>
                    @foreach($steps as $row)
                    <div class="ingre_step"><i>{{$count++}}</i><p>{{$row->content}}</p>
                        <div style="text-align: center;"><img src="{{ asset('assets/images/article_pic/'.$row->picture) }}" /></div>
                    </div>
                    
                    @endforeach
                </div>
                <div class="clear"></div>
                <h1 style="border-bottom: 1px solid #dedede;">Comments</h1>
                  {!! Form::open(['url' => 'commentsubmit']) !!}
                  {!! Form::textarea('description', null, array('id'=>'commenteditor')) !!}
                  {!! Form::hidden('recipeid',$recipe->id ) !!}
                  <div style="float:right;">
                    {!! Form::submit('Post comment',['class'=> 'main_button']) !!}
                   </div>
                  
                  {!! Form::close() !!}
                <script type="text/javascript">
                    CKEDITOR.replace( 'commenteditor' );
                </script>
                <div class="clear"></div>
                 <div class="ingre_box">
                     @foreach($comments as $row)
                    <div class="ingre_step"><img onError="this.onerror=null;this.src='{{ asset('assets/images/user_pic/minicons2-14-512.png') }}';" src="{{ asset('assets/images/user_pic/'.$row->user->avatar) }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> {{$row->user->username}} comment
                        <div style="border-top:1px solid #dedede;margin:15px;">
                          <?php echo $row->content; ?>
                        </div>
                    </div>
                     @endforeach
                   
                </div>
                 
            </div>
            <div class="clear"></div>
        </div>
      
      
    </div>

@stop

