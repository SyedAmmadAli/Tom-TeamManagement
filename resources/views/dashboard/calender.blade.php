@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Calendar
@endsection

@section('page-name')
    Calendar
@endsection

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>


<!-- FullCalendar & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: "{{ route('tasks.events') }}", // Fetch tasks dynamically
        eventColor: '#007bff', // Default blue color
        eventTextColor: '#fff', // White text

        // Show details on hover
        eventDidMount: function(info) {
            var tooltip = new bootstrap.Tooltip(info.el, {
                title: `<strong>Task:</strong> ${info.event.title} <br>
                        <strong>Details:</strong> ${info.event.extendedProps.description} <br>
                        <strong>Priority:</strong> ${info.event.extendedProps.priority} <br>
                        <strong>Added By:</strong> ${info.event.extendedProps.created_by}`,
                html: true,
                placement: "top",
                trigger: "hover"
            });
        },

        // Redirect to task details page on click
        eventClick: function(info) {
            var taskId = info.event.id; // Get task ID
            window.location.href = "{{ route('viewTaskDetails', ':id') }}".replace(':id', taskId);
        }
    });

    calendar.render();
});

</script>


@endsection
