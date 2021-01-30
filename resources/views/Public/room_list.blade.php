@extends('Templates.Public.main_template')

@section('content')
    <a href="/cart">Cart</a>
    <br>
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
    <form autocomplete="off" action="/rooms/check" method="post">
        {{ csrf_field() }}
        <label>Check Availablity</label>
        <br>
        <label>from date</label>
        <input autocomplete="off" type="text" name="from_date" class="dateFilter" required>
        <label>and end date</label>
        <input autocomplete="off" type="text" name="end_date" class="dateFilter" required>
        <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <h2>Rooms List (Default room list,later room will show according to their close dates)</h2>
    <form action="cart" method="post">
        {{ csrf_field() }}
        <input type="number" name="total_member" required>
        <br>
        @foreach($rooms as $room)
            <a href="/rooms/{{ $room->id }}">{{ $room->name }}</a>
            <button type="submit" name="room_id" value="{{ $room->id }}">Select</button>
            <br>
        @endforeach
    </form>
@endsection
