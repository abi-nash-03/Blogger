@extends('layouts.app')
@section('content')
      <h1>Services</h1>
      <p>This page will contain all the services provided by the applicaiton </p>

      @if (count($services) > 0)
      <ul class="list-group">
          @foreach ($services as $service)
              <li class="list-group-item">{{$service}}</li>
          @endforeach
      </ul>
      @endif

@endsection