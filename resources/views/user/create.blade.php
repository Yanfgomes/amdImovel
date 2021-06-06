<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    Informações de Cadastro
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1" name="cpf" id="cpf" placeholder="cpf">
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1" name="phone" id="phone" placeholder="(99)9999-9999">
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $('#cpf').mask('000.000.000-00', {reverse: true});
    </x-slot>
</x-app-layout>
