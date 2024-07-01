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
                                <h3>Saran AI</h3>
                            </div>
                            <div class="card-body">
                                <p>Penjualan Anda terlihat bagus belakangan ini. Tingkatkan stok bahan baku terigu sebesar 20% dan gula sebesar 30%. Penggunaan stok meningkat, jadi pastikan persediaan cukup untuk memenuhi permintaan yang terus bertambah. Dengan langkah ini, kita dapat memastikan kelancaran produksi dan mempertahankan kualitas produk kita. Teruslah bersemangat dan semoga penjualan semakin meningkat!</p>
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
