$(document).ready(function () {
    $("#add-score-team-1").click(function () {
        let last_score = $("#score-team-1").html();
        new_score = parseInt(last_score) + 1;
        $("#score-team-1").html(new_score);

    });

    $("#deduct-score-team-1").click(function () {
        let last_score = $("#score-team-1").html();
        new_score = parseInt(last_score) - 1;
        $("#score-team-1").html(new_score);
    });

    $("#add-score-team-2").click(function () {
        let last_score = $("#score-team-2").html();
        new_score = parseInt(last_score) + 1;
        $("#score-team-2").html(new_score);
    });

    $("#deduct-score-team-2").click(function () {
        let last_score = $("#score-team-2").html();
        new_score = parseInt(last_score) - 1;
        $("#score-team-2").html(new_score);
    });
});
