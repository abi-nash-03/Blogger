@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Session status{{ session('status') }}
                        </div>
                    @endif --}}

                    <a href="/posts/create" class="btn btn-primary">Create</a>

                    <div class="pt-3 pb-3">
                        <h3>You Blogs</h3>
                    </div>

                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>

                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td><form action="/posts/{{$post->id}}" method="POST" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form></td>
                                </tr>
                            @endforeach


                        </table>
                    @else
                        <p>You have no blogs</p>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
