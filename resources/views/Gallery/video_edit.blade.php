@extends('Templates.Gallery.sub_template_video_edit')

@section('sub_content')
    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-content ">
                <video controls>
                    <source src="{{'/videos/'.$video->gallery_video}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
@endsection