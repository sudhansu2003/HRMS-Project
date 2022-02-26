@extends('layouts.admin')
@push('script-page')
    <script>
        $(document).on('click', '.code', function () {
            var type = $(this).val();
            if (type == 'manual') {
                $('#manual').removeClass('d-none');
                $('#manual').addClass('d-block');
                $('#auto').removeClass('d-block');
                $('#auto').addClass('d-none');
            } else {
                $('#auto').removeClass('d-none');
                $('#auto').addClass('d-block');
                $('#manual').removeClass('d-block');
                $('#manual').addClass('d-none');
            }
        });

        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
@endpush
@section('page-title')
    {{__('Manage Coupon')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create coupon')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('coupons.create') }}" data-ajax-popup="true" data-title="{{__('Create New Coupon')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> {{__('Name')}}</th>
                                <th> {{__('Code')}}</th>
                                <th> {{__('Discount (%)')}}</th>
                                <th> {{__('Limit')}}</th>
                                <th> {{__('Used')}}</th>
                                <th> {{__('Action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($coupons as $coupon)
                                <tr class="font-style">
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ $coupon->used_coupon() }}</td>
                                    <td class="action">
                                        <a href="{{ route('coupons.show',$coupon->id) }}" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="{{__('View Detail')}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('edit coupon')
                                            <a href="#" class="edit-icon" data-url="{{ route('coupons.edit',$coupon->id) }}" data-ajax-popup="true" data-title="{{__('Edit Coupon')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        @can('delete coupon')
                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$coupon->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy', $coupon->id],'id'=>'delete-form-'.$coupon->id]) !!}
                                            {!! Form::close() !!}
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

