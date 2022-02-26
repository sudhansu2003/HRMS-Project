<div class="card bg-none card-box">
    {{Form::open(array('url'=>'warning','method'=>'post'))}}
    <div class="row">
        @if(\Auth::user()->type != 'employee')
            <div class="form-group col-md-6 col-lg-6">
                {{ Form::label('warning_by', __('Warning By'),['class'=>'form-control-label'])}}
                {{ Form::select('warning_by', $employees,null, array('class' => 'form-control select2','required'=>'required')) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_to',__('Warning To'),['class'=>'form-control-label'])}}
            {{Form::select('warning_to',$employees,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('subject',__('Subject'),['class'=>'form-control-label'])}}
            {{Form::text('subject',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_date',__('Warning Date'),['class'=>'form-control-label'])}}
            {{Form::text('warning_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
