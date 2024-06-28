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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <header class="px-4 py-2 shadow ">
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
                <button data-messages class="p-3 mr-2 focus:outline-none hover:bg-gray-200 hover:rounded-md" type="button">
                    <svg class="fill-current w-5" viewBox="0 0 512 512">
                        <path d="M339.392 258.624L512 367.744V144.896zM0 144.896v222.848l172.608-109.12zM480 80H32C16.032 80 3.36 91.904.96 107.232L256 275.264l255.04-168.032C508.64 91.904 495.968 80 480 80zM310.08 277.952l-45.28 29.824a15.983 15.983 0 01-8.8 2.624c-3.072 0-6.112-.864-8.8-2.624l-45.28-29.856L1.024 404.992C3.488 420.192 16.096 432 32 432h448c15.904 0 28.512-11.808 30.976-27.008L310.08 277.952z" />
                    </svg>
                </button>
                <button data-notifications class="p-3 mr-3 focus:outline-none hover:bg-gray-200 hover:rounded-md" type="button">
                    <svg class="fill-current w-5" viewBox="-21 0 512 512">
                        <path d="M213.344 512c38.636 0 70.957-27.543 78.379-64H134.965c7.426 36.457 39.746 64 78.379 64zm0 0M362.934 255.98c-.086 0-.172.02-.258.02-82.324 0-149.332-66.988-149.332-149.332 0-22.637 5.207-44.035 14.273-63.277-4.695-.446-9.453-.723-14.273-.723-82.473 0-149.332 66.855-149.332 149.332v59.477c0 42.218-18.496 82.07-50.946 109.503C2.25 370.22-2.55 384.937 1.332 399.297c4.523 16.703 21.035 27.371 38.36 27.371H386.89c18.175 0 35.308-11.777 38.996-29.59 2.86-13.781-2.047-27.543-12.735-36.523-31.02-26.004-48.96-64.215-50.218-104.575zm0 0" />
                        <path style="fill: red;" d="M469.344 106.668c0 58.91-47.754 106.664-106.668 106.664-58.91 0-106.664-47.754-106.664-106.664C256.012 47.758 303.766 0 362.676 0c58.914 0 106.668 47.758 106.668 106.668zm0 0" />
                    </svg>
                </button>
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
        <div class="flex flex-col w-64 h-screen overflow-y-auto bg-gray-800 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700 rounded-r-lg">
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
               
                <a href="{{ route('admin/profile') }}">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white">
                    <i class="bi bi-person-circle"></i> 
                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Profile</span>
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
                
                <div x-data="{ isOpen: false }"> 
                <button @click="isOpen = !isOpen" class="p-2.5 mt-3 flex items-center justify-between rounded-md px-4 duration-300 cursor-pointer hover:bg-green-500 text-white w-full">
                    <div class="flex items-center">
                        <i class="bi bi-journal-x"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">X-Files</span>
                    </div>
                    <i :class="{'bi bi-chevron-down': !isOpen, 'bi bi-chevron-up': isOpen}" class="text-sm"></i> 
                </button>
            
                <div x-show="isOpen" class="mt-2 space-y-2">
    <a href="{{ route('filepage') }}" class="block text-gray-200 hover:bg-green-500 hover:text-white ml-5 p-2 rounded-md flex items-center"> 
        <i class="bi bi-lock mr-2"></i>  
        Encryption
    </a>
    <a href="{{ route('filepage') }}" class="block text-gray-200 hover:bg-green-500 hover:text-white ml-5 p-2 rounded-md flex items-center">
        <i class="bi bi-key mr-2"></i>   
        Decryption
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
        <div class="flex flex-col w-full h-screen px-4 py-8 mt-10">
            <div>@yield('contents')</div>
        </div>
    </div>
</body>
 
</html>