@extends('layouts.app')

@section('content')
    <h2>Create Blog</h2>
    <form action="{{env('APP_URL')}}/posts" method="POST" class="pt-3" enctype="multipart/form-data">
        {{-- {{route('posts.store')}} --}}
        {{-- {{ csrf_field() }} --}}
        @csrf
        <div>
            {{-- {{env('APP_URL')}}/posts --}}
        </div>
        <div class="mb-3">
            <label class="form-label" >Title</label>
            <input type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Blog Body</label>
            <textarea name="body" id="article-ckeditor" class="form-control" rows="3"></textarea>
        </div>
        <div>
            {{-- <label for="file">File</label> --}}
            <input id="file" name = "cover_image" type="file" />
        </div>
        <br>
        <input type="submit" class="btn btn-success">
    </form>



@endsection