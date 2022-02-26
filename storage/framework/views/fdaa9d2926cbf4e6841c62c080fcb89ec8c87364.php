<?php
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = Utility::getValByName('company_favicon');
?>
<!DOCTYPE html>
<html dir="<?php echo e(env('SITE_RTL') == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        <?php echo e(Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'HRMGo')); ?>

        - <?php echo $__env->yieldContent('page-title'); ?></title>
    <link rel="icon"
        href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image" sizes="16x16">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->yieldPushContent('head'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/animate.css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/site.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ac.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/stylesheet.css')); ?>">
    <?php if(env('SITE_RTL') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('css-page'); ?>
    <meta name="url" content="<?php echo e(url('') . '/' . config('chatify.routes.prefix')); ?>"
        data-user="<?php echo e(Auth::user()->id); ?>">

    
    <script src="<?php echo e(asset('js/chatify/autosize.js')); ?>"></script>
    
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
</head>

<body class="application application-offset">
    <div class="container-fluid container-application">
        <?php echo $__env->make('partial.Admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main-content position-relative">
            <?php echo $__env->make('partial.Admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-content">
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div
                            class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                            <div class="d-inline-block">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo $__env->yieldContent('page-title'); ?></h5>
                            </div>
                        </div>
                        <div
                            class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                            <?php echo $__env->yieldContent('action-button'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"></h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal"
                        aria-label="Close"><?php echo e(__('Close')); ?></a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/js/site.core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/progressbar.js/dist/progressbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('theme-script'); ?>

    <script src="<?php echo e(asset('js/letter.avatar.js')); ?>"></script>
    <script>
        LetterAvatar.transform();
    </script>

    <script src="<?php echo e(asset('assets/js/site.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables.min.js')); ?>"></script>
    <script>
        var toster_pos = "<?php echo e(env('SITE_RTL') == 'on' ? 'left' : 'right'); ?>";
    </script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>

    <script>
        moment.locale('en');
    </script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>


    <?php if(Utility::getValByName('gdpr_cookie') == 'on'): ?>
        <script type="text/javascript">
            var defaults = {
                'messageLocales': {
                    /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                    'en': "<?php echo e(Utility::getValByName('cookie_text')); ?>"
                },
                'buttonLocales': {
                    'en': 'Ok'
                },
                'cookieNoticePosition': 'bottom',
                'learnMoreLinkEnabled': false,
                'learnMoreLinkHref': '/cookie-banner-information.html',
                'learnMoreLinkText': {
                    'it': 'Saperne di più',
                    'en': 'Learn more',
                    'de': 'Mehr erfahren',
                    'fr': 'En savoir plus'
                },
                'buttonLocales': {
                    'en': 'Ok'
                },
                'expiresIn': 30,
                'buttonBgColor': '#d35400',
                'buttonTextColor': '#fff',
                'noticeBgColor': '#051c4b',
                'noticeTextColor': '#fff',
                'linkColor': '#009fdd'
            };
        </script>
        <script src="<?php echo e(asset('assets/js/cookie.notice.js')); ?>"></script>
    <?php endif; ?>

    <?php if(\Auth::user()->type != 'super admin'): ?>
        <script>
            $(document).ready(function() {
                pushNotification('<?php echo e(Auth::id()); ?>');
            });

            function pushNotification(id) {

                // ajax setup form csrf token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = false;

                var pusher = new Pusher('<?php echo e(env('PUSHER_APP_KEY')); ?>', {
                    cluster: '<?php echo e(env('PUSHER_APP_CLUSTER')); ?>',
                    forceTLS: true
                });

                // Pusher Notification
                var channel = pusher.subscribe('send_notification');
                channel.bind('notification', function(data) {
                    if (id == data.user_id) {
                        $(".notification-toggle").addClass('beep');
                        $(".notification-dropdown #notification-list").prepend(data.html);
                    }
                });

                // Pusher Message
                var msgChannel = pusher.subscribe('my-channel');
                msgChannel.bind('my-chat', function(data) {
                    console.log(data);
                    if (id == data.to) {
                        getChat();
                    }
                });
            }

            // Get chat for top ox
            function getChat() {
                $.ajax({
                    url: '<?php echo e(route('message.data')); ?>',
                    type: "get",
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if (data.length != 0) {
                            $(".message-toggle-msg").addClass('beep');
                            $(".dropdown-list-message-msg").html(data);
                        }
                    }
                })
            }

            getChat();

            $(document).on("click", ".mark_all_as_read_message", function() {
                $.ajax({
                    url: '<?php echo e(route('message.seen')); ?>',
                    type: "get",
                    cache: false,
                    success: function(data) {
                        $('.dropdown-list-message-msg').html('');
                        $(".message-toggle-msg").removeClass('beep');
                    }
                })
            });
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('script-page'); ?>

    <script>
        var dataTabelLang = {
            paginate: {
                previous: "<?php echo e(__('Previous')); ?>",
                next: "<?php echo e(__('Next')); ?>"
            },
            lengthMenu: "<?php echo e(__('Show')); ?> _MENU_ <?php echo e(__('entries')); ?>",
            zeroRecords: "<?php echo e(__('No data available in table')); ?>",
            info: "<?php echo e(__('Showing')); ?> _START_ <?php echo e(__('to')); ?> _END_ <?php echo e(__('of')); ?> _TOTAL_ <?php echo e(__('entries')); ?>",
            infoEmpty: " ",
            search: "<?php echo e(__('Search:')); ?>"
        }
    </script>
    <script>
        var date_picker_locale = {
            format: 'YYYY-MM-DD',
            daysOfWeek: [
                "<?php echo e(__('Sun')); ?>",
                "<?php echo e(__('Mon')); ?>",
                "<?php echo e(__('Tue')); ?>",
                "<?php echo e(__('Wed')); ?>",
                "<?php echo e(__('Thu')); ?>",
                "<?php echo e(__('Fri')); ?>",
                "<?php echo e(__('Sat')); ?>"
            ],
            monthNames: [
                "<?php echo e(__('January')); ?>",
                "<?php echo e(__('February')); ?>",
                "<?php echo e(__('March')); ?>",
                "<?php echo e(__('April')); ?>",
                "<?php echo e(__('May')); ?>",
                "<?php echo e(__('June')); ?>",
                "<?php echo e(__('July')); ?>",
                "<?php echo e(__('August')); ?>",
                "<?php echo e(__('September')); ?>",
                "<?php echo e(__('October')); ?>",
                "<?php echo e(__('November')); ?>",
                "<?php echo e(__('December')); ?>"
            ],
        };
        var calender_header = {
            today: "<?php echo e(__('today')); ?>",
            month: '<?php echo e(__('month')); ?>',
            week: '<?php echo e(__('week')); ?>',
            day: '<?php echo e(__('day')); ?>',
            list: '<?php echo e(__('list')); ?>'
        };
    </script>
    <?php if($message = Session::get('success')): ?>
        <script>
            show_toastr('Success', '<?php echo $message; ?>', 'success');
        </script>
    <?php endif; ?>
    <?php if($message = Session::get('error')): ?>
        <script>
            show_toastr('Error', '<?php echo $message; ?>', 'error');
        </script>
    <?php endif; ?>
    <?php echo $__env->make('Chatify::layouts.footerLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\pshrmsl\resources\views/layouts/admin.blade.php ENDPATH**/ ?>