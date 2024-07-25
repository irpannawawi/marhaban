<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('administrator.update', ['administrator' => $user]) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <x-input-label for="role" :value="__('Role')" />
                                <select id="role" class="block mt-1 w-full rounded-md shadow-sm" name="role" required>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staf_bahan" {{ $user->role === 'staf_bahan' ? 'selected' : '' }}>Staf Bahan</option>
                                    <option value="staf_produk" {{ $user->role === 'staf_produk' ? 'selected' : '' }}>Staf Produk</option>
                                </select>
                                <x-input-error for="role" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                <x-input-error for="password" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                <x-input-error for="password_confirmation" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Modals --}}


</x-app-layout>
