@extends('layouts.admin')

@section('page-title')
    {{__('Manage Complain')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Complaint')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('complaint.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Complaint')}}">
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
                                <th>{{__('Complaint From')}}</th>
                                <th>{{__('Complaint Against')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Complaint Date')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Complaint') || Gate::check('Delete Complaint'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($complaints as $complaint)

                                <tr>
                                    <td>{{!empty( $complaint->complaintFrom($complaint->complaint_from))? $complaint->complaintFrom($complaint->complaint_from)->name:'' }}</td>
                                    <td>{{ !empty($complaint->complaintAgainst($complaint->complaint_against))?$complaint->complaintAgainst($complaint->complaint_against)->name:'' }}</td>
                                    <td>{{ $complaint->title }}</td>
                                    <td>{{ \Auth::user()->dateFormat( $complaint->complaint_date) }}</td>
                                    <td>{{ $complaint->description }}</td>
                                    @if(Gate::check('Edit Complaint') || Gate::check('Delete Complaint'))
                                        <td>
                                            @can('Edit Complaint')
                                                <a href="#" data-url="{{ URL::to('complaint/'.$complaint->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Complaint')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Complaint')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$complaint->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['complaint.destroy', $complaint->id],'id'=>'delete-form-'.$complaint->id]) !!}
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

