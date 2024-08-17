@extends('layouts.app') 

@section('title', 'Passwords')

@section('contents')

<div class="container mx-auto px-4 relative">
    <div class="flex justify-end items-center space-x-4 mb-4 mt-2">
        <div class="p-2.5 flex items-center rounded-md bg-gray-800 text-white shadow-md">
            <i class="bi bi-search text-sm"></i>
            <input type="text" id="searchInput" placeholder="Search"
                class="text-sm ml-4 bg-transparent text-gray-200 focus:outline-none placeholder-gray-400" />
        </div>

        <button data-modal-target="addPasswordModal" data-modal-toggle="addPasswordModal"
            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
            +
        </button>
    </div>

    @foreach ($passwords as $password)
        <div class="password-item bg-gray-800 hover:bg-gray-600 rounded-lg shadow-lg overflow-hidden mb-4 relative ">
            <div class="flex flex-col md:flex-row md:items-center p-4">
                <div class="title bg-green-500 text-white py-2 px-4 rounded-md font-semibold w-48 md:mr-4 bg-opacity-75	">
                    {{ $password->title }}
                </div>
                <div class="details flex-grow">
                    <div class="flex items-center mb-2">
                        <p class="text-gray-200 mr-4 flex-grow"><strong>Username:</strong> {{ $password->username }}</p>
                        <button
                            class="copy-btn bg-green-500 text-white py-1 px-2 rounded-md hover:bg-green-600 focus:outline-none bi bi-clipboard"
                            data-clipboard-target="#username-{{ $password->id }}"></button>
                        <input type="hidden" id="username-{{ $password->id }}" value="{{ $password->username }}">
                    </div>
                    <div class="flex items-center mb-2">
                        <p class="text-gray-200 mr-4 flex-grow"><strong>Password:</strong> <span
                                id="password-{{ $password->id }}">{{ $password->password }}</span></p>
                        <button
                            class="copy-btn bg-green-500 text-white py-1 px-2 rounded-md hover:bg-green-600 focus:outline-none bi bi-clipboard"
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
                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md focus:outline-none mr-2">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<div id="addPasswordModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

        <div
            class="inline-block align-bottom bg-gray-800 rounded-lg px-8 py-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-white">Add New Password</h2>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('passAdd') }}" method="POST">
                @csrf

                @foreach (['title' => 'Title', 'username' => 'Username', 'password' => 'Password', 'website' => 'Website', 'desc' => 'Description',] as $field => $label)
                    <div class="mb-4">
                        <label for="{{ $field }}" class="block text-sm font-medium text-white">{{ $label }}</label>
                        <input type="{{ ($field == 'password') ? 'password' : 'text' }}" id="{{ $field }}"
                            name="{{ $field }}" class="mt-1 p-2 rounded-md w-full bg-gray-500 text-white" required>
                    </div>
                @endforeach

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
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
    const modalOverlay = document.querySelector('.fixed.inset-0.bg-gray-900'); // Select the overlay

    modalTrigger.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    function closeModal() {
        modal.classList.add('hidden');
    }

    modalOverlay.addEventListener('click', closeModal); // Close on overlay click
</script>

<script>
    const searchInput = document.getElementById('searchInput');
    const passwordItems = document.querySelectorAll('.password-item'); // Get all password items

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();

        passwordItems.forEach(item => {
            const titleElement = item.querySelector('.title');
            if (titleElement) {
                const title = titleElement.textContent.toLowerCase();
                item.style.display = title.includes(searchTerm) ? 'block' : 'none'; // Show/hide based on match
            }
        });
    });
</script>
@endsection
