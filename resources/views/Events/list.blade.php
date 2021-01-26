@extends('Templates.Event.sub_template_events')

@section('sub_content')
    @foreach($events as $event)
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <a href="/hotel-admin/events/detail/{{ $event->id }}" class="btn-link">
                        <h2>
                            {{ $event->title }}
                        </h2>
                    </a>
                    <div class="small m-b-xs">
                        <strong>{{ $event->author_name }}</strong> <span class="text-muted"><i class="fa fa-clock-o"></i>{{ $event->created_at }}</span>
                    </div>
                    <p>
                        {{ substr(strip_tags($event->about),0,250) }}.........
                    </p>
                    <img src="{{'/photos/'.$event->photo}}" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="small text-right">
                                <br>
                                <?php $total = 0 ?>
                                @foreach($comments as $comment)
                                    @if($comment->event_id == $event->id)
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
    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection