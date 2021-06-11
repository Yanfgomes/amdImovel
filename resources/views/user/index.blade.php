<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-1">
                    <a href="{{route('customer.create')}}">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            Novo Usuário
                        </button>
                    </a>
                </div>
                <table id="tableUser" class="display mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cpf</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Usuário</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->cpf}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                @if ($user->adm==1)
                                    <td>Administrador</td>
                                @elseif ($user->customer==1)
                                    <td>Cliente</td>
                                @elseif ($user->lessee==1)
                                    <td>Locatário</td>
                                @else
                                    <td>?</td>
                                @endif
                                <td><a href="{{route('customer.view', ['id' => $user->id])}}"><img src="{{ asset('img/info.svg') }}" ></a></td>
                                <td><a href="{{route('customer.delete', ['id' => $user->id])}}"><img src="{{ asset('img/trash-2.svg') }}" ></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        $(document).ready(function() {
            $('#tableUser').DataTable();
        } );
    </x-slot>
</x-app-layout>
