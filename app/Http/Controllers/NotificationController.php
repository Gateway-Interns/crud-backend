<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Notifications\NewReleaseNotification;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function markAsRead(Notification $notification)
    {
        $response =  Gate::authorize('check', $notification);
        Auth::user()->markAllNotificationsAsRead($notification);
        return new NotificationResource(['message' => 'Notification mark as read.'], 401);
    }
    public function markAllAsRead()
    {
        Auth::user()->markAllNotificationsAsRead();
        return new NotificationResource(['message' => 'Notification mark all as read.'], 401);
    }


    public function markAsUnread(Notification $notification)
    {
        Gate::authorize('check', $notification);
        Auth::user()->markNotificationAsUnread($notification->id);
        return new NotificationResource(['message' => 'Notification mark all as unread.'], 401);
    }

    public function deleteNotification(Notification $notification)
    {
        Gate::authorize('check', $notification);
        Auth::user()->deleteNotification($notification->id);
        return new NotificationResource(['message' => 'Notification deleted.'], 401);
    }
}
