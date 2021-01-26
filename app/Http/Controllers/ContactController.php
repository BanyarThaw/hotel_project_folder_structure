<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\contactMail;
use App\Mail\replyMail;
use App\Models\Contact;
use App\Models\Contactreplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /*
    Public
    =========
    */
    public function contact_form() {
        return view("Public.contact");
    }

    public function contact_store() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ]);
    
            $contact = new Contact();
    
            $contact->name = request()->name;
            $contact->email = request()->email;
            $contact->subject = request()->subject;
            $contact->message = request()->message;
            $contact->status = 1;
            $contact->save();
            
            Mail::to('nightking70682@gmail.com')->send(new contactMail($contact));
            return redirect("contact")->with("message","Messge Sent!!!");
        }
        return redirect('hotel-admin/login');
    }

    /*
    Admin
    ========
    */
    public function contact_mail_list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $contact_mails = Contact::orderBy('created_at','desc')->get();

            return view('Contact.list',compact('contact_mails','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function contact_mail_show($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $contact_mail = Contact::find($id);

            $contact_mail->status = 0;
            $contact_mail->save();

            return view('Contact.show',compact('contact_mail','contact_mails_notifications'));
        }   
        return redirect('hotel-admin/login');
    }

    public function contact_mail_reply($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $contact_mail = Contact::find($id);

            return view('Contact.reply',compact('contact_mail','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function contact_mail_reply_send($id) {
        if(Auth::check()) {
            $validatedData = request()->validate([
                "reply" => "required",
            ]);
            
            $contact_mail = Contact::find($id);
            $reply = new Contactreplies();
    
            $reply->email = $contact_mail->email;
            $reply->reply = request()->reply;
            $reply->save();
    
            $reply_id = $reply->id;
    
            $replymessage = Contactreplies::findOrFail($reply_id);
            
            Mail::to($contact_mail->email)->send(new replyMail($contact_mail,$replymessage));
    
            return redirect('hotel-admin/reply');
        }
        return redirect('hotel-admin/login');
    }

    public function reply_mail_list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $replies = Contactreplies::orderBy('created_at','desc')->get();

            return view('Contact.reply_list',compact('replies','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function reply_mail_show($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $reply = Contactreplies::find($id);
    
            return view('Contact.reply_show',compact('reply','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }
    public function email_template() {
        return view('emails.email_template');
    }
}
