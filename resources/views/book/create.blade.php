<h3>Crea Nuovo book</h3>

<form method="POST" action="{{route('books.store')}}">
    @csrf
    <br/>
    <span>title</span>
    <br/>
    <input type="text" name="title" value="{{old('title')}}">
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>isbn</span>
    <br/>
    <input type="text" name="isbn" value="{{old('isbn')}}">
    @error('isbn')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>author</span>
    <br/>
    <input type="text" name="author" value="{{old('author')}}">
    @error('author')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Genere</span>
    <br/>
    <select name="genre_id">
        <option value="0">Seleziona</option>
        @foreach($genres AS $genre)
            <option value="{{$genre->id}}">{{$genre->name}}</option>
        @endforeach
    </select>
    @error('genre_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Quantità</span>
    <br/>
    <input type="text" name="quantity" value="{{old('quantity')}}">
    @error('quantity')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <span>Anno di pubblicazione</span>
    <br/>
    <input type="text" name="year" value="{{old('year')}}">
    @error('year')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <input type="submit" value="salva book">
</form>



