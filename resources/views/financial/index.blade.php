<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    <a href="{{route('financial.create')}}">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            Nova Fatura
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
    </x-slot>
</x-app-layout>
