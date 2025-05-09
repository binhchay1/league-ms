<?php

namespace App\Jobs;

use App\Repositories\ScheduleRepository;
use App\Repositories\ResultRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
     */
    public function __construct(
        $s_i,
        $type,
        $score,
        $set,
        ScheduleRepository $scheduleRepository,
        ResultRepository $resultRepository,
        $new_score_player,
        $requestPlayer
    ) {
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
     */
    public function handle()
    {
        try {
            $getSchedule = $this->scheduleRepository->getScheduleById($this->s_i);
            $getResult = $this->resultRepository->getResultByScheduleId($getSchedule->id);

            // Xác định player hiện tại
            $currentTeam = explode('-', $this->score);
            $currentPlay = ($currentTeam[1] === '1') ? 1 : 3;

            $player = 'player_' . $currentPlay;
            $resultCurrent = 'result_round_' . $this->set;

            if (empty($getResult)) {
                // Chưa có kết quả nào => tạo mới
                $dataResult = [
                    'schedule_id' => $getSchedule->id,
                    $resultCurrent => json_encode([
                        $player => ['column_1' => $this->score]
                    ]),
                    'column' => 1
                ];

                $this->resultRepository->create($dataResult);
            } else {
                // Đã có kết quả => cập nhật tiếp
                $dataGetResult = json_decode($getResult->$resultCurrent ?? '{}');
                $currentColumn = $getResult->column ?? 0;
                $nextColumn = $currentColumn + 1;
                $strNextColumn = 'column_' . $nextColumn;

                if (isset($dataGetResult->$player)) {
                    $dataPlayer = (array) $dataGetResult->$player;
                    $dataNext = [$strNextColumn => $this->score];
                    $totalResult = array_merge($dataPlayer, $dataNext);

                    $dataUpdateResult = [
                        $resultCurrent => json_encode([
                            $player => $totalResult
                        ]),
                        'column' => $nextColumn
                    ];
                } else {
                    $dataGetResultNew = (array) $dataGetResult;
                    $dataGetResultNew[$player] = (object) [$strNextColumn => $this->score];

                    // Convert từng player về JSON string (giống format ban đầu)
                    $dataUpdateResult[$resultCurrent] = [];
                    foreach ($dataGetResultNew as $key => $value) {
                        $dataUpdateResult[$resultCurrent][$key] = $value;
                    }

                    $dataUpdateResult[$resultCurrent] = json_encode($dataUpdateResult[$resultCurrent]);
                    $dataUpdateResult['column'] = $nextColumn;
                }

                $this->resultRepository->updateResult($this->s_i, $dataUpdateResult);
            }

            Log::info('UpdateResultJob hoàn thành', ['schedule_id' => $this->s_i]);

        } catch (\Exception $e) {
            Log::error('Lỗi trong UpdateResultJob: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
