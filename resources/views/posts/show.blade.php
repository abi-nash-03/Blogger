@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Back</a>
    <h1 class="pt-4">{{$posts->title}}</h1>
    <img style="width:100%" src="/storage/cover_image/{{$posts->cover_image}}" alt="">
    <br><br>
    <div>
        <p>{!!$posts->body!!}</p>
    </div>
    <hr>
    <small>{{$posts->created_at}} by {{$posts->user->name}}</small>
    <hr>
    @if (!Auth::guest())
        @if(Auth::user()->id == $posts->user_id)
            <a href="/posts/{{$posts->id}}/edit" class="btn btn-secondary">Edit</a>
            <form action="/posts/{{$posts->id}}" method="POST" class="float-right">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        @endif
    @endif
@endsection