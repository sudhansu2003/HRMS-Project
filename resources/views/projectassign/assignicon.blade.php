<div class="card bg-none card-box">
    {{ Form::open(['route' => 'projectassigns.storeassign']) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('id', __('Employee Name'), ['class' => 'form-control-label']) }}
            {!! Form::select('id', $usersWithoutProject->pluck('user_name','user_id'), null, ['class' => 'form-control font-style select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('project_name', __('Project Name'), ['class' => 'form-control-label']) }}
            {!! Form::select('project_name', $projectName->pluck('project_name', 'project_name'), null, ['class' => 'form-control font-style select2', 'required' => 'required']) !!}
        </div>
        <div class="col-12">
            <input type="submit" value="{{ __('Assign') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
    <div class="row">
        <div class="col-md-6">
            <h4>Assigned Users:</h4>
            @if($usersWithProject->count() > 0)
                <ul>
                @foreach($usersWithProject as $user)
                    <li class="d-flex justify-content-between align-items-center">
                        <span>{{ $user->user_name }}</span>
                        <form method="post" action="{{ route('projectassigns.unassign', ['user_name' => $user->user_name, 'project_name' => $projectName->first()->project_name]) }}" id="delete-form-{{ $user->user_id }}" style="display: none;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_name" value="{{ $user->user_name }}">
                            <input type="hidden" name="project_name" value="{{ $projectName->first()->project_name }}">
                        </form>
                        <a href="#" class="delete-icon" 
                            data-toggle="tooltip" 
                            data-original-title="Delete"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->user_id }}').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                    </li>
                @endforeach
                </ul>
            @else
                <p>No employees assigned to this project.</p>
            @endif
        </div>
    </div>
</div>
