@extends('layouts.admin')
@section('page-title')
    {{__('Employee Profile')}}
@endsection

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4">
            {{ Form::open(array('route' => array('employee.profile'),'method'=>'get','id'=>'employee_profile_filter')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('branch', __('Branch'),['class'=>'text-type']) }}
                    {{ Form::select('branch',$brances,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'select-box select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('department', __('Department'),['class'=>'text-type']) }}
                    {{ Form::select('department',$departments,isset($_GET['department'])?$_GET['department']:'', array('class' => 'select-box select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('designation', __('Designation'),['class'=>'text-type']) }}
                    <select class="select2 select-box select2-multiple" id="designation_id" name="designation" data-placeholder="{{ __('Select Designation ...') }}">
                        <option value="">{{__('Designation')}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-auto text-right my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('employee_profile_filter').submit(); return false;" data-toggle="tooltip" data-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('employee.profile')}}" class="reset-btn" data-toggle="tooltip" data-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            {{ Form::close() }}
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        @forelse($employees as $employee)
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="card profile-card">
                    <div class="avatar-parent-child">
                        <img src="{{!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')).'/'.$employee->user->avatar : asset(Storage::url('uploads/avatar')).'/avatar.png'}}" class="avatar rounded-circle avatar-xl">
                    </div>
                    <h4 class="h4 mb-0 mt-2">{{ $employee->name }}</h4>
                    <div class="sal-right-card">
                        <span class="badge badge-pill badge-blue">{{ !empty($employee->designation)?$employee->designation->name:'' }}</span>
                        <div class="Id">
                            @can('Show Employee Profile')
                                <a href="{{route('show.employee.profile',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                            @else
                                <a href="#">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center">
                    <h6>{{__('there is no employee')}}</h6>
                </div>
            </div>
        @endforelse
    </div>
@endsection
@push('script-page')

    <script>

        $(document).ready(function () {
            var d_id = $('#department').val();
            getDesignation(d_id);
        });

        $(document).on('change', 'select[name=department]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">{{__('Select Designation')}}</option>');
                    $.each(data, function (key, value) {
                        $('#designation_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
@endpush

