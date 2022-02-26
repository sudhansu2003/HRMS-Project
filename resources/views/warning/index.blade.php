@extends('layouts.admin')

@section('page-title')
    {{__('Manage Warning')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Warning')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('warning.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Warning')}}">
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
                                <th>{{__('Warning By')}}</th>
                                <th>{{__('Warning To')}}</th>
                                <th>{{__('Subject')}}</th>
                                <th>{{__('Warning Date')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Warning') || Gate::check('Delete Warning'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($warnings as $warning)
                                <tr>
                                    <td>{{!empty( $warning->WarningBy($warning->warning_by))? $warning->WarningBy($warning->warning_by)->name:'' }}</td>
                                    <td>{{ !empty($warning->warningTo($warning->warning_to))?$warning->warningTo($warning->warning_to)->name:'' }}</td>
                                    <td>{{ $warning->subject }}</td>
                                    <td>{{  \Auth::user()->dateFormat($warning->warning_date) }}</td>
                                    <td>{{ $warning->description }}</td>
                                    @if(Gate::check('Edit Warning') || Gate::check('Delete Warning'))
                                        <td>
                                            @can('Edit Warning')
                                                <a href="#" data-url="{{ URL::to('warning/'.$warning->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Warning')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Warning')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$warning->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['warning.destroy', $warning->id],'id'=>'delete-form-'.$warning->id]) !!}
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

