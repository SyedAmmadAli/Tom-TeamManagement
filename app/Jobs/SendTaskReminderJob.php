<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\TaskNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTaskReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = Carbon::now()->format('Y-m-d');

        // Find tasks whose due date is today or tomorrow
        $tasks = Task::with('assignedusers')->whereIn('due_date', [$today, Carbon::tomorrow()->format('Y-m-d')])
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($tasks as $task) {
            foreach ($task->assignedusers as $assignedUser) {
                TaskNotification::create([
                    'user_id' => $assignedUser->user_id,
                    'task_id' => $task->id,
                    'message' => "Reminder: Task '{$task->task_title}' is due on {$task->due_date}.",
                    'is_read' => 0,
                ]);
            }
        }
    }
}
