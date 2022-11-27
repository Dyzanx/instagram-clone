@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')

            @foreach($posts as $post)
            <div class="card pub-image">
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
                        <a href="" title="like" class="like-button">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                        <!-- <a href="" title="unlike" class="unlike-button">
                            <i class="fa-solid fa-heart"></i>
                        </a> -->
                        <a href="" title="comments" class="comments-button">
                            <i class="fa-regular fa-comment-dots"></i>({{count($post->comments)}})
                            <!--  -->
                        </a>
                    </div>
                    <div class="description">
                        <span class="nickname">{{ '@'.$post->user->nickname }}</span>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="clearfix"></div>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection