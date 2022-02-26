<div class="card bg-none card-box">
    {{Form::model($transferbalance,array('route' => array('transferbalance.update', $transferbalance->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('from_account_id',__('From Account'),['class'=>'form-control-label'])}}
                {{Form::select('from_account_id',$accounts,null,array('class'=>'form-control select2','placeholder'=>__('Choose Account')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('to_account_id',__('To Account'),['class'=>'form-control-label'])}}
                {{Form::select('to_account_id',$accounts,null,array('class'=>'form-control select2','placeholder'=>__('Choose Account')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('date',__('Date'),['class'=>'form-control-label'])}}
                {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('amount',__('Amount'),['class'=>'form-control-label'])}}
                {{Form::number('amount',null,array('class'=>'form-control','step'=>'0.01'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('payment_type_id',__('Payment Method'),['class'=>'form-control-label'])}}
                {{Form::select('payment_type_id',$paymentTypes,null,array('class'=>'form-control select2','placeholder'=>__('Choose Payment Method')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('referal_id',__('Ref#'),['class'=>'form-control-label'])}}
                {{Form::text('referal_id',null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Description')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
