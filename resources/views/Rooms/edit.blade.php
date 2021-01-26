<h2>Edit Room</h2>
<form action="/hotel-admin/room/{{ $room->id }}" method="POST" enctype="multipart/form-data">
    {{ method_field("PUT") }}
    {{ csrf_field() }}
    <label>Room Name :</label><br>
    <input type="text" name="name" value="{{ $room->name }}" required>
    <br><br>
    <label>About</label><br>
    <textarea name="about">{{ $room->about }}</textarea>
    <br><br>
    <label>Price :</label><br>
    <input type="number" name="price" value="{{ $room->price }}" required>
    <br><br>
    <label>Max Member :</label><br>
    <input type="number" name="max_member" value="{{ $room->max_member }}" required>
    <br><br>
    <label>Photo :</label><br>
    <input type="file" name="photo">
    <br><br>
    <input type="submit" value="Create">
</form> 