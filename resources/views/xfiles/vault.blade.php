@extends('layouts.app')
@section('title', 'Vault')

@section('contents')
<div class="container mx-auto px-4 relative">

    {{-- Error and success messages --}}
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

    {{-- Search Bar --}}
    <div class="flex justify-end items-center space-x-4 mb-4 mt-2">
        <div class="p-2.5 flex items-center rounded-md px-15 duration-300 cursor-pointer bg-gray-800 text-white">
            <i class="bi bi-search text-sm"></i>
            <input type="text" id="searchInput" placeholder="Search"
                class="text-[15px] ml-4 w-full bg-transparent focus:outline-none placeholder-gray-300" />
        </div>
    </div>

    {{-- Vault Items --}}
    <div id="vaultItems" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        @foreach($vaultItems as $item)
            <div class="vault-item bg-green-700 hover:bg-green-500 rounded-lg shadow-lg overflow-hidden relative h-60">  
                <h2 class="text-white text-2xl font-semibold mb-2 p-4">{{ $item->title }}</h2>
                <div x-data="{ open: false, deleteMode: false }">
                    <button class="absolute top-4 right-4 text-white hover:text-green-200 focus:outline-none text-2xl"
                        x-on:click="open = !open; deleteMode = false">
                        <i class="bi bi-key-fill"></i>
                    </button>

                    <button class="absolute bottom-4 right-4 text-red-500 hover:text-red-700 focus:outline-none text-2xl"
                        x-on:click="open = !open; deleteMode = true" x-show="!open">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    {{-- Decryption Form --}}
                    <div x-show="open && !deleteMode" class="mt-4 p-4" id="keyInput-{{ $item->id }}">
                        @if (session('decryptionError') && session('errorItemId') == $item->id)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('decryptionError') }}</span>
                            </div>
                            {{ session()->forget(['decryptionError', 'errorItemId']) }}
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


                    {{-- Delete Confirmation Form (similar error handling logic) --}}
                    <div x-show="open && deleteMode" class="mt-4 p-4" id="deleteConfirmation-{{ $item->id }}">
                        @if (session('deleteError') && session('errorItemId') == $item->id)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('deleteError') }}</span>
                            </div>
                            {{ session()->forget(['deleteError', 'errorItemId']) }}
                        @endif

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
                            <button type="button" @click="deleteMode = false; open = false"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


{{-- Search Script --}}
<script>
    const searchInput = document.getElementById('searchInput');
    const vaultItems = document.querySelectorAll('.vault-item');

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();

        vaultItems.forEach(item => {
            const titleElement = item.querySelector('h2');
            if (titleElement) {
                const title = titleElement.textContent.toLowerCase();
                item.style.display = title.includes(searchTerm) ? 'block' : 'none';
            }
        });
    });
</script>

@endsection