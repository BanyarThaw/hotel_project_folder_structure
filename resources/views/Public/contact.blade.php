@extends('Templates.Public.main_template')

@section('content')
    <h3>MESSAGE</h3>
    <p>Do you have anything in your mind to tell us?</p>
    <p>Please don't hesitate to get in touch to us via our contact form.</p>
    <br>
    <form action="/contact" method="post">
        {{ csrf_field() }}
        <label>Your name(required)</label>
        <br>
        <input type="text" name="name" required>
        <br><br>
        <label>Your Email(required)</label>
        <br>
        <input type="email" name="email" required>
        <br><br>
        <label>Subject</label>
        <br>
        <input type="text" name="subject" required>
        <br><br>
        <label>Your Message</label>
        <br>
        <textarea name="message"></textarea>
        <br><br>
        <input type="submit" value="Send">
    </form>
@endsection