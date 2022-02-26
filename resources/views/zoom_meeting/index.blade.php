@extends('layouts.admin')

@section('page-title')
    {{ __('Zoom Meeting') }}
@endsection

<style>
    .ranges {
        display: none;
    }
</style>


@section('action-button')
      
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
        <div class="all-button-box">
            <a href="{{ route('zoom_meeting.calender') }}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="far fa-calendar-alt"></i> {{__('Calendar View')}} </a>
        </div>
    </div>

    @if (\Auth::user()->type == 'company')
        <a href="#" data-url="{{ route('zoom-meeting.create') }}" data-size="xl" data-ajax-popup="true"
            data-title="{{ __('Create New Zoom Meeting') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fa fa-plus"></i> {{ __('Create') }}
        </a>
    @endif
@endsection
@section('content')

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center dataTable">
                <thead>
                    <tr>
                        <th >{{ __('Title') }}</th>
                        <th >{{ __('Meeting Time') }}</th>
                        <th >{{ __('Duration') }}</th>
                        <th >{{ __('User') }}</th>
                        <th >{{ __('Join URL') }}</th>
                        <th >{{ __('Status') }}</th>    
                        <th class="text-right"> {{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ZoomMeetings as $ZoomMeeting)
                    <tr>
                        <td>{{ $ZoomMeeting->title }}</td>
                        <td>{{ $ZoomMeeting->start_date }}</td>
                        <td>{{ $ZoomMeeting->duration }} {{ __(' Minute') }}</td>
                       

                        {{-- <td>
                            {{ $ZoomMeeting->user_detail($ZoomMeeting->user_id) }}
                        </td> --}}

                        <td>
                            <div class="avatar-group">
                                @foreach ($ZoomMeeting->users($ZoomMeeting->user_id) as $projectUser)
                                    <a href="#" class="avatar rounded-circle avatar-sm avatar-group">
                                        <img alt="" @if (!empty($users->avatar)) src="{{ $profile . '/' . $projectUser->avatar }}" @else  avatar="{{ !empty($projectUser) ? $projectUser->name : '' }}" @endif
                                            data-original-title="{{ !empty($projectUser) ? $projectUser->name : '' }}"
                                            data-toggle="tooltip"
                                            data-original-title="{{ !empty($projectUser) ? $projectUser->name : '' }}"
                                            class="">
                                    </a>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            @if($ZoomMeeting->created_by == \Auth::user()->id && $ZoomMeeting->checkDateTime())
                            <a href="{{$ZoomMeeting->start_url}}" target="_blank"> {{__('Start meeting')}} <i class="fas fa-external-link-square-alt "></i></a>
                            @elseif($ZoomMeeting->checkDateTime())
                                <a href="{{$ZoomMeeting->join_url}}" target="_blank"> {{__('Join meeting')}} <i class="fas fa-external-link-square-alt "></i></a>
                            @else
                                -
                            @endif
                        </td>
                        
                      
                        <td>
                            @if($ZoomMeeting->checkDateTime())
                                @if($ZoomMeeting->status == 'waiting')
                                    <span class="badge badge-info">{{ucfirst($ZoomMeeting->status)}}</span>
                                @else
                                    <span class="badge badge-success">{{ucfirst($ZoomMeeting->status)}}</span>
                                @endif
                            @else
                                <span class="badge badge-danger">{{__("End")}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="actions ml-3 rtl-actions">
                               

                                <a href="#" class="action-item text-danger mr-2 emp_delete " data-toggle="tooltip" data-original-title="{{__('Delete')}}" 
                                data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                data-confirm-yes="document.getElementById('delete-form-{{$ZoomMeeting->id }}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['zoom-meeting.destroy', $ZoomMeeting->id],'id' => 'delete-form-'.$ZoomMeeting->id ]) !!}
                                {!! Form::close() !!}
                                <span class="clearfix"></span>
                            </div>
                        </td>
                    </tr>                                
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('script-page')
    <script>
        function ddatetime_range() 
        {
            $('.datetime_class_start_date').daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "autoApply": false,
                "locale": {
                    "format": 'YYYY-MM-DD H:mm'
                },
                "timePicker24Hour": true,
            }, function(start, end, label) {
                $('.start_date').val(start.format('YYYY-MM-DD H:mm'));
            });
        }
    </script>
@endpush
