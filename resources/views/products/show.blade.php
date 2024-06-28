@extends('layouts.app')
 
@section('title', 'Show Product')
 
@section('contents')
<h1 class="font-bold text-2xl ml-3">User Detail</h1>
<hr />
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">name</label>
            <div class="mt-2">
                {{ $user->name }}
            </div>
        </div>
 
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
            <div class="mt-2">
                {{ $user->email }}
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="mt-2">
                {{ $user->password }}
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Type</label>
            <div class="mt-2">
                {{ $user->type }}
            </div>
        </div>
        </form>
    </div>
</div>
@endsection