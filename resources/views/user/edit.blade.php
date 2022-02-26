<div class="card bg-none card-box">
    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('name', __('Name'),['class'=>'form-control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('email', __('Email'),['class'=>'form-control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        @if(\Auth::user()->type != 'super admin')
            <div class="form-group  col-lg-6 col-md-6">
                {{ Form::label('role', __('User Role'),['class'=>'form-control-label']) }}
                {!! Form::select('role', $roles, $user->roles,array('class' => 'form-control select2','required'=>'required')) !!}
                @error('role')
                <span class="invalid-role" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        @endif
        <div class="col-md-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {!! Form::close() !!}
</div>
