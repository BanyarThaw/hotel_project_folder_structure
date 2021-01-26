<h2>Create Room</h2>
<form action="/hotel-admin/room" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label>Room Name :</label><br>
    <input type="text" name="name" required>
    <br><br>
    <label>About</label><br>
    <textarea name="about"></textarea>
    <br><br>
    <label>Price :</label><br>
    <input type="number" name="price" required>
    <br><br>
    <label>Max Member</label><br>
    <input type="number" name="max_member" required>
    <br><br>
    <label>Photo :</label><br>
    <input type="file" name="photo" required>
    <br><br>
    <input type="submit" value="Create">
</form> 