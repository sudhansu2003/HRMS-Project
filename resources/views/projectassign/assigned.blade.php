@extends('layouts.admin')

@section('page-title')
    {{__('Assign Project')}}
@endsection

@section('action-button')
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
                                <th>{{__('Project ID')}}</th>
                                <th>{{__('Project Name')}}</th>
                                <th>{{__('Employee ID')}}</th>
                                <th>{{__('Employee Name')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result as $data)
                            <tr>
                                <td>{{ $data['project_id'] }}</td>
                                <td>{{ $data['project_name'] }}</td>
                                <td>{{ $data['user_id'] }}</td>
                                <td>{{ $data['user_name'] }}</td>
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


