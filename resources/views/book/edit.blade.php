<h3>Modifica book</h3>

<form method="POST" action="{{route('books.update', ['book'=> $book->id])}}">
    @csrf
    @method('PUT')
    <br/>
    <span>title</span>
    <br/>
    <input type="text" name="title" value="{{$book->title}}">
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>isbn</span>
    <br/>
    <input type="text" name="isbn" value="{{$book->isbn}}">
    @error('isbn')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>author</span>
    <br/>
    <input type="text" name="author" value="{{$book->author}}">
    @error('author')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Genere</span>
    <br/>
    <select name="genre_id">
        @foreach($genres AS $value)
            <option value="{{$value->id}}" @if($value->id == $book->genre_id)  selected @endif>{{$value->genre}}</option>
        @endforeach
    </select>
    @error('genre_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Quantità</span>
    <br/>
    <input type="text" name="quantity" value="{{$book->quantity}}">
    @error('quantity')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Anno di pubblicazione</span>
    <br/>
    <input type="text" name="year" value="{{$book->year}}">
    @error('year')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <input type="submit" value="salva book">
</form>
