<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ADMIN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Inserisci libro') }}
                            </h2>
                        </header>
                    </section>

                    <section>
                        @isset($book->id)
                            <form method="POST" action="{{route('books.update', ['book'=> $book->id])}}" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')
                        @else
                            <form method="post" action="{{ route('books.store') }}" class="mt-6 space-y-6">
                                @csrf
                        @endisset


                            <div>
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                              :value="old('title', $book->title )" x-model="formData.title"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>

                            <div>
                                <x-input-label for="isbn" :value="__('Isbn')"/>
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full"
                                              :value="old('isbn', $book->isbn)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('isbn')"/>
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Author')"/>
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                                              :value="old('author', $book->author)" x-model="formData.author"/>
                                <x-input-error class="mt-2" :messages="$errors->get('author')"/>
                            </div>

                            <div>
                                <x-input-label for="genre_id" :value="__('Genre')"/>
                                <select name="genre_id" id="genre_id"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="0">Seleziona</option>
                                    @foreach($genres AS $genre)
                                        <option value="{{$genre->id}}"@if($genre->id == $book->genre_id) selected @endif>{{$genre->name}}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('genre_id')"/>
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Quantity')"/>
                                <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full"
                                              :value="old('quantity', $book->quantity)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('quantity')"/>
                            </div>

                            <div>
                                <x-input-label for="year" :value="__('Year')"/>
                                <x-text-input id="year" name="year" type="text" class="mt-1 block w-full"
                                              :value="old('year', $book->year)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('year')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>

                        </form>

                    </section>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    function saveForm() {

    }

</script>



</body>
</html>
