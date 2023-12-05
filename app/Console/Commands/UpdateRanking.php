<?php

namespace App\Console\Commands;

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
    protected $description = 'Command description';

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
        $ranking = $this->rankingRepository->getRankingByTypeForUpdatePlaces();

        dd($ranking);
    }
}
