@extends('Templates.Blog.sub_template_blogs_show')

@section('sub_content')
    <div class="col-lg-10">
        <div class="ibox">
            <div class="ibox-content">
                <div class="float-right">
                    <button class="btn btn-white btn-xs" type="button"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<a href="/hotel-admin/blogs/edit/{{ $blog->id }}" style="color:black;">Edit</a></button>
                    <button class="btn btn-white btn-xs" type="button"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<a href="/hotel-admin/blogs/delete/{{ $blog->id }}" style="color:black;">Delete</a></button>
                </div>
                <div class="text-center article-title">
                <span class="text-muted"><i class="fa fa-clock-o"></i>{{ $blog->created_at }}</span>
                    <h1>
                        {{ $blog->title }}
                    </h1>
                </div>
                <p>
                {!! $blog->about !!}
                </p>
                <img src="{{'/photos/'.$blog->photo}}" style="width: 100%;">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="small text-right">
                            <br>
                            <?php $total = 0; ?>
                            @foreach($comments as $comment)
                                @if($comment->blog_id == $blog->id)
                                    <?php $total = $total +  1; ?>
                                @endif
                            @endforeach
                            <div> <i class="fa fa-comments-o"> </i> {{ $total }} comments </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Comments:</h2>
                        @foreach($comments as $comment)
                            @if($comment->blog_id == $blog->id)
                                <div class="social-feed-box">
                                    <div class="social-avatar">
                                        <div class="media-body">
                                        
                                                <a href="#">
                                                    {{ $comment->email }}
                                                </a>
                                                <small class="text-muted">{{ $comment->created_at }}</small>
                                            
                                        </div>
                                    </div>
                                    <div class="social-body">
                                        <p>
                                        {{ $comment->comment }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection