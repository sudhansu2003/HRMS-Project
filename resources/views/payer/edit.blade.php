<div class="card bg-none card-box">
    {{Form::model($payer,array('route' => array('payer.update', $payer->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('payer_name',__('Payer Name'),['class'=>'form-control-label'])}}
                {{Form::text('payer_name',null,array('class'=>'form-control','placeholder'=>__('Enter Payer Name')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('contact_number',__('Contact Number'),['class'=>'form-control-label'])}}
                {{Form::number('contact_number',null,array('class'=>'form-control','placeholder'=>__('Enter Contact Number')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
