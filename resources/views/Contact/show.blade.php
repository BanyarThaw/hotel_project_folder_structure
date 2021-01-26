@extends('Templates.Contact.sub_template_contact_mails_show')

@section('sub_content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <div class="float-right tooltip-demo">
                    <a href="/hotel-admin/contact/reply/{{ $contact_mail->id }}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                </div>
                <h2>
                    View Message
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <h3>
                        <span class="font-normal">Subject: </span>{{ $contact_mail->subject }}
                    </h3>
                    <h5>
                        <span class="float-right font-normal">{{ date('H:i',strtotime($contact_mail->created_at)) }}{{ date('A',strtotime($contact_mail->created_at)) }}&nbsp;&nbsp;{{ date('d-m-Y', strtotime($contact_mail->created_at)) }}</span>
                        <span class="font-normal">From: </span>{{ $contact_mail->email }}
                    </h5>
                </div>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <p>
                        {{ $contact_mail->message }} 
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection