@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Trainer') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Trainer')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('trainer.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="{{ __('Create New Trainer') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('trainer.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                    data-url="{{ route('trainer.file.import') }}" data-ajax-popup="true"
                    data-title="{{ __('Import Trainer CSV file') }}">
                    <i class="fa fa-file-csv"></i> {{ __('Import') }}
                </a>
            </div>
        </div>
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
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Full Name') }}</th>
                                    <th>{{ __('Contact') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    @if (Gate::check('Edit Trainer') || Gate::check('Delete Trainer') || Gate::check('Show Trainer'))
                                        <th width="200px">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($trainers as $trainer)
                                    <tr>
                                        <td>{{ !empty($trainer->branches) ? $trainer->branches->name : '' }}</td>
                                        <td>{{ $trainer->firstname . ' ' . $trainer->lastname }}</td>
                                        <td>{{ $trainer->contact }}</td>
                                        <td>{{ $trainer->email }}</td>
                                        @if (Gate::check('Edit Trainer') || Gate::check('Delete Trainer') || Gate::check('Show Trainer'))
                                            <td>
                                                @can('Show Trainer')
                                                    <a href="#" data-url="{{ route('trainer.show', $trainer->id) }}"
                                                        data-size="lg" data-ajax-popup="true"
                                                        data-title="{{ __('Trainer Detail') }}" class="edit-icon bg-success"
                                                        data-toggle="tooltip"
                                                        data-original-title="{{ __('View Detail') }}"><i
                                                            class="fas fa-eye"></i></a>
                                                @endcan
                                                @can('Edit Trainer')
                                                    <a href="#" data-url="{{ route('trainer.edit', $trainer->id) }}"
                                                        data-size="lg" data-ajax-popup="true"
                                                        data-title="{{ __('Edit Trainer') }}" class="edit-icon"
                                                        data-toggle="tooltip" data-original-title="{{ __('Edit') }}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('Delete Trainer')
                                                    <a href="#" class="delete-icon"
                                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $trainer->id }}').submit();"
                                                        data-toggle="tooltip" data-original-title="{{ __('Delete') }}"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['trainer.destroy', $trainer->id], 'id' => 'delete-form-' . $trainer->id]) !!}
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
