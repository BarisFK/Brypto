@extends('layouts.app')
@section('title', 'Encryption')

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

<form method="POST" action="{{ route('encryption') }}"> @csrf
    <div class="flex flex-col space-y-4">
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Message:</label>
            <textarea name="message" id="message" rows="4" class="w-full p-2 border rounded-md bg-gray-300"></textarea>
        </div>

        <div>
            <label for="key" class="block text-sm font-medium text-gray-700">Encryption Key (Base64):</label>
            <input type="text" name="key" id="key" value="{{ old('key') }}" placeholder="Base64 encoded key from .env"
                class="readonly w-full p-2 border rounded-md bg-gray-100 cursor-not-allowed bg-gray-300" disabled>

        </div>

        <button type="submit" name="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Encrypt and Display</button>
    </div>
</form>

@if (session('encryptedData'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 rounded-md">
        <h3 class="text-lg font-semibold mb-2">Encrypted Data:</h3>
        <pre>{{ session('encryptedData') }}</pre>

        {{-- Save to Vault Form --}}
        <form method="POST" action="{{ route('saveToVault') }}" class="mt-4">
            @csrf
            <input type="hidden" name="encrypted_data" value="{{ session('encryptedData') }}">
            <div>
                <label for="vault_title" class="block text-sm font-medium text-gray-700">Vault Title:</label>
                <input type="text" name="vault_title" id="vault_title" class="w-full p-2 border rounded-md">
            </div>
            <button type="submit" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save
                to
                Vault</button>
        </form>
    </div>
@endif

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@endsection