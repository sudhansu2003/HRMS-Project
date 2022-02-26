<div class="card bg-none card-box">
    {{Form::open(array('url'=>'loan','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('loan_option', __('Loan Options*'),['class'=>'form-control-label']) }}
            {{ Form::select('loan_option',$loan_options,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Loan Amount'),['class'=>'form-control-label']) }}
            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'),['class'=>'form-control-label']) }}
            {{ Form::text('start_date',null, array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'),['class'=>'form-control-label']) }}
            {{ Form::text('end_date',null, array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('reason', __('Reason'),['class'=>'form-control-label']) }}
            {{ Form::textarea('reason',null, array('class' => 'form-control','rows'=>1,'required'=>'required')) }}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
