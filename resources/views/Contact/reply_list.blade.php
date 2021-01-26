@extends('Templates.Contact.sub_template_reply_mails')

@section('sub_content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Email</th>
                                    <th>Reply</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($replies as $reply)
                                        <tr>
                                            <td><a href="/hotel-admin/reply/{{ $reply->id }}" style="color:black;">{{ date('d-m-Y', strtotime($reply->created_at)) }}</a></td>
                                            <td><a href="/hotel-admin/reply/{{ $reply->id }}" style="color: black;">{{ $reply->email }}</a></td>
                                            <td><a href="/hotel-admin/reply/{{ $reply->id }}" style="color:black;">{{ substr(strip_tags($reply->reply),0,30) }}.....</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection