<div class="card bg-none card-box">
    <div class="row">
        {{ Form::hidden('id', $data->pluck('id')->first()) }}
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Employee Name'), ['class' => 'form-control-label']) }}
            {!! Form::select('name', $data->pluck('name', 'id'), null, ['class' => 'form-control font-style select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('project_name', __('Project Name'), ['class' => 'form-control-label']) }}
            {!! Form::select('project_name', $projectName->pluck('project_name', 'project_name'), null, ['class' => 'form-control font-style select2', 'required' => 'required']) !!}
        </div>
        <div class="col-12">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
