<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Galleryphotos;
use App\Models\Galleryvideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    //photos
    public function photo_list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $photos = Galleryphotos::all();
            return view('Gallery.photo_list',compact('photos','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function photo_create() {
        if(Auth::check()) {
            return view('Gallery.photo_create');
        }
        return redirect('hotel-admin/login');   
    }

    public function photo_store() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'photo'=> 'required',
            ]);
                        
            $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('photos'),$photoName);
    
            $galleryPhoto = new Galleryphotos;
    
            $galleryPhoto->gallery_photo = $photoName;
            $galleryPhoto->save();
    
            return redirect("hotel-admin/gallery/photos");
        }
        return redirect('hotel-admin/login');
    }

    public function photo_edit($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $galleryPhoto = Galleryphotos::find($id);

            return view("Gallery.photo_edit",compact('galleryPhoto','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function photo_update($id) {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'photo' => 'required',
            ]);
    
            $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('photos'),$photoName);
    
            $galleryPhoto = Galleryphotos::find($id);
    
            $galleryPhoto->gallery_photo = $photoName;
            $galleryPhoto->save();
    
            return redirect("hotel-admin/gallery/photos");
        }
        return redirect('hotel-admin/login');
    }

    public function photo_delete($id) {
        if(Auth::check()) {
            $galleryPhoto = Galleryphotos::find($id);

            $galleryPhoto->delete();
            return redirect("hotel-admin/gallery/photos");
        }
        return redirect('hotel-admin/login');
    }

    //videos
    public function video_list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $videos = Galleryvideos::all();
            return view('Gallery.video_list',compact('videos','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function video_create() {
        if(Auth::check()) {
            return view('Gallery.video_create');
        }
        return redirect('hotel-admin/login');
    }

    public function video_store() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'video'=> 'required',
            ]);
            
            $videoName = date('YmdHis').".".request()->video->getClientOriginalExtension();
            request()->video->move(public_path('videos'),$videoName);
    
            $galleryVideo = new Galleryvideos;
    
            $galleryVideo->gallery_video = $videoName;
            $galleryVideo->save();
    
            return redirect("hotel-admin/gallery/videos");
        }
        return redirect('hotel-admin/login');
    }

    public function video_edit($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $video = Galleryvideos::find($id);
            return view('Gallery.video_edit',compact('video','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function video_update($id) {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'video' => 'required',
            ]);
    
            $videoName = date('YmdHis').".".request()->video->getClientOriginalExtension();
            request()->video->move(public_path('videos'),$videoName);
    
            $galleryVideo = Galleryvideos::find($id);
    
            $galleryVideo->gallery_video = $videoName;
            $galleryVideo->save();
    
            return redirect("hotel-admin/gallery/videos");
        }
        return redirect('hotel-admin/login');
    }

    public function video_delete($id) {
        if(Auth::check()) {
            $galleryVideo = Galleryvideos::find($id);

            $galleryVideo->delete();
            return redirect("hotel-admin/gallery/videos");
        }
        return redirect('hotel-admin/login');
    }
}
