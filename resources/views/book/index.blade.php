<h3>Seleziona</h3>
<hr>
<a href="{{route('books.create')}}">Crea</a>
<hr>
<table width="100%" border="1px solid #F00">
    <thead>
    <tr>
        <td>Id</td>
        <td>Title</td>
        <td>isbn</td>
        <td>author</td>
        <td>genre_id</td>
        <td>genre</td>
        <td>quantity</td>
        <td>reserve</td>
        <td>year</td>
        <td colspan="2">Actions</td>
    </tr>
    </thead>
    <tbody style="border:1px solid #F00">
    @foreach($books AS $book)
        <tr>
        <td>{{$book->id}}</td>
        <td>{{$book->title}}</td>
        <td>{{$book->isbn}}</td>
        <td>{{$book->author}}</td>
        <td>{{$book->genre_id}}</td>
        <td>{{$book->genere->genre}}</td>
        <td>{{$book->quantity}}</td>
        <td>
            {{$book->reserve}}
            <form method="POST" action="{{route("reserve-book", ["book"=> $book])}}">

                @method("PUT")
                @csrf
                <input type="submit" value="Prenota">
            </form>
        </td>
        <td>{{$book->year}}</td>
        <td><a href="{{route("books.edit" , ["book" => $book])}}">Modifica</a></td>
        <td>
        <form method="POST" action="{{route("books.destroy", ["book" => $book])}}">
            @method("DELETE")
            @csrf
            <input type="submit" value="ELIMINA">
        </form>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>

<br><br><br>
<hr/>
<br><br><br>
<p>Cerca</p>

<form method="POST" action="{{route("search-book")}}">
    @csrf
    <br/>
    <span>title</span>
    <br/>
    <input type="text" name="title" value="{{old('title')}}">
    @error('title')
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
        @foreach($genres AS $value)
            <option value="{{$value->id}}">{{$value->genre}}</option>
        @endforeach
    </select>
    @error('genre_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br/><br/>
    <input type="submit" value="cerca">

</form>


