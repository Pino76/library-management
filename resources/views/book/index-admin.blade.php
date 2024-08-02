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
                                {{ __('ADMIN - Book') }}
                            </h2>
                        </header>
                    </section>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Gestionale
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                <a href="{{route('books.create')}}">Crea Nuovo Libro</a>
                            </p>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                <a href="{{route('view-search')}}">Per modificare il libro</a>
                            </p>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Per visualizzare utenti e vedere lo stato dei libri degli utenti
                            </p>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Restituzione libro
                            </p>




                        </header>


                    </section>
                </div>


            </div>

        </div>
    </div>
</x-app-layout>
