@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Performance Type') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Department')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('performanceType.create') }}"
                    class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                    data-title="{{ __('Create New Performance Type') }}">
                    <i class="fa fa-plus"></i> {{ __('Create') }}
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
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($performance_types as $performance_type)
                                <tr>
                                    <td>{{ $performance_type->name }}</td>
                                    <td class="Action">
                                        <span>
                                            @can('Edit Performance Type')
                                                <a href="#" data-url="{{ URL::to('performanceType/'.$performance_type->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Department')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Performance Type')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$performance_type->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['performanceType.destroy', $performance_type->id],'id'=>'delete-form-'.$performance_type->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </span>
                                    </td>
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
