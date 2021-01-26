@extends('Templates.Contact.sub_template_contact_mails')

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
                                    <th>Name</th>
                                    <th>Message</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($contact_mails as $contact_mail)
                                        @if($contact_mail->status == 1)
                                            <tr>
                                                <td><b><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color:black;">{{ date('d-m-Y', strtotime($contact_mail->created_at)) }}</a></b></td>
                                                <td><b><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color: black;">{{ $contact_mail->name }}</a></b></td>
                                                <td><b><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color:black;">{{ substr($contact_mail->message,0,20) }}....</a></b></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color:black;">{{ date('d-m-Y', strtotime($contact_mail->created_at)) }}</a></td>
                                            <td><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color: black;">{{ $contact_mail->name }}</a></td>
                                            <td><a href="/hotel-admin/contact/{{ $contact_mail->id }}" style="color:black;">{{ substr($contact_mail->message,0,20) }}....</a></td>
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