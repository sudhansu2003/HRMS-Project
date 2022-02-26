@extends('layouts.admin')

@section('page-title')
    {{__('Ticket Reply')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @if(\Auth::user()->type=='employee')
            @if($ticket->created_by==\Auth::user()->id)
                @can('Edit Ticket')
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="{{ URL::to('ticket/'.$ticket->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Ticket')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                    </div>
                @endcan
            @endif
        @else
            @can('Edit Ticket')
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ URL::to('ticket/'.$ticket->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Ticket')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                </div>
            @endcan
        @endif
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            @foreach($ticketreply as $reply)
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between w-100">
                            <h6 class="mb-0">{{!empty(\Auth::user()->getUser($reply->created_by))?\Auth::user()->getUser($reply->created_by)->name:'' }} </h6>
                            <small class="text-gray text-xs">{{$reply->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $reply->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @if($ticket->status=='open')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between w-100">
                            <h6 class="m-0">{{__('Add Reply')}}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        {{Form::open(array('url'=>'ticket/changereply','method'=>'post'))}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('description',__('Description'),['class'=>'form-control-label'])}}
                                    {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Ticket Reply')))}}
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                                <input type="submit" value="{{__('Send')}}" class="btn-create badge-blue">
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

