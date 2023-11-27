<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:report-analysis-real-time-google';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store analysis real time google report';
    protected $properties = '364260330';
    protected $urlAuth = 'https://accounts.google.com/o/oauth2/v2/auth';
    protected $scope = 'https://www.googleapis.com/auth/analytics';
    protected $client_id = '721393104634-tg647fgut8op86ndtme6vglmpaet0cht.apps.googleusercontent.com';
    protected $redirect_uri = 'https://onesignal.modobomco.com/admin/report-analysis-google';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->googleAuth();
        dump('Done');
        exit;
    }

    public function googleAuth()
    {
        $params = [
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'token',
            'scope' => $this->scope,
            'include_granted_scopes' => 'true'
        ];

        $response = Http::post($this->urlAuth, $params);
        dd($response);
    }

    public function getAnalytics()
    {
        $urlAnalytics = 'https://analyticsdata.googleapis.com/v1beta/properties/' + $properties + ':runRealtimeReport';
    }
}
