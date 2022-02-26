<div class="card bg-none card-box">
    {{Form::open(array('url'=>'holiday','method'=>'post'))}}
        <div class="row">
            <div class="form-group col-md-12">
                {{Form::label('date',__('Date'),['class'=>'form-control-label'])}}
                {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
            </div>
            <div class="form-group col-md-12">
                {{Form::label('occasion',__('Occasion'),['class'=>'form-control-label'])}}
                {{Form::text('occasion',null,array('class'=>'form-control'))}}
            </div>
            <div class="col-12">
                <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    {{Form::close()}}
</div>
