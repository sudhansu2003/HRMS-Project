@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if(\Auth::user()->type == 'employee')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Event View')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="page-title">
                            <div class="row justify-content-between align-items-center full-calender">
                                <div class="col d-flex align-items-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                            <i class="fas fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </div>
                                    <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{__('Month')}}</a>
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <!-- Fullcalendar -->
                                <div class="overflow-hidden widget-calendar">
                                    <div class="calendar e-height" data-toggle="event_calendar" id="event_calendar"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Mark Attandance')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <p class="text-muted pb-0-5">{{__('My Office Time: '.$officeTime['startTime'].' to '.$officeTime['endTime'])}}</p>
                        <center>
                            <div class="row">
                                <div class="col-md-6 float-right border-right">
                                    {{Form::open(array('url'=>'attendanceemployee/attendance','method'=>'post'))}}
                                    @if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00')
                                        <button type="submit" value="0" name="in" id="clock_in" class="btn-create badge-success">{{__('CLOCK IN')}}</button>
                                    @else
                                        <button type="submit" value="0" name="in" id="clock_in" class="btn-create badge-success disabled" disabled>{{__('CLOCK IN')}}</button>
                                    @endif
                                    {{Form::close()}}
                                </div>
                                <div class="col-md-6 float-left">
                                    @if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00')
                                        {{Form::model($employeeAttendance,array('route'=>array('attendanceemployee.update',$employeeAttendance->id),'method' => 'PUT')) }}
                                        <button type="submit" value="1" name="out" id="clock_out" class="btn-create badge-danger">{{__('CLOCK OUT')}}</button>
                                    @else
                                        <button type="submit" value="1" name="out" id="clock_out" class="btn-create badge-danger disabled" disabled>{{__('CLOCK OUT')}}</button>
                                    @endif
                                    {{Form::close()}}
                                </div>
                            </div>
                        </center>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Announcement List')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                    <th>{{__('description')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->start_date)  }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                        <td>{{ $announcement->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Meeting List')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Meeting title')}}</th>
                                    <th>{{__('Meeting Date')}}</th>
                                    <th>{{__('Meeting Time')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                        <td>{{ \Auth::user()->timeFormat($meeting->time) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box"><i class="fas fa-users"></i></div>
                        <h4>{{__('Total Staff')}}</h4>
                    </div>
                    <div class="number-icon">{{ $countUser +   $countEmployee}}</div>
                    <div class="user-text">
                        <h5>{{__('User')}}: {{$countUser}}</h5>
                        <h5>{{__('Employee')}}: {{$countEmployee}} </h5>
                    </div>
                </div>
                <img src="{{ asset('assets/img/dot-icon.png') }}" alt="" class="dotted-icon"/>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box yellow-bg"><i class="fas fa-tag"></i></div>
                        <h4>{{__('Total Ticket')}}</h4>
                    </div>
                    <div class="number-icon">{{$countTicket}}</div>
                    <div class="user-text">
                        <h5>{{__('Open ticket')}}: {{$countOpenTicket}}</h5>
                        <h5>{{__('Close ticket')}}: {{$countCloseTicket}}</h5>
                    </div>
                    <img src="{{ asset('assets/img/dot-icon.png') }}" alt="" class="dotted-icon"/>
                </div>
            </div>
            @if(\Auth::user()->type=='company')
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box green-bg"><i class="fas fa-money-bill"></i></div>
                            <h4>{{__('Account Balance')}}</h4>
                        </div>
                        <div class="number-icon">{{ \Auth::user()->priceFormat($accountBalance) }}</div>
                        <div class="user-text">
                            <h5>{{__('Payee')}}: {{$totalPayer}}</h5>
                            <h5>{{__('Payer')}}: {{$totalPayer}}</h5>
                        </div>
                    </div>
                    <img src="{{ asset('assets/img/dot-icon.png') }}" alt="" class="dotted-icon"/>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <h4 class="h4 font-weight-400">{{__("Today's Not Clock In")}}</h4>
                <div class="card bg-none min-height-443">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($notClockIns as $notClockIn)
                                <tr>
                                    <td>{{ $notClockIn->name }}</td>
                                    <td><span class="absent-btn">{{__('Absent')}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left">{{__('Announcement List')}}</h4>
                </div>
                <div class="card bg-none min-height-443">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Description')}}</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ \Auth::user()->dateFormat($announcement->start_date) }}</td>
                                    <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                    <td>{{ $announcement->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="h4 font-weight-400 float-left">{{__('Event View')}}</h4>
                <div class="card widget-calendar min-height-940">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-2 col-sm-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-5 col-sm-6 text-center">
                                <h5 class="fullcalendar-title h4 d-inline-block font-weight-600 mb-0">{{__('Calendar')}}</h5>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-4 text-lg-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{__('Month')}}</a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar" data-toggle="event_calendar"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left">{{__('Meeting schedule')}}</h4>
                </div>
                <div class="card bg-none min-height-940">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Time')}}</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($meetings as $meeting)
                                <tr>
                                    <td>{{ $meeting->title }}</td>
                                    <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                    <td>{{  \Auth::user()->timeFormat($meeting->time) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@push('theme-script')
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
@endpush
@push('script-page')
    <script>
        // event_calendar (not working now)
        var e, t, a = $('[data-toggle="event_calendar"]');
        a.length && (t = {
            header: {right: "", center: "", left: ""},
            buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
            theme: !1,
            selectable: !0,
            selectHelper: !0,
            editable: !0,
            events: {!! json_encode($arrEvents) !!} ,
            eventStartEditable: !1,
            locale: '{{basename(App::getLocale())}}',
            dayClick: function (e) {
                var t = moment(e).toISOString();
                $("#new-event").modal("show"), $(".new-event--title").val(""), $(".new-event--start").val(t), $(".new-event--end").val(t)
            },
            eventResize: function (event) {
                var eventObj = {
                    start: event.start.format(),
                    end: event.end.format(),
                };

                /*$.ajax({
                    url: event.resize_url,
                    method: 'PUT',
                    data: eventObj,
                    success: function (response) {
                    },
                    error: function (data) {
                        data = data.responseJSON;
                    }
                });*/
            },
            viewRender: function (t) {
                e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
            },
            eventClick: function (e, t) {
                var title = e.title;
                var url = e.url;

                if (typeof url != 'undefined') {
                    $("#commonModal .modal-title").html(title);
                    $("#commonModal .modal-dialog").addClass('modal-md');
                    $("#commonModal").modal('show');
                    $.get(url, {}, function (data) {
                        $('#commonModal .modal-body').html(data);
                    });
                    return false;
                }
            }
        }, (e = a).fullCalendar(t),
            $("body").on("click", "[data-calendar-view]", function (t) {
                t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                var a = $(this).attr("data-calendar-view");
                e.fullCalendar("changeView", a)
            }), $("body").on("click", ".fullcalendar-btn-next", function (t) {
            t.preventDefault(), e.fullCalendar("next")
        }), $("body").on("click", ".fullcalendar-btn-prev", function (t) {
            t.preventDefault(), e.fullCalendar("prev")
        }));
    </script>
@endpush

