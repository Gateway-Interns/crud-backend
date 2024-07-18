<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewReleaseNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{

    public function markAsRead(Notification $id)
    {
        Gate::authorize('check', $id);
        // $user = Auth::user();
        // if (!$user) {
        //     return new NotificationResource(['message' => 'User not authenticated.'], 401);
        // }
        // $notification = Auth::user()->notifications()->find($id);
        // if ($notification) {
        //     $notification->markAsRead();
        //     return new NotificationResource(['message' => 'Uthorized.'], 403);
        // }
        Auth::user()->markAllNotificationsAsRead();
        return new NotificationResource(['message' => 'Notification mark as read.'], 401);
    }


    public function markAllAsRead(Notification $id)
    {
        Gate::authorize('modify', $id);
        Auth::user()->markAllNotificationsAsRead();
        return new NotificationResource(['message' => 'Notification mark all as read.'], 401);
    }

    public function markAsUnread(Notification $id)
    {
        Gate::authorize('modify', $id);
        Auth::user()->markNotificationAsUnread($id);
        return new NotificationResource(['message' => 'Notification mark all as unread.'], 401);
    }

    public function deleteNotification(Notification $id)
    {
        Gate::authorize('modify', $id);
        Auth::user()->deleteNotification($id);
        return new NotificationResource(['message' => 'Notification deleted.'], 401);
    }
}
