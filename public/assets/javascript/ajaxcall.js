$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});
function deleteingre(rid,gid,url) {
    if(confirm("Do you want to delete this row?"))
    {
    $("#gridingre").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/deleteingre/", {recipeid: rid,ingreid: gid}).done(function (data) {
        $("#gridingre").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
function editingre(rid,gid,url) {
    if(confirm("Do you want to save this row?"))
    {
       
        var getdetail = $("#textboxdetail_"+gid).val();
    $("#gridingre").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/editingre/", {recipeid: rid,ingreid: gid,detail:getdetail}).done(function (data) {
        $("#gridingre").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
////////////////////////////////////
function deletestep(rid,sid,url) {
    if(confirm("Do you want to delete this row?"))
    {
    $("#gridstep").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/deletestep/", {recipeid: rid,stepid: sid}).done(function (data) {
        $("#gridstep").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
function editstep(rid,sid,url) {
    if(confirm("Do you want to save this row?"))
    {
       
        var getdetail = $("#txtcontent_"+sid).val();
    $("#gridstep").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/editstep/", {recipeid: rid,stepid: sid,detail:getdetail}).done(function (data) {
        $("#gridstep").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
////////////////////////////////////
////////////////////////////////////
function deletecomment(rid,cid,url) {
    if(confirm("Do you want to delete this row?"))
    {
    $("#gridcomment").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/deletecomment/", {recipeid: rid,commentid: cid}).done(function (data) {
        $("#gridcomment").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
function editcomment(rid,cid,url) {
    if(confirm("Do you want to save this row?"))
    {
       
        var getdetail = $("#txtcomment_"+cid).val();
    $("#gridcomment").html("Please wait for loading data");
    $.post(url+"/admin/editdetailrecipe/editcomment/", {recipeid: rid,commentid: cid,detail:getdetail}).done(function (data) {
        $("#gridcomment").html(data);
        alert("success");
    }).fail(function() {
                alert( "error" );
    });
}
}
////////////////////////////////////

function addingre(rid,url) {
    if(confirm("Do you want to create this row?"))
    {
        var gid = $('[name="ddl_ingrename"]').val();
        var getdetail = $('[name="txt_ingre_detail"]').val();
       
        $("#gridingre").html("Please wait for loading data");
        $.post(url+"/admin/editdetailrecipe/addingre/", {recipeid: rid,ingreid: gid,detail:getdetail}).done(function (data) {
            $("#gridingre").html(data);
            alert("success");
        }).fail(function() {
                    alert( "error" );
        });
}
}
    
    $(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){

        readURL(this);
    });
});
    
//THis is a test. DO now Warning