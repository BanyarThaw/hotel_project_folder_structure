@extends('Templates.Public.main_template')

@section('content')
    <h2>Gallery  Photos</h2>
    @foreach($gallery_photos as $gallery_photo)
        <div style="width: 200px;float:left;d">
            <img src="{{'/photos/'.$gallery_photo->gallery_photo}}" style="width: 100%;">   
        </div>
    @endforeach
@endsection