<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            display: none;
        }
        .overlay.active {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal" x-data="{ sidebarOpen: false }">
   
    {{-- Top --}}
    <header class="bg-gray-800 text-white shadow-md relative z-40">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Toggle Button -->
            <button @click="sidebarOpen = !sidebarOpen; $nextTick(() => document.querySelector('.overlay').classList.toggle('active', sidebarOpen))" class="p-3 md:hidden text-white rounded-md fixed top-3 left-3 z-50 focus:outline-none">
                <i class="bi bi-list text-xl"></i>
            </button>

            <div class="flex items-center w-56">
                <div class="w-full flex items-center justify-center">
                    <div class="text-green-400 font-bold text-2xl flex items-center">
                        <i class="bi bi-shield-lock text-3xl"></i>
                        <span class="ml-2">Brypto</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="p-3 text-white hover:bg-green-700 rounded-md">
                        <i class="bi bi-envelope-fill text-xl"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white text-gray-800 rounded-md shadow-lg z-10">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Message 1</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Message 2</a>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="p-3 text-white hover:bg-green-700 rounded-md">
                        <i class="bi bi-bell-fill text-xl"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white text-gray-800 rounded-md shadow-lg z-10">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Notification 1</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Notification 2</a>
                        </div>
                    </div>
                </div>
                <button class="flex items-center p-3 text-white hover:bg-green-700 rounded-md relative" x-data="{ open: false }" @click="open = !open">
                    <i class="bi bi-person-circle text-2xl"></i>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-64 w-48 bg-white text-gray-800 rounded-lg shadow-md z-10">
                        <div class="flex flex-col items-center py-4">
                            <i class="bi bi-person-circle text-4xl mb-2"></i>
                            <span class="text-lg font-semibold">{{ auth()->user()->name }}</span>
                            <span class="text-sm text-gray-500 mt-1">{{ auth()->user()->email }}</span>
                            <a href="{{ route('admin/profile') }}" class="mt-2 mb-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                View Profile
                            </a>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false; document.querySelector('.overlay').classList.remove('active')" class="overlay"></div>

    <div class="flex">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full' + ' md:translate-x-0' " class="fixed top-16 left-0 w-64 bg-gray-800 text-gray-100 h-[calc(100vh-4rem)] overflow-y-auto transform transition-transform duration-300 z-40 md:relative md:w-64">
            <div class="p-4">
                <h1 class="text-gray-400 text-md text-center">Welcome {{ auth()->user()->name }}!</h1>
            </div>
            <div class="px-4">
                <div class="flex items-center bg-gray-700 rounded-md p-2 mb-4">
                    <i class="bi bi-search text-gray-400"></i>
                    <input type="text" placeholder="Search" class="ml-2 bg-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none">
                </div>
                <a href="{{ route('dashboard') }}">
                    <div class="flex items-center p-2 mb-2 text-white bg-gray-700 hover:bg-green-600 rounded-md cursor-pointer">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="ml-4">Dashboard</span>
                    </div>
                </a>
                @if (auth()->check())
                @if (auth()->user()->type === 'admin')
                <a href="{{ route('users.index') }}">
                    <div class="flex items-center p-2 mb-2 text-white bg-gray-700 hover:bg-green-600 rounded-md cursor-pointer">
                        <i class="bi bi-people"></i>
                        <span class="ml-4">Users</span>
                    </div>
                </a>
                <a href="{{ route('passPage') }}">
                    <div class="flex items-center p-2 mb-2 text-white bg-gray-700 hover:bg-green-600 rounded-md cursor-pointer">
                        <i class="bi bi-file-lock"></i>
                        <span class="ml-4">Passwords</span>
                    </div>
                </a>
                <a href="{{ route('cardsPage') }}">
                    <div class="flex items-center p-2 mb-2 text-white bg-gray-700 hover:bg-green-600 rounded-md cursor-pointer">
                        <i class="bi bi-credit-card-2-front"></i>
                        <span class="ml-4">Cards</span>
                    </div>
                </a>
                <div x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="flex items-center justify-between p-2 mb-2 text-white bg-gray-700 hover:bg-green-600 rounded-md cursor-pointer w-full">
                        <div class="flex items-center">
                            <i class="bi bi-journal-x"></i>
                            <span class="ml-4">X-Files</span>
                        </div>
                        <i :class="{'bi bi-chevron-down': !isOpen, 'bi bi-chevron-up': isOpen}" class="text-sm"></i>
                    </button>
                    <div x-show="isOpen" class="bg-gray-600">
                        <a href="{{ route('encryptPage') }}" class="block px-4 py-2 text-gray-100 hover:bg-green-500">Encryption</a>
                        <a href="{{ route('decryptPage') }}" class="block px-4 py-2 text-gray-100 hover:bg-green-500">Decryption</a>
                        <a href="{{ route('vaultPage') }}" class="block px-4 py-2 text-gray-100 hover:bg-green-500">Vault</a>
                    </div>
                </div>
                @endif
                @endif
                <a href="{{ route('logout') }}">
                    <div class="my-4 border-t border-gray-600"></div>
                    <div class="flex items-center p-2 text-white bg-gray-700 hover:bg-red-600 rounded-md cursor-pointer">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="ml-4">Logout</span>
                    </div>
                </a>
            </div>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-700 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-gray-200 border-b-2 border-gray-500 pb-2 flex justify-center">@yield('title')</h1>
            <div>@yield('contents')</div>
        </main>
    </div>
</body>

</html>
