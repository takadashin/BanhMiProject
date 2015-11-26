@extends('layouts.main')

@section('title')
    Home Page
@stop

@section('content')

    <div class="innerwrap">
        <div id="recipe_detail">
            <center>
                <div class="recipe_detail_top">
                    <div style="float:left;text-align: center;width:60%;height:250px;overflow: hidden;position:relative;">
                        <h2 style="color:orange">Italian Meatball Sandwich Casserole</h2>
                        <div><a href="http://google.com"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> </a>Recipe by: Martiny</div>
                        <div style="text-align: left;margin-top:20px;"><i>"All the ingredients for a meatball sandwich are here, just assembled in a different manner. This recipe is always a hit at our house. We NEVER have any leftovers, it is so good!"</i></div>
                                <div><ul class="navbar_action" >
                                       
                                        <li style="display: table-cell;"><a href="http://google.com"><img src="{{ asset('assets/images/user-group-512.png') }}"  />follow</a></li>
                                        <li style="display: table-cell;"><a href="http://google.com"><img src="{{ asset('assets/images/spoon.png') }}"  />made</a></li>
                                        <li style="display: table-cell;"><a href="http://google.com"><img src="{{ asset('assets/images/thumpup.png') }}"  />like</a></li>
                                      
                            </table> </div>
                    </div>
                <div  style="float:right;width:39%;">
                    <img style="height:auto;width:100%;" src="{{ asset('assets/images/article_pic/1826.jpg') }}" />
                </div>
                </div>
            </center>
            <div class="clear" style="height:5px; background: #23527c;"></div>
            
            <div class="recipe_detail_body">
                <h1 style="border-bottom: 1px solid #dedede;">Ingredients</h1>
                <div class="ingre_box">
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />1 spoon pepper</div>
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />2 spoon sugar</div>
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />1 chicken leg</div>
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />1 spoon pepper</div>
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />2 spoon sugar</div>
                    <div class="ingre_item"><img src="{{ asset('assets/images/ingre_icon.png') }}" />1 chicken leg</div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <h1 style="border-bottom: 1px solid #dedede;">Directions</h1>
                <div class="ingre_box">
                    <div class="ingre_step"><i>1</i><p>This is a step</p></div>
                    <div class="ingre_step"><i>2</i><p>This is a step</p></div>
                    <div class="ingre_step"><i>3</i><p>This is a step</p></div>
                    <div class="ingre_step"><i>4</i><p>This is a step</p></div>
                </div>
                <div class="clear"></div>
                <h1 style="border-bottom: 1px solid #dedede;">Comments</h1>
                 <div class="ingre_box">
                    <div class="ingre_step"><img src="{{ asset('assets/images/mystery_person.png') }}"  style="width: 46px;height:auto;vertical-align: -19px;" /> comment
                        <div style="border-top:1px solid #dedede;margin:15px;">
                            Awesome
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="clear"></div>
        </div>
      
      
    </div>

@stop

