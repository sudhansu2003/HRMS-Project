<div class="card bg-none card-box">
    {{ Form::model($asset, array('route' => array('account-assets.update', $asset->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'),['class'=>'form-control-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
            {{ Form::number('amount', null, array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('purchase_date', __('Purchase Date'),['class'=>'form-control-label']) }}
            {{ Form::text('purchase_date',null, array('class' => 'form-control datepicker')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('supported_date', __('Support Until'),['class'=>'form-control-label']) }}
            {{ Form::text('supported_date',null, array('class' => 'form-control datepicker')) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>

    </div>
    {{ Form::close() }}
</div>
