$(document).ready(function () {
    $("#add-score-team-1").click(function () {
        this.handleScore();
    });

    $("#deduct-score-team-1").click(function () {
        this.handleScore();
    });

    $("#add-score-team-2").click(function () {
        this.handleScore();
    });

    $("#deduct-score-team-2").click(function () {
        this.handleScore();
    });
});

function handleScore(team, status) {
    let idScore = '#score-' + team;
    let idAdd = '#add-score-' + team;
    let idDeduct = '#deduct-score-' + team;

    let last_score = $(idScore).html();
    if (status == 'add') {
        if (parseInt(last_score) == 1) {
            $(idAdd).attr("disabled", true);
        }
        new_score = parseInt(last_score) + 1;
    } else {
        if (parseInt(last_score) == 1) {
            $(idDeduct).attr("disabled", true);
        }
        new_score = parseInt(last_score) - 1;
    }

    $(idScore).html(new_score);
}
