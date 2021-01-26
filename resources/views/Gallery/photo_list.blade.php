@extends('Templates.Gallery.sub_template_photo')

@section('sub_content')
    @foreach($photos as $photo)
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="/hotel-admin/gallery/photos/{{ $photo->id }}">
                            <i class="fa fa-pencil" style="color: black;"></i>
                        </a>
                        <a href="/hotel-admin/gallery/photos/delete/{{ $photo->id }}">
                            <i class="fa fa-trash" style="color: black;"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ">
                    <img src="{{'/photos/'.$photo->gallery_photo}}" style="width: 100%;">
                </div>
            </div>
        </div>
    @endforeach
@endsection