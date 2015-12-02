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

//THis is a test. DO now Warning