<div class="card bg-none card-box">
    {{Form::open(array('url'=>'department','method'=>'post'))}}
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('branch_id',__('Branch'),['class'=>'form-control-label'])}}
                {{Form::select('branch_id',$branch,null,array('class'=>'form-control select2','placeholder'=>__('Select Branch')))}}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Department Name')))}}
                @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
