@extends('Templates.Contact.sub_template_reply_mails_show')

@section('sub_content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    View Reply Mail
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <h3>
                        <span class="font-normal">Email: </span>{{ $reply->email }}
                    </h3>
                    <h5>
                        <span class="float-right font-normal">{{ date('H:i',strtotime($reply->created_at)) }}{{ date('A',strtotime($reply->created_at)) }}&nbsp;&nbsp;{{ date('d-m-Y', strtotime($reply->created_at)) }}</span>
                    </h5>
                </div>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <p>
                        {!! $reply->reply !!} 
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection