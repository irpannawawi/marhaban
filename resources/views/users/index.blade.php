<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('administrator.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                        Create</a>
                        <table class="table table-hover table-striped table-sm table-bordered mt-2 ">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->role }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('administrator.edit', ['administrator' => $user->id]) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <form
                                                action="{{ route('administrator.destroy', ['administrator' => $user->id]) }}"
                                                class="d-inline" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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


    {{-- Modals --}}


</x-app-layout>
