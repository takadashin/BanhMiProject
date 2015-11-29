/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function checklike(userid,followid) {
if (confirm("You want to follow this chef of "+userid+" ?")) {
    
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "getfollow",
        type: 'POST',
        data: {userid:userid},
        dataType: 'JSON',
        success: function (data) {
            alert("Ok");
        },
         error: function(data){
        // Error...
        var errors = data.responseJSON;

        alert(errors);

        
    }
    });
    $( "#followbutton" ).addClass("active" );
  }
}