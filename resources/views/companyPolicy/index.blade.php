@extends('layouts.admin')

@section('page-title')
    {{__('Manage Company Policy')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Company Policy')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('company-policy.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Company Policy')}}">
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
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Attachment')}}</th>
                                @if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($companyPolicy as $policy)
                                @php
                                    $policyPath=asset(Storage::url('uploads/companyPolicy'));
                                @endphp
                                <tr>
                                    <td>{{ !empty($policy->branches)?$policy->branches->name:'' }}</td>
                                    <td>{{ $policy->title }}</td>
                                    <td>{{ $policy->description }}</td>
                                    <td>
                                        @if(!empty($policy->attachment))
                                            <a href="{{$policyPath.'/'.$policy->attachment}}" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    @if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy'))
                                        <td>
                                            @can('Edit Company Policy')
                                                <a href="#" data-url="{{ route('company-policy.edit',$policy->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Company Policy')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Company Policy')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$policy->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['company-policy.destroy', $policy->id],'id'=>'delete-form-'.$policy->id]) !!}
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

