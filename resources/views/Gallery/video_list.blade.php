@extends('Templates.Gallery.sub_template_video')

@section('sub_content')
    @foreach($videos as $video)
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="/hotel-admin/gallery/videos/edit/{{ $video->id }}">
                            <i class="fa fa-pencil" style="color: black;"></i>
                        </a>
                        <a href="/hotel-admin/gallery/videos/delete/{{ $video->id }}">
                            <i class="fa fa-trash" style="color: black;"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ">
                    <video controls>
                        <source src="{{'/videos/'.$video->gallery_video}}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    @endforeach
@endsection