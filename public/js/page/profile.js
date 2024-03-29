$(function () {
    loadImage();
});

function loadImage() {
    $(document).on('click', '#btn_chooseImg', function () {
        $('#profile_photo_path').click();
    });

    $('#profile_photo_path').change(function () {
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteAccount() {
    window.location.href = '/delete-account-apple/';
}
