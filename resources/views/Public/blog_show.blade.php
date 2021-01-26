@extends('Templates.Public.main_template')

@section('content')
    <h2>Show Blog</h2>
    <h4>Blog Title</h4>
    <p>{{ $blog->title }}</p>
    <h4>About</h4>
    <p>{{ $blog->about }}</p>
    <h4>Author Name</h4>
    <p>{{ $blog->author_name }}</p>
    <h4>Photo</h4>
    <img src="{{'/photos/'.$blog->photo}}" width="150" height="150">
    <h2>Comments</h2>
    @foreach($comments as $comment)
        @if($comment->blog_id == $blog->id)
            <div>
            <b>[ {{ $comment->email}} ] :</b>
            {{ $comment->comment }}
            </div>
        @endif
    @endforeach
    <form action="/blogs/comments" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
        <input type="email" name="email" placeholder="enter your email" required>
        <br><br>
        <input type="text" name="comment" placeholder="comment" required>
        <br><br>
        <input type="submit" value="Send">
    </form>
@endsection