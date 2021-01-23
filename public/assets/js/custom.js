$(document).ready(function() {
    $("[data-type='delete_user']").click(function() {
        swal({
            title: "Are you sure?",
            text: "Once Delete, You will not get back this log in future!",
            icon: "warning",
            buttons: !0,
            dangerMode: !0
        }).then(t => {
            if (t) {
                var o = $(this).data("url");
                console.log(o, csrf_token);
                $.get(o).done(t => {
                    location.reload();
                }).fail(function(e, t, n) {
                    show_toast("error", "Network or Database Error."), _log(e, t, n)
                })
            }
        })
    });

    //admin jurisdition.blade.php edit modal
    $(".editJurisdiction").click(function() {
        $("[name='juris_name']").val($(this).data('juris'));
        $("[name='juris_id']").val($(this).data('id'));
    });

    $("[data-target='#editArticle']").on("click", function(){
        $name = $(this).data('selector');
        $('#textEditHide').val($name);
        $val = $('#'+ $name).val();
        if ( $val=='null'){
            $val= "";
            $("#articleAll").show();
            $("#type").val('create');
        } else{
            $("#articleAll").hide();
            $("#type").val('update');
        }
        $('#textEdit').trumbowyg('html', $val);
    });

    // $("[data-target='#addArticle']").on("click", function(){
    //     $name = $(this).data('selector');
    //     $('#textEditHide').val($name);
    //     $('#textEdit').trumbowyg('html', $('#'+ $name).val());
    // });
})