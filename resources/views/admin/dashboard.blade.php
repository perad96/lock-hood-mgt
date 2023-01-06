@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats text-dark" style="border: 2px solid var(--primary)">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-tag-content"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-dark">Orders Count({{date('F')}})</p>
                                    <p class="card-title">{{$monthOrdersTotalCount}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats bg-success">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-check-2"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-dark">Completed Orders Count({{date('F')}})</p>
                                    <p class="card-title">{{$monthOrdersCompleteCount}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats bg-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-time-alarm"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-dark">Pending Orders Count(All)</p>
                                    <p class="card-title">{{$pendingOrdersCount}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats bg-secondary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-badge text-light"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-light">Number of Customers</p>
                                    <p class="card-title text-light">{{$totalCustomersCount}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-2 p-4">
            <div class="card-title h5">Pending Orders</div>
            <div id='calendar' class="w-100"></div>
        </div>


    </div>
@endsection

@section('js')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
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
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }
                    calendar.unselect()
                },
                eventClick: function(arg) {
                    // if (confirm('Are you sure you want to delete this event?')) {
                    //     arg.event.remove()
                    // }
                },
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: BASE + '/util/get-all-tasks-calender'
            });

            calendar.render();
        });

    </script>
@endsection
