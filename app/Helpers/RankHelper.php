<?php

use App\Models\Ranks;

if (!function_exists('getLeagueRankingInfo')) {
    function getLeagueRankingInfo($leagueInfor, $hasEnded = false)
    {
        $ranking = collect();
        $topRank = null;
        $bottomRank = null;
        $champion = null;

        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

            if ($hasEnded) {
                $champion = $topRank;
            }
        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                'champion' => 0, // cao nhất
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
                null => 999, // dự phòng cho dữ liệu thiếu
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(function ($r) use ($priority) {
                    $roundPriority = $r->eliminated_round === null ? -1 : ($priority[$r->eliminated_round] ?? 999);
                    return [$roundPriority, $r->win]; // ✅ sắp theo round trước, win sau (tăng dần)
                })
                ->values(); // reindex lại collection
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

            if ($hasEnded) {
                $champion = $ranking->firstWhere('eliminated_round', 'champion');
            }

        }
        return compact('ranking', 'topRank', 'bottomRank', 'champion');
    }
}
