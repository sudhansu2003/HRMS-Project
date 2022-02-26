<div class="card bg-none card-box">
    {{Form::open(array('url'=>'travel','method'=>'post'))}}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('employee_id', __('Employee'),['class'=>'form-control-label'])}}
            {{ Form::select('employee_id', $employees,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('start_date',__('Start Date'),['class'=>'form-control-label'])}}
            {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('end_date',__('End Date'),['class'=>'form-control-label'])}}
            {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('purpose_of_visit',__('Purpose of Visit'),['class'=>'form-control-label'])}}
            {{Form::text('purpose_of_visit',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('place_of_visit',__('Place Of Visit'),['class'=>'form-control-label'])}}
            {{Form::text('place_of_visit',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
