$(document).ready(function () {

    let currentScoreP1T1 = parseInt($('#score-player-1-team-1').html());
    let currentScoreP2T1 = parseInt($('#score-player-2-team-1').html());
    let currentScoreP1T2 = parseInt($('#score-player-1-team-2').html());
    let currentScoreP2T2 = parseInt($('#score-player-2-team-2').html());

    if (currentScoreP1T1 == 0) {
        $('#deduct-score-team-1-1').attr("disabled", true);
    }

    if (currentScoreP2T1 == 0) {
        $('#deduct-score-team-1-2').attr("disabled", true);
    }

    if (currentScoreP1T2 == 0) {
        $('#deduct-score-team-2-1').attr("disabled", true);
    }

    if (currentScoreP2T2 == 0) {
        $('#deduct-score-team-2-2').attr("disabled", true);
    }

    $("#add-score-team-1-1").click(function () {
        handleScore('team-1-1', 'add');
    });

    $("#deduct-score-team-1-1").click(function () {
        handleScore('team-1-1', 'deduct');
    });

    $("#add-score-team-1-2").click(function () {
        handleScore('team-1-2', 'add');
    });

    $("#deduct-score-team-1-2").click(function () {
        handleScore('team-1-2', 'deduct');
    });

    $("#add-score-team-2-1").click(function () {
        handleScore('team-2-1', 'add');
    });

    $("#deduct-score-team-2-1").click(function () {
        handleScore('team-2-1', 'deduct');
    });

    $("#add-score-team-2-2").click(function () {
        handleScore('team-2-2', 'add');
    });

    $("#deduct-score-team-2-2").click(function () {
        handleScore('team-2-2', 'deduct');
    });
});

function handleScore(teamParam, status) {
    let split = teamParam.split('-');
    let team = split[0] + '-' + split[1];
    let idScore = '#score-' + team;
    let idScorePlayer = '#score-player-' + split[2] + '-team-' + split[1];
    let player = split[2];
    let idDeduct = '#deduct-score-' + teamParam;
    let last_score = parseInt($(idScore).html());
    let last_score_player = parseInt($(idScorePlayer).html());
    let otherScore = 0;
    let set = $('#number-set').html();

    if (status == 'add') {
        $(idDeduct).attr("disabled", false);
        new_score = last_score + 1;
        new_score_player = last_score_player + 1;
        if (new_score == 21) {
            if (team == 'team-1') {
                otherScore = parseInt($('#score-team-2').html());
            } else {
                otherScore = parseInt($('#score-team-1').html());
            }

            if ((new_score - otherScore) >= 2) {
                handleGameRound(team, new_score, new_score_player, player);

                return;
            }
        }

        if (new_score == 30) {
            handleGameRound(team, new_score, new_score_player, player);

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
            handleGameRound(team, new_score, new_score_player, player);

            return;
        }
    }

    $(idScore).html(new_score);
    $(idScorePlayer).html(new_score_player);

    saveScore(new_score, team, set, '', new_score_player, player);
}

function handleGameRound(team, new_score, new_score_player, player) {
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
    $('#score-player-1-team-1').html(0);
    $('#score-player-2-team-1').html(0);
    $('#score-player-1-team-2').html(0);
    $('#score-player-2-team-2').html(0);
    $('#deduct-score-team-1-1').attr("disabled", true);
    $('#deduct-score-team-1-2').attr("disabled", true);
    $('#deduct-score-team-2-1').attr("disabled", true);
    $('#deduct-score-team-2-2').attr("disabled", true);
    $(nextSquare).css('background-color', 'gray');
    saveScore(new_score, team, set, 'end', new_score_player, player);

    if (nextSquare == squareT2) {
        $('#area-button-score-1-1').empty();
        $('#area-button-score-1-2').empty();
        $('#area-button-score-2-1').empty();
        $('#area-button-score-2-2').empty();
        $('#score-player-1-team-1').empty();
        $('#score-player-2-team-1').empty();
        $('#score-player-1-team-2').empty();
        $('#score-player-2-team-2').empty();
        $('#score-team-1').empty();
        $('#score-team-2').empty();
        $('#text-set').empty();
        $('#text-set').html('End game');
    }

    notiModal.show();
}

function saveScore(score, team, set, result = '', new_score_player, player) {
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
            new_score_player: new_score_player,
            player: player,
            type: 'doubles'
        }
    });
}
