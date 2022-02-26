<div class="card bg-none card-box">
    {{Form::model($customQuestion,array('route' => array('custom-question.update', $customQuestion->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('question',__('Question'),['class'=>'form-control-label'])}}
                {{Form::text('question',null,array('class'=>'form-control','placeholder'=>__('Enter question')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('is_required',__('Is Required'),['class'=>'form-control-label'])}}
                {{ Form::select('is_required', $is_required,null, array('class' => 'form-control select2','required'=>'required')) }}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
