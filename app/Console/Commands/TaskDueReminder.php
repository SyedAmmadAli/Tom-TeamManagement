<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\TaskNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TaskDueReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-due-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for tasks that are due soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::whereDate('due_date', now()->toDateString())->get();

        Log::info('Tasks retrieved: ' . $tasks->count());

        foreach ($tasks as $task) {
            foreach ($task->assignedusers as $user) {

                // Log::info($task->assignedusers);
                Log::info('Storing notification for Task ID: ' . $task->id . ' for User ID: ' . $user->user_id);

                // Store notification in the database
                TaskNotification::create([
                    'user_id' => $user->user_id,
                    'task_id' => $task->id,
                    'message' => "Reminder: Task '{$task->task_title}' is due today.",
                    'is_read' => 0, // Mark as unread

                ]);
            }
        }

        // Log::info('Task due-date reminders stored in database.');
    }
}
