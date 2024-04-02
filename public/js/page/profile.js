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

navigator.getUserMedia =
    navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia(
        { audio: true, video: { width: 1280, height: 720 } },
        (stream) => {
            const video = document.querySelector("video");
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
                video.play();
            };
        },
        (err) => {
            console.error(`The following error occurred: ${err.name}`);
        },
    );
} else {
    console.log("getUserMedia not supported");
}
