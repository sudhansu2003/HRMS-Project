@extends('layouts.auth')

@section('title')
    {{ __('Register') }}
@endsection

@section('language-bar')
    <div class="all-select">
        <a href="#" class="monthly-btn mb-3">
            <span class="monthly-text">{{__('Change Language')}}</span>
            <select name="language" id="language" class="select-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                @foreach(App\Models\Utility::languages() as $language)
                    <option @if($lang == $language) selected @endif value="{{ route('register',$language) }}">{{Str::upper($language)}}</option>
                @endforeach
            </select>
        </a>
    </div>
@endsection

@section('content')
<div class="col-11 col-xl-6 py-5 mx-auto ml-md-0">
  <h4 class="text-primary font-weight-normal mb-1"><strong>{{__('Register')}}</strong></h4>
  <form action="{{ route('register') }}" method="POST" class="pt-3 text-left needs-validation" novalidate="">
    @csrf
    <label class="d-block position-relative mb-3">
      <p class="text-sm mb-2">{{ __('Name') }}</p>
      <input type="text" id="name" name="name" value="{{ old('name') }}" class="text-sm rounded-6 w-100 py-3 px-3 border text-grayDark @error('name') is-invalid @enderror" required autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
        @enderror
    </label>
    <label class="d-block position-relative mb-3">
      <p class="text-sm mb-2">{{ __('E-Mail Address') }}</p>
      <input type="email" id="email" name="email" value="{{ old('email') }}" class="text-sm rounded-6 w-100 py-3 px-3 border text-grayDark @error('email') is-invalid @enderror" required autofocus>
      @error('email')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
    </label>
    <label class="d-block position-relative mb-3">
      <p class="text-sm mb-2">{{ __('Password') }}</p>
      <input type="password" id="password" name="password"  class="text-sm rounded-6 w-100 py-3 px-3 border text-grayDark @error('password') is-invalid @enderror" >
      @error('password')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
    </label>
    <label class="d-block position-relative mb-3">
      <p class="text-sm mb-2">{{ __('Confirm Password') }}</p>
      <input type="password" id="password-confirm" name="password_confirmation"  class="text-sm rounded-6 w-100 py-3 px-3 border text-grayDark" >
    </label>            
    <button type="submit" class="btn-primary px-4 py-2 text-xs"><span class="d-block py-1">{{ __('Register') }}</span></button>
    <div class="or-text">{{__('OR')}}</div>
    <div class="text-xs text-muted text-center">
        {{__("Back to")}} <a href="{{route('login',$lang)}}">{{__('Login')}}</a>
    </div>
  </form>
</div>
@endsection
