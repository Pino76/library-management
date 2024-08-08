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
                                {{ __('Manage Book') }}
                            </h2>
                        </header>
                    </section>

                </div>
            </div>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                                    Year
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Reserve
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Borrowed
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    To be returned
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Returned
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
                                        {{$book->year}}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                        {{$book->pivot->created_at->format('d-m-Y')}}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                        @if($book->pivot->borrowed_date != null)
                                            {{ Carbon\Carbon::parse($book->pivot->borrowed_date)->format('d-m-Y') }}
                                        @else
                                            <span> - </span>
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 text-center">

                                        {{ Carbon\Carbon::parse($book->pivot->expire_date)->format('d-m-Y') }}

                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                        @if($book->pivot->returned_date != null)
                                            {{ Carbon\Carbon::parse($book->pivot->returned_date)->format('d-m-Y') }}
                                        @else
                                            <span> - </span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 font-medium text-gray-900 text-center">
                                        nessun libro preso in prestito
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
