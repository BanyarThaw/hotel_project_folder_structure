<a href="/hotel-admin/room/close_dates/{{ $room->id }}">Close Dates of {{ $room->name }}</a>
<h2>Show Room</h2>
<h4>Room Name</h4>
<p>{{ $room->name }}</p>
<h4>About</h4>
<p>{{ $room->about }}</p>
<h4>Room Price</h4>
<p>{{ $room->price }}</p>
<h4>Max Member</h4>
<p>{{ $room->max_member }}</p>
<h4>Photo</h4>
<img src="{{'/photos/'.$room->photo}}" width="150" height="150">
<h2>Comments</h2>

