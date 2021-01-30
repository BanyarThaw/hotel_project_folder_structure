<h2>Testing Area</h2>
<p> this is testing 3</p>
<form action="test_cart" method="post">
    {{ csrf_field() }}
    <input type="number" name="total_member" required>
    <br>
    @foreach($rooms as $room)
        <a href="/rooms/{{ $room->id }}">{{ $room->name }}</a>
        <button type="submit" name="room_id" value="{{ $room->id }}">Select</button>
        <br>
    @endforeach
</form>
<button class="xhr">Xhr Send</button>
<script src="{{ asset('js/tests.js') }}"></script>