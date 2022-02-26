<div class="card bg-none card-box">
    {{Form::open(array('url'=>'document','method'=>'post'))}}
    <div class="row">
        <div class="form-group col-12">
            {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Document Name')))}}
            @error('name')
            <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-12">
            {{ Form::label('is_required', __('Required Field'),['class'=>'form-control-label']) }}
            <select class="form-control select2" required name="is_required">
                <option value="0">{{__('Not Required')}}</option>
                <option value="1">{{__('Is Required')}}</option>
            </select>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
