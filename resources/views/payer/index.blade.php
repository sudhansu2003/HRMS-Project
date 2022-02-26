@extends('layouts.admin')
@section('page-title')
    {{__('Payer')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Payer')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('payer.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Payer')}}">
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
                                <th>{{__('Payer Name')}}</th>
                                <th>{{__('Contact Number')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($payers as $payer)
                                <tr>
                                    <td>{{ $payer->payer_name }}</td>
                                    <td>{{ $payer->contact_number }}</td>

                                    <td>
                                        @can('Edit Payer')
                                            <a href="#" data-url="{{ URL::to('payer/'.$payer->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Payer')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('Delete Payer')
                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$payer->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['payer.destroy', $payer->id],'id'=>'delete-form-'.$payer->id]) !!}
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

