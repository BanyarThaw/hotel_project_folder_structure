@extends('Templates.Public.main_template')

@section('content')
    <h2>Events List</h2>
    @foreach($events as $event)
        <a href="/events/{{ $event->id }}">{{ $event->title }}</a>
        <br>
    @endforeach
@endsection