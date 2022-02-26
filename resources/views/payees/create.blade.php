<div class="card bg-none card-box">
    {{Form::open(array('url'=>'payees','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('payee_name',__('Payee Name'))}}
                {{Form::text('payee_name',null,array('class'=>'form-control','placeholder'=>__('Enter Payee Name')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('contact_number',__('Contact Number'))}}
                {{Form::number('contact_number',null,array('class'=>'form-control','placeholder'=>__('Enter Contact Number')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
