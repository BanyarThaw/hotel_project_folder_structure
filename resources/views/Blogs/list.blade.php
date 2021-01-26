@extends('Templates.Blog.sub_template_blogs')

@section('sub_content')
    @foreach($blogs as $blog)
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <a href="/hotel-admin/blogs/detail/{{ $blog->id }}" class="btn-link">
                        <h2>
                            {{ $blog->title }}
                        </h2>
                    </a>
                    <div class="small m-b-xs">
                        <strong>{{ $blog->author_name }}</strong> <span class="text-muted"><i class="fa fa-clock-o"></i>{{ $blog->created_at }}</span>
                    </div>
                    <p>
                        {{ substr(strip_tags($blog->about),0,250) }}.........
                    </p>
                    <img src="{{'/photos/'.$blog->photo}}" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="small text-right">
                                <br>
                                <?php $total = 0 ?>
                                @foreach($comments as $comment)
                                    @if($comment->blog_id == $blog->id)
                                        <?php $total = $total+1 ?> 
                                    @endif
                                @endforeach
                                <div> <i class="fa fa-comments-o"> </i> {{ $total }} comments </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection