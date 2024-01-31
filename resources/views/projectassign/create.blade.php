<div class="card bg-none card-box">
    {{ Form::open(array('route' => array('projectdetails.store'))) }}
    <div class="row">
            <div class="form-group col-md-12">
                {{ Form::label('project_name', __('Project Name'),['class'=>'form-control-label']) }}
                {{ Form::text('project_name', '', ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        <div class="form-group col-md-6">
            {{ Form::label('client_name', __('Client Name'),['class'=>'form-control-label']) }}
            {{ Form::text('client_name', '', ['class' => 'form-control', 'required' => 'required']) }} 
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('deal_date', __('Deal Date'),['class'=>'form-control-label']) }}
            {{ Form::text('deal_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'),['class'=>'form-control-label']) }}
            {{ Form::text('start_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('estimated_delivery_date', __('Estimated Delivery Date'),['class'=>'form-control-label']) }}
            {{ Form::text('estimated_delivery_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('early_delivery', __('Early Delivery'),['class'=>'form-control-label']) }}
            {{ Form::text('early_delivery', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('late_delivery', __('Late Delivery'),['class'=>'form-control-label']) }}
            {{ Form::text('late_delivery', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="col-12">
        <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue" style="border-radius: 7px;">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
