@extends('layouts.app')
 
@section('title', 'User List')
 
@section('contents')
<div class="container mx-auto px-4 py-8">

    @if(Session::has('success'))
    <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
 
    <div class="overflow-x-auto shadow-sm rounded-lg">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
            <thead class="bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Id</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Password</th>
                    <th class="px-6 py-3 text-left">Type</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($user->count() > 0)
                @foreach($user as $rs)
                <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $rs->name }}</td>
                    <td class="px-6 py-4">{{ $rs->email }}</td>
                    <td class="px-6 py-4">{{ $rs->password }}</td>
                    <td class="px-6 py-4">{{ $rs->type }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin/users/show', $rs->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Detail</a>
                        <a href="{{ route('admin/users/edit', $rs->id)}}" class="text-green-600 dark:text-green-400 hover:underline">Edit</a>
                        <form action="{{ route('admin/users/remove', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center px-6 py-4 text-gray-500 dark:text-gray-400" colspan="6">User not found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
