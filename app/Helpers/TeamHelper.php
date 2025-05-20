<?php

use App\Models\Ranks;

if (!function_exists('getTeamNameFromRank')) {
    function getTeamNameFromRank($rank) {
        $type = $rank->league->type_of_league ?? 'singles';
        $name1 = $rank->user?->name ?? '---';
        $name2 = $rank->user?->partner?->name ?? '';

        return $type === 'doubles' && $name2 ? "$name1 / $name2" : $name1;
    }
}

if (!function_exists('getTeamName')) {
    function getTeamName($rank) {
        $name1 = $rank->user?->name ?? '---';
        $type = $rank->league?->type_of_league ?? 'singles';

        if ($type === 'doubles') {
            $name2 = $rank->user?->partner?->name ?? '';
            return $name1 . ($name2 ? ' + ' . $name2 : '');
        }

        return $name1;
    }
}

if (!function_exists('getTeamNameFromUser')) {
    function getTeamNameFromUser($player, $type = 'singles') {
        $name1 = $player->user?->name ?? '---';
        $name2 = $player->partner?->name ?? '';

        return $type === 'doubles' && $name2 ? $name1 . ' + ' . $name2 : $name1;
    }
}


if (!function_exists('getFullNameWithPartner')) {
    function getFullNameWithPartner($registration, $type = 'singles') {
        $name1 = $registration->user?->name ?? '---';
        $name2 = $registration->partner?->name ?? '';

        return $type === 'doubles' && $name2 ? $name1 . ' + ' . $name2 : $name1;
    }
}

