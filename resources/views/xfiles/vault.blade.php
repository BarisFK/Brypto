@extends('layouts.app')
@section('title', 'Vault')

@section('contents')
<div class="container mx-auto mt-8">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Hata!</strong>
            <span class="block sm:inline">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($vaultItems as $item)
            <div class="bg-green-500 hover:bg-green-700 rounded-lg shadow-md p-6 transition duration-300 relative">
                <h2 class="text-white text-xl font-semibold mb-2">{{ $item->title }}</h2>
                <div x-data="{ open: false, deleteMode: false }">
                    <button class="absolute top-4 right-4 text-white hover:text-green-200 focus:outline-none"
                        @click="open = !open" aria-expanded="false" aria-controls="keyInput-{{ $item->id }}">
                        <i class="bi bi-key-fill"></i>
                    </button>

                    <button class="absolute bottom-4 right-4 text-red-500 hover:text-red-700 focus:outline-none"
                        @click="deleteMode = true; open = false" x-show="!open">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    <div x-show="open" class="mt-4" id="keyInput-{{ $item->id }}">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                                @if (session('decryptedData'))
                                    <pre>{{ session('decryptedData') }}</pre>
                                @endif
                            </div>
                        @endif

                   @if (session('decryptionError'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('decryptionError') }}</span>
                    </div>
                @endif

                        @if ($item->decrypted_data)
                            <p class="text-white mb-2">Decrypted Data:</p>
                            <pre>{{ $item->decrypted_data }}</pre>
                        @else
                            <form action="{{ route('decryptVault') }}" method="POST">
                                @csrf
                                <input type="hidden" name="itemId" value="{{ $item->id }}">
                                <div class="mb-4">
                                    <input type="text" name="key"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Enter Decryption Key">
                                </div>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Decrypt</button>
                            </form>
                        @endif
                    </div>


                    <div x-show="deleteMode" class="mt-4" id="deleteConfirmation-{{ $item->id }}">
                        <p class="text-white mb-2">Are you sure you want to delete this item?</p>
                        <form action="{{ route('deleteVaultData', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="mb-4">
                                <input type="text" name="key"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Enter Decryption Key">
                            </div>
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                            <button type="button" @click="deleteMode = false"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection