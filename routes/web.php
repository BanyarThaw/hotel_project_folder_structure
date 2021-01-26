<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogcommentsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Public Interface
//===============
//cart
Route::get('cart',[PublicController::class,'cart']);
Route::post('cart',[PublicController::class,'add_to_cart']);

//checkout
Route::get('checkout',[PublicController::class,'checkout']);
Route::post('checkout',[PublicController::class,'proceed_checkout']);

//rooms
Route::get('rooms',[PublicController::class,'room_list']);
Route::post('rooms/reviews',[PublicController::class,'room_review_store']);
Route::get('rooms/{id}',[PublicController::class,'room_show']);
Route::post('rooms/check',[PublicController::class,'room_checking']);

//blogs
Route::get('blogs',[PublicController::class,'blog_list']);
Route::post('blogs/comments',[PublicController::class,'blog_comment_store']);
Route::get('blogs/{id}',[PublicController::class,'blog_show']);

//events
Route::get('events',[PublicController::class,'event_list']);
Route::post('events/comments',[PublicController::class,'event_comment_store']);
Route::get('events/{id}',[PublicController::class,'event_show']);

//contact
Route::get('contact',[ContactController::class,'contact_form']);
Route::post('contact',[ContactController::class,'contact_store']);

//gallery/photos
Route::get('gallery/photos',[PublicController::class,'gallery_photos_list']);

//gallery/videos
Route::get('gallery/videos',[PublicController::class,'gallery_videos_list']);

//Admin Interface
//================
//rooms
Route::get('hotel-admin/room',[RoomController::class,'list']);
Route::post('hotel-admin/room',[RoomController::class,'store']);
Route::get('hotel-admin/room/create',[RoomController::class,'create']);
Route::get('hotel-admin/room/detail/{id}',[RoomController::class,'show']);
Route::get('hotel-admin/room/edit/{id}',[RoomController::class,'edit']);
Route::put('hotel-admin/room/{id}',[RoomController::class,'update']);
Route::get('hotel-admin/room/close_dates/{id}',[RoomController::class,'close_dates']);
Route::post('hotel-admin/room/close_dates',[RoomController::class,'close_dates_add']);
Route::get('hotel-admin/room/close_dates/delete/{id}',[RoomController::class,'close_dates_delete']);

//blogs
Route::get('hotel-admin/blogs',[BlogController::class,'list']);
Route::post('hotel-admin/blogs',[BlogController::class,'store']);
Route::get('hotel-admin/blogs/detail/{id}',[BlogController::class,'show']);
Route::get('hotel-admin/blogs/create',[BlogController::class,'create']);
Route::get('hotel-admin/blogs/edit/{id}',[BlogController::class,'edit']);
Route::put('hotel-admin/blogs/{id}',[BlogController::class,'update']);
Route::get('hotel-admin/blogs/delete/{id}',[BlogController::class,'destory']);

//events
Route::get('hotel-admin/events',[EventController::class,'list']);
Route::post('hotel-admin/events',[EventController::class,'store']);
Route::get('hotel-admin/events/detail/{id}',[EventController::class,'show']);
Route::get('hotel-admin/events/create',[EventController::class,'create']);
Route::get('hotel-admin/events/edit/{id}',[EventController::class,'edit']);
Route::put('hotel-admin/events/{id}',[EventController::class,'update']);
Route::get('hotel-admin/events/delete/{id}',[EventController::class,'destory']);

//gallery/photos
Route::get('hotel-admin/gallery/photos',[GalleryController::class,'photo_list']);
Route::get('hotel-admin/gallery/photos/create',[GalleryController::class,'photo_create']);
Route::post('hotel-admin/gallery/photos',[GalleryController::class,'photo_store']);
Route::get('hotel-admin/gallery/photos/{id}',[GalleryController::class,'photo_edit']);
Route::patch('hotel-admin/gallery/photos/{id}',[GalleryController::class,'photo_update']);
Route::get('hotel-admin/gallery/photos/delete/{id}',[GalleryController::class,'photo_delete']);

//gallery/videos
Route::get('hotel-admin/gallery/videos',[GalleryController::class,'video_list']);
Route::get('hotel-admin/gallery/videos/create',[GalleryController::class,'video_create']);
Route::post('hotel-admin/gallery/videos',[GalleryController::class,'video_store']);
Route::get('hotel-admin/gallery/videos/edit/{id}',[GalleryController::class,'video_edit']);
Route::patch('hotel-admin/gallery/videos/{id}',[GalleryController::class,'video_update']);
Route::get('hotel-admin/gallery/videos/delete/{id}',[GalleryController::class,'video_delete']);

//contact
Route::get('hotel-admin/contact',[ContactController::class,'contact_mail_list']);
Route::get('hotel-admin/contact/{id}',[ContactController::class,'contact_mail_show']);  
Route::get('hotel-admin/contact/reply/{id}',[ContactController::class,'contact_mail_reply']);
Route::post('hotel-admin/contact/reply/{id}',[ContactController::class,'contact_mail_reply_send']);
Route::get('hotel-admin/reply',[ContactController::class,'reply_mail_list']);
Route::get('hotel-admin/reply/{id}',[ContactController::class,'reply_mail_show']);

//login/logout/register
Route::get('hotel-admin/login',[LoginController::class,'index']);
Route::post('hotel-admin/login',[LoginController::class,'login']);
Route::get('hotel-admin/register',[LoginController::class,'register']);
Route::post('hotel-admin/register',[LoginController::class,'create']);
Route::get('hotel-admin/logout',[LoginController::class,'logout']);

//email template testing
Route::get('email_template',[ContactController::class,'email_template']);
