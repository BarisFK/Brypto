@extends('layouts.app') 

@section('title', 'Passwords')

@section('contents')

<div class="p-2.5 my-4 mx-1.5 flex items-center rounded-md px-15 duration-300 cursor-pointer bg-gray-700 text-white">
    <i class="bi bi-search text-sm"></i>
    <input type="text" placeholder="Search"
        class="text-[15px] ml-4 w-full bg-transparent focus:outline-none placeholder-gray-300" />
</div>
<div class="container mx-auto px-4">
    <div class="fixed bottom-4 right-4 z-10">
        <button data-modal-target="addPasswordModal" data-modal-toggle="addPasswordModal"
            class="bg-gradient-to-r from-green-400 to-green-900 hover:from-teal-500 hover:to-teal-700 text-gray-200 font-bold py-2 px-4 rounded-full shadow-md">
            +
        </button>
    </div>

    @foreach ($passwords as $password)
        <div
            class="password-item bg-gradient-to-r from-green-600 to-green-400 hover:from-gray-800 hover:to-green-500 rounded-lg shadow-lg overflow-hidden mb-4 relative">
            <div class="flex flex-col md:flex-row md:items-center p-4">
                <div class="title bg-teal-500 text-gray-200 py-2 px-4 rounded-md font-semibold w-48 md:mr-4">
                    {{ $password->title }}
                </div>
                <div class="details flex-grow">
                    <div class="flex items-center mb-2">
                        <p class="text-gray-200 mr-4 flex-grow"><strong>Username:</strong> {{ $password->username }}</p>
                        <button
                            class="copy-btn bi bi-clipboard bg-teal-600 text-gray-200 py-1 px-2 rounded-md hover:bg-teal-700 focus:outline-none"
                            data-clipboard-target="#username-{{ $password->id }}"></button>
                        <input type="hidden" id="username-{{ $password->id }}" value="{{ $password->username }}">
                    </div>
                    <div class="flex items-center mb-2">
                        <p class="text-gray-200 mr-4 flex-grow"><strong>Password:</strong> <span
                                id="password-{{ $password->id }}">{{ $password->password }}</span></p>
                        <button
                            class="copy-btn bi bi-clipboard bg-teal-600 text-gray-200 py-1 px-2 rounded-md hover:bg-teal-700 focus:outline-none"
                            data-clipboard-target="#password-{{ $password->id }}"></button>
                    </div>
                    <p class="text-gray-200 mb-2"><strong>Website:</strong> {{ $password->website }}</p>
                    <p class="text-gray-200"><strong>Description:</strong> {{ $password->desc }}</p>
                </div>
            </div>
            <div class="delete-button absolute bottom-2 right-2">
                <form action="{{ route('passAdd', $password->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bi bi-trash bg-red-500 hover:bg-red-600 text-gray-200 py-1 px-2 rounded-md focus:outline-none">

                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>



<div id="addPasswordModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

        <div
            class="inline-block align-bottom bg-white rounded-lg px-8 py-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">Add New Password</h2>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('passAdd') }}" method="POST">
                @csrf

                @foreach (['title' => 'Card Title', 'username' => 'Username', 'password' => 'Password', 'website' => 'Website', 'desc' => 'Description',] as $field => $label)
                    <div class="mb-4">
                        <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                        <input type="{{ ($field == 'password') ? 'password' : 'text' }}" id="{{ $field }}"
                            name="{{ $field }}" class="mt-1 p-2 border rounded-md w-full" required>
                    </div>
                @endforeach

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-700 text-gray-200 font-bold py-2 px-4 rounded">
                        Add Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    const modalTrigger = document.querySelector('[data-modal-target="addPasswordModal"]');
    const modal = document.getElementById('addPasswordModal');
    const modalOverlay = document.querySelector('.fixed.inset-0.bg-gray-500'); // Select the overlay

    modalTrigger.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    function closeModal() {
        modal.classList.add('hidden');
    }

    modalOverlay.addEventListener('click', closeModal); // Close on overlay click
</script>
@endsection