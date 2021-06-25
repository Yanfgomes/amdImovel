<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('immobiles.store')}}" method="post">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        Informações de Cadastro
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <x-label for="customer" :value="__('Locador:')" class="mx-2"/>
                        <select name="customer" id="customer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" required>
                            <option value="">Selecione o Locador</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->id." - ".$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <x-label for="cep" :value="__('Dados do Imóvel:')" class="mx-2" />
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cep" id="cep" placeholder="Cep" required>
                        <br>
                        <select name="uf" id="uf" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                            <option value="">Selecione o Estado</option>
                            @foreach ($ufs as $uf)
                                <option value="{{$uf->id}}">{{$uf->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="city" id="city" placeholder="Cidade" required>
                        <br>
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="district" id="district" placeholder="Bairro" required>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="street" id="street" placeholder="Rua" required>
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2" name="number" id="number" placeholder="Número" required>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="complement" id="complement" placeholder="Complemento" required>
                    </div>
                    <div class="p-6 bg-white mb-1">
                        <x-label for="rent" :value="__('Valor do Aluguel:')" class="mx-2" />
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="rent" id="rent" placeholder="Aluguel" required>
                        
                        <select name="status" id="status" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                            <option value="Disponível">Disponível</option>
                            <option value="Alugado">Alugado</option>
                        </select>
                        
                        <select name="lessee" id="lessee" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2">
                            <option value="">Selecione o Locatário</option>
                            @foreach ($lessees as $lessee)
                                <option value="{{$lessee->id}}">{{$lessee->id." - ".$lessee->name}}</option>
                            @endforeach
                        </select>
                        <div class="mt-4">
                            <button class="inline-block float-right items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 origin-top-right right-0">
                                Salvar
                            </button>
                            <br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="script">
        $('#cep').mask('00000-000', {reverse: true});
        $('#rent').mask('00.000.000,00', {reverse: true});
    </x-slot>
</x-app-layout>
