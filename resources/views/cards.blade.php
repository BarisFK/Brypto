@extends('layouts.app')
@section('title', 'Cards')

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

<div class="grid grid-cols-3 gap-4">
    @for ($i = 1; $i <= 2; $i++)
        <div
            class="bg-green-500 hover:bg-green-700 text-white p-6 rounded-lg flex items-center justify-center text-2xl font-semibold h-48 w-96">
            Card {{ $i }}
        </div>
    @endfor
    <div
            class="bg-green-500 hover:bg-green-700 text-white p-6 rounded-lg flex items-center justify-center text-5xl font-semibold h-48 w-96">
            +
        </div>
</div>

@endsection