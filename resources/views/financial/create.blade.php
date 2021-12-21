<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('financial.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        Informações de Cadastro
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        
                        <x-label for="immobile" :value="__('Imóvel:')" class="mx-2  my-2 pt-1" />
                        <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="immobile" id="immobile" required>
                            <option value="">Selecione o Imóvel</option>
                            @foreach ($immobiles as $immobile)
                                <option value="{{$immobile->id}}">{{$immobile->id}} - {{$immobile->street." ".$immobile->number.", ".$immobile->complement}}</option>
                            @endforeach
                        </select>
                        
                        <x-label for="type" :value="__('Tipo da Fatura:')" class="mx-2  my-2 pt-1" />
                        <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="type" id="type" required>
                            <option value="">Selecione o Lançamento</option>
                            @foreach ($listTypes as $listType)
                                <option value="{{$listType->id}}">{{$listType->id}} - {{$listType->name}}</option>
                            @endforeach
                        </select>

                        <x-label for="value" :value="__('Valor:')" class="mx-2 my-2 pt-1" />
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="value" id="value" placeholder="Valor" required>
                        
                        <x-label for="cycle" :value="__('Período:')" class="mx-2 my-2 pt-1" />
                        <input type="month" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cycle" id="cycle" value="{{date("Y-m")}}" required>

                        <x-label for="due" :value="__('Vencimento:')" class="mx-2 my-2 pt-1" />
                        <input type="date" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="due" id="due" value="{{date("Y-m-d")}}" required>
                        
                        <x-label for="status" :value="__('Status:')" class="mx-2 my-2 pt-1" />
                        <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                            @foreach ($listStatus as $listStatu)
                                <option value="{{$listStatu->id}}">{{$listStatu->id}} - {{$listStatu->name}}</option>
                            @endforeach
                        </select>

                        <x-label for="file" :value="__('Comprovante:')" class="mx-2 my-2 pt-1" />
                        <input type="file" name="file" id="file" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2">
                    </div>
                    <div class="p-6 bg-white mb-1">
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
        $('#value').mask('000.000,00', {reverse: true});
    </x-slot>
</x-app-layout>
