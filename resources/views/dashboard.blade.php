<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-2">
                    <div class="col-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="float-start">Saran AI</h3>
                                <div class="float-end mt-2">
                                    <a href="{{route('generate_advice')}}" class="btn btn-primary">Generate</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>{{$gpt_response==null?'Belum ada saran':$gpt_response}}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <x-grafik-penjualan />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <x-chats />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
