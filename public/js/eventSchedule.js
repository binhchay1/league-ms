//create function (eventDeleteAdmin)
$(function () {
    eventDeleteAdmin();
});

function eventDeleteAdmin()
{
    // show modal and check admin (button, id, tr)
    $(document).on('click', '.btn_delete', function() {
        $('#ModalCreate').modal('show');
    });

}
