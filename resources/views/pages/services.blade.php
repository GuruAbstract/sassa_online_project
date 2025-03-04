@extends('layouts.app')

@section('content')
        <h1 class="text-center">{{$title}}</h1>
        @if(count($services)> 0)
        <ul>
           @foreach($services as $service)
           <li class="list-group-item text-center">{{$service}}</li>
           @endforeach
        </ul>
        @endif
@endsection  