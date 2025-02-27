<?php

namespace App\Enums;

final class Group
{
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 2;

    const STATUS_PUBLIC = 'public';
    const STATUS_PRIVATE = 'private';

    const STATUS_REQUESTED = 'requested';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_WAITING = 'waiting';

    const RATE_ANCIENT = 'ancient';
    const RATE_EMERGING = 'emerging';
    const RATE_NEWLY_ESTABLISHED = 'newly established';

    const COLOR_OF_RATE = [
        'ancient' => 'ancient',
        'emerging' => 'emerging',
        'newly established' => 'newly'
    ];
}
