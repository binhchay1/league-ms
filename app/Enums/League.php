<?php

namespace App\Enums;

final class League
{
    const ROUND_LEAGUE = [
        'round 1', 'round 2', 'quarter-finals', 'semi-finals', 'final'
    ];

    const TOTAL_COUNT_LEAGUE = [
        '1' => '4',
        '2' => '8',
        '3' => '16',
        '4' => '32',
        '5' => '64',
    ];

    const LIST_RATE = [
        1 => [2],
        2 => [2, 4],
        3 => [2, 4, 8],
        4 => [2, 4, 8, 16],
        5 => [2, 4, 8, 16, 32]
    ];
}
