@extends('layouts.admin')

@section('page-title')
    {{__('Manage Document')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Document')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('document-upload.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New  Document Type')}}">
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Document')}}</th>
                                <th>{{__('Role')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($documents as $document)
                                @php
                                    $documentPath=asset(Storage::url('uploads/documentUpload'));
                                       $roles = \Spatie\Permission\Models\Role::find($document->role);
                                @endphp
                                <tr>
                                    <td>{{ $document->name }}</td>
                                    <td>
                                        @if(!empty($document->document))
                                            <a href="{{$documentPath.'/'.$document->document}}" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    <td>{{ !empty($roles)?$roles->name:'All' }}</td>
                                    <td>{{ $document->description }}</td>
                                    @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                                        <td>
                                            @can('Edit Document')
                                                <a href="#" data-url="{{ route('document-upload.edit',$document->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Document')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Document')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$document->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['document-upload.destroy', $document->id],'id'=>'delete-form-'.$document->id]) !!}
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

