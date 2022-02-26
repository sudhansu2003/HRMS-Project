<div class="card bg-none card-box">
    {{ Form::model($appraisal, ['route' => ['appraisal.update', $appraisal->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('branch', __('Branch'), ['class' => 'form-control-label']) }}
                {{ Form::select('branch', $brances, null, ['class' => 'form-control select2', 'required' => 'required', 'id' => 'branch']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('employee', __('Employee'), ['class' => 'form-control-label']) }}
                {{ Form::select('employee', $employee, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('appraisal_date', __('Select Month'), ['class' => 'form-control-label']) }}
                {{ Form::text('appraisal_date', null, ['class' => 'form-control custom-datepicker']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('remark', __('Remarks'), ['class' => 'form-control-label']) }}
                {{ Form::textarea('remark', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($performance_types as $performances)
            <div class="col-md-12 mt-3">
                <h6>{{ $performances->name }}</h6>
                <hr class="mt-0">
            </div>
            @foreach ($performances->types as $types)

                <div class="col-6">
                    {{ $types->name }}
                </div>
                <div class="col-6">
                    <fieldset id='demo1' class="rating">
                        <input class="stars" type="radio" id="technical-5-{{ $types->id }}"
                            name="rating[{{ $types->id }}]" value="5"
                            {{ isset($ratings[$types->id]) && $ratings[$types->id] == 5 ? 'checked' : '' }}>
                        <label class="full" for="technical-5-{{ $types->id }}"
                            title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="technical-4-{{ $types->id }}"
                            name="rating[{{ $types->id }}]" value="4"
                            {{ isset($ratings[$types->id]) && $ratings[$types->id] == 4 ? 'checked' : '' }}>
                        <label class="full" for="technical-4-{{ $types->id }}"
                            title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="technical-3-{{ $types->id }}"
                            name="rating[{{ $types->id }}]" value="3"
                            {{ isset($ratings[$types->id]) && $ratings[$types->id] == 3 ? 'checked' : '' }}>
                        <label class="full" for="technical-3-{{ $types->id }}"
                            title="Meh - 3 stars"></label>
                        <input class="stars" type="radio" id="technical-2-{{ $types->id }}"
                            name="rating[{{ $types->id }}]" value="2"
                            {{ isset($ratings[$types->id]) && $ratings[$types->id] == 2 ? 'checked' : '' }}>
                        <label class="full" for="technical-2-{{ $types->id }}"
                            title="Kinda bad - 2 stars"></label>
                        <input class="stars" type="radio" id="technical-1-{{ $types->id }}"
                            name="rating[{{ $types->id }}]" value="1"
                            {{ isset($ratings[$types->id]) && $ratings[$types->id] == 1 ? 'checked' : '' }}>
                        <label class="full" for="technical-1-{{ $types->id }}"
                            title="Sucks big time - 1 star"></label>
                    </fieldset>
                </div>
            @endforeach
        @endforeach
    </div>



    <div class="row">

        <div class="col-12">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<script type="text/javascript">
    function getEmployee(did) {
        $.ajax({
            url: '{{ route('branch.employee.json') }}',
            type: 'POST',
            data: {
                "branch": did,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('#employee').empty();
                $('#employee').append('<option value="">{{ __('Select Branch') }}</option>');
                $.each(data, function(key, value) {
                    var select = '';
                    if (key == '{{ $appraisal->employee }}') {
                        select = 'selected';
                    }

                    $('#employee').append('<option value="' + key + '"  ' + select + '>' + value +
                        '</option>');
                });
            }
        });
    }

    $(document).ready(function() {
        var d_id = $('#branch').val();
        getEmployee(d_id);
    });
</script>
