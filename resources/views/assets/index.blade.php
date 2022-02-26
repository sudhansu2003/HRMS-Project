@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Assets') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Assets')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('account-assets.create') }}"
                        class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                        data-title="{{ __('Create Assets') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('assets.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                    data-url="{{ route('assets.file.import') }}" data-ajax-popup="true"
                    data-title="{{ __('Import  Asset CSV file') }}">
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
                                    <th> {{ __('Name') }}</th>
                                    <th> {{ __('Purchase Date') }}</th>
                                    <th> {{ __('Support Until') }}</th>
                                    <th> {{ __('Amount') }}</th>
                                    <th> {{ __('Description') }}</th>
                                    @if (Gate::check('Edit Assets') || Gate::check('Delete Assets'))
                                        <th> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assets as $asset)
                                    <tr>
                                        <td class="font-style">{{ $asset->name }}</td>
                                        <td class="font-style">{{ \Auth::user()->dateFormat($asset->purchase_date) }}
                                        </td>
                                        <td class="font-style">
                                            {{ \Auth::user()->dateFormat($asset->supported_date) }}</td>
                                        <td class="font-style">{{ \Auth::user()->priceFormat($asset->amount) }}</td>
                                        <td class="font-style">{{ $asset->description }}</td>
                                        @if (Gate::check('Edit Assets') || Gate::check('Delete Assets'))
                                            <td>
                                                @can('Edit Assets')
                                                    <a href="#" class="edit-icon"
                                                        data-url="{{ route('account-assets.edit', $asset->id) }}"
                                                        data-ajax-popup="true" data-title="{{ __('Edit Assets') }}"
                                                        data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('Delete Assets')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $asset->id }}').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['account-assets.destroy', $asset->id], 'id' => 'delete-form-' . $asset->id]) !!}
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

@push('script-page')
    <script>
        $(document).ready(function() {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {
                    format: 'YYYY-MM-DD'
                },
            });
        });
    </script>
@endpush
