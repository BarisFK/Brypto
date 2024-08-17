@extends('layouts.app')

@section('title', 'Profile Settings')

@section('contents')
<div class="container mx-auto px-4 py-6 bg-gray-800 rounded-lg shadow-md max-w-md">
    <div class="flex justify-center mb-6">
        <div class="relative">
            <img src="https://via.placeholder.com/100" alt="Profile Photo" class="w-24 h-24 rounded-full border-4 border-indigo-500">
            <div class="absolute bottom-0 right-0 bg-gray-800 p-2 rounded-full shadow-md">
                <i class="bi bi-upload text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <form method="POST" enctype="multipart/form-data" action="">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input name="name" type="text" value="{{ auth()->user()->name }}" 
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none" disabled />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input name="email" type="text" value="{{ auth()->user()->email }}" 
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none" disabled />
            </div>
        </div>
    </form>
</div>
@endsection
