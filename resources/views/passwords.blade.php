@extends('layouts.app')

@section('title', 'Passwords')

@section('contents')

<div class="container mx-auto px-4 py-6">

    <!-- Header with search and add button -->
    <div class="flex flex-col md:flex-row md:justify-end md:items-center mb-6">
        <div class="relative flex items-center w-full mr-2 md:w-1/3">
            <input type="text" id="searchInput" placeholder="Search"
                class="w-full px-4 py-2 bg-gray-600 text-white placeholder-gray-400 rounded-md shadow-sm focus:outline-none" />
            <i class="bi bi-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
        <button data-modal-target="addPasswordModal" data-modal-toggle="addPasswordModal"
            class="mt-4 md:mt-0 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
            + Add New
        </button>
    </div>

    <!-- Password items -->
    <div class="space-y-6">
        @foreach ($passwords as $password)
            <div class="bg-gray-800 hover:bg-gray-700 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 password-item">
                <div class="p-4">
                    <div class="bg-green-500 text-white py-2 px-4 rounded-md font-semibold mb-4 title">
                        {{ $password->title }}
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <p class="text-gray-300 flex-grow"><strong>Username:</strong> {{ $password->username }}</p>
                            <button
                                class="copy-btn bg-gray-700 hover:bg-gray-600 text-white p-2 rounded-md flex items-center justify-center transition-transform transform hover:scale-105"
                                data-clipboard-target="#username-{{ $password->id }}"
                                aria-label="Copy Username">
                                <i class="bi bi-clipboard text-lg"></i>
                                <span class="sr-only">Copy Username</span>
                            </button>
                            <input type="hidden" id="username-{{ $password->id }}" value="{{ $password->username }}">
                        </div>
                        <div class="flex items-center mb-2">
                            <p class="text-gray-300 flex-grow"><strong>Password:</strong> {{ $password->password }}</p>
                            <button
                                class="copy-btn bg-gray-700 hover:bg-gray-600 text-white p-2 rounded-md flex items-center justify-center transition-transform transform hover:scale-105"
                                data-clipboard-target="#password-{{ $password->id }}"
                                aria-label="Copy Password">
                                <i class="bi bi-clipboard text-lg"></i>
                                <span class="sr-only">Copy Password</span>
                            </button>
                        </div>
                        <p class="text-gray-300 mb-2"><strong>Website:</strong> {{ $password->website }}</p>
                        <p class="text-gray-300"><strong>Description:</strong> {{ $password->desc }}</p>
                    </div>
                    <div class="flex justify-end">
                        <form action="{{ route('passAdd', $password->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md focus:outline-none transition-transform transform hover:scale-110">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Add Password Modal -->
<div id="addPasswordModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

        <div class="inline-block align-bottom bg-gray-800 rounded-lg px-8 py-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
    const modalOverlay = document.querySelector('.fixed.inset-0.bg-gray-900');

    modalTrigger.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    function closeModal() {
        modal.classList.add('hidden');
    }

    modalOverlay.addEventListener('click', closeModal);
</script>

<script>
    const searchInput = document.getElementById('searchInput');
    const passwordItems = document.querySelectorAll('.password-item');

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();

        passwordItems.forEach(item => {
            const titleElement = item.querySelector('.title');
            if (titleElement) {
                const title = titleElement.textContent.toLowerCase();
                item.style.display = title.includes(searchTerm) ? 'block' : 'none';
            }
        });
    });
</script>

@endsection
