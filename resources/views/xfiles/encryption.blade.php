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
            <textarea name="message" id="message" rows="4" class="w-full p-2 border rounded-md"></textarea>
        </div>

        <div>
            <label for="key" class="block text-sm font-medium text-gray-700">Encryption Key (Base64):</label>
            <input type="text" name="key" id="key" value="{{ old('key') }}" placeholder="Enter base64 encoded key"
                class="w-full p-2 border rounded-md">
        </div>

        <button type="submit" name="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Encrypt and Display</button>
    </div>
</form>

@if (session('encryptedData'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 rounded-md">
        <h3 class="text-lg font-semibold mb-2">Encrypted Data:</h3>
        <pre>{{ session('encryptedData') }}</pre>
    </div>
@endif

@endsection