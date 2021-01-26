<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Blogcomments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function list() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $blogs = Blog::orderBy('created_at','desc')->paginate(6);
            $comments = Blogcomments::all();
            return view('Blogs.list',compact('blogs','comments','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function show($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $blog = Blog::find($id);
            $comments = Blogcomments::all();
            return view('Blogs.show',compact('blog','comments','contact_mails_notifications'));
        }
        return redirect('hotel-admin/login');
    }

    public function create() {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            return view('Blogs.create',compact('contact_mails_notifications'));
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
    
            $blog = new Blog();
    
            $blog->title = request()->title;
            $blog->about = request()->about;
            $blog->author_name = request()->author_name;
            $blog->photo = $photoName;
            $blog->save();
    
            return redirect("hotel-admin/blogs");
        }
        return redirect('hotel-admin/login');
    }

    public function edit($id) {
        if(Auth::check()) {
            $contact_mails_notifications = Contact::all();
            $blog = Blog::find($id);
            return view('Blogs.edit',compact('blog','contact_mails_notifications'));
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
    
                $blog = Blog::find($id);
                $blog->title = request()->title;
                $blog->about = request()->about;
                $blog->author_name = request()->author_name;
                $blog->photo = $photoName;
                $blog->save();
            }
            else {
                $blog = Blog::find($id);
    
                $blog->title = request()->title;
                $blog->about = request()->about;
                $blog->author_name = request()->author_name;
                $blog->save();
            }
            return redirect("hotel-admin/blogs");
        }
        return redirect('hotel-admin/login');
    }

    public function destory($id) {
        if(Auth::check()) {
            $blog = Blog::find($id);

            $blog->delete();
            return redirect("hotel-admin/blogs");
        }
       return redirect('hotel-admin/login');
    }
}
