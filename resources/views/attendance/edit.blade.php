
<div class="card bg-none card-box">
    {{Form::model($attendanceEmployee,array('route' => array('attendanceemployee.update', $attendanceEmployee->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 ">
            {{Form::label('employee_id',__('Employee'))}}
            {{Form::select('employee_id',$employees,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('date',__('Date'))}}
            {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
        </div>

        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('clock_in',__('Clock In'))}}
            {{Form::text('clock_in',null,array('class'=>'form-control timepicker'))}}
        </div>

        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('clock_out',__('Clock Out'))}}
            {{Form::text('clock_out',null,array('class'=>'form-control timepicker'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>


