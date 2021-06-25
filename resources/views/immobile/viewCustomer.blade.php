<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    informações do Imóvel
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    <x-label for="customer" :value="__('Locador:')" class="mx-2"/>
                    <select name="customer" id="customer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" required>
                        <option value="{{$immobile->user->id}}" selected>{{$immobile->user->id." - ".$immobile->user->name}}</option>
                    </select>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    <x-label for="cep" :value="__('Dados do Imóvel:')" class="mx-2" />
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cep" id="cep" placeholder="Cep" value="{{$immobile->cep}}" required>
                    <br>
                    <select name="uf" id="uf" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                        <option value="{{$immobile->uf->id}}" selected>{{$immobile->uf->name}}</option>
                    </select>
                    <br>
                    <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="city" id="city" placeholder="Cidade" value="{{$immobile->city}}" required>
                    <br>
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="district" id="district" placeholder="Bairro" value="{{$immobile->district}}" required>
                    <br>
                    <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="street" id="street" placeholder="Rua" value="{{$immobile->street}}" required>
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2" name="number" id="number" placeholder="Número" value="{{$immobile->number}}" required>
                    <br>
                    <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="complement" id="complement" placeholder="Complemento" value="{{$immobile->complement}}" required>
                </div>
                <div class="p-6 bg-white mb-1">
                    <x-label for="rent" :value="__('Valor do Aluguel:')" class="mx-2" />
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="rent" id="rent" placeholder="Aluguel" value="{{number_format($immobile->rent,2,",",".")}}" required>
                    
                    <select name="status" id="status" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                        <option value="">{{$immobile->status}}</option>
                    </select>
                    
                    <select name="lessee" id="lessee" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2">
                        @if (isset($immobile->lessee->id))
                            <option value="">{{$immobile->lessee->id." - ".$immobile->lessee->name}}</option>
                        @else
                            <option value=""></option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $('#cep').mask('00000-000', {reverse: true});
        $('#rent').mask('00.000.000,00', {reverse: true});
    </x-slot>
</x-app-layout>
