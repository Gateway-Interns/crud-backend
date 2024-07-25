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
        Auth::user()->markNotificationAsRead($notification->id);
        return response()->json(['message' => 'Notification Mark as read']);
    }
    public function markAllAsRead()
    {
        Auth::user()->markAllNotificationsAsRead();
        return response()->json(['message' => 'Notification all marked as read']);
    }


    public function markAsUnread(Notification $notification)
    {
        Gate::authorize('check', $notification);
        Auth::user()->markNotificationAsUnread($notification->id);
        return response()->json(['message' => 'Notification Mark as unread']);
    }

    public function deleteNotification(Notification $notification)
    {
        Gate::authorize('check', $notification);
        Auth::user()->deleteNotification($notification->id);
        return response()->json(['message' => 'Notification deleted']);
    }
}
