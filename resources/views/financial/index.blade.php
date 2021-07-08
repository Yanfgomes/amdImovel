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
                @if (auth()->user()->adm==1)
                    <form action="{{route('financial.index')}}" method="post">
                        <div class="p-6 bg-white border-b border-gray-200 mb-1 flex justify-around">
                            <select name="customer" id="customer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2">
                                <option value="">Todos</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
                                @endforeach
                            </select>
                            <select name="immobile" id="immobile" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2">
                                <option value="">Todos</option>
                                @foreach ($immobiles as $immobile)
                                    <option value="{{$immobile->id}}">{{$immobile->id}} - {{$immobile->street." ".$immobile->number.", ".$immobile->complement}}</option>
                                @endforeach
                            </select>
                            <input type="month" name="month" id="month" value="{{$month}}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2">

                            <input type="submit" value="Filtrar" class="inline-flex items-center px-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                        </div>
                    </form>
                
                @elseif (auth()->user()->customer==1)
                    <form action="{{route('financial.index')}}" method="post">
                        <div class="p-6 bg-white border-b border-gray-200 mb-1 flex justify-around">
                            <input type="month" name="month" id="month" value="{{$month}}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2">

                            <input type="submit" value="Filtrar" class="inline-flex items-center px-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                        </div>
                    </form>
                @endif
                <div class="p-6 bg-white mb-1">
                    <div class="w-full p2 text-center text-lg font-bold">
                        Faturas Em Aberto
                    </div>
                    <div class="my2 py-2 border-b border-gray-200 mb-1">
                        <table id="tableFinancials" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Endereço</th>
                                    <th>Valor</th>
                                    <th>Fatura</th>
                                    <th>Data</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financialsNotPaid as $bill)
                                    @php
                                        if($bill->value>0)
                                            $valor=$bill->value;
                                        else
                                            $valor=$bill->value*-1;
                                    @endphp
                                    <tr>
                                        <td>{{$bill->immobile->street." ".$bill->immobile->number.", ".$bill->immobile->complement}}</td>
                                        <td>R$ {{number_format($valor,2,",",".")}}</td>
                                        <td>{{$bill->type->name}}</td>
                                        <td>{{$bill->created_at->format("d/m/Y")}}</td>
                                        <td><a href="{{route('financial.view', ['id' => $bill->id])}}"><img src="{{ asset('img/info.svg') }}" ></a></td>
                                        <td><a href="{{route('financial.delete', ['id' => $bill->id])}}"><img src="{{ asset('img/trash-2.svg') }}" ></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="w-full p2 text-center text-lg font-bold mt-4">
                        Faturamento dos Imóveis
                    </div>
                    <div class="my-2">
                        <table id="tableImmobiles" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Endereço</th>
                                    <th>Faturas</th>
                                    <th>Total Geral</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financials as $immobile)
                                    <tr>
                                        <td>{{$immobile->street." ".$immobile->number.", ".$immobile->complement}}</td>
                                        <td>{{$immobile->financial->count()}}</td>
                                        <td>R$ {{number_format($immobile->financial->sum('value'))}}</td>
                                        <td>
                                            <form action="{{route('immobiles.dashboard', ['id' => $immobile->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="month" value="{{$month}}">
                                                <button>
                                                    <img src="{{ asset('img/info.svg') }}" >
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $(document).ready(function() {
            $('#tableFinancials').DataTable({
                "scrollX": true,
                "searching": false
            });
        } );

        $(document).ready(function() {
            $('#tableImmobiles').DataTable({
                "scrollX": true,
                "searching": false
            });
        } );
    </x-slot>
</x-app-layout>
