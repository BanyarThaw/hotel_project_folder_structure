@extends('Templates.Gallery.sub_template_photo_edit')

@section('sub_content')
    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-content ">
                <img src="{{'/photos/'.$galleryPhoto->gallery_photo}}" style="width: 100%;">
            </div>
        </div>
    </div>
@endsection