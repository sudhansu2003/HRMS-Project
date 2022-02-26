<div class="card bg-none card-box">
    {{Form::model($ip,array('route' => array('edit.ip', $ip->id), 'method' => 'POST')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('ip',__('IP'),['class'=>'form-control-label'])}}
            {{Form::text('ip',null,array('class'=>'form-control'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

