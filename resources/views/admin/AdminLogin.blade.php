<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/PNG.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Background Animation */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-800 via-indigo-700 to-purple-700 bg-[length:400%_400%] animate-gradientBG">

<script>
    // Tailwind animation
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'gradientBG': 'gradientBG 15s ease infinite'
          }
        }
      }
    }
</script>

    <div class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-sm animate-fadeIn opacity-0 transition-opacity duration-1000" id="loginCard">

        @if(session('error'))
            <p class="text-red-500 text-center mb-4 animate-shake">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/admin/login" class="space-y-4">
            @csrf
            <div>
                <p>login hikaridenki Service login</p>
                <label class="block text-gray-700 font-medium mb-1">User</label>
                <input type="text" name="user" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300">
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold shadow-lg hover:bg-indigo-500 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                Login <i class="bi bi-box-arrow-in-right"></i>
            </button>
        </form>
    </div>

    <script>
        // Fade in card
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.getElementById('loginCard');
            setTimeout(() => {
                card.classList.remove('opacity-0');
            }, 100);
        });
    </script>

    <style>
        /* Extra Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 1s forwards; }
        @keyframes shake { 0%,100%{ transform: translateX(0) } 25%{ transform: translateX(-5px) } 75%{ transform: translateX(5px) } }
        .animate-shake { animation: shake 0.5s; }
    </style>
</body>
</html>
