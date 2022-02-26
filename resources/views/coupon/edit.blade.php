<div class="card bg-none card-box">
    {{Form::model($coupon, array('route' => array('coupons.update', $coupon->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
            {{Form::text('name',null,array('class'=>'form-control font-style','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('discount',__('Discount'),['class'=>'form-control-label'])}}
            {{Form::number('discount',null,array('class'=>'form-control','required'=>'required','step'=>'0.01'))}}
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('limit',__('Limit'),['class'=>'form-control-label'])}}
            {{Form::number('limit',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('code',__('Code'),['class'=>'form-control-label'])}}
            {{Form::text('code',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
