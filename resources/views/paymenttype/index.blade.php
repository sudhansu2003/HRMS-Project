@extends('layouts.admin')

@section('page-title')
    {{__('Manage Payment Type')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Payment Type')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('paymenttype.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Payment Type')}}">
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
                                <th>{{__('Payment Type')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="fdont-style">
                            @foreach ($paymenttypes as $paymenttype)
                                <tr>
                                    <td>{{ $paymenttype->name }}</td>

                                    <td>
                                        @can('Edit Payment Type')
                                            <a href="#" data-url="{{ URL::to('paymenttype/'.$paymenttype->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Payment Type')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('Delete Payment Type')
                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$paymenttype->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['paymenttype.destroy', $paymenttype->id],'id'=>'delete-form-'.$paymenttype->id]) !!}
                                            {!! Form::close() !!}
                                        @endif
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

