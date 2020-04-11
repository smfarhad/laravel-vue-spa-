<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return [
            'read' =>  NotificationResource::collection($user->notifications),
            'unRead' => NotificationResource::collection($user->unreadNotifications),
            'count' => $user->unreadNotifications->count()
        ];
    }
    public function markAsRead(Request $request)
    {
        $user = User::find(Auth::id());

        $user->notifications->where('id', $request->id)->markAsRead();
    }
}
