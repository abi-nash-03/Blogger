@extends('layouts.app')
@section('content')
    <h2>Edit Blog</h2>
    <form action="{{env('APP_URL')}}/posts/{{$posts->id}}" method="POST" class="pt-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label" >Title</label>
            <input type="text" name="title" value="{{$posts->title}}" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Blog Body</label>
            <textarea name="body" id="article-ckeditor" class="form-control" rows="3">
                {{$posts->body}} 
            </textarea>
        </div>
        <div>
            {{-- <label for="file">File</label> --}}
            <input id="file" name = "cover_image" type="file" value="{{$posts->cover_image}}" />
        </div>
        <br>
        <input type="submit" class="btn btn-success" value="save">
    </form>
    <script>
        console.log(`{{$posts->body}}`);
    </script>


@endsection