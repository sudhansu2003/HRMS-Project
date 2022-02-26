@extends('layouts.admin')

@section('page-title')
    {{__('Manage Trip')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Travel')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('travel.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Trip')}}">
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
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Purpose of Visit')}}</th>
                                <th>{{__('Place Of Visit')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Travel') || Gate::check('Delete Travel'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($travels as $travel)
                                <tr>
                                    @role('company')
                                    <td>{{ !empty($travel->employee())?$travel->employee()->name:'' }}</td>
                                    @endrole
                                    <td>{{ \Auth::user()->dateFormat( $travel->start_date) }}</td>
                                    <td>{{ \Auth::user()->dateFormat( $travel->end_date) }}</td>
                                    <td>{{ $travel->purpose_of_visit }}</td>
                                    <td>{{ $travel->place_of_visit }}</td>
                                    <td>{{ $travel->description }}</td>
                                    @if(Gate::check('Edit Travel') || Gate::check('Delete Travel'))
                                        <td>
                                            @can('Edit Travel')
                                                <a href="#" data-url="{{ URL::to('travel/'.$travel->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Trip')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit Trip')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Travel')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$travel->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['travel.destroy', $travel->id],'id'=>'delete-form-'.$travel->id]) !!}
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

