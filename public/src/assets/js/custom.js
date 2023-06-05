/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

function selectImage(id){
  
    var old_selected_id=$("#selected_id").val();
    $("#selection_"+old_selected_id).removeClass('selectedImage');
    $("#selection_"+id).addClass('selectedImage');
    var newpath=$(`#selection_path_${id}`).val();
    $("#selected_id").val(id);
    $("#selected_path").val(newpath);

}
function discardImage(){
    var old_selected_id=$("#selected_id").val();
    $("#selection_"+old_selected_id).removeClass('selectedImage');
    $("#selected_path").val();
    $("#selected_id").val();
    $("#attachment_path").val();
}
function doneImage(){
    
    var selected_path=$("#selected_path").val();
    $("#attachment_path").val(selected_path);

}