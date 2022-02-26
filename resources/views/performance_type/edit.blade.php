<div class="card bg-none card-box">
    {{ Form::model($performance_type, ['route' => ['performanceType.update', $performance_type->id], 'method' => 'PUT']) }}
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{ __('Updated') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
