<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
            <div class="flex items-center">
                <span class="text-gray-900 font-semibold">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
                <div class="ml-4 relative">
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_pic ?? asset('path/to/default-image.png') }}" alt="{{ Auth::user()->prenom }}">
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">
                        {{ __('Bonjour, :name!', ['name' => Auth::user()->prenom . ' ' . Auth::user()->nom]) }}
                    </h1>
                    <p>{{ __("Vous êtes connecté!") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
