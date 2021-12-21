<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    Informações de Cadastro
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    @php
                        if($financial->value>0)
                            $value=$financial->value;
                        else
                            $value=$financial->value*-1;
                    @endphp
                    
                    <x-label for="immobile" :value="__('Imóvel:')" class="mx-2  my-2 pt-1" />
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="immobile" id="immobile" required>
                        <option value="{{$financial->immobile_id}}" selected>{{$financial->immobile_id}} - {{$financial->immobile->street." ".$financial->immobile->number.", ".$financial->immobile->complement}}</option>
                    </select>
                    
                    <x-label for="type" :value="__('Tipo da Fatura:')" class="mx-2  my-2 pt-1" />
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="type" id="type" required>
                        <option value="{{$financial->type_id}}" selected>{{$listType->id}} - {{$listType->type->name}}</option>
                    </select>

                    <x-label for="value" :value="__('Valor:')" class="mx-2 my-2 pt-1" />
                    <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="value" id="value" placeholder="Valor" value="{{number_format($value,2,',','.')}}" required>
  
                    <x-label for="cycle" :value="__('Período:')" class="mx-2 my-2 pt-1" />
                    <input type="month" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cycle" id="cycle" value="{{substr($financial->cycle,0,7)}}" required>

                    <x-label for="due" :value="__('Vencimento:')" class="mx-2 my-2 pt-1" />
                    <input type="date" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="due" id="due" value="{{$financial->due}}" required>

                    <x-label for="status" :value="__('Status:')" class="mx-2 my-2 pt-1" />
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="status" id="status" required>
                        <option value="{{$financial->status_id}}" selected>{{$financial->status_id}} - {{$financial->status->name}}</option>
                    </select>

                    <x-label for="file" :value="__('Comprovante:')" class="mx-2 my-2 pt-1" />
                    @if (!empty($financial->document))
                        <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mx-3  right-0 mt-4">
                            <a href="{{ asset($financial->document) }}" target="_BLANK"><img class="pr-1" src="{{ asset('img/file.svg') }}" ></a>
                            <div class="block">
                                <a href="{{ asset($financial->document) }}" target="_BLANK">
                                    <p>Comprovante</p>
                                    <p>{{$financial->paid->format("d/m/Y")}}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
    </x-slot>
</x-app-layout>
