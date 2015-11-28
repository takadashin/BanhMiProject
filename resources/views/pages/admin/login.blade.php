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
                    <table>
                        <tr>
                            <td>User Name</td>
                            <td>:</td>
                            <td><input class="login_text" type="text" name="username" /> </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input class="login_text" type="password" name="username" /> </td>
                        </tr>
                    </table>
                    <input type="submit" class="submitbutton" name="btn_submit" value="Log in" />
                </div>
            </div>
        </div>
    </body>
</html>
