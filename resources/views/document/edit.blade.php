<div class="card bg-none card-box">
    {{Form::model($document,array('route' => array('document.update', $document->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('name',__('Name',['class'=>'form-control-label']))}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Department Name')))}}
                @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('is_required', __('Required Field'),['class'=>'form-control-label']) }}
                <select class="form-control select2" required name="is_required">
                    <option value="0" @if($document->is_required == 0) selected @endif>{{__('Not Required')}}</option>
                    <option value="1" @if($document->is_required == 1) selected @endif>{{__('Is Required')}}</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
