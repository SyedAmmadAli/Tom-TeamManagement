<?php

namespace App\Http\Controllers\tasks;

use App\Http\Controllers\Controller;
use App\Models\AssignedEmployee;
use App\Models\Media;
use App\Models\Task as ModelsTask;
use App\Models\TaskNotification;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use function Pest\Laravel\get;

class TaskController extends Controller
{
    public function CreateTask()
    {
        $loggedUser = Auth::user()->id;
        $getusers = User::whereNotIn('id', [$loggedUser])->get();
        $getMedia = Media::find($loggedUser);

        $allusers = User::all();
        return view('dashboard.create-task', compact('allusers', 'getusers', 'getMedia'));
    }

    public function ProcessCreateTask(Request $req)
    {
        // dd($req->all());

        // Validate input
        $taskData = $req->validate([
            'task_title' => 'required',
            'description' => 'required',
            'assigned_employee' => 'required|array',
            'priority' => 'required',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required',
            'attachment' => 'array|max:5000',
            // 'attachments.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,txt,xls,xlsx,ppt,pptx,zip,rar',

        ]);
        // dd($taskData);


        $assignedEmp = $req->assigned_employee;
        $imagePaths = [];

        // Handle file uploads
        if ($req->hasFile('attachments')) {
            foreach ($req->file('attachments') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('./dashboard/uploads/');
                $mimeType = $file->getMimeType();
                $size = $file->getSize(); // File size in bytes
                $fileType = explode('/', $mimeType)[0]; // 'image', 'video', 'audio', etc.


                // if (!file_exists($destinationPath)) {
                //     mkdir($destinationPath, 0777, true);
                // }

                // $file->move($destinationPath, $filename);
                $imagePaths[] = 'dashboard/uploads/' . $filename;
            }
        }



        // Save task in the database
        $task = ModelsTask::create([
            'task_title' => $req->task_title,
            'description' => $req->description,
            'priority' => $req->priority,
            'assigned_from' => Auth::user()->id,
            'due_date' => $req->due_date,
            'status' => $req->status,
            'attachments' => json_encode($req->attachment)
        ]);


        //media library
        // $media = Media::create([
        //     'filename' => $filename,
        //     'file_type' => $fileType,
        //     'mime_type' => $mimeType,
        //     'size' => $size,
        //     'uploaded_by' => Auth::id(),
        // ]);

        // Assign employees & send notifications
        foreach ($assignedEmp as $userId) {
            AssignedEmployee::create([
                'task_id' => $task->id,
                'user_id' => $userId,
            ]);

            // Insert notification
            TaskNotification::create([
                'user_id' => $userId,
                'task_id' => $task->id,
                'message' => 'New task assigned: ' . $req->task_title,
                'is_read' => 0,
            ]);
        }

        if ($task) {
            return redirect()->route('createTask')->with('success', 'Task created successfully.');
        } else {
            return redirect()->route('createTask')->with('error', 'Failed to create task.');
        }
    }




    public function ViewTasks()
    {
        // If user is admin, show all tasks
        if (Auth::user()->role_id == '1') {
            $tasks = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])->get();
            // return $tasks;
        } else {
            // Otherwise, show only assigned tasks
            $tasks = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])
                ->whereHas('assignedusers', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();
        }

        return view('dashboard.view-task', compact('tasks'));
    }

    public function ViewTaskDetails(string $id)
    {
        $task = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])->find($id);
    
        $files = [];
        $extension = [];
    
        // Check if attachments exist and decode them
        if (!empty($task->attachments)) {
            $decoded = json_decode($task->attachments);
    
            if (is_array($decoded)) {
                $files = $decoded;
    
                foreach ($files as $file) {
                    $extension[] = pathinfo($file, PATHINFO_EXTENSION);
                }
            }
        }
    
        return view('dashboard.view-taskdetails', compact('task', 'files', 'extension'));
    }
    

    public function ChangeTaskStatus(string $id)
    {
        $task = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])->find($id);

        if (!$task) {
            return redirect()->route('viewTasks')->with('error', 'Task not found.');
        }

        if ($task->status === 'completed') {
            return redirect()->route('viewTasks')->with('error', 'Task is already completed.');
        }

        // Update task status
        $task->status = 'completed';
        $task->save();

        // Create a notification for all assigned users
        foreach ($task->assignedusers as $assignedUser) {
            TaskNotification::create([
                'user_id' => $assignedUser->user_id, // Notify each assigned user
                'task_id' => $task->id,
                'message' => "Task Completed: {$task->task_title}",
                'is_read' => 0, // Mark as unread
            ]);
        }

        return redirect()->route('viewTasks')->with('success', 'Task Completed.');
    }


    public function ChangeTaskStatusOpen(string $id)
    {
        $task = ModelsTask::find($id);

        if ($task->status === 'open') {
            return redirect()->route('viewTasks')->with('error', 'Task is already opened.');
        }

        $task->status = 'open';
        $task->save();

        return redirect()->route('viewTasks')->with('success', 'Task Opened.');
    }

    public function DeleteTask(string $id)
    {
        $task = ModelsTask::find($id);
        $task->delete();

        return redirect()->route('viewTasks')->with('success', 'Task Deleted.');
    }

    public function EditTask(string $id)
    {
        $task = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])->find($id);
        // return $task;
        $allusers = User::all();


        return view('dashboard.edit-task', compact('task', 'allusers'));
    }

    public function ProcessEditTask(Request $req, $task_id)
    {
        // Validate input
        $validatedData = $req->validate([
            'task_title' => 'required',
            'description' => 'required',
            'assigned_employee' => 'required',
            'priority' => 'required',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required',
            'attachment' => 'array',
            'attachment.*' => 'string', // because you're getting file paths
        ]);

        // Find the task
        $task = ModelsTask::findOrFail($task_id);

        // Update task basic info
        $task->update([
            'task_title' => $validatedData['task_title'],
            'description' => $validatedData['description'],
            'priority' => $validatedData['priority'],
            'due_date' => $validatedData['due_date'],
            'status' => $validatedData['status'],
        ]);

        // Get old attachments from DB
        $existingAttachments = json_decode($task->attachments, true) ?? [];

        // Get new attachments from request (if any)
        $newAttachments = $req->has('attachment') ? $req->attachment : [];

        // Merge old + new only if new ones are uploaded
        if (!empty($newAttachments)) {
            $mergedAttachments = array_merge($existingAttachments, $newAttachments);
        } else {
            $mergedAttachments = $existingAttachments;
        }

        // Save updated attachment list
        $task->attachments = json_encode($mergedAttachments);
        $task->save();

        // Update assigned users
        $task->assignedusers()->delete(); // Remove old assigned users
        foreach ($req->assigned_employee as $user_id) {
            $task->assignedusers()->create(['user_id' => $user_id]);
        }

        return redirect()->back()->with('success', 'Task updated successfully.');
    }


    public function removeAttachment(Request $request)
    {
        $file = $request->input('file');

        // Find task and remove the file from the JSON array
        $task = ModelsTask::whereJsonContains('attachments', $file)->first();
        if ($task) {
            $attachments = json_decode($task->attachments, true);
            $attachments = array_filter($attachments, fn($f) => $f !== $file);
            $task->attachments = json_encode(array_values($attachments));
            $task->save();

            // Delete the file from storage
            $filePath = public_path($file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }


    public function getTasks()
    {
        if (Auth::user()->role_id == '1') {
            $tasks = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])->get();
        } else {
            $tasks = ModelsTask::with(['assignedusers.employee', 'assignedfrom'])
                ->whereHas('assignedusers', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();
        }


        $events = $tasks->map(function ($task) {
            // Assign colors based on priority
            $colorMap = [
                'low' => '#28a745',   // Green for Low priority
                'medium' => '#ffc107', // Yellow for Medium priority
                'high' => '#dc3545'    // Red for High priority
            ];

            return [
                'id' => $task->id,
                'title' => $task->task_title,
                'start' => $task->due_date,
                'end' => $task->due_date,
                'description' => $task->description,
                'priority' => $task->priority,
                'created_by' => $task->assignedfrom->first_name,
                'status' => $task->status,
                'backgroundColor' => $colorMap[$task->priority] ?? '#007bff', // Default color if priority is missing
                'textColor' => '#fff'
            ];
        });

        return response()->json($events);
    }


    public function GetData()
    {
        return view('dashboard.calender');
    }
}
