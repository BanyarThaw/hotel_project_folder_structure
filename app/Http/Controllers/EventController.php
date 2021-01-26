<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Eventcomments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class EventController extends Controller
{
    public function list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $events = Event::orderBy('created_at','desc')->paginate(6);
            $comments = Eventcomments::all();
            return view('Events.list',compact('events','comments','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }   

    public function show($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $event = Event::find($id);
            $comments = Eventcomments::all();

            return view('Events.show',compact('event','comments','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function create() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();

            return view('Events.create',compact('contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function store() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'title' => 'required',
                'about' => 'required',
                'author_name' => 'required',
                'photo' => 'required',
            ]);
    
            $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('photos'),$photoName);
    
            $event = new Event();
    
            $event->title = request()->title;
            $event->about = request()->about;
            $event->author_name = request()->author_name;
            $event->photo = $photoName;
            $event->save();
    
            return redirect("hotel-admin/events");
        }
        return redirect('hotel-admin/login');
    }

    public function edit($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $event = Event::find($id);

            return view("Events.edit",compact('event','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function update($id) {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'title' => 'required',
                'about' => 'required',
                'author_name' => 'required',
            ]);
    
            if(request()->photo) {
                $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
                request()->photo->move(public_path('photos'),$photoName);
    
                $event = Event::find($id);
                $event->title = request()->title;
                $event->about = request()->about;
                $event->author_name = request()->author_name;
                $event->photo = $photoName;
                $event->save();
            }
            else {
                $event = Event::find($id);
    
                $event->title = request()->title;
                $event->about = request()->about;
                $event->author_name = request()->author_name;
                $event->save();
            }
            return redirect("hotel-admin/events");
        }
        return redirect('hotel-admin/login');
    }

    public function destory($id) {
        if(Auth::check()) {
            $event = Event::find($id);

            $event->delete();
            return redirect("hotel-admin/events");
        }
        return redirect('hotel-admin/login');
    }
}
