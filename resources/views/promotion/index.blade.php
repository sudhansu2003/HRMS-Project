@extends('layouts.admin')

@section('page-title')
    {{__('Manage Promotion')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Promotion')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('promotion.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Promotion')}}">
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
                                <th>{{__('Designation')}}</th>
                                <th>{{__('Promotion Title')}}</th>
                                <th>{{__('Promotion Date')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($promotions as $promotion)
                                <tr>
                                    @role('company')
                                    <td>{{ !empty($promotion->employee())?$promotion->employee()->name:'' }}</td>
                                    @endrole
                                    <td>{{ !empty($promotion->designation())?$promotion->designation()->name:'' }}</td>
                                    <td>{{ $promotion->promotion_title }}</td>
                                    <td>{{  \Auth::user()->dateFormat($promotion->promotion_date) }}</td>
                                    <td>{{ $promotion->description }}</td>
                                    @if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion'))
                                        <td>
                                            @can('Edit Promotion')
                                                <a href="#" data-url="{{ URL::to('promotion/'.$promotion->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Promotion')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Promotion')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$promotion->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['promotion.destroy', $promotion->id],'id'=>'delete-form-'.$promotion->id]) !!}
                                                {!! Form::close() !!}
                                            @endif
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

