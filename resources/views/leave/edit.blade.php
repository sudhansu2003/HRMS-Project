<div class="card bg-none card-box">
    {{Form::model($leave,array('route' => array('leave.update', $leave->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('employee_id',__('Employee'))}}
                {{Form::select('employee_id',$employees,null,array('class'=>'form-control select2','placeholder'=>__('Select Employee')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('leave_type_id',__('Leave Type'))}}
                {{Form::select('leave_type_id',$leavetypes,null,array('class'=>'form-control select2','placeholder'=>__('Select Leave Type')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Start Date'))}}
                {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('End Date'))}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('leave_reason',__('Leave Reason'))}}
                {{Form::textarea('leave_reason',null,array('class'=>'form-control','placeholder'=>__('Leave Reason')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('remark',__('Remark'))}}
                {{Form::textarea('remark',null,array('class'=>'form-control','placeholder'=>__('Leave Remark')))}}
            </div>
        </div>
    </div>
    @role('Company')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('status',__('Status'))}}
                <select name="status" id="" class="form-control select2">
                    <option value="">{{__('Select Status')}}</option>
                    <option value="pending" @if($leave->status=='Pending') selected="" @endif>{{__('Pending')}}</option>
                    <option value="approval" @if($leave->status=='Approval') selected="" @endif>{{__('Approval')}}</option>
                    <option value="reject" @if($leave->status=='Reject') selected="" @endif>{{__('Reject')}}</option>
                </select>
            </div>
        </div>
    </div>
    @endrole
    <div class="row">
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
