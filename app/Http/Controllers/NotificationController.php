<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        Auth::user()->markAllNotificationsAsRead($id);
        return response()->json(['message' => 'Notification marked as read.']);
    }
    public function markAllAsRead()
    {
        Auth::user()->markAllNotificationsAsRead();
        return response()->json(['message' => 'All notifications marked as read.']);
    }

    public function markAsUnread($id)
    {
        Auth::user()->markNotificationAsUnread($id);
        return response()->json(['message' => 'Notification marked as unread.']);
    }

    public function deleteNotification($id)
    {
        Auth::user()->deleteNotification($id);
        return response()->json(['message' => 'Notification deleted.']);
    }
}
