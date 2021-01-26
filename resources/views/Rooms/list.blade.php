<h2>Rooms List</h2>
@foreach($rooms as $room)
    <a href="/hotel-admin/room/detail/{{ $room->id }}">
        <p>{{ $room->name }}</p>
    </a>
    <form action="/hotel-admin/room/edit/{{ $room->id }}" method="get">
        {{ csrf_field() }}
        <button type="submit">Update</button>
    </form>
@endforeach