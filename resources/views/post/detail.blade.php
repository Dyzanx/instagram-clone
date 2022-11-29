@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')

            <div class="card pub-image details">
                <div class="card-header">
                    @if($post->user->image)
                    <div class="container-avatar">
                        <img class="avatar post-avatar"
                            src="{{ route('user.avatar', ['filename'=>$post->user->image]) }}"
                            alt="{{Auth::user()->nickname}} avatar">
                    </div>
                    @endif
                    <div class="data-user">
                        {{ $post->user->name.'  '.$post->user->surname }}
                        <span class="nickname">{{ ' | @'.$post->user->nickname }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="post">
                        <img src="{{ route('post.file', ['filename' => $post->image_path]) }}"
                            alt="{{ $post->user->nickname }} post">
                    </div>
                    <div class="likes">
                        <!-- comprove if user has been liked the post -->
                        @php $user_like = false; @endphp
                        @foreach($post->likes as $like)
                        @if($like->user->id === Auth::user()->id)
                        @php $user_like = true; @endphp
                        @endif
                        @endforeach

                        @if(!$user_like)
                        <img title="like" src="{{ asset('img/black-hearth.png') }}" data-id="{{ $post->id }}"
                            alt="like button icon" class="like-button">
                        @else
                        <img title="dislike" src="{{ asset('img/red-hearth.png') }}" data-id="{{ $post->id }}"
                            alt="dislike button icon" class="dislike-button">
                        @endif
                        <span class="likes-counter">{{ count($post->likes) }}</span>

                        <a href="{{ route('post.detail', ['id' => $post->id]) }}" title="comments"
                            class="comments-button">
                            <i class="fa-regular fa-comment-dots"></i><span
                                class="likes-counter">({{count($post->comments)}})</span>
                        </a>
                    </div>
                    <div class="description">
                        <span class="nickname">{{ '@'.$post->user->nickname }}</span>
                        <span class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($post->created_at) }}</span>
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="description">
                        <h4>
                            <i class="fa-regular fa-comment-dots comments-icon"></i>
                            Comments({{count($post->comments)}})
                        </h4>
                        <hr>
                        <h5>Send a new comment</h5>
                        <form action="{{ route('comment.save') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <p>
                                <textarea class="form-control @error('image') is-invalid @enderror" name="content"
                                    cols="30" rows="3" required></textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </p>

                            <input type="submit" class="btn btn-success" value="Envíar comentario">
                        </form>

                        <h5 class="comments-title">Comments list</h5>
                        <div class="users-comments">
                            @foreach($post->comments as $comment)
                            <div class="user-comment">
                                <span class="nickname">{{ '@'.$comment->user->nickname }}</span>
                                <span
                                    class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>
                                    {{ $comment->content }}
                                </p>
                                @if($comment->user_id === Auth::user()->id || $post->user_id === Auth::user()->id)
                                <span class="config-comments">
                                    <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                        class="badge rounded-pill text-bg-danger">Delete</a>
                                </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection