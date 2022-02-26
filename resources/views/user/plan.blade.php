<div class="card bg-none card-box">
    <div class="table-responsive">
        <table class="table table-striped mb-0 dataTable">
            @foreach($plans as $plan)
                <tr>
                    <td>{{$plan->name}} {{isset(\Auth::user()->planPrice()['stripe_currencys_symbol'])?\Auth::user()->planPrice()['stripe_currency_symbol'].$plan->price:''}} {{' / '. $plan->duration}}</td>
                    <td>{{__('Users')}} : {{$plan->max_users}}</td>
                    <td>{{__('Employees')}} : {{$plan->max_employees}}</td>
                    <td class="Action">
                        @if($user->plan==$plan->id)
                            <span class="btn badge-success btn-xs rounded-pill my-auto"><i class="fas fa-check text-white"></i></span>
                        @else
                            <a href="{{route('plan.active',[$user->id,$plan->id])}}" class="btn badge-blue btn-xs rounded-pill my-auto text-white" title="{{__('Click to Upgrade Plan')}}"><i class="fas fa-cart-plus"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
