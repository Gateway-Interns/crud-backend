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

        return $user->id === $notification->id ? Response::allow() : Response::deny('notificaiton doesnt bleong to you'.  $notification->id);
    }
}
