<?php

function getRoundNameByLevel($totalRound, $currentLevel) {
    $map = [
        1 => 'final',
        2 => 'semi-finals',
        3 => 'quarter-finals',
        4 => 'round of 16',
        5 => 'round of 32',
        6 => 'round of 64',
        7 => 'round of 128',
        8 => 'round of 256',
        // mở rộng nếu cần
    ];

    $level = $totalRound - $currentLevel + 1;

    return $map[$level] ?? "round $level";
}
