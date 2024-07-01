@extends('layouts.app') 

@section('title', 'Admin Dashboard')

@section('contents')
<div class="grid grid-cols-3 gap-4">
    @for ($i = 1; $i <= 6; $i++)
        <div
            class="bg-green-500 hover:bg-green-700 text-white p-6 rounded-lg flex items-center justify-center text-2xl font-semibold h-48">
            Grid {{ $i }}
        </div>
    @endfor
</div>


@endsection