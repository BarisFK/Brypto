@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Card Statistics --}}
    <a href="{{ route('cardsPage') }}" class="bg-green-500 hover:bg-green-700 text-white p-6 rounded-lg flex flex-col justify-between h-48 transition duration-300 ease-in-out transform hover:scale-105">
        <div>
            <h2 class="text-xl font-semibold mb-2">Card Statistics</h2>
            <p class="text-lg">Total Cards: {{ $totalCards }}</p>
            <p class="text-sm">Last Added Card: {{ $lastCreatedCard['title'] }}</p>
            <p class="text-sm">Expiring Soon: {{ $expiringSoon }}</p>
        </div>
        <div class="mt-4">
            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">Details</span>
        </div>
    </a>

    {{-- Password Statistics --}}
    <a href="{{ route('passPage') }}" class="bg-blue-500 hover:bg-blue-700 text-white p-6 rounded-lg flex flex-col justify-between h-48 transition duration-300 ease-in-out transform hover:scale-105">
        <div>
            <h2 class="text-xl font-semibold mb-2">Password Statistics</h2>
            <p class="text-lg">Total Passwords: {{ $totalPasswords }}</p>
            <p class="text-sm">Most Used Website: {{ $mostUsedWebsite ?? 'N/A' }}</p>
        </div>
        <div class="mt-4">
            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">Details</span>
        </div>
    </a>

    {{-- Data Security --}}
    <a href="{{ route('encryptPage') }}" class="bg-purple-500 hover:bg-purple-700 text-white p-6 rounded-lg flex flex-col justify-between h-48 transition duration-300 ease-in-out transform hover:scale-105">
        <div>
            <h2 class="text-xl font-semibold mb-2">Data Security</h2>
            <p class="text-lg">Encryption Status: {{ $encryptionStatus }}</p>
            {{-- Add other relevant security or app-specific statistics here --}}
        </div>
        <div class="mt-4">
            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">Details</span>
        </div>
    </a>
</div>
@endsection
