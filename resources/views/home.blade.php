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

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection