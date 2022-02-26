<div class="card bg-none card-box">
{{Form::model($otherpayment,array('route' => array('otherpayment.update', $otherpayment->id), 'method' => 'PUT')) }}
<div class="card-body p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('title', __('Title')) }}
                {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('amount', __('Amount')) }}
                {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
            </div>
        </div>
    </div>
    <div class="col-12">
        <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
        <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
</div>

{{Form::close()}}
</div>

