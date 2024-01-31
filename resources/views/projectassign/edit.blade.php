<!-- Include necessary datepicker stylesheets and scripts -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Your other head elements -->

<div class="card bg-none card-box">
{{ Form::open(array('route' => array('projectdetail.update', $project->project_id), 'method' => 'patch')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('project_name', __('Project Name'), ['class'=>'form-control-label']) }}
            {{ Form::text('project_name', $project->project_name, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('client_name', __('Client Name'), ['class'=>'form-control-label']) }}
            {{ Form::text('client_name', $project->client_name, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('deal_date', __('Deal Date'), ['class'=>'form-control-label']) }}
            {{ Form::text('deal_date', $project->deal_date, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class'=>'form-control-label']) }}
            {{ Form::text('start_date', $project->start_date, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('estimated_delivery_date', __('Estimated Delivery Date'), ['class'=>'form-control-label']) }}
            {{ Form::text('estimated_delivery_date', $project->estimated_delivery_date, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('actual_delivery', __('Actual Delivery Date'), ['class'=>'form-control-label']) }}
            {{ Form::text('actual_delivery', $project->actual_delivery, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('early_delivery', __('Early Delivery'), ['class'=>'form-control-label']) }}
            {{ Form::text('early_delivery', $project->early_delivery, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('late_delivery', __('Late Delivery'), ['class'=>'form-control-label']) }}
            {{ Form::text('late_delivery', $project->early_delivery, ['class' => 'form-control datepicker', 'required'=>'required']) }}
        </div>
        <!-- Other form fields with default values -->
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue" style="border-radius: 7px;">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
