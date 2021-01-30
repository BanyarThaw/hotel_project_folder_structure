<br>
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<script src="{{asset('js/jquery-3.3.1.js')}}" type='text/javascript'></script>
<script src="{{asset('js/jquery-ui.min.js')}}" type='text/javascript'></script>
<script type='text/javascript'>
    $(document).ready(function(){
        $('.dateFilter').datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
    });
</script>
<form autocomplete="off" action="/testing" method="post">
    {{ csrf_field() }}
    <label>Check Availablity</label>
    <br>
    <label>from date</label>
    <input autocomplete="off" type="text" name="from_date" class="dateFilter" required>
    <label>and end date</label>
    <input autocomplete="off" type="text" name="end_date" class="dateFilter" required>
    <br>
    <input type="submit" value="Submit">
</form>
