<div class="card bg-none card-box">
    {{Form::model($trainer,array('route' => array('trainer.update', $trainer->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class'=>'form-control-label'])}}
                {{Form::select('branch',$branches,null,array('class'=>'form-control select2','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('firstname',__('First Name'),['class'=>'form-control-label'])}}
                {{Form::text('firstname',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('lastname',__('Last Name'),['class'=>'form-control-label'])}}
                {{Form::text('lastname',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('contact',__('Contact'),['class'=>'form-control-label'])}}
                {{Form::text('contact',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('email',__('Email'),['class'=>'form-control-label'])}}
                {{Form::text('email',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('expertise',__('Expertise'),['class'=>'form-control-label'])}}
            {{Form::textarea('expertise',null,array('class'=>'form-control','placeholder'=>__('Expertise')))}}
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('address',__('Address'),['class'=>'form-control-label'])}}
            {{Form::textarea('address',null,array('class'=>'form-control','placeholder'=>__('Address')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
