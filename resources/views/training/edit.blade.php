<div class="card bg-none card-box">
    {{Form::model($training,array('route' => array('training.update', $training->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class'=>'form-control-label'])}}
                {{Form::select('branch',$branches,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('trainer_option',__('Trainer Option'),['class'=>'form-control-label'])}}
                {{Form::select('trainer_option',$options,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('training_type',__('Training Type'),['class'=>'form-control-label'])}}
                {{Form::select('training_type',$trainingTypes,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('trainer',__('Trainer'),['class'=>'form-control-label'])}}
                {{Form::select('trainer',$trainers,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('training_cost',__('Training Cost'),['class'=>'form-control-label'])}}
                {{Form::number('training_cost',null,array('class'=>'form-control','step'=>'0.01','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('employee',__('Employee'),['class'=>'form-control-label'])}}
                {{Form::select('employee',$employees,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Start Date'),['class'=>'form-control-label'])}}
                {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('End Date'),['class'=>'form-control-label'])}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Description')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
