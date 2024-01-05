<?php

namespace App\Http\Middleware;

use App\Repositories\NotificationRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CacheNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $key = 'notification_next_match_' . $user_id;
            $getCacheNotification = Cache::get($key);
            if (empty($getCacheNotification)) {
                $getNotification = $this->notificationRepository->getNotificationByUser($user_id);
                Cache::set($key, $getNotification);
            }
        }

        return $next($request);
    }
}
