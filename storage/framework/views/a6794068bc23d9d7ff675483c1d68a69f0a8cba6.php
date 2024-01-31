<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if(\Auth::user()->type == 'employee'): ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Event View')); ?></h4>
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
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month"><?php echo e(__('Month')); ?></a>
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek"><?php echo e(__('Week')); ?></a>
                                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay"><?php echo e(__('Day')); ?></a>
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
                        <h4><?php echo e(__('Mark Attandance')); ?></h4>
                    </div>
                     <div class="card-body dash-card-body">
                        <p class="text-muted pb-0-5"><?php echo e(__('My Office Time: '.$officeTime['startTime'].' to '.$officeTime['endTime'])); ?></p>
                        <center>
                            <div class="row">
                                <div class="col-md-6 float-right border-right">
                                    <?php echo e(Form::open(array('url'=>'attendanceemployee/attendance','method'=>'post'))); ?>

                                    <?php if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00'): ?>
                                        <button type="submit" value="0" name="in" id="clock_in" class="btn-create badge-success"><?php echo e(__('CLOCK IN')); ?></button>
                                    <?php else: ?>
                                        <button type="submit" value="0" name="in" id="clock_in" class="btn-create badge-success disabled" disabled><?php echo e(__('CLOCK IN')); ?></button>
                                    <?php endif; ?>
                                    <?php echo e(Form::close()); ?>

                                </div>
                                <div class="col-md-6 float-left">
                                    <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                                        <?php echo e(Form::model($employeeAttendance,array('route'=>array('attendanceemployee.update',$employeeAttendance->id),'method' => 'PUT'))); ?>

                                        <button type="submit" value="1" name="out" id="clock_out" class="btn-create badge-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                                    <?php else: ?>
                                        <button type="submit" value="1" name="out" id="clock_out" class="btn-create badge-danger disabled" disabled><?php echo e(__('CLOCK OUT')); ?></button>
                                    <?php endif; ?>
                                    <?php echo e(Form::close()); ?>

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
                        <h4><?php echo e(__('Announcement List')); ?></h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('description')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($announcement->title); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                        <td><?php echo e($announcement->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Meeting List')); ?></h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Meeting title')); ?></th>
                                    <th><?php echo e(__('Meeting Date')); ?></th>
                                    <th><?php echo e(__('Meeting Time')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($meeting->title); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                        <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box"><i class="fas fa-users"></i></div>
                        <h4><?php echo e(__('Total Staff')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e($countUser +   $countEmployee); ?></div>
                    <div class="user-text">
                        <h5><?php echo e(__('User')); ?>: <?php echo e($countUser); ?></h5>
                        <h5><?php echo e(__('Employee')); ?>: <?php echo e($countEmployee); ?> </h5>
                    </div>
                </div>
                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon"/>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card card-box">
                    <div class="left-card">
                        <div class="icon-box yellow-bg"><i class="fas fa-tag"></i></div>
                        <h4><?php echo e(__('Total Ticket')); ?></h4>
                    </div>
                    <div class="number-icon"><?php echo e($countTicket); ?></div>
                    <div class="user-text">
                        <h5><?php echo e(__('Open ticket')); ?>: <?php echo e($countOpenTicket); ?></h5>
                        <h5><?php echo e(__('Close ticket')); ?>: <?php echo e($countCloseTicket); ?></h5>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon"/>
                </div>
            </div>
            <?php if(\Auth::user()->type=='company'): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box green-bg"><i class="fas fa-money-bill"></i></div>
                            <h4><?php echo e(__('Account Balance')); ?></h4>
                        </div>
                        <div class="number-icon"><?php echo e(\Auth::user()->priceFormat($accountBalance)); ?></div>
                        <div class="user-text">
                            <h5><?php echo e(__('Payee')); ?>: <?php echo e($totalPayer); ?></h5>
                            <h5><?php echo e(__('Payer')); ?>: <?php echo e($totalPayer); ?></h5>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" alt="" class="dotted-icon"/>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <h4 class="h4 font-weight-400"><?php echo e(__("Today's Not Clock In")); ?></h4>
                <div class="card bg-none min-height-443">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__currentLoopData = $notClockIns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notClockIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($notClockIn->name); ?></td>
                                    <td><span class="absent-btn"><?php echo e(__('Absent')); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Announcement List')); ?></h4>
                </div>
                <div class="card bg-none min-height-443">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($announcement->title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                    <td><?php echo e($announcement->description); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Event View')); ?></h4>
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
                                <h5 class="fullcalendar-title h4 d-inline-block font-weight-600 mb-0"><?php echo e(__('Calendar')); ?></h5>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-4 text-lg-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month"><?php echo e(__('Month')); ?></a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek"><?php echo e(__('Week')); ?></a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay"><?php echo e(__('Day')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar" data-toggle="event_calendar"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Meeting schedule')); ?></h4>
                </div>
                <div class="card bg-none min-height-940">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Time')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($meeting->title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                    <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
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
            events: <?php echo json_encode($arrEvents); ?> ,
            eventStartEditable: !1,
            locale: '<?php echo e(basename(App::getLocale())); ?>',
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
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>