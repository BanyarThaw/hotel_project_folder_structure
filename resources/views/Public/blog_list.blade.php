@extends('Templates.Public.main_template')

@section('content')
    <h2>Blogs List</h2>
    @foreach($blogs as $blog)
        <a href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a>
        <br>
    @endforeach
@endsection