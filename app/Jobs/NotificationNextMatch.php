<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class NotificationNextMatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $league_id;
    private $match;
    private $leagueRepository;
    private $scheduleRepository;
    private $notificationRepository;

    public function __construct($league_id, $match, $leagueRepository, $scheduleRepository, $notificationRepository)
    {
        $this->league_id = $league_id;
        $this->match = $match;
        $this->leagueRepository = $leagueRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getLeague = $this->leagueRepository->getById($this->league_id);
        $getNextSchedule = $this->scheduleRepository->getScheduleByLeagueAndMatch($this->league_id, $this->match);
        $content = __('Your match is about to take place. Your league is ') . $getLeague->name . '.' . __(' Starting at ') . $getNextSchedule->date . ' ' . $getNextSchedule->time;

        $dataNotification = [
            'content' => $content,
            'status' => 0,
            'league_id' => $this->league_id,
            'match' => $this->match
        ];

        if (!empty($getNextSchedule)) {
            if (!empty($getNextSchedule->player1Team1)) {
                $player1team1 = $getNextSchedule->player1Team1;
                $dataNotification['user_id'] = $player1team1->id;
                $getNotification = $this->notificationRepository->getNotificationByUserAndLeague($this->league_id, $dataNotification['user_id'], $this->match);
                if (empty($getNotification)) {
                    $this->notificationRepository->create($dataNotification);
                    $key = 'notification_next_match_' . $dataNotification['user_id'];
                    $getNotification = $this->notificationRepository->getNotificationByUser($dataNotification['user_id']);
                    Cache::set($key, $getNotification);
                }
            }

            if (!empty($getNextSchedule->player1Team2)) {
                $player1team2 = $getNextSchedule->player1Team2;
                $dataNotification['user_id'] = $player1team2->id;
                $getNotification = $this->notificationRepository->getNotificationByUserAndLeague($this->league_id, $dataNotification['user_id'], $this->match);
                if (empty($getNotification)) {
                    $this->notificationRepository->create($dataNotification);
                    $key = 'notification_next_match_' . $dataNotification['user_id'];
                    $getNotification = $this->notificationRepository->getNotificationByUser($dataNotification['user_id']);
                    Cache::set($key, $getNotification);
                }
            }

            if (!empty($getNextSchedule->player2Team1)) {
                $player2team1 = $getNextSchedule->player2Team1;
                $dataNotification['user_id'] = $player2team1->id;
                $getNotification = $this->notificationRepository->getNotificationByUserAndLeague($this->league_id, $dataNotification['user_id'], $this->match);
                if (empty($getNotification)) {
                    $this->notificationRepository->create($dataNotification);
                    $key = 'notification_next_match_' . $dataNotification['user_id'];
                    $getNotification = $this->notificationRepository->getNotificationByUser($dataNotification['user_id']);
                    Cache::set($key, $getNotification);
                }
            }

            if (!empty($getNextSchedule->player2Team2)) {
                $player2team2 = $getNextSchedule->player2Team2;
                $dataNotification['user_id'] = $player2team2->id;
                $getNotification = $this->notificationRepository->getNotificationByUserAndLeague($this->league_id, $dataNotification['user_id'], $this->match);
                if (empty($getNotification)) {
                    $this->notificationRepository->create($dataNotification);
                    $key = 'notification_next_match_' . $dataNotification['user_id'];
                    $getNotification = $this->notificationRepository->getNotificationByUser($dataNotification['user_id']);
                    Cache::set($key, $getNotification);
                }
            }
        }
    }
}
