<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(auth()->user()->status === 'blocked')
                <div class="p-6 text-gray-900 dark:text-gray-100" style="background-color: red;">
                        {{ __("Votre compte est banni.") }}
                </div>
                    @elseif(auth()->user()->status === 'en_attente')
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="background-color: blue;">
                        {{ __("Votre compte est en attente de validation.") }}
                    </div>
                    @else
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="background-color: green">
                        {{ __("Vous êtes connecté!") }}
                        @can('view permission')
                        <button>test</button>
                        @endcan
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
