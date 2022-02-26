@extends('layouts.admin')

@section('page-title')
    {{__('Manage Resignation')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Resignation')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('resignation.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Resignation')}}">
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
                                <th>{{__('Notice Date')}}</th>
                                <th>{{__('Resignation Date')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Resignation') || Gate::check('Delete Resignation'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($resignations as $resignation)
                                <tr>
                                    @role('company')
                                    <td>{{ !empty($resignation->employee())?$resignation->employee()->name:'' }}</td>
                                    @endrole
                                    <td>{{  \Auth::user()->dateFormat($resignation->notice_date) }}</td>
                                    <td>{{  \Auth::user()->dateFormat($resignation->resignation_date) }}</td>
                                    <td>{{ $resignation->description }}</td>
                                    @if(Gate::check('Edit Resignation') || Gate::check('Delete Resignation'))
                                        <td>
                                            @can('Edit Resignation')
                                                <a href="#" data-url="{{ URL::to('resignation/'.$resignation->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Resignation')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Resignation')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$resignation->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['resignation.destroy', $resignation->id],'id'=>'delete-form-'.$resignation->id]) !!}
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

