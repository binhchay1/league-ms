<?php

namespace App\Enums;

final class Title
{
    const PLAYER = 'player';
    const COACH = 'coach';
    const ADMIN = 'admin';
    const USER = 'user';
    const GROUP_MEMBER = 'group member';
    const GROUP_LEADER = 'group leader';
    const REFEREE = 'referee';
    const LIST_TITLE = [
        'player', 'coach', 'admin', 'user', 'group member', 'group leader', 'referee'
    ];
}
