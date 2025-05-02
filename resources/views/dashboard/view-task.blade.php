@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    View Task
@endsection

@section('page-name')
    View Task
@endsection


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="overflow-x:auto; scrollbar-color: #4254ba; scrollbar-width: thin;">
                <h4 class="header-title">View All Tasks</h4>
                <p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </p>
                <table id="basic-datatable" class="table table-striped  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sr. No. </th>
                            <th>Task Title</th>
                            {{-- <th>Description</th> --}}
                            <th>Assigned To</th>
                            <th>Assigned From</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Attachments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($tasks)
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->task_title }}</td>
                                    {{-- <td class="text-truncate" style="max-width: 200px;">{!! $task->description !!}</td> --}}
                                    <td class="text-captialize">
                                        @foreach ($task->assignedusers as $users)
                                            {{ $users->employee->first_name }},
                                        @endforeach
                                    </td>
                                    <td>{{ $task->assignedfrom->first_name }}</td>
                                    <td>{{ $task->priority }}</td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        @if ($task->attachments)
                                            Attachments
                                        @else
                                            No attachments
                                        @endif
                                    </td>
                                    {{-- <td>

                                @if ($task->status == 1)
                                    Active
                                @else
                                    Block
                                @endif

                            </td> --}}

                                    <td>
                                        @if (Auth::user()->id == $task->assigned_from || Auth::user()->role_id == '1')
                                            <a href="{{ route('editTask', $task->id) }}" class="btn btn-primary">Edit</a>
                                        @endif
                                        <a href="{{ route('viewTaskDetails', $task->id) }}"
                                            class="btn btn-warning">View</a>

                                        @if (Auth::user()->role_id == '1')
                                            <a href="{{ route('deleteTask', $task->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">No Task Found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

@endsection
