@extends('layouts.admin')
@section('page-title')
    {{__('Manage Appraisal')}}
@endsection
@push('css-page')
    <style>
        @import url({{ asset('css/font-awesome.css') }});
    </style>
@endpush
@push('script-page')
    <script src="{{ asset('js/bootstrap-toggle.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
            $("fieldset[id^='demo'] .stars").click(function () {
                alert($(this).val());
                $(this).attr("checked");
            });
        });

        $(document).ready(function () {
            var employee = $('#employee').val();
            getEmployee(employee);
        });

        $(document).on('change', 'select[name=branch]', function () {
            var branch = $(this).val();
            getEmployee(branch);
        });

        function getEmployee(did) {
            $.ajax({
                url: '{{route('branch.employee.json')}}',
                type: 'POST',
                data: {
                    "branch": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#employee').empty();
                    $('#employee').append('<option value="">{{__('Select Branch')}}</option>');
                    $.each(data, function (key, value) {
                        $('#employee').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }


    </script>
@endpush

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Appraisal')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('appraisal.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Appraisal')}}">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>{{__('Designation')}}</th>
                                <th>{{__('Employee')}}</th>
                                <th>{{__('Overall Rating')}}</th>
                                <th>{{__('Appraisal Date')}}</th>
                                @if( Gate::check('Edit Appraisal') ||Gate::check('Delete Appraisal') ||Gate::check('Show Appraisal'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($appraisals as $appraisal)
                                @php
                                    if(!empty($appraisal->rating)){
                                        $rating = json_decode($appraisal->rating,true);
                                       if(!empty($rating)){
                                            $starsum = array_sum($rating);
                                            $overallrating = $starsum/count($rating);
                                        }else{
                                            $overallrating = 0;
                                        }
                                    }
                                    else{
                                        $overallrating = 0;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ !empty($appraisal->branches)?$appraisal->branches->name:'' }}</td>
                                    <td>{{ !empty($appraisal->employees)?!empty($appraisal->employees->department)?$appraisal->employees->department->name:'':'' }}</td>
                                    <td>{{ !empty($appraisal->employees)?!empty($appraisal->employees->designation)?$appraisal->employees->designation->name:'':'' }}</td>
                                    <td>{{!empty($appraisal->employees)?$appraisal->employees->name:'' }}</td>
                                    <td>

                                        @for($i=1; $i<=5; $i++)
                                            @if($overallrating < $i)
                                                @if(is_float($overallrating) && (round($overallrating) == $i))
                                                    <i class="text-warning fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="fas fa-star"></i>
                                                @endif
                                            @else
                                                <i class="text-warning fas fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="theme-text-color">({{number_format($overallrating,1)}})</span>
                                    </td>
                                    <td>{{ $appraisal->appraisal_date}}</td>
                                    @if( Gate::check('Edit Appraisal') ||Gate::check('Delete Appraisal') ||Gate::check('Show Appraisal'))
                                        <td>
                                            @can('Show Appraisal')
                                                <a href="#" data-url="{{ route('appraisal.show',$appraisal->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Appraisal Detail')}}" data-toggle="tooltip" data-original-title="{{__('View Detail')}}" class="edit-icon bg-success"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('Edit Appraisal')
                                                <a href="#" data-url="{{ route('appraisal.edit',$appraisal->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Appraisal')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="edit-icon"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Appraisal')
                                                <a href="#" class="delete-icon" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm-yes="document.getElementById('delete-form-{{$appraisal->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['appraisal.destroy', $appraisal->id],'id'=>'delete-form-'.$appraisal->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



