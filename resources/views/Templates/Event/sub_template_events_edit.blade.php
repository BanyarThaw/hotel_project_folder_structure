@extends('Templates.Main.main_template')

@section('content')
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Admin</span>
                                <span class="text-muted text-xs block">menu<b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="/hotel-admin/logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            Hotel
                        </div>
                    </li>
                    <li  class="active">
                        <a href="/hotel-admin/events"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="nav-label">Events</span></a>
                    </li>
                    <li>
                        <a href="/hotel-admin/blogs"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span class="nav-label">Blogs</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Booking List</span></a>
                    </li>
                    <li>
                        <a href="/hotel-admin/contact"><i class="fa fa-envelope" aria-hidden="true"></i> <span class="nav-label">Contact Mails</span> </a>
                    </li>
                    <li>
                        <a href="/hotel-admin/gallery/photos"><i class="fa fa-file-image-o" aria-hidden="true"></i> <span class="nav-label">Photo Gallery</span> </a>
                    </li>
                    <li>
                        <a href="/hotel-admin/gallery/videos"><i class="fa fa-file-video-o" aria-hidden="true"></i> <span class="nav-label">Video Gallery</span> </a>
                    </li>   
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" href="/hotel-admin/contact">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning">
                                    <?php $mail_noti = 0; ?>
                                    @foreach($contact_mails_notifications as $contact_mails_notification)
                                            @if($contact_mails_notification->status == 1 )
                                                <?php $mail_noti = $mail_noti + 1; ?>
                                            @endif
                                    @endforeach
                                    {{ $mail_noti }}
                                </span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="/hotel-admin/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Events</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">events&nbsp;/&nbsp;edit</a>
                        </li>
                    </ol>
                </div>
            </div>
            @yield('sub_content')
            <div class="footer">
                <div class="float-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2018
                </div>
            </div>
        </div>
    </div>
@endsection