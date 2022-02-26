@extends('layouts.admin')

@section('page-title')
    {{__('Manage Award')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Award')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('award.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Award')}}">
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
                                <th>{{__('Employee')}}</th>
                                @endrole
                                <th>{{__('Award Type')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Gift')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Award') || Gate::check('Delete Award'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($awards as $award)
                                <tr>
                                    @role('company')
                                    <td>{{!empty( $award->employee())? $award->employee()->name:'' }}</td>
                                    @endrole
                                    <td>{{ !empty($award->awardType())?$award->awardType()->name:'' }}</td>
                                    <td>{{  \Auth::user()->dateFormat($award->date )}}</td>
                                    <td>{{ $award->gift }}</td>
                                    <td>{{ $award->description }}</td>

                                    @if(Gate::check('Edit Award') || Gate::check('Delete Award'))
                                        <td class="Action">
                                            <span>
                                                @can('Edit Award')
                                                    <a href="#" data-url="{{ URL::to('award/'.$award->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Award')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('Delete Award')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$award->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['award.destroy', $award->id],'id'=>'delete-form-'.$award->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </span>
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

