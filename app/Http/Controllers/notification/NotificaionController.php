<?php

namespace App\Http\Controllers\notification;

use App\Http\Controllers\Controller;
use App\Models\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificaionController extends Controller
{
    public function sendNotification(Request $request)
    {
        $notification = TaskNotification::create([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'message' => 'A new task has been assigned to you.',
            'is_read' => 0
        ]);

        return response()->json(['success' => true, 'notification' => $notification]);
    }

    public function fetchNotifications()
    {
        $userId = Auth::id();

        $notifications = TaskNotification::with(['users', 'task'])->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        $notification = TaskNotification::find($request->id);
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
        }

        return response()->json(['success' => true]);
    }

    public function MarkAsReadNoti(Request $request) {
        TaskNotification::where('user_id', Auth::id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
    
        return response()->json(['success' => true]);
    }
}
