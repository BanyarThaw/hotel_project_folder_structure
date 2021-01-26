@extends('Templates.Login.main_template')

@section('content')
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <h3>Register to Hotel</h3>
            <form class="m-t" role="form" action="/hotel-admin/register" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" required="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Remember_token" name="remember_token" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/hotel-admin/login">Login</a>
            </form>
            <p class="m-t"> <small>Hotel &copy; 2014</small> </p>
        </div>
    </div>
@endsection