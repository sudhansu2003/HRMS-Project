<div class="card bg-none card-box">
    {{ Form::model($ZoomMeeting, ['route' => ['zoom-meeting.update', $ZoomMeeting->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('', __('Title'), ['class' => 'form-control-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control', 'required' => false]) }}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group select2_option">
                {{ Form::label('', __('User'), ['class' => 'form-control-label']) }}
                {!! Form::select('user_id', $employee_option, null, ['required' => true, 'data-placeholder' => 'Yours Placeholder', 'class' => 'form-control js-multiple-select']) !!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('', __('Start Date'), ['class' => 'form-control-label']) }}
                {!! Form::text('start_date1', $ZoomMeeting->start_date, ['class' => 'form-control datetime_class datetime_class_start_date']) !!}
                <input type="hidden" name="start_date" class="start_date" value="{{ $ZoomMeeting->start_date }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('', __('Duration'), ['class' => 'form-control-label']) }}
                {!! Form::number('duration', null, ['class' => 'form-control', 'required' => true, 'min' => 0]) !!}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('', __('Password'), ['class' => 'form-control-label']) }}
                <input type="password" name="password" class="form-control" value="{{ $ZoomMeeting->password }}">
                
            </div>
        </div>
       
       
        <div class="col-12">
            <div class="form-group text-right">
                <input type="submit" class="btn btn-sm btn-primary rounded-pill mr-auto" value="{{ __('Save') }}"
                    data-ajax-popup="true">
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
