<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Blogcomments;
use App\Models\Bookinglist;
use App\Models\Bookinglistdetail;
use App\Models\Event;
use App\Models\Eventcomments;
use App\Models\Galleryphotos;
use App\Models\Galleryvideos;
use App\Models\Room;
use App\Models\Roomreviews;
use App\Models\Roomclosedates;

class PublicController extends Controller
{
    //blog
    //=====
    public function blog_list() {
        $blogs = Blog::all();
        return view('Public.blog_list',compact('blogs'));
    }  

    public function blog_show($id) {
        $blog = Blog::find($id);
        $comments = Blogcomments::all();
        return view('Public.blog_show',compact('blog','comments'));
    }

    public function blog_comment_store() {
        $validatedData = request()->validate([
            'blog_id'=>'required|integer',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        $comment = new Blogcomments();
        
        $comment->email = request()->email;
        $comment->comment = request()->comment;
        $comment->blog_id = request()->blog_id;
        $comment->save();
        
        $blog_id = request()->blog_id;
        return redirect("blogs/".$blog_id);
    }

    //event
    //=====
    public function event_list() {
        $events = Event::all();
        return view('Public.event_list',compact('events'));
    }

    public function event_show($id) {
        $event = Event::find($id);
        $comments = Eventcomments::all();
        return view('Public.event_show',compact('event','comments'));
    }

    public function event_comment_store() {
        $validatedData = request()->validate([
            'event_id' => 'required|integer',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        $comment = new Eventcomments();

        $comment->email = request()->email;
        $comment->comment = request()->comment;
        $comment->event_id = request()->event_id;
        $comment->save();

        $event_id = request()->event_id;
        return redirect("events/".$event_id);
    }

    //room
    //=====
    public function room_list() {
        $rooms = Room::All();
        return view('Public.room_list',compact('rooms'));
    }

    public function room_show($id) {
        $room = Room::find($id);
        $reviews = Roomreviews::all();
        return view('Public.room_show',compact('room','reviews'));
    }

    public function room_review_store() {
        $validatedData = request()->validate([
            'room_id' => 'required|integer',
            'email' => 'required|email',
            'review' => 'required',
        ]);

        $review = new Roomreviews();

        $review->email = request()->email;
        $review->review = request()->review;
        $review->room_id = request()->room_id;
        $review->save();

        $room_id = request()->room_id;
        return redirect("rooms/".$room_id);
    }

    public function room_checking() {
        $rooms = Room::orderBy('created_at','desc')->get();

        session()->forget('rooms');
        session()->forget('count');

        session()->forget('filteredRooms');
        session()->forget('count2');

        session()->put('count', 0);
        foreach($rooms as $room)
        {
            $total_rooms[session('count')] = [
                "id" => $room->id,
                "name" => $room->name,
                //STATUS : 0 = open, 1 or other positive integers = close
                "status" => 0
            ];
            session()->put('count',session('count')+1);
        }

        session()->put('rooms',$total_rooms);

        $from = request()->from_date;
        $end = request()->end_date;

        $closed_rooms = Roomclosedates::whereBetween('close_date',[$from,$end])->get();
        
        session()->put('count2', 0);
        foreach(session('rooms') as $room => $room_detail)
        {
            foreach($closed_rooms as $closed_room)
            {
                if($room_detail['name'] == $closed_room->room_name)
                {
                    //increase the status value if room_name in session and room_name in $closed_rooms are same
                    $room_detail['status'] = $room_detail['status']+1;
                }
            }
            $total_rooms_filtered[session('count2')] = [
                "id" => $room_detail['id'],
                "name" => $room_detail['name'],
                //STATUS : 0 = open, 1 or other positive integers = close
                "status" => $room_detail['status']
            ];
            session()->put('count2',session('count2')+1);
        }

        session()->put('filteredRooms',$total_rooms_filtered);

        return view("Public.room_list_check_result",compact('closed_rooms','rooms'));
    }

    //cart
    public function cart() {
        return view('Public.cart');
    }

    public function add_to_cart() {
        //dd(request()->total_member);
        //dd(request()->room_id);
        $room = Room::find(request()->room_id);

        //dd($room->max_member);
        if(!$room) {
            abort(404);
        }

        //Algorithm
        $room_quantity = intval((request()->total_member+1)/$room->max_member);

        $cost = $room->price*$room_quantity;

        //dd($room_quantity);
        //dd($cost);
        $cart = session()->get('cart');

        if(!$cart) {
            session()->put('cart_count', 0);
            $cart = [
                session('cart_count') => [
                    "room_id" => $room->id,
                    "room_name" => $room->name,
                    "room_quantity" => $room_quantity,
                    "members" => request()->total_member,
                    "cost" => $cost,
                    "photo" => $room->photo
                ]
            ];

            session()->put('cart', $cart);
            return view("Public.room_list_check_result_after_cart");
        }
        
        session()->put('cart_count', session('cart_count')+1);

        $cart[session('cart_count')] = [
            "room_id" => $room->id,
            "room_name" => $room->name,
            "room_quantity" => $room_quantity,
            "members" => request()->total_member,
            "cost" => $cost,
            "photo" => $room->photo
        ];
    
        session()->put('cart', $cart);
        //return redirect('cart');
        return view("Public.room_list_check_result_after_cart");
    }    

    //checkout
    public function checkout() {
        return view("Public.checkout");
    }

    public function proceed_checkout() {
        //dd(request());
        $validatedData = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        //calculating total cost
        $total = 0;
        foreach(session('cart') as $room_id => $details) {
            $total = $total + $details['cost'];
        }


        $bookingList = new Bookinglist();

        $bookingList->first_name = request()->first_name;
        $bookingList->last_name = request()->last_name;
        $bookingList->email = request()->email;
        $bookingList->phone =  request()->phone;
        $bookingList->cost = $total;
        $bookingList->save();
        $bookingList->id;
        
        //adding data to database by foreaching session
        foreach(session('cart') as $room_id => $details) {
            $bookingListDetail = new Bookinglistdetail();

            $bookingListDetail->booking_list_id =  $bookingList->id;
            $bookingListDetail->room_id = $details['room_id'];
            $bookingListDetail->room_name = $details['room_name'];
            $bookingListDetail->room_quantity = $details['room_quantity'];
            $bookingListDetail->total_members = $details['members'];
            $bookingListDetail->save();
        }

        //clearing session data
        session()->flush('cart');
        session()->flush('count');

        return redirect("rooms");
    }

    //gallery/photos
    //=====
    public function gallery_photos_list() {
        $gallery_photos = Galleryphotos::orderBy('created_at','desc')->get();

        return view('Public.gallery_photos_list',compact('gallery_photos'));
    }

    //gallery/videos
    //=====
    public function gallery_videos_list() {
        $gallery_videos = Galleryvideos::orderBy('created_at','desc')->get();

        return view('Public.gallery_videos_list',compact('gallery_videos'));
    }

    //testing
    //=========
    public function testing_1() {
        return view('Testing.testing1');
    }

    public function testing_2() {
        $rooms = Room::orderBy('created_at','desc')->get();

        session()->forget('test_rooms');
        session()->forget('test_count');

        session()->forget('test_filteredRooms');
        session()->forget('test_count2');

        session()->put('test_count', 0);
        foreach($rooms as $room)
        {
            $test_total_rooms[session('test_count')] = [
                "id" => $room->id,
                "name" => $room->name,
                //STATUS : 0 = open, 1 or other positive integers = close
                "status" => 0
            ];
            session()->put('test_count',session('test_count')+1);
        }

        session()->put('test_rooms',$test_total_rooms);

        $from = request()->from_date;
        $end = request()->end_date;

        /*
            $filtered = $collection->whereBetween('price', [100, 200]);
            $filtered->all();
        */

        $closed_rooms = Roomclosedates::whereBetween('close_date',[$from,$end])->get();
        
        session()->put('test_count2', 0);
        foreach(session('test_rooms') as $room => $room_detail)
        {
            foreach($closed_rooms as $closed_room)
            {
                if($room_detail['name'] == $closed_room->room_name)
                {
                    //increase the status value if room_name in session and room_name in $closed_rooms are same
                    $room_detail['status'] = $room_detail['status']+1;
                }
            }
            $test_total_rooms_filtered[session('test_count2')] = [
                "id" => $room_detail['id'],
                "name" => $room_detail['name'],
                //STATUS : 0 = open, 1 or other positive integers = close
                "status" => $room_detail['status']
            ];
            session()->put('test_count2',session('test_count2')+1);
        }

        session()->put('test_filteredRooms',$test_total_rooms_filtered);
        /*
        $all_closed_rooms = Roomclosedates::orderBy('close_date','asc')->get();

        $filtered_closed_rooms = $all_closed_rooms::whereBetween('close_date',[$from,$end])->get();
        */

        return view("Testing.testing2",compact('closed_rooms'));
    }

    public function testing_3() {
        $rooms = Room::All();        

        return view("Testing.testing3",compact('rooms'));
    }

    public function test_cart() {
        $room = Room::find(request()->room_id);

        //dd($room->max_member);
        if(!$room) {
            abort(404);
        }
        //Check
        //========
        $max_member = $room->max_member;
        $extra_bed = $room->extra_bed;
        //$total_max_capacity = $room->adult+$room->children+$room->extra_bed;
        //$total_max_capacity = $room->max_member+$room->extrea_bed;
        $total_max_capacity = $max_member + $extra_bed;
        //dd($room->extra_bed);
        //dd($max_member);
        //dd($total_max_capacity);
        $total_member = request()->total_member;
        $room_quantity = intval((request()->total_member)/$room->max_member);
        $cost = $room->price*$room_quantity;
        if($total_member < $max_member) {
            $test_cart = session()->get('test_cart');
            if(!$test_cart) {
                session()->put('test_count', 0);
                $test_cart = [
                    session('test_count') => [
                        "room_id" => $room->id,
                        "room_name" => $room->name,
                        "room_quantity" => $room_quantity,
                        "members" => request()->total_member,
                        "cost" => $cost,
                        "photo" => $room->photo,
                        "extra_bed" => "no"
                    ]
                ];

                session()->put('test_cart', $test_cart);
                return redirect('test_cart');
            }
            
            session()->put('test_count', session('test_count')+1);

            $test_cart[session('test_count')] = [
                "room_id" => $room->id,
                "room_name" => $room->name,
                "room_quantity" => $room_quantity,
                "members" => request()->total_member,
                "cost" => $cost,
                "photo" => $room->photo,
                "extra_bed" => "no"
            ];
        
            session()->put('test_cart', $test_cart);
        }
        
        if($total_member == $total_max_capacity) {
            //choose extra bed or extra room
            return view('Testing.testing4')->with('total_member',$total_member);
        }

        if($total_member > $total_max_capacity) {
            //choose extar bed or extra room
            return view('Testing.testing5');
        }
        
        //Algorithm
        //$room_quantity = intval((request()->total_member)/$room->max_member);

        //$cost = $room->price*$room_quantity;

        //dd($room_quantity);
        //dd($cost);
        /*
        $test_cart = session()->get('test_cart');

        if(!$test_cart) {
            session()->put('test_count', 0);
            $test_cart = [
                session('test_count') => [
                    "room_id" => $room->id,
                    "room_name" => $room->name,
                    "room_quantity" => $room_quantity,
                    "members" => request()->total_member,
                    "cost" => $cost,
                    "photo" => $room->photo
                ]
            ];

            session()->put('test_cart', $test_cart);
            return redirect('test_cart');
        }
        
        session()->put('test_count', session('test_count')+1);

        $test_cart[session('test_count')] = [
            "room_id" => $room->id,
            "room_name" => $room->name,
            "room_quantity" => $room_quantity,
            "members" => request()->total_member,
            "cost" => $cost,
            "photo" => $room->photo
        ];
    
        session()->put('test_cart', $test_cart);
        */
        return redirect('test_cart');
    }

    public function test_extra_bed() {
        if($total_member < $max_member) {
            $test_cart = session()->get('test_cart');
            if(!$test_cart) {
                session()->put('test_count', 0);
                $test_cart = [
                    session('test_count') => [
                        "room_id" => $room->id,
                        "room_name" => $room->name,
                        "room_quantity" => $room_quantity,
                        "members" => request()->total_member,
                        "cost" => $cost,
                        "photo" => $room->photo,
                        "extra_bed" => "no"
                    ]
                ];

                session()->put('test_cart', $test_cart);
                return redirect('test_cart');
            }
            
            session()->put('test_count', session('test_count')+1);

            $test_cart[session('test_count')] = [
                "room_id" => $room->id,
                "room_name" => $room->name,
                "room_quantity" => $room_quantity,
                "members" => request()->total_member,
                "cost" => $cost,
                "photo" => $room->photo,
                "extra_bed" => "no"
            ];
        
            session()->put('test_cart', $test_cart);
        }
        redirect()->back();
    }

    public function test_cart_detail() {
        return view('Testing.test_cart');
    }
}
