<?php

namespace App\Console\Commands;

use App\Mail\PreLeagueMail;
use App\Repositories\LeagueRepository;
use Illuminate\Console\Command;

class SendMailPreLeague extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pre-league';
    private $leagueRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail for pre-league';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LeagueRepository $leagueRepository)
    {
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
        $now = date('Y-m-d');
        $league = $this->leagueRepository->getLeagueForPre($now);

        foreach ($league as $record) {
            if ((strtotime($record->start_date) - strtotime($now)) == 86400) {
                $dataEmail = [
                    'user_name' => $record->userLeague->name,
                    'league_name' => $record->name,
                    'league_start_date' => $record->start_date,
                    'schedule' => $record->schedule
                ];
                $preLeagueEmail = new PreLeagueMail($dataEmail);
                SendMail::dispatch($record->userLeague->email, $preLeagueEmail)->onQueue('send_email_pre_league');
            }
        }
    }
}
