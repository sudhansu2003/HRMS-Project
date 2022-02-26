<div class="card bg-none card-box">
    {{Form::model($jobOnBoard,array('route' => array('job.on.board.update', $jobOnBoard->id), 'method' => 'post')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {!! Form::label('joining_date', __('Joining Date'),['class'=>'form-control-label']) !!}
            {!! Form::text('joining_date', null, ['class' => 'form-control datepicker']) !!}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('status',__('Status'),['class'=>'form-control-label'])}}
            {{Form::select('status',$status,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

