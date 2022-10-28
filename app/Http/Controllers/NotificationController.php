<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(User $user)
    {
        $notifications = $user->notifications;
        
        return response()->json(compact('notifications'));
    }

    public function markAsRead($notification_id)
    {
        $notification = DatabaseNotification::find($notification_id);
        $notification->markAsRead();
        
        return redirect($notification->data['url']);
    }
}
