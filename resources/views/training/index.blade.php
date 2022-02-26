@extends('layouts.admin')

@section('page-title')
    {{__('Manage Training')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Training')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('training.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Training')}}">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <a href="{{ route('training.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fa fa-file-excel"></i> {{ __('Export') }}
            </a>
        </div>
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
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Training Type')}}</th>
                                <th>{{__('Employee')}}</th>
                                <th>{{__('Trainer')}}</th>
                                <th>{{__('Training Duration')}}</th>
                                <th>{{__('Cost')}}</th>
                                @if( Gate::check('Edit Training') ||Gate::check('Delete Training') ||Gate::check('Show Training'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($trainings as $training)
                                <tr>
                                    <td>{{ !empty($training->branches)?$training->branches->name:'' }}</td>
                                    <td>{{ !empty($training->types)?$training->types->name:'' }} <br>
                                        @if($training->status == 0)
                                            <span class="text-warning">{{ __($status[$training->status]) }}</span>
                                        @elseif($training->status == 1)
                                            <span class="text-primary">{{ __($status[$training->status]) }}</span>
                                        @elseif($training->status == 2)
                                            <span class="text-success">{{ __($status[$training->status]) }}</span>
                                        @elseif($training->status == 3)
                                            <span class="text-info">{{ __($status[$training->status]) }}</span>
                                        @endif

                                    </td>
                                    <td>{{ !empty($training->employees)?$training->employees->name:'' }} </td>
                                    <td>{{ !empty($training->trainers)?$training->trainers->firstname:'' }}</td>
                                    <td>{{\Auth::user()->dateFormat($training->start_date) .' to '.\Auth::user()->dateFormat($training->end_date)}}</td>
                                    <td>{{\Auth::user()->priceFormat($training->training_cost)}}</td>
                                    @if( Gate::check('Edit Training') ||Gate::check('Delete Training') || Gate::check('Show Training'))
                                        <td>
                                            @can('Show Training')
                                                <a href="{{ route('training.show',\Illuminate\Support\Facades\Crypt::encrypt($training->id)) }}" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="{{__('View Detail')}}"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('Edit Training')
                                                <a href="#" data-url="{{ route('training.edit',$training->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Training')}}" data-toggle="tooltip" data-original-title="{{__('Edit ')}}" class="edit-icon"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Training')
                                                <a href="#" class="delete-icon" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$training->id}}').submit();" data-toggle="tooltip" data-original-title="{{__('Delete')}}"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['training.destroy', $training->id],'id'=>'delete-form-'.$training->id]) !!}
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



