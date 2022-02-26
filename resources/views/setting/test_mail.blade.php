<div class="card bg-none card-box">
{{ Form::open(array('route' => array('test.send.mail'))) }}
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('email', __('Email'),['class'=>'form-control-label']) }}
        {{ Form::text('email', '', array('class' => 'form-control','required'=>'required')) }}
        @error('email')
        <span class="invalid-email" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="modal-footer">
    <input type="submit" value="{{__('Send')}}" class="btn-create badge-blue">
    <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
</div>
{{ Form::close() }}
</div>

