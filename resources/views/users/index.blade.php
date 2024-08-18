@extends('layouts.app')

@section('title', 'User List')

@section('contents')
<div class="container mx-auto px-4 py-8">

    @if(Session::has('success'))
    <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
            <thead class="bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Id</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Password</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($user->count() > 0)
                @foreach($user as $usr)
                <tr class="text-slate-200 border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="px-4 py-4 text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                    <td class="px-4 py-4">{{ $usr->name }}</td>
                    <td class="px-4 py-4">{{ $usr->email }}</td>
                    <td class="px-4 py-4">{{ "***" }}</td>
                    <td class="px-4 py-4">{{ $usr->type }}</td>
                    <td class="px-4 py-4">
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                            <a href="{{ route('admin/users/show', $usr->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Detail</a>
                            <a href="{{ route('admin/users/edit', $usr->id)}}" class="text-green-600 dark:text-green-400 hover:underline">Edit</a>
                            <form action="{{ route('admin/users/remove', $usr->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center px-4 py-4 text-gray-500 dark:text-gray-400" colspan="6">User not found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
