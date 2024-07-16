@extends('layouts.app')
@section('title', 'Decryption')

@section('contents')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" enctype="multipart/form-data" action="{{ route('decryption') }}">
    @csrf
    <div class="flex flex-col space-y-4">
        <div class="file-upload-area p-4 border-2 border-dashed border-gray-300 rounded-md">
            <label for="file" class="block text-sm font-medium text-gray-700">Choose a file to upload (.txt)</label>
            <input type="file" name="file" id="file" class="mt-1" accept=".txt">
        </div>

        <div>
            <label for="key" class="block text-sm font-medium text-gray-700">Decryption Key (Base64):</label>
            <input type="text" name="key" id="key" value="{{ old('key') }}" placeholder="Base64 encoded key from .env"
                class="readonly w-full p-2 border rounded-md bg-gray-100 cursor-not-allowed" disabled>
        </div>

        <button type="submit" name="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Decrypt and Display</button>
    </div>
</form>

@if (session('decryptionError'))
    <div class="mt-4 p-4 bg-red-100 border border-red-400 rounded-md">
        <h3 class="text-lg font-semibold mb-2">Decryption Error:</h3>
        <pre>{{ session('decryptionError') }}</pre>
    </div>
@elseif (session('decryptedData'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 rounded-md">
        <h3 class="text-lg font-semibold mb-2">Decrypted Data:</h3>
        <pre>{{ session('decryptedData') }}</pre>
        @if (file_exists(session('originalFilePath') . '.bak'))
            <p class="mt-2">Decrypted Data file was created ({{ session('originalFilePath') . '.bak' }}).</p>
        @endif
    </div>
@endif

@endsection