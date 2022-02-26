<div class="card bg-none card-box">
    <div class="row">
        {{ Form::model($timeSheet, array('route' => array('timesheet.update', $timeSheet->id), 'method' => 'PUT')) }}
        <div class="row">
            @if(\Auth::user()->type != 'employee')
                <div class="form-group col-md-12">
                    {{ Form::label('employee_id', __('Employee'),['class'=>'form-control-label']) }}
                    {!! Form::select('employee_id', $employees, null,array('class' => 'form-control font-style select2','required'=>'required')) !!}
                </div>
            @endif
            <div class="form-group col-md-6">
                {{ Form::label('date', __('Date'),['class'=>'form-control-label']) }}
                {{ Form::text('date',null, array('class' => 'form-control datepicker','required'=>'required')) }}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('hours', __('Hours'),['class'=>'form-control-label']) }}
                {{ Form::number('hours',null, array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
            </div>
            <div class="form-group  col-md-12">
                {{ Form::label('remark', __('Remark'),['class'=>'form-control-label']) }}
                {!! Form::textarea('remark', null, ['class'=>'form-control','rows'=>'2']) !!}
            </div>
            <div class="col-12">
                <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
