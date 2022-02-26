@extends('layouts.admin')

@section('page-title')
    {{__('Event')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Event')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('event.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Event')}}">
                    <i class="fa fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
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
            <div class="card overflow-hidden widget-calendar">
                <div class="calendar e-height" data-toggle="event_calendar" id="event_calendar"></div>
            </div>
            <!-- Modal - Add new event -->
            <!--* Modal header *-->
            <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="new-event--form">
                                <div class="form-group">
                                    <label class="form-control-label">Event title</label>
                                    <input type="text" class="form-control form-control-alternative new-event--title" placeholder="Event Title">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-control-label d-block mb-3">Status color</label>
                                    <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                                        <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" checked></label>
                                        <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning"></label>
                                        <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger"></label>
                                        <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success"></label>
                                        <label class="btn bg-secondary"><input type="radio" name="event-tag" value="bg-default"></label>
                                        <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary"></label>
                                    </div>
                                </div>
                                <input type="hidden" class="new-event--start"/>
                                <input type="hidden" class="new-event--end"/>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary rounded-pill float-right new-event--add">Create event</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal - Edit event -->
            <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="edit-event--form">
                                <div class="form-group">
                                    <label class="form-control-label">Event title</label>
                                    <input type="text" class="form-control form-control-alternative edit-event--title" placeholder="Event Title">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label d-block mb-3">Status color</label>
                                    <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
                                        <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" checked></label>
                                        <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning"></label>
                                        <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger"></label>
                                        <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success"></label>
                                        <label class="btn bg-secondary"><input type="radio" name="event-tag" value="bg-default"></label>
                                        <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Event Desctiption"></textarea>
                                    <i class="form-group--bar"></i>
                                </div>
                                <input type="hidden" class="edit-event--id">
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary rounded-pill float-right" data-calendar="update">Update</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill float-right" data-calendar="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('theme-script')
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
@endpush

@push('script-page')
    <script>
        // load chart data using these
        // event_calendar (not working now)
        var e, t, a = $('[data-toggle="event_calendar"]');
        a.length && (t = {
            header: {right: "", center: "", left: ""},
            buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
            theme: !1,
            selectable: !0,
            selectHelper: !0,
            editable: !0,
            events: {!! $arrEvents !!} ,
            eventStartEditable: !1,
            locale: '{{basename(App::getLocale())}}',

            eventResize: function (event) {
                var eventObj = {
                    start: event.start.format(),
                    end: event.end.format(),
                };

                $.ajax({
                    url: event.resize_url,
                    method: 'PUT',
                    data: eventObj,
                    success: function (response) {

                    },
                    error: function (data) {
                        data = data.responseJSON;
                    }
                });
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

    <script>
        $(document).ready(function () {
            var b_id = $('#branch_id').val();
            getDepartment(b_id);
        });
        $(document).on('change', 'select[name=branch_id]', function () {
            var branch_id = $(this).val();
            getDepartment(branch_id);
        });

        function getDepartment(bid) {

            $.ajax({
                url: '{{route('event.getdepartment')}}',
                type: 'POST',
                data: {
                    "branch_id": bid, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $('#department_id').empty();
                    $('#department_id').append('<option value="">{{__('Select Department')}}</option>');

                    $('#department_id').append('<option value="0"> {{__('All Department')}} </option>');
                    $.each(data, function (key, value) {
                        $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        $(document).on('change', '#department_id', function () {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {
            $.ajax({
                url: '{{route('event.getemployee')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data);
                    $('#employee_id').empty();
                    $('#employee_id').append('<option value="">{{__('Select Employee')}}</option>');
                    $('#employee_id').append('<option value="0"> {{__('All Employee')}} </option>');

                    $.each(data, function (key, value) {
                        $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>

@endpush
