<h2>Testing Area</h2>
{{ $total_member }}
<div>
    <div style="float: left;margin-right: 30px;">
        <form action="/test_extra_bed" method="post">
            {{ csrf_field() }}
            <button>+1 bed</button>
        </form>
    </div>
    <div>
        <form action="/extra_room" method="post">
            {{ csrf_field() }}
            <button>Extra Room</button>
        </form>
    </div>
</div>