<form action="{{route('postForm')}}" method="POST">
    @csrf 
    <span>ho ten </span><input type="text" name="hoten">
    <span>age </span><input type="text" name="age">
    <span> address </span><input type="text" name="address">
    <input type="submit">
</form>