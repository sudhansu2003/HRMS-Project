@extends('layouts.admin')
@section('page-title')
    {{__('Manage Plan')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Plan')
            @if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="{{ route('plans.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Plan')}}" data-original-title="{{__('Create Plan')}}">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            @endif
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                <div class="plan-3">
                    <h6>{{$plan->name}}</h6>
                    <p class="price">
                        <sup>{{(\Auth::user()->planPrice()['stripe_currency_symbol'])?\Auth::user()->planPrice()['stripe_currency_symbol']:'$'}}</sup>
                        {{$plan->price}}
                        <sub>{{__('Duration : ').ucfirst($plan->duration)}}</sub>
                    </p>
                    <p class="price-text"></p>
                    <ul class="plan-detail">
                        <li>{{$plan->max_users}} {{__('Users')}}</li>
                        <li>{{$plan->max_employees}} {{__('Employees')}}</li>
                    </ul>
                    @can('Edit Plan')
                        <a title="{{__('Edit Plan')}}" href="#" class="button text-xs" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                            <i class="far fa-edit"></i>
                        </a>
                    @endcan
                    @if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))
                        @can('Buy Plan')
                            @if($plan->id != \Auth::user()->plan)
                                @if($plan->price > 0)
                                    <a href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}" class="button text-xs">{{__('Buy Plan')}}</a>
                                @else
                                    <a href="#" class="button text-xs">{{__('Free')}}</a>
                                @endif
                            @endif
                        @endcan
                    @endif
                    @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                        <p class="server-plan text-white">
                            {{__('Plan Expired : ') }} {{!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'}}
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

