$(function () {
    loadImage();
});
function loadImage() {
    $(document).on('click', '#btn_chooseImg', function () {
        $('#image').click();
    });

    $('#image').change(function() {
        readURL(this);
    });
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
