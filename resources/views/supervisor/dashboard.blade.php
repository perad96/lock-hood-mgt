@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <div class="card shadow mt-2 p-4">
            <div class="card-title h5">Pending Tasks</div>
            <div id='calendarTasks' class="w-100"></div>
        </div>


    </div>
@endsection

@section('js')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            let calendarTasks = new FullCalendar.Calendar(document.getElementById('calendarTasks'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialDate: '{{date("Y-m-d")}}',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                select: function(arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendarTasks.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }
                    calendarTasks.unselect()
                },
                eventClick: function(arg) {
                },
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: BASE + '/util/get-all-tasks-calender-supervisor'
            });

            calendarTasks.render();
        });

    </script>
@endsection
