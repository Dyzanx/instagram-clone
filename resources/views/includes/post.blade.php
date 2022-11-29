<div class="card pub-image">
    <div class="card-header">
        @if($post->user->image)
        <div class="container-avatar">
            <img class="avatar post-avatar" src="{{ route('user.avatar', ['filename'=>$post->user->image]) }}"
                alt="{{Auth::user()->nickname}} avatar">
        </div>
        @endif
        <div class="data-user">
            {{ $post->user->name.'  '.$post->user->surname }}
            <span class="nickname">{{ ' | @'.$post->user->nickname }}</span>
        </div>
    </div>

    <div class="card-body">
        <a href="{{ route('post.detail', ['id' => $post->id]) }}" title="Go to post">
            <div class="post">
                <img src="{{ route('post.file', ['filename' => $post->image_path]) }}"
                    alt="{{ $post->user->nickname }} post">
            </div>
        </a>
        <div class="likes">
            <!-- comprove if user has been liked the post -->
            @php $user_like = false; @endphp
            @foreach($post->likes as $like)
            @if($like->user->id === Auth::user()->id)
            @php $user_like = true; @endphp
            @endif
            @endforeach

            @if(!$user_like)
            <img title="like" src="{{ asset('img/black-hearth.png') }}" data-id="{{ $post->id }}" alt="like button icon"
                class="like-button">
            @else
            <img title="dislike" src="{{ asset('img/red-hearth.png') }}" data-id="{{ $post->id }}"
                alt="dislike button icon" class="dislike-button">
            @endif
            <span class="likes-counter">{{ count($post->likes) }}</span>

            <a href="{{ route('post.detail', ['id' => $post->id]) }}" title="comments" class="comments-button">
                <i class="fa-regular fa-comment-dots"></i><span
                    class="likes-counter">({{count($post->comments)}})</span>
            </a>
        </div>
        <div class="description">
            <span class="nickname">{{ '@'.$post->user->nickname }}</span>
            <p>{{ $post->description }}</p>
        </div>
    </div>
</div>