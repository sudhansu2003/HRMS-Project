<div class="card bg-none card-box">
    {{Form::open(array('url'=>'accountlist','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('account_name',__('Account Name'),['class'=>'form-control-label'])}}
                {{Form::text('account_name',null,array('class'=>'form-control','placeholder'=>__('Enter Account Name')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('initial_balance',__('Initial Balance'),['class'=>'form-control-label'])}}
                {{Form::number('initial_balance',null,array('class'=>'form-control','placeholder'=>__('Enter Initial Balance')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('account_number',__('Account Number'),['class'=>'form-control-label'])}}
                {{Form::number('account_number',null,array('class'=>'form-control','placeholder'=>__('Enter Account Number')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch_code',__('Branch Code'),['class'=>'form-control-label'])}}
                {{Form::text('branch_code',null,array('class'=>'form-control','placeholder'=>__('Enter Branch Code')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('bank_branch',__('Bank Branch'),['class'=>'form-control-label'])}}
                {{Form::text('bank_branch',null,array('class'=>'form-control','placeholder'=>__('Enter Bank Branch')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
