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


//other League
$(function () {
    otherLeague();
})

function otherLeague() {
    $("[name='record']").on("change", function (e) {
        let edit_id = $(this).val();
        window.location.href = window.location.origin + '/info/' + edit_id;
    });
}

//active

$('#check').change(function () {
    $('#open-tab1').prop("disabled", !this.checked);

});

$("#open-tab1").on('click', function () {
    $('.leagueInfo').toggle('hide')
    $('.infor').toggle('show')
    $('#check').prop('checked', false);

})

