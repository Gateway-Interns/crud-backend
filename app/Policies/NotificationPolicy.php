<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function check(User $user, Notification $notification): Response
    {
       // $notificationData = $notification->data;
        $notificationData = json_decode($notification->data, true);
        return $user->id === $notificationData['id'] ? Response::allow() : Response::deny('notificaiton doesnt bleong to you' .   $notificationData['id']);
    }
}
