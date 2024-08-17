@extends('layouts.app')

@section('title', 'Edit User')

@section('contents')
<div class="container mx-auto px-4 py-6 rounded-lg shadow-md bg-gray-800 w-1/2 ">
    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div class="flex flex-col">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}"
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="flex flex-col">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}"
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="flex flex-col">
                <label for="oldpass" class="block text-sm font-medium text-gray-300">Old Password</label>
                <input type="password" name="oldpass" id="oldpass"
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="flex flex-col">
                <label for="password" class="block text-sm font-medium text-gray-300">New Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="flex flex-col">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-700 px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
