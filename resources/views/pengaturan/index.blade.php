<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <tr>
                        <th>Pengaturan</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>App Name</td>
                        <td>{{ config('app.name') }}</td>
                    </tr>
                    <tr>
                        <td>App Url</td>
                        <td>{{ config('app.url') }}</td>
                    </tr>
                    <tr>
                        <td>App Version</td>
                        <td>{{ config('app.version') }}</td>
                    </tr>
                    <tr>
                        <td>App Env</td>
                        <td>{{ config('app.env') }}</td>
                    </tr>
                    <tr>
                        <td>Gpt Key</td>
                        <td>
                            <form
                                action="{{ route('pengaturan.update', ['pengaturan' => $pengaturans->where('key', 'gpt-key')->first()->id]) }}"
                                method="post">
                                @csrf
                                @method('patch')
                                <div class="input-group">
                                    <input type="password" class="form-control" name="value"
                                        value="{{ $pengaturans->where('key', 'gpt-key')->first()->value }}">

                                    <button type="submit" class="btn btn-primary input-group-text"><i
                                            class="fa fa-save"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Gpt Version</td>
                        <td>
                            <form
                                action="{{ route('pengaturan.update', ['pengaturan' => $pengaturans->where('key', 'gpt-version')->first()->id]) }}"
                                method="post">
                                @csrf
                                @method('patch')
                                <div class="input-group">
                                    <select class="form-control"  name="value">
                                        <option {{ $pengaturans->where('key', 'gpt-version')->first()->value=='gpt-3.5-turbo'?'selected':'' }} value="gpt-3.5-turbo">gpt-3.5-turbo</option>
                                        <option {{ $pengaturans->where('key', 'gpt-version')->first()->value=='gpt-4o'?'selected':'' }} value="gpt-4o">gpt-4o</option>
                                        <option {{ $pengaturans->where('key', 'gpt-version')->first()->value=='gpt-4'?'selected':'' }} value="gpt-4">gpt-4</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary input-group-text"><i
                                            class="fa fa-save"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Toko</td>
                        <td>
                            <form
                                action="{{ route('pengaturan.update', ['pengaturan' => $pengaturans->where('key', 'nama_toko')->first()->id]) }}"
                                method="post">
                                @csrf
                                @method('patch')
                                <div class="input-group">
                                    <input type="text" class="form-control" name="value"
                                        value="{{ $pengaturans->where('key', 'nama_toko')->first()->value }}">

                                    <button type="submit" class="btn btn-primary input-group-text"><i
                                            class="fa fa-save"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



</x-app-layout>
