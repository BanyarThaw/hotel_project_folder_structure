<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Roomclosedates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function list() {
        if(Auth::check()) {
            $rooms = Room::all();
            return view('Rooms.list',compact('rooms'));
        }
        return redirect('hotel-admin/login');
    }

    public function create() {
        if(Auth::check()) {
            return view('Rooms.create');
        }
        return redirect('hotel-admin/login');
    }

    public function store() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'name' => 'required',
                'about'=> 'required',
                'price'=> 'required|integer',
                'max_member' => 'required',
                'photo'=> 'required',
            ]);
    
            $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('photos'),$photoName);
    
            $room = new Room();
    
            $room->name = request()->name;
            $room->about = request()->about;
            $room->price = request()->price;
            $room->max_member = request()->max_member;
            $room->photo = $photoName;
            $room->save();
    
            return redirect("hotel-admin/room");
        }
        return redirect('hotel-admin/login');
    }

    public function show($id) {
        if(Auth::check()) {
            $room = Room::find($id);
            return view('Rooms.show',compact('room'));
        }
        return redirect('hotel-admin/login');
    }

    public function edit($id) {
        if(Auth::check()) {
            $room= Room::find($id);

            return view("Rooms.edit",compact('room'));
        }
        return redirect('hotel-admin/login');
    }

    public function update($id) {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'name' => 'required',
                'about' => 'required',
                'price' => 'required',
                'max_member' => 'required',
            ]);
    
            if(request()->photo) {
                $photoName = date('YmdHis').".".request()->photo->getClientOriginalExtension();
                request()->photo->move(public_path('photos'),$photoName);
                
                $room = Room::find($id);
                $room->name = request()->name;
                $room->about = request()->about;
                $room->price = request()->price;
                $room->max_member = request()->max_member;
                $room->photo = $photoName;
                $room->save();
            }
            else {
                $room = Room::find($id);
    
                $room->name = request()->name;
                $room->about = request()->about;
                $room->price = request()->price;
                $room->max_member = request()->max_member;
                $room->save();
            }
            return redirect("hotel-admin/room");
        }
        return redirect('hotel-admin/login');
    }

    public function close_dates($id) {
        if(Auth::check()) {
            $room = Room::find($id);
            $rooms_close_dates = Roomclosedates::all();
            return view('Rooms.close_dates',compact('room','rooms_close_dates'));
        }
        return redirect('hotel-admin/login');
    }

    public function close_dates_add() {
        if(Auth::check()) {
            $validatedData = request()->validate([
                'close_date' => 'required',
                'room_name' => 'required',
            ]);
    
            $rooms_close_dates = new Roomclosedates();
            
            $rooms_close_dates->close_date = request()->close_date;
            $rooms_close_dates->room_name = request()->room_name;
            $rooms_close_dates->save();
    
            return redirect()->back();
        }
        return redirect('hotel-admin/login');
    }

    public function close_dates_delete($id) {
        if(Auth::check()) {
            $rooms_close_dates = Roomclosedates::find($id);

            $rooms_close_dates->delete();
            return redirect()->back();
        }
        return redirect('hotel-admin/login');
    }
}
