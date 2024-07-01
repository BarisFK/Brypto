<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <header class="px-4 py-2 shadow-md">
        <div class="flex justify-between">
            <div class="flex items-center">
                <div class="text-green-500 font-bold text-2xl md:text-3xl flex items-center">
                    <div class="flex items-center justify-center bg-green-500 rounded-md"> 
                        <i class="bi bi-shield-lock text-white px-2 py-1"></i>
                    </div>
                    <span class="ml-2">Brypto</span> 
                 </div>
                <button data-search class="p-4 md:hidden focus:outline-none" type="button"></button>
            </div>
            <div class="flex items-center">

<div class="relative inline-block text-left mr-2" x-data="{ open: false }">
    <div>
        <button @click="open = !open" type="button" class="p-3 focus:outline-none hover:bg-gray-200 hover:rounded-md">
            <i class="bi bi-envelope-fill text-2xl"></i>
        </button>
    </div>
    
    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Message 1</a>
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Message 2</a>
        </div>
    </div>
</div>

<div class="relative inline-block text-left mr-3" x-data="{ open: false }">
    <div>
        <button @click="open = !open" type="button" class="p-3 focus:outline-none hover:bg-gray-200 hover:rounded-md">
            <i class="bi bi-bell-fill text-2xl"></i>
        </button>
    </div>

    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Notification 1</a>
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Notification 2</a>
        </div>
    </div>
</div>

<button data-dropdown class="flex items-center px-3 py-2 focus:outline-none hover:bg-gray-200 hover:rounded-md relative" type="button" x-data="{ open: false }" @click="open = true" :class="{ 'bg-gray-200 rounded-md': open }">
    <i class="bi bi-person-circle text-3xl"></i> 
    
    <div data-dropdown-items class="text-base text-left absolute top-0 right-0 mt-16 w-48 bg-white rounded-lg shadow-md overflow-hidden" x-show="open" @click.away="open = false">
        <div class="flex flex-col items-center py-4"> 
            <i class="bi bi-person-circle text-6xl mb-2"></i> 
            <span class="text-lg font-semibold">{{ auth()->user()->name }}</span> 
            <span class="text-sm text-gray-500 mt-1 mb-2">{{ auth()->user()->email }}</span>
            <a href="{{ route('admin/profile') }}" class="mt-2 mb-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            View Profile
            </a>
        </div>
    </div>
</button>

</div>

        </div>
    </header>
 
    <div class="flex flex-row">
        <div class="flex flex-col w-64 h-screen overflow-y-auto bg-gray-800 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700 rounded-r-md">
            <div class="sidebar text-center bg-gray-800">
                <div class="text-gray-100 text-xl text-center">
                 <div class="p-2.5 mt-1 flex items-center justify-center"> 
                  <h1 class="text-gray-300 text-[12px]">Welcome {{ auth()->user()->name }}!</h1>
                </div>
            </div>
                <div class="p-2.5 my-4 mx-1.5 flex items-center rounded-md px-15 duration-300 cursor-pointer bg-gray-700 text-white">
                <i class="bi bi-search text-sm"></i>
                <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none placeholder-gray-300" />
                </div>
                <a href="{{ route('admin/home') }}">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Home</span>
                    </div>
                </a>
               
                @if (auth()->check())
                @if (auth()->user()->type === 'admin')
                <a href="{{ route('users.index') }}">
                <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white">
                    <i class="bi bi-people"></i>
                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Users</span>
                </div>
                </a>

                <a href="{{ route('admin/home') }}">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white">
                        <i class="bi bi-file-lock"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Passwords</span>
                    </div>
                </a>
                <a href="{{ route('cardsPage') }}">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white">
                        <i class="bi bi-credit-card-2-front"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Cards</span>
                    </div>
                </a>
               
                <div x-data="{ isOpen: false }"> 
                <button @click="isOpen = !isOpen" class="p-2.5 mt-3 flex items-center justify-between rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white w-full">
                    <div class="flex items-center">
                        <i class="bi bi-journal-x"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">X-Files</span>
                    </div>
                    <i :class="{'bi bi-chevron-down': !isOpen, 'bi bi-chevron-up': isOpen}" class="text-sm"></i> 
                </button>
            
                <div x-show="isOpen" class="mt-2 space-y-2 bg-gray-700">
    <a href="{{ route('encryptPage') }}" class="block text-gray-200 hover:bg-green-600 hover:text-white ml-5 p-2 rounded-lg flex items-center"> 
        <i class="bi bi-lock mr-2"></i>  
        Encryption
    </a>
    <a href="{{ route('decryptPage') }}" class="block text-gray-200 hover:bg-green-600 hover:text-white ml-5 p-2 rounded-lg flex items-center">
        <i class="bi bi-key mr-2"></i>   
        Decryption
    </a>
    <a href="{{ route('vaultPage') }}" class="block text-gray-200 hover:bg-green-600 hover:text-white ml-5 p-2 rounded-lg flex items-center">
        <i class="bi bi-safe mr-2"></i>   
        Vault
    </a>
</div>

            </div>

        @endif
    @endif
                <a href="{{ route('logout') }}">
                    <div class="my-4 bg-gray-600 h-[1px]"></div>
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex flex-col w-full h-screen px-4 py-8">
        <h1 class="mb-10 font-bold text-2xl ">@yield('title')</h1>
        <div>@yield('contents')</div>
        </div>
    </div>
</body>
 
</html>