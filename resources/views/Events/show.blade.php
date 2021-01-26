@extends('Templates.Event.sub_template_events_show')

@section('sub_content')
    <div class="col-lg-10">
        <div class="ibox">
            <div class="ibox-content">
                <div class="float-right">
                    <button class="btn btn-white btn-xs" type="button"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<a href="/hotel-admin/events/edit/{{ $event->id }}" style="color:black;">Edit</a></button>
                    <button class="btn btn-white btn-xs" type="button"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<a href="/hotel-admin/events/delete/{{ $event->id }}" style="color:black;">Delete</a></button>
                </div>
                <div class="text-center article-title">
                <span class="text-muted"><i class="fa fa-clock-o"></i>{{ $event->created_at }}</span>
                    <h1>
                        {{ $event->title }}
                    </h1>
                </div>
                <p>
                {!! $event->about !!}
                </p>
                <img src="{{'/photos/'.$event->photo}}" style="width: 100%;">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="small text-right">
                            <br>
                            <?php $total = 0; ?>
                            @foreach($comments as $comment)
                                @if($comment->event_id == $event->id)
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
                            @if($comment->event_id == $event->id)
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