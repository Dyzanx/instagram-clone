@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="principal-title">Your liked posts</h1>
            <hr>

            @foreach($likes as $like)
            @include('includes.post', ['post' => $like->post])
            @endforeach

            <div class="clearfix"></div>
            {{ $likes->links() }}
        </div>
    </div>
</div>
@endsection