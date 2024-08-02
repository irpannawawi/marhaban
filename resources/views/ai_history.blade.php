<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AI History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-3 shadow-sm sm:rounded-lg">
                <div class="row d-flex justify-content-end">
                    <div class="col-md-4 float-end">
                        <form action="{{ route('ai_history') }}">
                            @csrf
                            <x-filter />
                        </form>
                    </div>
                    <div class="col-12 p-2">
                        <table class="table table-hover table-striped table-sm table-bordered datatable">
                            <thead >
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tgl</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Response</th>
                                    <th class="text-center">Total Token</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gpt_responses as $ai_history)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td nowrap>{{ Illuminate\Support\Carbon::parse($ai_history->created_at)->format('d-m-Y H:i') }}</td>
                                        <td class="text-center">{{ $ai_history->model }}</td>
                                        <td>{{ $ai_history->response }}</td>
                                        <td class="text-center">{{ number_format($ai_history->total_token, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
