<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <style>
        .card {
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-animated {
            position: relative;
            overflow: hidden;
            transition: all 0.4s;
        }

        .btn-animated::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.15);
            transition: all 0.75s;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .btn-animated:hover::before {
            width: 0;
            height: 0;
        }
    </style>
</head>

<body>
    <section class="bg-gray-900 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="flex items-center mb-6 text-4xl font-bold text-white">
                <span class="bg-gradient-to-r from-green-400 to-green-600 text-transparent bg-clip-text">
                    Join Us Today!
                </span>
            </div>
            <div class="w-full bg-gray-800 rounded-lg shadow-lg dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-green-700 card">
                <div class="p-6 space-y-6 md:space-y-8 sm:p-8">
                    <h1 class="text-2xl font-extrabold leading-tight tracking-tight text-green-200 md:text-3xl dark:text-green-200 text-center">
                        Create an account
                    </h1>
                    <form action="{{ route('register.save') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-green-400 dark:text-green-400">Username</label>
                            <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-gray-100 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="username" required>
                            @error('name')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-green-400 dark:text-green-400">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-gray-100 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="your@mail.com" required>
                            @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-green-400 dark:text-green-400">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-gray-100 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" required>
                            @error('password')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-green-400 dark:text-green-400">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-gray-100 sm:text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" required>
                            @error('password_confirmation')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn-animated">Create an account</button>
                        <p class="text-sm font-light text-gray-400 dark:text-gray-400">
                            Already have an account? <a href="{{ route('login') }}" class="font-medium text-green-500 hover:underline dark:text-green-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
