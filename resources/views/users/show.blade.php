@extends('layouts.app')

@section('title', 'User Details')

@section('contents')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-full md:w-1/4">Name</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white w-full md:w-3/4">
                {{ $user->name }}
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-full md:w-1/4">Email</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white w-full md:w-3/4">
                {{ $user->email }}
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-full md:w-1/4">Password</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white w-full md:w-3/4">
                {{ "***" }} 
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-full md:w-1/4">Type</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white w-full md:w-3/4">
                {{ $user->type }}
            </div>
        </div>
    </div>
</div>
@endsection
