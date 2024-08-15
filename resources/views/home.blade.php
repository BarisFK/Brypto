<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brypto Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"><path fill="%23d1fae5" d="M0 40L40 0H20L0 20Z" opacity="0.1"/></svg>');
            background-size: cover;
            background-attachment: fixed;
        }

        .bounce-icon {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .btn-animated {
            transition: all 0.3s ease;
        }

        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .feature-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-white via-green-50 to-white min-h-screen flex flex-col items-center justify-center text-center">

    <div class="mt-24 space-y-4">
        <i class="fas fa-shield-alt fa-6x text-green-500 bounce-icon"></i> 
        <h1 class="text-4xl font-bold text-green-600 tracking-wide">Brypto</h1>
        <p class="text-xl text-gray-700">Secure your digital world with Brypto.</p>
    </div>

    <div class="mt-8 space-x-4">
        <a href="/login" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-lg transition duration-300 btn-animated">Login</a>
        <a href="/register" class="px-6 py-3 bg-white hover:bg-green-100 border border-green-500 text-green-500 hover:text-green-600 rounded-lg shadow-lg transition duration-300 btn-animated">Register    </a>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 max-w-5xl mt-12">
        <div class="feature-card">
            <i class="fas fa-lock fa-2x text-green-500 mb-2"></i>
            <h3 class="text-xl font-bold text-green-600 mb-2">High Security</h3>
            <p class="text-gray-700 text-sm">Our advanced encryption ensures your data is always secure.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-user-shield fa-2x text-green-500 mb-2"></i>
            <h3 class="text-xl font-bold text-green-600 mb-2">Privacy Protection</h3>
            <p class="text-gray-700 text-sm">Your privacy is our top priority, safeguarding your personal information.
            </p>
        </div>
        <div class="feature-card">
            <i class="fas fa-cloud fa-2x text-green-500 mb-2"></i>
            <h3 class="text-xl font-bold text-green-600 mb-2">Privatly Backup</h3>
            <p class="text-gray-700 text-sm">Easily back up your data to your local and take it to anywhere.</p>
        </div>
    </div>

    <footer class="text-green-600 text-center py-4 mt-8">
        <p>&copy; 2024 Brypto. All rights reserved.</p>
    </footer>

</body>

</html>
