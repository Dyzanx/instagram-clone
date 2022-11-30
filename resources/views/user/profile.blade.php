@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="user-data">
                @if($user->image)
                <div class="container-avatar">
                    <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}"
                        alt="{{Auth::user()->nickname}} avatar">
                </div>
                @endif
                <div class="user-data-info">
                    <h1>{{ '@'.$user->nickname }}</h1>
                    <h2>{{ $user->name.'  '.$user->surname }}</h2>
                    <p class="nickname">{{ 'User joined '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
            <div class="clearfix"></div>

            @foreach($user->posts as $post)
            @include('includes.post', ['post' => $post])
            @endforeach
        </div>
    </div>
</div>
@endsection