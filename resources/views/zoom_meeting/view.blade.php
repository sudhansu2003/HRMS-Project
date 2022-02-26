<div class="card card-box">

    <div class="tab-content tab-bordered">
        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Name') }}</span></dt>
                                <dd class="col-sm-8"><span
                                        class="text-sm">{{ $ZoomMeeting->title }}</span></dd>


                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Meeting Id') }}</span>
                                </dt>
                                <dd class="col-sm-8"><span
                                        class="text-sm">{{ $ZoomMeeting->meeting_id }}</span></dd>



                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('User') }}</span></dt>
                                <dd class="col-sm-8"><span
                                        class="text-sm">{{ !empty($ZoomMeeting->getUserInfo) ? $ZoomMeeting->getUserInfo->name : '' }}</span>
                                </dd>

                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Start Date') }}</span>
                                </dt>
                                <dd class="col-sm-8"><span
                                        class="text-sm">{{ \Auth::user()->dateFormat($ZoomMeeting->start_date) }}</span>
                                </dd>

                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Duration') }}</span>
                                </dt>
                                <dd class="col-sm-8"><span
                                        class="text-sm">{{ $ZoomMeeting->duration }}</span></dd>

                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Start URl') }}</span>
                                </dt>
                                <dd class="col-sm-8"><span class="text-sm">
                                        @if ($ZoomMeeting->created_by == \Auth::user()->id && $ZoomMeeting->checkDateTime())
                                            <a href="{{ $ZoomMeeting->start_url }}" target="_blank">
                                                {{ __('Start meeting') }} <i
                                                    class="fas fa-external-link-square-alt "></i></a>
                                        @elseif($ZoomMeeting->checkDateTime())
                                            <a href="{{ $ZoomMeeting->join_url }}" target="_blank">
                                                {{ __('Join meeting') }} <i
                                                    class="fas fa-external-link-square-alt "></i></a>
                                        @else
                                            -
                                        @endif
                                    </span></dd>

                                <dt class="col-sm-4"><span class="h6 text-sm mb-0">{{ __('Status') }}</span>
                                </dt>
                                <dd class="col-sm-8">
                                    @if ($ZoomMeeting->checkDateTime())
                                        @if ($ZoomMeeting->status == 'waiting')
                                            <span class="badge badge-info">{{ ucfirst($ZoomMeeting->status) }}</span>
                                        @else
                                            <span
                                                class="badge badge-success">{{ ucfirst($ZoomMeeting->status) }}</span>
                                        @endif
                                    @else
                                        <span class="badge badge-danger">{{ __('End') }}</span>
                                    @endif
                                </dd>

                            </dl>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
