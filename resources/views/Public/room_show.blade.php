@extends('Templates.Public.main_template')

@section('content')
    <h2>Show Room</h2>
    <h4>Room Name</h4>
    <p>{{ $room->title }}</p>
    <h4>About</h4>
    <p>{{ $room->about }}</p>
    <h4>Room Price</h4>
    <p>{{ $room->price }}</p>
    <h4>Photo</h4>
    <img src="{{'/photos/'.$room->photo}}" width="150" height="150">
    <h2>Reviews</h2>
    @foreach($reviews as $review)
        @if($review->room_id == $room->id)
            <div>
            <b>[ {{ $review->email}} ] :</b>
            {{ $review->review }}
            </div>
        @endif
    @endforeach
    <form action="/rooms/reviews" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="email" name="email" placeholder="enter your email" required>
        <br><br>
        <input type="text" name="review" placeholder="review    " required>
        <br><br>
        <input type="submit" value="Send">
    </form>
@endsection