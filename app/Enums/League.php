<?php

namespace App\Enums;

final class League
{
    const ROUND_LEAGUE = [
        'round 1', 'round 2', 'quarter-finals', 'semi-finals', 'final'
    ];

    const ROUND_PER_LEAGUE = [
        'round 1' => ['round 1', 'round 2', 'quarter-finals', 'semi-finals', 'final'],
        'round 2' => ['round 2', 'quarter-finals', 'semi-finals', 'final'],
        'quarter-finals' => ['quarter-finals', 'semi-finals', 'final'],
        'semi-finals' => ['semi-finals', 'final']
    ];

    const NUMBER_PLAYER = [
        '4', '8', '16', '32',
    ];
}
