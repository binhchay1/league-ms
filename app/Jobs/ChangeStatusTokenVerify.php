<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeStatusTokenVerify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $verifyUserRepository;
    private $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($verifyUserRepository, $token)
    {
        $this->verifyUserRepository = $verifyUserRepository;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getToken = $this->verifyUserRepository->getVerifyByToken($this->token);
        if (!empty($getToken)) {
            if ($getToken->status == 0) {
                $this->verifyUserRepository->updateStatusByToken($this->token);
            }
        }
    }
}
