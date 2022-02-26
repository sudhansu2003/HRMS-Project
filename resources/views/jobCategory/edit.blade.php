<div class="card bg-none card-box">
    {{Form::model($jobCategory,array('route' => array('job-category.update', $jobCategory->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Title'),['class'=>'form-control-label'])}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter category title')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
