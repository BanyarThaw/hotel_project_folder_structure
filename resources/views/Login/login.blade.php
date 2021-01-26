@extends('Templates.Login.main_template')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to Hotel</h3>
            <form class="m-t" role="form" action="/hotel-admin/login" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/hotel-admin/register">Create an account</a>
            </form>
            <p class="m-t"> <small>Hotel &copy; 2014</small> </p>
        </div>
    </div>
@endsection
