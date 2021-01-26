@extends('Templates.Public.main_template')

@section('content')
    <h2>Gallery Videos</h2>
    @foreach($gallery_videos as $gallery_video)
        <div> 
            <video controls>
                <source src="{{'/videos/'.$gallery_video->gallery_video}}" type="video/mp4">
            </video>
        </div>
        <br>
    @endforeach
@endsection