<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <link href="{{ asset("assets/css/admin.css") }}" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}"> 
    </head>
    <body>
        <div class="login_box">
            <div style="position: relative;">
                <img src="{{ asset('assets/images/logo.png') }}" style="position: absolute; margin-left: -225px;" >
                <div style="padding:55px;background: #B0B8D4;">
                     <div class="login-admin-error-msg">{{ Session::get('login_error') }} </div>
                    {!! Form::open(['url' => 'admin/loginStore']) !!}
                        <table cellspacing="10px">
                            <tr>
                                <td>User Name</td>
                                <td>:</td>
                                <td> {!! Form::text('username',null,array('class' => 'login_text')) !!} </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td>{!! Form::password('password',array('class' => 'login_text')) !!} </td>
                            </tr>
                        </table>
                        {!! Form::submit('Log In',array('class' => 'submitbutton')) !!}
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </body>
</html>
