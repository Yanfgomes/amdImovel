<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (auth()->user()->adm==1)
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <a href="{{route('immobiles.create')}}">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                                Novo Imóvel
                            </button>
                        </a>
                    </div>
                @endif
                <table id="tableImmobiles" class="display mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Proprietário</th>
                            <th>Uf</th>
                            <th>Cidade</th>
                            <th>Bairro</th>
                            <th>Endereço</th>
                            <th>Aluguel</th>
                            <th>Status</th>
                            <th>Locatário</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($immobiles as $immobile)
                            <tr>
                                <td>{{$immobile->user->name}}</td>
                                <td>{{$immobile->uf->uf}}</td>
                                <td>{{$immobile->city}}</td>
                                <td>{{$immobile->district}}</td>
                                <td>{{$immobile->street." ".$immobile->number.", ".$immobile->complement}}</td>
                                <td>R$ {{number_format($immobile->rent,2,",",".")}}</td>
                                <td>{{$immobile->status}}</td>
                                <td>{{$immobile->lessee->name??''}}</td>
                                <td><a href="{{route('immobiles.view', ['id' => $immobile->id])}}"><img src="{{ asset('img/info.svg') }}" ></a></td>
                                <td><a href="{{route('customer.delete', ['id' => $immobile->id])}}"><img src="{{ asset('img/trash-2.svg') }}" ></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $(document).ready(function() {
            $('#tableImmobiles').DataTable();
        } );
    </x-slot>
</x-app-layout>
