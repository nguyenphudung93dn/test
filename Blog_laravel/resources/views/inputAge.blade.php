<form action="{{route('checkage')}}" method="GET">
    @csrf 
    <input type="number" name="age">
    <input type="submit">
</form>

