<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('immobiles.update')}}" method="post">
                    @method("put")
                    @csrf
                    <input type="hidden" name="id" value="{{$immobile->id}}">
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        Atualização de Imóvel
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <x-label for="customer" :value="__('Locador:')" class="mx-2"/>
                        <select name="customer" id="customer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" required>
                            <option value="">Selecione o Locador</option>
                            @foreach ($users as $user)
                                @if ($immobile->user->id==$user->id)
                                    <option value="{{$user->id}}" selected>{{$user->id." - ".$user->name}}</option>
                                @else
                                    <option value="{{$user->id}}">{{$user->id." - ".$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <x-label for="cep" :value="__('Dados do Imóvel:')" class="mx-2" />
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cep" id="cep" placeholder="Cep" value="{{$immobile->cep}}" required>
                        <br>
                        <select name="uf" id="uf" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                            <option value="">Selecione o Estado</option>
                            @foreach ($ufs as $uf)
                                @if ($immobile->uf->id==$uf->id)
                                    <option value="{{$uf->id}}" selected>{{$uf->name}}</option>
                                @else
                                    <option value="{{$uf->id}}">{{$uf->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="city" id="city" placeholder="Cidade" value="{{$immobile->city}}" required>
                        <br>
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="district" id="district" placeholder="Bairro" value="{{$immobile->district}}" required>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="street" id="street" placeholder="Rua" value="{{$immobile->street}}" required>
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 ml-2" name="number" id="number" placeholder="Número" value="{{$immobile->number}}" required>
                        <br>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" name="complement" id="complement" placeholder="Complemento" value="{{$immobile->complement}}" required>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <x-label for="rent" :value="__('Valor do Aluguel:')" class="mx-2" />
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="rent" id="rent" placeholder="Aluguel" value="{{number_format($immobile->rent,2,",",".")}}" required>
                        
                        <select name="status" id="status" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                            <option value="Disponível" {{$immobile->status=="Disponível"?"selected":""}}>Disponível</option>
                            <option value="Alugado" {{$immobile->status=="Alugado"?"selected":""}}>Alugado</option>
                        </select>
                        
                        <select name="lessee" id="lessee" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2">
                            <option value="">Selecione o Locatário</option>
                            @foreach ($lessees as $lessee)
                                @if ($immobile->lessee->id==$lessee->id)
                                    <option value="{{$lessee->id}}" selected>{{$lessee->id." - ".$lessee->name}}</option>
                                @else
                                    <option value="{{$lessee->id}}">{{$lessee->id." - ".$lessee->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-4">
                            <button class="inline-block float-right items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 origin-top-right right-0">
                                Salvar
                            </button>
                            <br>
                        </div>
                    </div>
                </form>
                
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    Documentos
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    @if ($images->count()>0)
                        @foreach ($images as $image)
                            <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mx-3  right-0 mt-4">
                                <a href="{{ asset($image->image) }}" target="_BLANK"><img class="pr-1" src="{{ asset('img/file.svg') }}" ></a>
                                <div class="block">
                                    <a href="{{ route('immobiles.image.delete', ['id' => $image->id]) }}"><div class="float-right div-botao-x -m-3.5"></div></a>
                                    <a href="{{ asset($image->image) }}" target="_BLANK">
                                        <p>{{$image->type}}</p>
                                        <p>16/06/2021</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="block font-medium text-sm text-gray-700 mx-2">Nenhum arquivo anexado</p>
                    @endif
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    Anexar Documentos
                </div>
                <div class="p-6 bg-white mb-1">
                    <form action="{{ route('immobiles.image') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="immobile_id" value="{{$immobile->id}}">

                        <select name="type" id="type" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 mx-2" required>
                            <option value="Contrato">Contrato</option>
                            <option value="Identidade">Identidade</option>
                        </select>

                        <input type="file" class="shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="file" id="file" required>

                        <div class="mt-4">
                            <button class="inline-block float-right items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 origin-top-right right-0">
                                Enviar
                            </button>
                            <br>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $('#cep').mask('00000-000', {reverse: true});
        $('#rent').mask('00.000.000,00', {reverse: true});
    </x-slot>
</x-app-layout>
