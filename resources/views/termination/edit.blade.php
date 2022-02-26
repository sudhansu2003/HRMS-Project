<div class="card bg-none card-box">
    {{Form::model($termination,array('route' => array('termination.update', $termination->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group  col-lg-6 col-md-6">
            {{ Form::label('employee_id', __('Employee'),['class'=>'form-control-label'])}}
            {{ Form::select('employee_id', $employees,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{ Form::label('termination_type', __('Termination Type')),['class'=>'form-control-label'] }}
            {{ Form::select('termination_type', $terminationtypes,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{Form::label('notice_date',__('Notice Date'),['class'=>'form-control-label'])}}
            {{Form::text('notice_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{Form::label('termination_date',__('Termination Date'),['class'=>'form-control-label'])}}
            {{Form::text('termination_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group  col-lg-12">
            {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
