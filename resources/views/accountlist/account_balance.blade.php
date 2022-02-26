@extends('layouts.admin')
@section('page-title')
    {{__('Manage Account Balances')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th>{{__('Account Name')}}</th>
                                <th>{{__('Initial Balance')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @php $totalInitialBalance = 0; @endphp
                            @foreach ($accountLists as $accountlist)
                                @php
                                    $totalInitialBalance = $accountlist->initial_balance + $totalInitialBalance;
                                @endphp
                                <tr>
                                    <td>{{ $accountlist->account_name }}</td>
                                    <td>{{  \Auth::user()->priceFormat($accountlist->initial_balance) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-left text-dark">{{__('Total')}}</td>
                                <td>{{ \Auth::user()->priceFormat($totalInitialBalance)   }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

