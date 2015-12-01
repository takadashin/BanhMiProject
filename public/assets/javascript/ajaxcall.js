$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});
function deletetesting(rid,gid,url) {
    alert("Delete call");
    $.post(url+"/admin/editdetailrecipe/deleteingre/", {recipeid: rid,ingreid: gid}).done(function (data) {
        alert("Delete success");
    }).fail(function() {
                alert( "error" );
    });;
}
