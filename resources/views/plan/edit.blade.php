<div class="card bg-none card-box">
    {{Form::model($plan, array('route' => array('plans.update', $plan->id), 'method' => 'PUT', 'enctype' => "multipart/form-data")) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
            {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))}}
        </div>
        @if($plan->price>0)
            <div class="form-group col-md-6">
                {{Form::label('price',__('Price'),['class'=>'form-control-label'])}}
                {{Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'required'=>'required'))}}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('duration', __('Duration'),['class'=>'form-control-label']) }}
            {!! Form::select('duration', $arrDuration, null,array('class' => 'form-control select2','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('max_users',__('Maximum Users'),['class'=>'form-control-label'])}}
            {{Form::number('max_users',null,array('class'=>'form-control','required'=>'required'))}}
            <span class="small">{{__('Note: "-1" for Unlimited')}}</span>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('max_employees',__('Maximum Employees'),['class'=>'form-control-label'])}}
            {{Form::number('max_employees',null,array('class'=>'form-control','required'=>'required'))}}
            <span class="small">{{__('Note: "-1" for Unlimited')}}</span>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
