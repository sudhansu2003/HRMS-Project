
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

    <div class="row">
        <div class="col-md-6">
            <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Event View')); ?></h4>
            <div class="card widget-calendar min-height-940">
                <div class="card-header">
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
                    </div>
                </div>
                <div class="calendar" data-toggle="event_calendar"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.querySelector('.calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Set the initial view to month
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap', // Use Bootstrap theme
                locale: '<?php echo e(basename(App::getLocale())); ?>',
                selectable: true,
                selectHelper: true,
                editable: true,
                dayClick: function (e) {
                    var t = moment(e.date).toISOString();
                    $("#new-event").modal("show"), $(".new-event--title").val(""), $(".new-event--start").val(t), $(".new-event--end").val(t)
                },
                eventResize: function (event) {
                    var eventObj = {
                        start: event.startStr,
                        end: event.endStr,
                    };
                },
                viewRender: function (t) {
                    $(".fullcalendar-title").html(t.title)
                },
                eventClick: function (e, t) {
                    var title = e.event.title;
                    var url = e.event.url;

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
            });

            calendar.render();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/monthlyreport/index.blade.php ENDPATH**/ ?>