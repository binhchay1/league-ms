$(document).ready(function () {

    let currentScoreT1 = parseInt($('#score-team-1').html());
    let currentScoreT2 = parseInt($('#score-team-2').html());

    if (currentScoreT1 == 0) {
        $('#deduct-score-team-1').attr("disabled", true);
    }

    if (currentScoreT2 == 0) {
        $('#deduct-score-team-2').attr("disabled", true);
    }

    $("#add-score-team-1").click(function () {
        handleScore('team-1', 'add');
    });

    $("#deduct-score-team-1").click(function () {
        handleScore('team-1', 'deduct');
    });

    $("#add-score-team-2").click(function () {
        handleScore('team-2', 'add');
    });

    $("#deduct-score-team-2").click(function () {
        handleScore('team-2', 'deduct');
    });
});

function handleScore(team, status) {
    let idScore = '#score-' + team;
    let idDeduct = '#deduct-score-' + team;
    let last_score = parseInt($(idScore).html());
    let otherScore = 0;
    let set = $('#number-set').html();

    if (status == 'add') {
        $(idDeduct).attr("disabled", false);
        new_score = last_score + 1;
        if (new_score == 21) {
            if (team == 'team-1') {
                otherScore = parseInt($('#score-team-2').html());
            } else {
                otherScore = parseInt($('#score-team-1').html());
            }

            if ((new_score - otherScore) >= 2) {
                handleGameRound(team, new_score);

                return;
            }
        }

        if (new_score == 30) {
            handleGameRound(team, new_score);

            return;
        }
    } else {
        if (last_score == 1) {
            $(idDeduct).attr("disabled", true);
        }
        new_score = last_score - 1;

        if (team == 'team-1') {
            otherScore = parseInt($('#score-team-2').html());
        } else {
            otherScore = parseInt($('#score-team-1').html());
        }

        if ((new_score - otherScore) >= 2) {
            handleGameRound(team, new_score);

            return;
        }
    }

    $(idScore).html(new_score);

    saveScore(new_score, team, set);
}

function handleGameRound(team, new_score) {
    const notiModal = new bootstrap.Modal(document.getElementById('noti-modal'), {
        keyboard: false,
        backdrop: 'static'
    });
    let set = $('#number-set').html();
    let nextSet = parseInt(set) + 1;
    let titleModal = 'Set ' + set;
    let contentModal = 'Team ';
    let split = team.split('-');
    let idTitle = '#noti-modal .modal-title';
    let idBody = '#noti-modal .modal-body span';
    let squareT1 = '#square-' + split[1] + '-' + '1';
    let squareT2 = '#square-' + split[1] + '-' + '2';
    let nextSquare = '';
    contentModal = contentModal + split[1];

    if (($(squareT1).css('background-color') == "rgb(128, 128, 128)")) {
        nextSquare = squareT2;
    } else {
        nextSquare = squareT1;
    }

    $(idTitle).html(titleModal);
    $(idBody).html(contentModal);
    $('#number-set').html(nextSet);
    $('#score-team-1').html(0);
    $('#score-team-2').html(0);
    $('#deduct-score-team-1').attr("disabled", true);
    $('#deduct-score-team-2').attr("disabled", true);
    $(nextSquare).css('background-color', 'gray');
    saveScore(new_score, team, set, 'end');

    if (nextSquare == squareT2) {
        $('#area-button-score-1').empty();
        $('#area-button-score-2').empty();
        $('#score-team-1').empty();
        $('#score-team-2').empty();
        $('#text-set').empty();
        $('#text-set').html('End game');
    }

    notiModal.show();
}

function saveScore(score, team, set, result = '') {
    let url = new URL(window.location);
    let params = new URLSearchParams(url.search);
    let s_i = params.get('s_i');
    $.ajax({
        url: '/store-score',
        type: 'GET',
        dataType: 'json',
        data: {
            score: score,
            team: team,
            set: set,
            s_i: s_i,
            result: result,
            type: 'singles'
        }
    });
}
