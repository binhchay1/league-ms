<?php

namespace App\Console\Commands;

use App\Enums\Ranking;
use App\Repositories\RankingRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Console\Command;

class UpdateRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranking:update-places';
    private $rankingRepository;
    private $scheduleRepository;

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
    public function __construct(RankingRepository $rankingRepository, ScheduleRepository $scheduleRepository)
    {
        $this->rankingRepository = $rankingRepository;
        $this->scheduleRepository = $scheduleRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $previousDate = date('Y-m-d', strtotime("-1 days"));
        $listRanking = $this->rankingRepository->getRankingOrderByPoint();
        $getSchedule = $this->scheduleRepository->getScheduleByDate($previousDate);
        $places = 1;

        foreach ($getSchedule as $schedule) {
            if ($schedule['result_team_1'] < $schedule['result_team_2']) {

                $data = [
                    'points' => 3
                ];

                if (!empty($schedule->player1Team2)) {
                    $this->rankingRepository->updatePointByUser($schedule->player1Team2['id'], $data);
                }

                if (!empty($schedule->player2Team2)) {
                    $this->rankingRepository->updatePointByUser($schedule->player2Team2['id'], $data);
                }
            }

            if ($schedule['result_team_1'] > $schedule['result_team_2']) {

                $data = [
                    'points' => 3
                ];

                if (!empty($schedule->player1Team1)) {
                    $this->rankingRepository->updatePointByUser($schedule->player1Team1['id'], $data);
                }

                if (!empty($schedule->player2Team1)) {
                    $this->rankingRepository->updatePointByUser($schedule->player2Team1['id'], $data);
                }
            }

            if ($schedule['result_team_1'] == $schedule['result_team_2']) {

                $data = [
                    'points' => 1
                ];

                if (!empty($schedule->player1Team1)) {
                    $this->rankingRepository->updatePointByUser($schedule->player1Team1['id'], $data);
                }

                if (!empty($schedule->player2Team1)) {
                    $this->rankingRepository->updatePointByUser($schedule->player2Team1['id'], $data);
                }

                if (!empty($schedule->player1Team2)) {
                    $this->rankingRepository->updatePointByUser($schedule->player1Team2['id'], $data);
                }

                if (!empty($schedule->player2Team2)) {
                    $this->rankingRepository->updatePointByUser($schedule->player2Team2['id'], $data);
                }
            }
        }

        foreach ($listRanking as $record) {
            $data = [
                'places' => $places,
                'places_old' => $record->places
            ];

            $places++;

            $this->rankingRepository->updateById($record->id, $data);
        }

        dump('--------------- Updated places of ranking ---------------');
    }
}
