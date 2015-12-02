@extends('layouts.main')

@section('title')
    About Page
@stop

@section('css')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content') 
    <div class="innerwrap">
        <div class="header_title">
            <h1>About AllStartRecipe</h1>
        </div>  
        @include('flash::message')
        <div class="article_about" style="margin: 10px;">  
            <div class="article_content" style="margin: 5px;">
                <p>
                Since we come to Canada to study, our hobby are to try out a lot of restaurants. 
                Here we found out that we have a diversity recipe not only from different culture but also from the way they cook 
                even though that is the same food in their culture. Those can be completely different with just a bit different from ingredients they have.
                We realized that we need a website that can connect people around the world to share their own recipe, to find the right ingredient they miss, 
                to taste the right way people do, and rate the recipe and encourage new people to try out their recipes.
                </p>
                <br/>
                <p>The top three priorities for the website are:</p>
                <ul>
                    <li>To provide quality, trustworthy recipes in a user-friendly, easy navigational format.</li>
                    <li>To regularly update the home page with delicious recipe samplings from the various collections at the site.
    </li>
                    <li>The never-ending growth of the site by the continual addition of new, quality recipes from reliable sources. </li>
                </ul>
                <p>Enjoy the recipes, and hope you like them.</p>
                <p>Huyen Nguyen.</p> 
                <br/>
                <hr style="border-width: 2px;">
                <p> &Gg; To contact us, please use the form below:</p>
            </div>
                      
            <div class="article_content"> 
                {!! Form::open(['url' => 'about']) !!}
                <div class="form-group">
                    {!! Form::hidden('usersid', Session::get('username')) !!}
                    <br />
                    {!! Form::label('name', 'Name : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('name') }}</span>
                    {!! Form::text('name',null, array('class' => 'form-control')) !!} 
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'Email Address : ') !!}
                    <br />
                    <span class="errors">{{ $errors->first('email') }}</span>
                    {!! Form::text('email', null, array('class' => 'form-control')) !!}                     
                </div>
                
                <div class="form-group">                   
                    {!! Form::label('comment', 'Comment : ') !!}                    
                    <br />
                    <span class="errors">{{ $errors->first('comment') }}</span>
                    {!! Form::textarea('comment',null,array('id'=>'comment')) !!}
                </div>
                <script type="text/javascript">
                    CKEDITOR.replace( 'comment' );
                </script>
                
                <div>
                    {!! Form::submit('Send', array('class' => 'btn btn-primary')) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
        $('#flash-overlay-modal').modal();
    </script>

@stop
