<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Task;
use App\Models\TaskNotification;

class TaskAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task, $userId;

    public function __construct(Task $task, $userId)
    {
        $this->task = $task;
        $this->userId = $userId;
    }

    /**
     * Choose notification channels.
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Store notification in the custom task_notifications table.
     */
    public function toDatabase($notifiable)
    {
        // Insert into task_notifications table
        TaskNotification::create([
            'user_id' => $this->userId,
            'task_id' => $this->task->id,
            'message' => "New task assigned: " . $this->task->task_title,
            'is_read' => 0, // Default unread
        ]);

        return [
            'task_id' => $this->task->id,
            'message' => "New task assigned: " . $this->task->task_title,
        ];
    }

    /**
     * Send real-time notification via WebSockets.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'task_id' => $this->task->id,
            'message' => "New task assigned: " . $this->task->task_title,
        ]);
    }
}
