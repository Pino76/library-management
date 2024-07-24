<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ricerca Libro') }} {{ Auth::user() }} libro cercato{{$books}}
                                conta {{$bCount}}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('search-book') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                              :value="old('title' )"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Author')"/>
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                                              :value="old('author' )"/>
                                <x-input-error class="mt-2" :messages="$errors->get('author')"/>
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Genre')"/>
                                <select name="genre_id"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="0">Seleziona</option>
                                    @foreach($genres AS $genre)
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Search') }}</x-primary-button>

                            </div>
                        </form>
                    </section>

                </div>
            </div>


            <div class="space-y-10">&nbsp</div>

            @if($bCount != "")
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                     style="border: 1px solid #F00">
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="border: 1px solid #000">

                        <section>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        isbn
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Author
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Genre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Available
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reserve
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Year
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($books AS $book)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->title}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->isbn}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->author}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->genere->name}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->quantity}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->reserve}}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            @if($book->reserve > 0)
                                            <form method="POST" action="{{route("reserve-book", ["book"=> $book])}}">
                                                @method("PUT")
                                                @csrf
                                                <x-primary-button>{{ __('reserve') }}</x-primary-button>
                                            </form>
                                            @else
                                                libro non disponibile
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            {{$book->year}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 font-medium text-gray-900 text-center">
                                            nessun record trovato
                                        </td>
                                    </tr>

                                @endforelse


                                </tbody>
                            </table>


                        </section>

                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>