@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Calendar
@endsection

@section('page-name')
    Calendar
@endsection

<style>
    .fc-button {
        background-color: #007bff !important;
        color: #fff !important;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .fc-createTask-button {
        background-color: #28a745 !important;
        color: white !important;
    }

    .fc-button:hover {
        opacity: 0.9;
    }

    .fc-button:focus,
    .fc-button.fc-button-active {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Pass Laravel permission check into JavaScript
    const hasCreatePermission = @json($user_permissions->contains('permission_id', 15));

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // FullCalendar configuration object
        var calendarConfig = {
            initialView: 'dayGridMonth',

            headerToolbar: {
                left: hasCreatePermission ? 'prev,next createTask' : 'prev,next',
                center: 'title',
                right: 'today'
            },

            customButtons: hasCreatePermission ? {
                createTask: {
                    text: 'Create Event',
                    click: function() {
                        window.location.href = "{{ route('createTask') }}";
                    }
                }
            } : {},

            events: function(fetchInfo, successCallback, failureCallback) {
                fetch("{{ route('tasks.events') }}")
                    .then(response => response.json())
                    .then(events => {
                        let filteredEvents = events.filter(event => event.status !== 'completed');
                        successCallback(filteredEvents);
                    })
                    .catch(error => {
                        console.error("Error fetching tasks:", error);
                        failureCallback(error);
                    });
            },

            eventColor: '#007bff',
            eventTextColor: '#fff',

            eventDidMount: function(info) {
                new bootstrap.Tooltip(info.el, {
                    title: `<strong>Task:</strong> ${info.event.title} <br>
                            <strong>Priority:</strong> ${info.event.extendedProps.priority} <br>
                            <strong>Added By:</strong> ${info.event.extendedProps.created_by}<br>
                            <strong>Click to view details</strong>`,
                    html: true,
                    placement: "top",
                    trigger: "hover"
                });
            },

            eventClick: function(info) {
                var taskId = info.event.id;
                window.location.href = "{{ route('viewTaskDetails', ':id') }}".replace(':id', taskId);
            }
        };

        // Initialize and render the calendar
        var calendar = new FullCalendar.Calendar(calendarEl, calendarConfig);
        calendar.render();
    });
</script>

@endsection
