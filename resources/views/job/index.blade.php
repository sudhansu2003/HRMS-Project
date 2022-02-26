@extends('layouts.admin')
@section('page-title')
    {{__('Manage Job')}}
@endsection
@push('script-page')
    <script>

        $('.copy_link').click(function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('Success', 'Url copied to clipboard', 'success');
        });
    </script>
@endpush
@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Job')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="{{ route('job.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-title="{{__('Create New Job')}}">
                    <i class="fa fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box"><i class="fas fa-users"></i></div>
                    <h4>{{__('Total Jobs')}}</h4>
                </div>
                <div class="number-icon">{{$data['total']}}</div>
            </div>

        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box green-bg"><i class="fas fa-tag"></i></div>
                    <h4>{{__('Active Jobs')}}</h4>
                </div>
                <div class="number-icon">{{$data['active']}}</div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box red-bg"><i class="fas fa-money-bill"></i></div>
                    <h4>{{__('Inactive Jobs')}}</h4>
                </div>
                <div class="number-icon">{{$data['in_active']}}</div>
            </div>

        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created At')}}</th>
                                @if( Gate::check('Edit Job') ||Gate::check('Delete Job') ||Gate::check('Show Job'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ !empty($job->branches)?$job->branches->name:__('All') }}</td>
                                    <td>{{$job->title}}</td>
                                    <td>{{\Auth::user()->dateFormat($job->start_date)}}</td>
                                    <td>{{\Auth::user()->dateFormat($job->end_date)}}</td>
                                    <td>
                                        @if($job->status=='active')
                                            <span class="badge badge-success">{{App\Models\job::$status[$job->status]}}</span>
                                        @else
                                            <span class="badge badge-danger">{{App\Models\job::$status[$job->status]}}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Auth::user()->dateFormat($job->created_at) }}</td>
                                    @if( Gate::check('Edit Job') ||Gate::check('Delete Job') || Gate::check('Show Job'))
                                        <td>
                                            @if($job->status!='in_active')
                                                <a href="{{ route('job.requirement',[$job->code,!empty($job)?$job->createdBy->lang:'en']) }}" class="edit-icon bg-info copy_link" data-toggle="tooltip" data-original-title="{{__('Click to copy')}}"><i class="fas fa-link"></i></a>
                                            @endif
                                            @can('Show Job')
                                                <a href="{{ route('job.show',$job->id) }}" data-title="{{__('Job Detail')}}" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="{{__('View Detail')}}"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('Edit Job')
                                                <a href="{{ route('job.edit',$job->id) }}" data-title="{{__('Edit Job')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Job')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$job->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['job.destroy', $job->id],'id'=>'delete-form-'.$job->id]) !!}
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

