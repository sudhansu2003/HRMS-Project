@php
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = Utility::getValByName('company_favicon');
@endphp
<!DOCTYPE html>
<html dir="{{ env('SITE_RTL') == 'on' ? 'rtl' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'HRMGo') }}
        - @yield('page-title')</title>
    <link rel="icon"
        href="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
        type="image" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head')

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">
    @if (env('SITE_RTL') == 'on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
    @stack('css-page')
    <meta name="url" content="{{ url('') . '/' . config('chatify.routes.prefix') }}"
        data-user="{{ Auth::user()->id }}">

    {{-- scripts --}}
    <script src="{{ asset('js/chatify/autosize.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    {{-- styles --}}
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
</head>

<body class="application application-offset">
    <div class="container-fluid container-application">
        @include('partial.Admin.menu')
        <div class="main-content position-relative">
            @include('partial.Admin.header')
            <div class="page-content">
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div
                            class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                            <div class="d-inline-block">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 ">@yield('page-title')</h5>
                            </div>
                        </div>
                        <div
                            class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                            @yield('action-button')
                        </div>
                    </div>
                </div>
                @yield('content')
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
                        aria-label="Close">{{ __('Close') }}</a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/site.core.js') }}"></script>
    <script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>

    @stack('theme-script')

    <script src="{{ asset('js/letter.avatar.js') }}"></script>
    <script>
        LetterAvatar.transform();
    </script>

    <script src="{{ asset('assets/js/site.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script>
        var toster_pos = "{{ env('SITE_RTL') == 'on' ? 'left' : 'right' }}";
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        moment.locale('en');
    </script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>


    @if (Utility::getValByName('gdpr_cookie') == 'on')
        <script type="text/javascript">
            var defaults = {
                'messageLocales': {
                    /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                    'en': "{{ Utility::getValByName('cookie_text') }}"
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
        <script src="{{ asset('assets/js/cookie.notice.js') }}"></script>
    @endif

    @if (\Auth::user()->type != 'super admin')
        <script>
            $(document).ready(function() {
                pushNotification('{{ Auth::id() }}');
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

                var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
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
                    url: '{{ route('message.data') }}',
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
                    url: '{{ route('message.seen') }}',
                    type: "get",
                    cache: false,
                    success: function(data) {
                        $('.dropdown-list-message-msg').html('');
                        $(".message-toggle-msg").removeClass('beep');
                    }
                })
            });
        </script>
    @endif

    @stack('script-page')

    <script>
        var dataTabelLang = {
            paginate: {
                previous: "{{ __('Previous') }}",
                next: "{{ __('Next') }}"
            },
            lengthMenu: "{{ __('Show') }} _MENU_ {{ __('entries') }}",
            zeroRecords: "{{ __('No data available in table') }}",
            info: "{{ __('Showing') }} _START_ {{ __('to') }} _END_ {{ __('of') }} _TOTAL_ {{ __('entries') }}",
            infoEmpty: " ",
            search: "{{ __('Search:') }}"
        }
    </script>
    <script>
        var date_picker_locale = {
            format: 'YYYY-MM-DD',
            daysOfWeek: [
                "{{ __('Sun') }}",
                "{{ __('Mon') }}",
                "{{ __('Tue') }}",
                "{{ __('Wed') }}",
                "{{ __('Thu') }}",
                "{{ __('Fri') }}",
                "{{ __('Sat') }}"
            ],
            monthNames: [
                "{{ __('January') }}",
                "{{ __('February') }}",
                "{{ __('March') }}",
                "{{ __('April') }}",
                "{{ __('May') }}",
                "{{ __('June') }}",
                "{{ __('July') }}",
                "{{ __('August') }}",
                "{{ __('September') }}",
                "{{ __('October') }}",
                "{{ __('November') }}",
                "{{ __('December') }}"
            ],
        };
        var calender_header = {
            today: "{{ __('today') }}",
            month: '{{ __('month') }}',
            week: '{{ __('week') }}',
            day: '{{ __('day') }}',
            list: '{{ __('list') }}'
        };
    </script>
    @if ($message = Session::get('success'))
        <script>
            show_toastr('Success', '{!! $message !!}', 'success');
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            show_toastr('Error', '{!! $message !!}', 'error');
        </script>
    @endif
    @include('Chatify::layouts.footerLinks')
</body>

</html>
