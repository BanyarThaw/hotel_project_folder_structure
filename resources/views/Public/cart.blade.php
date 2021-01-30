@extends('Templates.Public.main_template')

@section('content')
    <?php print_r(session('cart')); ?>
    <p>this cart page</p>
    @if(session('cart'))
        <?php 
            $total = 0;
        ?>
        @foreach(session('cart') as $room_id => $details)
            Room Id :{{ $details['room_id'] }}
            <br>
            Room Name: {{ $details['room_name'] }}
            <br>
            Room Quantity : {{ $details['room_quantity'] }}
            <br>
            Total Member: {{ $details['members'] }}
            <br>
            Cost : {{ $details['cost'] }}
            <br>
            Photo
            <br>
            <img src="{{'/photos/'.$details['photo']}}" width="150" height="150">
            <br>
            <br><br>
            <?php 
                $total += $details['cost'];
            ?>
        @endforeach
        <h2>Total Cost : {{ $total }}</h2>
        <a href="checkout">Proceed to Check Out</a>
    @endif
@endsection