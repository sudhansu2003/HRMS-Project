@extends('layouts.admin')

@section('page-title')
    {{__('Manage Transfer')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Transfer')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('transfer.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Transfer')}}">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
            </div>
        @endcan
    </div>
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
                                @role('company')
                                <th>{{__('Employee Name')}}</th>
                                @endrole
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>{{__('Transfer Date')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Transfer') || Gate::check('Delete Transfer'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($transfers as $transfer)
                                <tr>
                                    @role('company')
                                    <td>{{ !empty($transfer->employee())?$transfer->employee()->name:'' }}</td>
                                    @endrole
                                    <td>{{ !empty($transfer->branch())?$transfer->branch()->name:'' }}</td>
                                    <td>{{ !empty($transfer->department())?$transfer->department()->name:'' }}</td>
                                    <td>{{  \Auth::user()->dateFormat($transfer->transfer_date) }}</td>
                                    <td>{{ $transfer->description }}</td>
                                    @if(Gate::check('Edit Transfer') || Gate::check('Delete Transfer'))
                                        <td>
                                            @can('Edit Transfer')
                                                <a href="#" data-url="{{ URL::to('transfer/'.$transfer->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Transfer')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Transfer')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$transfer->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['transfer.destroy', $transfer->id],'id'=>'delete-form-'.$transfer->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

