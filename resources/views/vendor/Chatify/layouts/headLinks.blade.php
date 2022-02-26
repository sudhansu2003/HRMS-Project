<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="route" content="{{ $route }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- scripts --}}
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<!-- <script src="{{ asset('js/app.js') }}"></script> -->

{{-- styles --}}

<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" /> --}}

{{-- Messenger Color Style--}}
@include('Chatify::layouts.messengerColor')
