<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('customer.store')}}" method="post">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        Informações de Cadastro
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="cpf" id="cpf" placeholder="cpf" required>
                        <input type="text" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="name" id="name" placeholder="name" required>
                        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="phone" id="phone" placeholder="Phone" required>
                        <input type="email" class="w-80 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <input type="password" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="password" id="password" placeholder="Password" required>
                        <input type="password" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 mx-2" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 mb-1">
                        <div class="mt-4">
                            <input type="radio" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mx-2" name="permission" value="1" required> Administrador
                        </div>
                        <div class="mt-4">
                            <input type="radio" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mx-2" name="permission" value="2" required> Cliente
                        </div>
                        <div class="mt-4">
                            <input type="radio" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mx-2" name="permission" value="3" required> Locatário
                        </div>
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
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#phone').mask('(00) 00000-0000');
    </x-slot>
</x-app-layout>
