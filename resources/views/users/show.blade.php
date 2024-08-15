@extends('layouts.app')
 
@section('title', 'User Details')
 
@section('contents')
<div class="max-w-4xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border-b border-gray-200 dark:border-gray-700">
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">
                {{ $user->name }}
            </div>
        </div>
 
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">
                {{ $user->email }}
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">
                {{ $user->password }}
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">
                {{ $user->type }}
            </div>
        </div>
    </div>
</div>
@endsection
