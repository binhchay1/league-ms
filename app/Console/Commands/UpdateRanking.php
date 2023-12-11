<?php

namespace App\Console\Commands;

use App\Enums\Ranking;
use App\Repositories\RankingRepository;
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
    public function __construct(RankingRepository $rankingRepository)
    {
        $this->rankingRepository = $rankingRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $listType = Ranking::RANKING_ARRAY_TYPE;
        foreach ($listType as $type) {
            $ranking = $this->rankingRepository->getRankingByTypeForUpdatePlaces($type);
            $places = 1;
            foreach ($ranking as $record) {
                $data = [
                    'places' => $places,
                    'places_old' => $record->places
                ];

                $places++;

                $this->rankingRepository->updateById($record->id, $data);
            }
        }

        dump('--------------- Updated places of ranking ---------------');
    }
}
