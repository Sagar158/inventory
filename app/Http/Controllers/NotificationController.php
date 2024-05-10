<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllNotificationsAsRead()
    {
        $user = auth()->user(); // Get the currently authenticated user

        // Mark all notifications as read
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function viewNotification()
    {
        $title = 'All Notifications';
        $user = Auth::user(); // Get the currently authenticated user

        // Retrieve all notifications for the user
        $notifications = $user->notifications()->paginate(10); // Paginate notifications if needed

        return view('notifications.index', compact('notifications','title'));
    }
}
