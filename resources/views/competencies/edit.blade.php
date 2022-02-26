<div class="card bg-none card-box">
    {{Form::model($competencies,array('route' => array('competencies.update', $competencies->id), 'method' => 'PUT')) }}
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
                {{Form::text('name',null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('type',__('Type'),['class'=>'form-control-label'])}}
                {{Form::select('type',$types,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Updated')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
