@extends('Templates.Public.main_template')

@section('content')
    <p>this is checkout page</p>
    <br>
    <form action="/checkout" method="post">
        {{ csrf_field() }}
        <label>First Name</label>
        <br>
        <input type="text" name="first_name" required>
        <br><br>
        <label>Last Name</label>
        <br>
        <input type="text" name="last_name" required>
        <br><br>
        <label>Email</label>
        <br>
        <input type="email" name="email" required>
        <br><br>
        <label>Phone</label>
        <br>
        <input type="text" name="phone" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
@endsection