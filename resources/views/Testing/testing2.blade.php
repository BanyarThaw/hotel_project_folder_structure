<h1>This is Testing Area</h1>

@foreach(session('test_rooms') as $room => $room_detail)
    @if($room_detail['status'] == 1)
        {{ $room_detail['name'] }}
        <br>
        {{ $room_detail['status'] }}
    @endif
@endforeach

<h2>Close Rooms</h2>
@foreach($closed_rooms as $closed_room)
    {{ $closed_room->close_date }}({{ $closed_room->room_name }})
    <br>
@endforeach
<br><br>
<h2>Open Rooms</h2>
@foreach(session('test_filteredRooms') as $filteredRoom => $filteredRoomDetail)
    @if($filteredRoomDetail['status'] == 0)
        {{ $filteredRoomDetail['name'] }} ( {{ $filteredRoomDetail['status'] }} )
        <br>
    @endif
@endforeach
