<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function all(User $user)
    {
        $notifications = NotificationResource::collection($user->notifications);
        
        return response()->json(compact('notifications'));
    }

    public function markAsRead($notification_id)
    {
        $notification = DatabaseNotification::find($notification_id);
        $notification->markAsRead();
        
        return redirect(route($notification->data['route_name']).'?search='.$notification->data['filter']);
    }
}
