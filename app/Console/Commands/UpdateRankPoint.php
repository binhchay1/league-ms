<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Repositories\LeagueRepository;
use App\Repositories\RankRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Console\Command;

class UpdateRankPoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranking:update';
    private $rankRepository;
    private $scheduleRepository;
    private $leagueRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update place of rankings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        RankRepository $rankRepository,
        ScheduleRepository $scheduleRepository,
        LeagueRepository $leagueRepository
    )
    {
        $this->rankRepository = $rankRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->leagueRepository = $leagueRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Bước 1: Reset toàn bộ bảng rank về trạng thái ban đầu
        $ranks = $this->rankRepository->getAll(); // bạn có thể thêm filter theo giải nếu muốn
        foreach ($ranks as $rank) {
            $this->rankRepository->updateById($rank->id, [
                'match_played' => 0,
                'win' => 0,
                'lose' => 0,
                'point' => 0,
                'eliminated_round' => null,
            ]);
        }
        $getSchedule = Schedule::whereNotNull('result_team_1')
            ->whereNotNull('result_team_2')
            ->get();
        foreach ($getSchedule as $schedule) {
            $team1Score = $schedule->result_team_1;
            $team2Score = $schedule->result_team_2;
            if ($team1Score === null || $team2Score === null) {
                continue; // Bỏ qua trận chưa có kết quả
            }
            // 1. Xác định winner team
            if ($team1Score > $team2Score) {
                $winnerTeamId = $schedule->player1_team_1;
                $loserTeamId = $schedule->player1_team_2;
            } elseif ($team1Score < $team2Score) {
                $winnerTeamId = $schedule->player1_team_2;
                $loserTeamId = $schedule->player1_team_1;
            } else {
                // Nếu hòa, không set winner_team_id
                $winnerTeamId = null;
                $loserTeamId = null;
            }

            // 2. Cập nhật winner_team_id vào schedule
            if ($winnerTeamId) {
                $this->scheduleRepository->updateById($schedule->id, [
                    'winner_team_id' => $winnerTeamId
                ]);
            }
            // 3. Cập nhật bảng ranks
            if ($schedule->league?->format_of_league === 'round-robin') {
                // Lấy điểm kết quả trận
                $team1Score = $schedule->result_team_1;
                $team2Score = $schedule->result_team_2;

                // Lấy rank cho 2 đội
                $team1Rank = $this->rankRepository->getByLeagueAndTeam($schedule->league_id, $schedule->player1_team_1);
                $team2Rank = $this->rankRepository->getByLeagueAndTeam($schedule->league_id, $schedule->player1_team_2);

                // Tạo mới nếu chưa có
                if (!$team1Rank) {
                    $team1Rank = $this->rankRepository->create([
                        'league_id' => $schedule->league_id,
                        'team_id' => $schedule->player1_team_1,
                        'match_played' => 0,
                        'win' => 0,
                        'lose' => 0,
                        'point' => 0,
                    ]);
                }

                if (!$team2Rank) {
                    $team2Rank = $this->rankRepository->create([
                        'league_id' => $schedule->league_id,
                        'team_id' => $schedule->player1_team_2,
                        'match_played' => 0,
                        'win' => 0,
                        'lose' => 0,
                        'point' => 0,
                    ]);
                }

                // Cập nhật số trận đã chơi
                $team1Rank->match_played += 1;
                $team2Rank->match_played += 1;

                // So sánh kết quả để cộng điểm
                if ($team1Score > $team2Score) {
                    $team1Rank->win += 1;
                    $team1Rank->point += 3;

                    $team2Rank->lose += 1;
                } elseif ($team2Score > $team1Score) {
                    $team2Rank->win += 1;
                    $team2Rank->point += 3;

                    $team1Rank->lose += 1;
                }

                // Lưu lại
                $team1Rank->save();
                $team2Rank->save();
            } else {
                // Knockout: cập nhật kết quả trận và loại đội thua
                $isFinal = $schedule->round === 'final';
                // Cập nhật team thắng
                $winnerRank = $this->rankRepository->getByLeagueAndTeam($schedule->league_id, $winnerTeamId);

                if (!$winnerRank) {
                    $winnerRank = $this->rankRepository->create([
                        'league_id' => $schedule->league_id,
                        'team_id' => $winnerTeamId,
                        'match_played' => 1,
                        'win' => 1,
                        'lose' => 0,
                        'point' => 0,
                        'eliminated_round' => $isFinal ? 'champion' : null,
                    ]);
                } else {
                    $winnerRank->match_played += 1;
                    $winnerRank->win += 1;

                    // Nếu đây là trận chung kết thì set champion
                    if ($isFinal) {
                        $winnerRank->eliminated_round = 'champion';
                    }

                    $winnerRank->save();
                }

// Cập nhật team thua
                $loserRank = $this->rankRepository->getByLeagueAndTeam($schedule->league_id, $loserTeamId);

                if (!$loserRank) {
                    $loserRank = $this->rankRepository->create([
                        'league_id' => $schedule->league_id,
                        'team_id' => $loserTeamId,
                        'match_played' => 1,
                        'win' => 0,
                        'lose' => 1,
                        'point' => 0,
                        'eliminated_round' => $schedule->round,
                    ]);
                } else {
                    $loserRank->match_played += 1;
                    $loserRank->lose += 1;
                    $loserRank->eliminated_round = $schedule->round;
                    $loserRank->save();
                }

            }
        }
        // 4. Cập nhật vị trí xếp hạng cho giải vòng tròn
        $leagues = $this->leagueRepository->getAllRoundRobinLeagues(); // bạn có thể lọc theo ngày nếu muốn
        foreach ($leagues as $league) {
            $listRanking = $this->rankRepository->getRankingByLeague($league->id);
            $sorted = $listRanking->sortByDesc('point')->sortByDesc('win');

            $place = 1;
            foreach ($sorted as $rank) {
                $this->rankRepository->updateById($rank->id, [
                    'places_old' => $rank->places,
                    'places' => $place
                ]);
                $place++;
            }
        }

        dump('✅ Updated results and rankings successfully.');
    }

}
