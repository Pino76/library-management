<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Search Book') }}
                            </h2>

                        </header>

                        <form method="post" @submit.prevent="searchBooks" class="mt-6 space-y-6">
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


            <div x-data="{bCount :{{$bCount}} }" x-show="bCount > 0 "
                 class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                 style="border: 1px solid #F00">
                <div class="p-6 text-gray-900 dark:text-gray-100">

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
                                    Year
                                </th>
                                @if(Auth::user()->role_id == \App\Enum\UserRoles::USER)
                                    <th scope="col" class="px-6 py-3">
                                        Reserve
                                    </th>
                                @else
                                    <th scope="col" class="px-6 py-3" colspan="2">
                                        Admin Action
                                    </th>
                                @endif
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
                                        {{$book->year}}
                                    </td>
                                    @if(Auth::user()->role_id == \App\Enum\UserRoles::USER)
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            @if($book->reserve > 0 &&  $book->is_assigned == 0 )
                                                <form method="POST"
                                                      action="{{route("reserve-book", ["book"=> $book])}}">
                                                    @method("PUT")
                                                    @csrf
                                                    <x-primary-button>{{ __('reserve') }}</x-primary-button>
                                                </form>
                                            @else
                                                {{$book->reserve == 0 ? 'il libro non è disponibile' : 'il libro è presente nella tua lista' }}
                                            @endif
                                        </td>
                                    @else
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            <x-primary-button>
                                                <a href="{{route("books.edit" , ["book" => $book])}}">{{ __('edit') }}</a>
                                            </x-primary-button>
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                            <form method="POST" action="{{route("books.destroy", ["book" => $book])}}">
                                                @method("DELETE")
                                                @csrf
                                                <x-primary-button>{{ __('delete') }}</x-primary-button>
                                            </form>

                                        </td>
                                    @endif
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


        </div>
    </div>
</x-app-layout>
