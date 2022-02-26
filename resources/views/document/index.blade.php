@extends('layouts.admin')

@section('page-title')
    {{__('Manage Document Type')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Document Type')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('document.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New  Document Type')}}">
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
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Document')}}</th>
                                <th>{{__('Required Field')}}</th>
                                @if(Gate::check('Edit Document Type') || Gate::check('Delete Document Type'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->name }}</td>
                                    <td>
                                        <h6 class="float-left mr-1">
                                            @if( $document->is_required == 1 )
                                                <div class="badge rounded-pill badge-success">{{__('Required')}}</div>
                                            @else
                                                <div class="badge rounded-pill badge-danger">{{__('Not Required')}}</div>
                                            @endif
                                        </h6>
                                    </td>

                                    @if(Gate::check('Edit Document Type') || Gate::check('Delete Document Type'))
                                        <td>
                                            @can('Edit Document Type')
                                                <a href="#" data-url="{{ URL::to('document/'.$document->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Document Type')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Document Type')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$document->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id],'id'=>'delete-form-'.$document->id]) !!}
                                                {!! Form::close() !!}
                                            @endif
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

