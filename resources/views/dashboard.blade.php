<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-3">
                    <div class="p-2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        {{-- saran ai --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="float-start">Saran AI</h3>
                                <div class="float-end mt-2">
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{ route('generate_advice') }}" class="btn btn-primary">Generate</a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($gpt_responses as $gpt)
                                            <div class="carousel-item @if ($loop->first) active @endif">
                                                <span
                                                    class="badge text-bg-secondary mb-3">{{ Illuminate\Support\Carbon::parse($gpt->created_at)->diffForHumans() }}</span>
                                                <p>{!! $gpt->response !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="float-start text-primary underline" href="{{ route('ai_history') }}">History Ai</a>
                                <button class="btn btn-primary float-end btn-sm ml-1" type="button"
                                    data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="">Next</span>
                                </button>
                                <button class="btn btn-primary float-end btn-sm ml-1" type="button"
                                    data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="">Previous</span>
                                </button>
                            </div>
                        </div>
                        {{-- ./ saran ai --}}
                    </div>
                    <div class="p-2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <x-grafik-penjualan />
                    </div>

                </div>
                <div class="row p-2">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
