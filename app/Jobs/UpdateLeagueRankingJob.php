<?php

namespace App\Jobs;

use App\Models\League;
use App\Models\Rank;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateLeagueRankingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduleId;

    /**
     * Create a new job instance.
     */
    public function __construct($scheduleId)
    {
        $this->scheduleId = $scheduleId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $schedule = Schedule::with('league')->find($this->scheduleId);
        if (!$schedule || !$schedule->league) return;

        $league = $schedule->league;
        $team1 = $schedule->team_1_id;
        $team2 = $schedule->team_2_id;
        $score1 = $schedule->result_team_1;
        $score2 = $schedule->result_team_2;

        // Ensure both scores are available
        if (is_null($score1) || is_null($score2)) return;

        // Handle Round Robin
        if ($league->type === 'round_robin') {
            // Find or create rank rows for both teams
            $rank1 = Rank::firstOrCreate([
                'league_id' => $league->id,
                'team_id' => $team1,
            ]);

            $rank2 = Rank::firstOrCreate([
                'league_id' => $league->id,
                'team_id' => $team2,
            ]);

            // Prevent duplicate update by checking if this match was already counted
            if (!$schedule->rank_updated) {
                $rank1->match_played += 1;
                $rank2->match_played += 1;

                if ($score1 > $score2) {
                    $rank1->win += 1;
                    $rank1->point += 3;
                    $rank2->lose += 1;
                } else {
                    $rank2->win += 1;
                    $rank2->point += 3;
                    $rank1->lose += 1;
                }

                $rank1->save();
                $rank2->save();

                $schedule->rank_updated = true;
                $schedule->save();
            }
        }

        // Handle Knockout
        if ($league->type === 'knockout') {
            $loserTeamId = null;
            $round = $schedule->round_name ?? 'Unknown';

            if ($score1 > $score2) {
                $loserTeamId = $team2;
            } elseif ($score2 > $score1) {
                $loserTeamId = $team1;
            }

            if ($loserTeamId) {
                $rank = Rank::firstOrCreate([
                    'league_id' => $league->id,
                    'team_id' => $loserTeamId,
                ]);
                $rank->eliminated_round = $round;
                $rank->save();
            }
        }
    }
}
