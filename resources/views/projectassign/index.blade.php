@extends('layouts.admin')

@section('page-title')
    {{__('Project Details')}}
@endsection

@section('action-button')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                        <div class="all-button-box row d-flex justify-content-end">
                            @can('Create Project Assign')
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="all-button-box d-flex justify-content-end">
                                        <a href="#" data-url="{{ route('projectdetails.create') }}"
                                            class="btn btn-sm btn-white btn-icon-only" 
                                            data-ajax-popup="true"
                                            data-title="{{ __('Create New Project') }}">
                                            <i class="fa fa-plus"></i> {{ __('Create') }}
                                        </a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th>{{__('Project ID')}}</th>
                                <th>{{__('Project Name')}}</th>
                                <th>{{__('Client Name')}}</th>
                                <th>{{__('Deal Date')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('Estimated Delivery Date')}}</th>
                                <th>{{__('Actual Delivery Date')}}</th>
                                <th>{{__('Early Delivery')}}</th>
                                <th>{{__('Late Delivery')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result as $project)
                                    <tr>
                                        <td>{{ $project['project_id'] }}</td>
                                        <td>{{ $project['project_name'] }}</td>
                                        <td>{{ $project['client_name'] }}</td>
                                        <td>{{ $project['deal_date'] }}</td>
                                        <td>{{ $project['start_date'] }}</td>
                                        <td>{{ $project['estimated_delivery_date'] }}</td>
                                        <td>{{ $project['actual_delivery_date'] }}</td>
                                        <td>{{ $project['early_delivery'] }}</td>
                                        <td>{{ $project['late_delivery'] }}</td>
                                        <td>
                                            @can('Edit Project Assign')
                                                <a href="#" data-url="{{ route('projectdetail.edit',['project_id' => $project->project_id] ) }}"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Project Details') }}" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('Delete Project Assign')
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $project->project_id }}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['projectdetail.destroy', 'project_id' => $project->project_id], 'id' => 'delete-form-' . $project->project_id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('Create Project Assign')
                                                <a href="#" data-url="{{ route('projectassigns.assignproject',['project_id' => $project->project_id]) }}" class="create-project-assign-icon" data-ajax-popup="true" data-title="{{ __('Assign Project') }}" data-toggle="tooltip" data-original-title="{{ __('Assign Project') }}">
                                                    <i class="fas fa-tasks"></i>
                                                </a>
                                            @endcan
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


