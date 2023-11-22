$(function () {
    countUp();
});

function countUp() {
    var options = {
        useEasing: true,
        useGrouping: true,
        separator: '.',
        decimal: ','
    };

    let total_player = '<?php echo $totalUser ?>';
    let total_league = '<?php echo $totalLeague ?>';
    let total_team = '<?php echo $totalTeam ?>';
    let total_view = '<?php echo $totalView ?>';

    var demo1 = new CountUp('total_league', 0, total_league, 0, 3, options);
    var demo2 = new CountUp('total_team', 0, total_team, 0, 3, options);
    var demo3 = new CountUp('total_player', 0, total_player, 0, 3, options);
    var demo4 = new CountUp('total_view', 0, total_view, 0, 3, options);
    !demo1.error ? demo1.start() : console.error(demo1.error);
    !demo2.error ? demo2.start() : console.error(demo2.error);
    !demo3.error ? demo3.start() : console.error(demo3.error);
    !demo4.error ? demo4.start() : console.error(demo4.error);
}
