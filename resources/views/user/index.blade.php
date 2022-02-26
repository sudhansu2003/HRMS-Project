@extends('layouts.admin')
@section('page-title')
    @if(\Auth::user()  ->type=='super admin')
        {{__('Manage Companies')}}
    @else
        {{__('Manage Users')}}
    @endif
@endsection

@section('action-button')
    @can('Create User')
        <div class="all-button-box row d-flex justify-content-end">
            @if(\Auth::user()->type=='super admin')
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="{{ route('user.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New Company')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            @else
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="{{ route('user.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New User')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            @endif
        </div>
    @endcan
@endsection

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@section('content')
    <div class="row">
        @foreach($users as $user)
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="card profile-card">
                    @if(Gate::check('Edit User') || Gate::check('Delete User'))
                        <div class="edit-profile user-text">
                            <div class="dropdown action-item">
                                <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @can('Edit User')
                                        <a href="#" data-url="{{ route('user.edit',$user->id) }}" class="dropdown-item text-sm" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Edit User')}}" data-original-title="{{ __('Edit User') }}">{{__('Edit')}}</a>
                                    @endcan
                                    @can('Delete User')
                                        <a href="#" class="dropdown-item text-sm" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$user->id}}').submit();">{{__('Delete')}}</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id],'id'=>'delete-form-'.$user->id]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="avatar-parent-child">
                        <img src="{{(!empty($user->avatar)? $profile.'/'.$user->avatar : $profile.'/avatar.png')}}" class="avatar rounded-circle avatar-xl">
                    </div>
                    <h4 class="h4 mb-0 mt-2">{{ $user->name }}</h4>
                    <h5 class="office-time mb-0">{{ $user->company_name }}</h5>
                    <div class="sal-right-card">
                        <span class="badge badge-pill badge-blue">{{ $user->type }}</span>
                    </div>
                    <h6 class="office-time mb-0 mt-4">{{ $user->email }}</h6>

                    @if(\Auth::user()->type == 'super admin')
                        <div class="mt-4">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-6 text-center">
                                    <span class="d-block font-weight-bold mb-0">{{!empty($user->currentPlan)?$user->currentPlan->name:''}}</span>
                                </div>
                                <div class="col-6 text-center Id">
                                    <a href="#" data-url="{{ route('plan.upgrade',$user->id) }}" data-ajax-popup="true" data-title="{{__('Upgrade Plan')}}">{{__('Upgrade Plan')}}</a>
                                </div>
                                <div class="col-12">
                                    <hr class="my-3">
                                </div>
                                <div class="col-12 text-center pb-2">
                                    <span class="text-dark text-xs">{{__('Plan Expire : ') }} {{!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'}}</span>
                                </div>
                                <div class="col-6 text-center">
                                    <span class="d-block text-sm font-weight-bold mb-0">{{\Auth::user()->countUsers()}}</span>
                                    <span class="d-block text-sm text-muted">{{__('Users')}}</span>
                                </div>
                                <div class="col-6 text-center">
                                    <span class="d-block text-sm font-weight-bold mb-0">{{\Auth::user()->countEmployees()}}</span>
                                    <span class="d-block text-sm text-muted">{{__('Employees')}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection


