<div class="favorite-list-item">
    @if(!empty($user->avatar))
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
             style="background-image: url('{{ asset('/storage/uploads/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
        </div>
    @else
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
             style="background-image: url('{{ asset('/storage/uploads/'.config('chatify.user_avatar.folder').'/avatar.png') }}');">
        </div>
    @endif
    <p>{{ strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name }}</p>
</div>
