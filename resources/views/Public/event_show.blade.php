@extends('Templates.Public.main_template')

@section('content')
    <h2>Show Blog</h2>
    <h4>Blog Title</h4>
    <p>{{ $event->title }}</p>
    <h4>About</h4>
    <p>{{ $event->about }}</p>
    <h4>Author Name</h4>
    <p>{{ $event->author_name }}</p>
    <h4>Photo</h4>
    <img src="{{'/photos/'.$event->photo}}" width="150" height="150">
    <h2>Comments</h2>
    @foreach($comments as $comment)
        @if($comment->event_id == $event->id)
            <div>
            <b>[ {{ $comment->email}} ] :</b>
            {{ $comment->comment }}
            </div>
        @endif
    @endforeach
    <form action="/events/comments" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="email" name="email" placeholder="enter your email" required>
        <br><br>
        <input type="text" name="comment" placeholder="comment" required>
        <br><br>
        <input type="submit" value="Send">
    </form>
@endsection