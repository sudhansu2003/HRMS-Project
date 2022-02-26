<div class="card bg-none card-box">
    {{ Form::open(array('url' => 'coupons','method' =>'post')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
            {{Form::text('name',null,array('class'=>'form-control font-style','required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('discount',__('Discount'),['class'=>'form-control-label'])}}
            {{Form::number('discount',null,array('class'=>'form-control','required'=>'required','step'=>'0.01'))}}
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('limit',__('Limit'),['class'=>'form-control-label'])}}
            {{Form::number('limit',null,array('class'=>'form-control','required'=>'required'))}}
        </div>

        <div class="form-group col-md-12">
            {{Form::label('code',__('Code'),['class'=>'form-control-label'])}}
            <div class="d-flex radio-check">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="manual_code" value="manual" name="icon-input" class="custom-control-input code" checked="checked">
                    <label class="custom-control-label" for="manual_code">{{__('Manual')}}</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="auto_code" value="auto" name="icon-input" class="custom-control-input code">
                    <label class="custom-control-label" for="auto_code">{{__('Auto Generate')}}</label>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12 d-block" id="manual">
            <input class="form-control font-uppercase" name="manualCode" type="text">
        </div>
        <div class="form-group col-md-12 d-none" id="auto">
            <div class="row">
                <div class="col-md-10">
                    <input class="form-control" name="autoCode" type="text" id="auto-code">
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn badge-blue btn-sm rounded-pill my-auto text-white" id="code-generate"><i class="fas fa-history"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
