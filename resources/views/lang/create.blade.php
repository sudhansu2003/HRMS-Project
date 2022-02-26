<div class="card bg-none card-box">
    {{ Form::open(array('route' => array('store.language'))) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('code', __('Language Code')) }}
            {{ Form::text('code', '', array('class' => 'form-control','required'=>'required')) }}
            @error('code')
            <span class="invalid-code" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
        <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
    {{ Form::close() }}
</div>

