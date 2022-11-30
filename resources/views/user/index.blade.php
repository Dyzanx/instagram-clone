@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>People you might like to meet</h1>
            <form action="" method="GET" id="search-form">
                <div class="row">
                    <div class="comf-group col">
                        <input id="search-input" class="form-control" type="text">
                    </div>
                    <div class="comf-group col btn-search">
                        <input type="submit" class="btn btn-success" value="Buscar">
                    </div>
                </div>
            </form>
            <hr>

            @foreach($users as $user)
            <div class="user-data">
                @if($user->image)
                <div class="container-avatar">
                    <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}"
                        alt="{{Auth::user()->nickname}} avatar">
                </div>
                @endif
                <div class="user-data-info">
                    <h2>{{ '@'.$user->nickname }}</h2>
                    <h3>{{ $user->name.'  '.$user->surname }}</h3>
                    <p class="nickname">{{ 'User joined '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-primary">See profile</a>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
            <div class="clearfix"></div>
            @endforeach

            <div class="clearfix"></div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection