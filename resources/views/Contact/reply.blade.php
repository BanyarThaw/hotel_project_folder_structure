@extends('Templates.Contact.sub_template_contact_mails_reply')

@section('sub_content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight">
                <div class="mail-box-header">
                    <h2>
                        Reply Mail
                    </h2>
                </div>
                <div class="mail-box">
                    <div class="mail-body">
                        <form action="/hotel-admin/contact/reply/{{ $contact_mail->id }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row"><label class="col-sm-2 col-form-label">To:</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value="{{ $contact_mail->email }}"></div>
                            </div>
                            <br>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Reply :</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" name="reply"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="mail-body text-right tooltip-demo">
                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection