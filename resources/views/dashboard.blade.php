<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Administração de imóvel e assessoria jurídica
                    </h2>
                </div>
                <img src="{{ asset('img/'.$imagem.'.jpg') }}" class="float-right pt-1" width="720px" height="405px">
                <h1 class="font-semibold text-6xl text-gray-800 leading-tight text-center py-14">
                    {{$mensagem}},<br>
                    {{$firstName}}
                </h1>
            </div>
        </div>
    </div>

    <x-slot name="script">
    </x-slot>
</x-app-layout>
