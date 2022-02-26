@extends('layouts.admin')
@section('page-title')
    {{__('Create Job')}}
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link href="{{asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
@endpush
@push('script-page')

    <script src="{{asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>

    <script>
        var e = $('[data-toggle="tags"]');
        e.length && e.each(function () {
            $(this).tagsinput({tagClass: "badge badge-primary"})
        });


    </script>
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
@endpush
@section('content')
    {{Form::open(array('url'=>'job','method'=>'post'))}}
    <div class="row">
        <div class="col-md-6 ">
            <div class="card card-fluid">
                <div class="card-body ">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('title', __('Job Title'),['class'=>'form-control-label']) !!}
                            {!! Form::text('title', old('title'), ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('branch', __('Branch'),['class'=>'form-control-label']) !!}
                            {{ Form::select('branch', $branches,null, array('class' => 'form-control select2','required'=>'required')) }}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('category', __('Job Category'),['class'=>'form-control-label']) !!}
                            {{ Form::select('category', $categories,null, array('class' => 'form-control select2','required'=>'required')) }}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('position', __('Positions'),['class'=>'form-control-label']) !!}
                            {!! Form::text('position', old('positions'), ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('status', __('Status'),['class'=>'form-control-label']) !!}
                            {{ Form::select('status', $status,null, array('class' => 'form-control select2','required'=>'required')) }}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('start_date', __('Start Date'),['class'=>'form-control-label']) !!}
                            {!! Form::text('start_date', old('start_date'), ['class' => 'form-control datepicker']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('end_date', __('End Date'),['class'=>'form-control-label']) !!}
                            {!! Form::text('end_date', old('end_date'), ['class' => 'form-control datepicker']) !!}
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" value="" data-toggle="tags" name="skill" placeholder="Skill"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card card-fluid">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>{{__('Need to ask ?')}}</h6>
                                <div class="my-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="applicant[]" value="gender" id="check-gender">
                                        <label class="custom-control-label" for="check-gender">{{__('Gender')}} </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="applicant[]" value="dob" id="check-dob">
                                        <label class="custom-control-label" for="check-dob">{{__('Date Of Birth')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="applicant[]" value="country" id="check-country">
                                        <label class="custom-control-label" for="check-country">{{__('Country')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <h6>{{__('Need to show option ?')}}</h6>
                               <div class="my-4">
                                   <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" name="visibility[]" value="profile" id="check-profile">
                                       <label class="custom-control-label" for="check-profile">{{__('Profile Image')}} </label>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" name="visibility[]" value="resume" id="check-resume">
                                       <label class="custom-control-label" for="check-resume">{{__('Resume')}}</label>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" name="visibility[]" value="letter" id="check-letter">
                                       <label class="custom-control-label" for="check-letter">{{__('Cover Letter')}}</label>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" name="visibility[]" value="terms" id="check-terms">
                                       <label class="custom-control-label" for="check-terms">{{__('Terms And Conditions')}}</label>
                                   </div>
                               </div>
                           </div>
                       </div>
                        <div class="form-group col-md-12">
                            <h6>{{__('Custom Question')}}</h6>
                            <div class="my-4">
                                @foreach($customQuestion as $question)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="custom_question[]" value="{{$question->id}}" id="custom_question_{{$question->id}}">
                                        <label class="custom-control-label" for="custom_question_{{$question->id}}">{{$question->question}} </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-fluid">
                <div class="card-body ">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('sescription', __('Job Description'),['class'=>'form-control-label']) !!}
                            <textarea class="form-control summernote-simple" name="description" id="exampleFormControlTextarea1" rows="15"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-fluid">
                <div class="card-body ">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('requirement', __('Job Requirement'),['class'=>'form-control-label']) !!}
                            <textarea class="form-control summernote-simple" name="requirement" id="exampleFormControlTextarea2" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="form-group">
                <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection

