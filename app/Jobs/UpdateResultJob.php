<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $s_i;
    protected $type;
    protected $score;
    protected $set;
    protected $scheduleRepository;
    protected $resultRepository;
    protected $new_score_player;
    protected $requestPlayer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($s_i, $type, $score, $set, $scheduleRepository, $resultRepository, $new_score_player, $requestPlayer)
    {
        $this->s_i = $s_i;
        $this->type = $type;
        $this->score = $score;
        $this->set = $set;
        $this->scheduleRepository = $scheduleRepository;
        $this->resultRepository = $resultRepository;
        $this->new_score_player = $new_score_player;
        $this->requestPlayer = $requestPlayer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $getSchedule = $this->scheduleRepository->getScheduleById($this->s_i);
            $getResult = $this->resultRepository->getResultByScheduleId($getSchedule->id);
            if ($this->type == 'singles') {
                if ($currentTeam[1] == '1') {
                    $currentPlay = 1;
                } else {
                    $currentPlay = 3;
                }
            } else {
                $this->score = $this->new_score_player;
                $numberPlayer = $this->requestPlayer;
                $currentPlay = $numberPlayer;
            }

            $player = 'player_' . $currentPlay;
            if (empty($getResult)) {
                $dataResult = [
                    'schedule_id' => $getSchedule->id,
                    'result_round_1' => json_encode([
                        $player => [
                            'column_1' => 1
                        ]
                    ]),
                    'column' => 1
                ];

                $this->resultRepository->create($dataResult);
            } else {
                $resultCurrent = 'result_round_' . $this->set;
                $dataGetResult = json_decode($getResult->$resultCurrent);
                $currentColumn = $getResult->column;
                $nextColumn = $currentColumn + 1;
                $strNextColumn = 'column_' . $nextColumn;
                if (isset($dataGetResult->$player)) {
                    $dataPlayer = (array) $dataGetResult->$player;
                    $dataNext = [
                        $strNextColumn => $this->score
                    ];
                    $totalResult = array_merge($dataPlayer, $dataNext);

                    $dataUpdateResult = [
                        $resultCurrent => json_encode([
                            $player => $totalResult
                        ]),
                        'column' => $nextColumn
                    ];
                } else {
                    $dataGetResultNew = (array) $dataGetResult;
                    $dataGetResultNew[$player] = (object) [
                        $strNextColumn => $this->score
                    ];

                    $dataUpdateResult[$resultCurrent] = $dataGetResultNew;
                    foreach ($dataUpdateResult[$resultCurrent] as $key => $value) {
                        $dataUpdateResult[$resultCurrent][$key] = json_encode($value);
                    }
                    $dataUpdateResult['column'] = $nextColumn;
                }

                $this->resultRepository->updateResult($this->s_i, $dataUpdateResult);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
