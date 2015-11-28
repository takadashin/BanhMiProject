<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CMS Admin</title>
        <link href="{{ asset("assets/css/main.css") }}" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}"> 
    </head>
    <body>
        <div>
            <div id="control_panel">
                <div id="user_stat">
                    <table>
                    <tr>
                        <td><span>User Name:</span> </td>
                    <td><p>Admin</p></td>
                    </tr>
                    <tr>
                    <td><span>Last Session:</span> </td>
                    <td><p>2015-10-16 10:15 A.M</p></td>
                    </tr>
                    <tr>
                    <td><span>Last Activity:</span> </td>
                    <td><p>Edit Post #2789</p></td>
                    </tr>
                    </table>
                </div>
                <div id="control_box">
                    <ul>
                        <li class="active"><a>Recipe Post</a></li>
                        <li><a>User</a></li>
                        <li><a>Comment</a></li>
                        <li><a>Logo</a></li>
                        
                    </ul>
                </div>
            </div>
            <div id="main_panel" >
                <div class="header_title"><h2>Recently Post</h2></div>
                <table class="Datagrid" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Title</th>
                        <th>Last edited</th>
                        <th>User Post</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    <tr>
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                        <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                    <tr class="even">
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                         <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                        <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                    <tr class="even">
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                         <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                         <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                    <tr class="even">
                        <td>Cookie French Made</td>
                        <td>2016-10-15 10:15 P.M</td>
                        <td>Maria</td>
                         <td><a href="Delete.php"><img src="../images/delete.png">Delete</a></td>
                        <td><a href="Edit.php"><img src="../images/edit.png">Edit</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
