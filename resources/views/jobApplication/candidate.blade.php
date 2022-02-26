@extends('layouts.admin')
@section('page-title')
    {{__('Manage Archive Application')}}
@endsection
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Applied For')}}</th>
                                <th>{{__('Rating')}}</th>
                                <th>{{__('Applied at')}}</th>
                                <th>{{__('CV / Resume')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($archive_application as $application)
                                <tr>
                                    <td><a class="" href="{{ route('job-application.show',\Crypt::encrypt($application->id)) }}">  {{$application->name}}</a></td>
                                    <td>{{ !empty($application->jobs)?$application->jobs->title:'-' }}</td>
                                    <td>
                                        <span class="static-rating static-rating-sm d-block">
                                            @for($i=1; $i<=5; $i++)
                                                @if($i <= $application->rating)
                                                    <i class="star fas fa-star voted"></i>
                                                @else
                                                    <i class="star fas fa-star"></i>
                                                @endif
                                            @endfor
                                         </span>
                                    </td>
                                    <td>{{\Auth::user()->dateFormat($application->created_at)}}</td>
                                    <td>
                                        @if(!empty($application->resume))
                                            <span class="text-sm">
                                                <a href="{{asset(Storage::url('uploads/job/resume')).'/'.$application->resume}}" target="_blank"><i class="fas fa-download"></i></a>
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @can('Show Job Application')
                                            <a class="edit-icon" data-toggle="tooltip" data-title="{{__('Details')}}" href="{{ route('job-application.show',\Crypt::encrypt($application->id)) }}"> <i class="fa fa-eye"></i></a>
                                        @endcan
                                    </td>
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

