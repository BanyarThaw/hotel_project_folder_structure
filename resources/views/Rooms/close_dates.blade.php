<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<script src="{{asset('js/jquery-3.3.1.js')}}" type='text/javascript'></script>
<script src="{{asset('js/jquery-ui.min.js')}}" type='text/javascript'></script>
<script type='text/javascript'>
    $(document).ready(function(){
        $('.dateFilter').datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
    });
</script>
{{ $room->name }}
<form action="/hotel-admin/room/close_dates" method="post">
    {{ csrf_field() }}
    <label>Choose close date</label>
    <br>
    <input type="text" name="close_date" class="dateFilter" required>
    <br>
    <input type="hidden" name="room_name" value=" {{ $room->name }}" required>
    <br>
    <input type="submit" value="Submit">
</form>
@foreach($rooms_close_dates as $room_close_date)
    @if($room_close_date->room_name == $room->name)
        <p style="display: inline;">{{ $room_close_date->close_date }}</p>
        <a href="/hotel-admin/room/close_dates/delete/{{ $room_close_date-> id}}">Delete</a>
        <br>
    @endif
@endforeach