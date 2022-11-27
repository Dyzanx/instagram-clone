@if(Auth::user()->image)
<div class="container-avatar">
    <img class="avatar" src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}"
        alt="{{Auth::user()->nickname}} avatar">
</div>
@endif