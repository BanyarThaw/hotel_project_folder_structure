@extends('Templates.Public.main_template')

@section('content')
    <p>this cart page</p>
    @if(session('test_cart'))
        <?php 
            $total = 0;
        ?>
        @foreach(session('test_cart') as $room_id => $details)
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
<!--
<table border="1">
    <thead>
        <tr>
            <th>Room Name</th>
            <th>Room Quantity</th>
            <th>Total Members</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Hla Hla</td>
            <td>3</td>
            <td>10</td>
            <td>100</td>
        </tr>
        <tr>
            <td>Hla Hla</td>
            <td>3</td>
            <td>10</td>
            <td>100</td>
        </tr>
        <tr>
            <td>Hla Hla</td>
            <td>3</td>
            <td>10</td>
            <td>100</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align: center;">Total Cost : 300</td>
        </tr>
    </tfoot>
</table>
-->