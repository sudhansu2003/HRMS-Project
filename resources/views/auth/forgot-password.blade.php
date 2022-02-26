@extends('layouts.auth')
@section('page-title')
    {{__('Forgot Password')}}
@endsection
@php
    $logo=asset(Storage::url('uploads/logo/'));
@endphp
@section('content')
    <div class="login-contain">
        <div class="login-inner-contain">
            <a class="navbar-brand" href="#">
                <img src="{{$logo.'/logo.png'}}" class="navbar-brand-img auth-logo" alt="logo">
            </a>
            <div class="login-form">
                <div class="page-title"><h5>{{__('Forgot Password')}}</h5></div>
                <small class="text-muted">{{ __('We will send a link to reset your password') }}</small>
                @if (session('status'))
                    <small class="text-muted">{{ session('status') }}</small>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label" for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-login">{{ __('Send Password Reset Link') }}</button>
                    <div class="or-text">{{__('OR')}}</div>
                    <a href="{{ route('login') }}" class="text-xs text-primary">{{__('Login')}}</a>
                </form>
            </div>
            <h5 class="copyright-text">
                {{(Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright HRMGo') }} {{ date('Y') }}
            </h5>

            <div class="all-select">
                <a href="#" class="monthly-btn">
                    <span class="monthly-text">{{__('Change Language')}}</span>
                    <select class="select-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
                        @foreach(Utility::languages() as $language)
                            <option @if($lang == $language) selected @endif value="{{ route('change.langPass',$language) }}">{{Str::upper($language)}}</option>
                        @endforeach
                    </select>
                </a>
            </div>
        </div>
    </div>
@endsection
