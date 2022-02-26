@extends('layouts.admin')

@push('css-page')
@include('Chatify::layouts.headLinks')
@endpush

@section('page-title')
    {{__('Messenger')}}
@endsection

@section('content')

<div class="rounded-12">
    <div class="messenger rounded min-h-750 overflow-hidden mt-4 px-4">
        {{-- ----------------------Users/Groups lists side---------------------- --}}
        <div class="messenger-listView">
            {{-- Header and search bar --}}
            <div class="m-header">
                <nav>
                    <nav class="m-header-right">
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                {{-- Search input --}}
                <input type="text" class="messenger-search" placeholder="{{__('Search')}}" />
                {{-- Tabs --}}
                <div class="messenger-listView-tabs">
                    <a href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                         <span class="fas fa-clock" title="{{__('Recent')}}"></span>
                     </a>
                    <a href="#" @if($route == 'group') class="active-tab" @endif data-view="groups">
                        <span class="fas fa-users" title="{{__('Members')}}"></span></a>
                </div>
            </div>
            {{-- tabs and lists --}}
            <div class="m-body">
               {{-- Lists [Users/Group] --}}
               {{-- ---------------- [ User Tab ] ---------------- --}}
               <div class="@if($route == 'user') show @endif messenger-tab app-scroll" data-view="users">

                   {{-- Favorites --}}
                    <p class="messenger-title">Favorites</p>
                    <div class="messenger-favorites app-scroll-thin"></div>

                   {{-- Saved Messages --}}
                   {!! view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}

                   {{-- Contact --}}
                   <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

               </div>

               {{-- ---------------- [ Group Tab ] ---------------- --}}
               <div class="all_members @if($route == 'group') show @endif messenger-tab app-scroll" data-view="groups">
                        <p style="text-align: center;color:grey;">{{__('Soon will be available')}}</p>
                    </div>

                 {{-- ---------------- [ Search Tab ] ---------------- --}}
               <div class="messenger-tab app-scroll" data-view="search">
                    {{-- items --}}
                    <p class="messenger-title">{{__('Search')}}</p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span>{{__('Type to search..')}}</span></p>
                    </div>
                 </div>
            </div>
        </div>

        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging">
                <nav>
                    {{-- header back button, avatar and user name --}}
                    <div style="display: inline-block;">
                            <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i> </a>
                            @if(!empty(Auth::user()->avatar))
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('{{ asset('/storage/uploads/avatar/'.Auth::user()->avatar) }}');"></div>
                            @else
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('{{ asset('/storage/uploads/avatar/avatar.png') }}');"></div>
                            @endif
                            <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                        </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite my-lg-1 my-xl-1 mx-lg-3 mx-xl-3"><i class="fas fa-star"></i></a>
                        <a href="#" class="show-infoSide my-lg-1 my-xl-1 mx-lg-3 mx-xl-3"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
            </div>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">{{__('Connected')}}</span>
                <span class="ic-connecting">{{__('Connecting...')}}</span>
                <span class="ic-noInternet">{{__('No internet access')}}</span>
            </div>
            {{-- Messaging area --}}
            <div class="m-body app-scroll">
                <div class="messages">
                    <p class="message-hint" style="margin-top: calc(30% - 126.2px);"><span>{{__('Please select a chat to start messaging')}}</span></p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <p>
                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- Send Message Form --}}
                @include('Chatify::layouts.sendForm')
            </div>
        </div>
        {{-- ---------------------- Info side ---------------------- --}}
        <div class="messenger-infoView app-scroll text-center">
            {{-- nav actions --}}
            <nav class="text-left">
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            {!! view('Chatify::layouts.info')->render() !!}
        </div>
    </div>
</div>
@endsection

@push('theme-script')
    @include('Chatify::layouts.modals')
@endpush
