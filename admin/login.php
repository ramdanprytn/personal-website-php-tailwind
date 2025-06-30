<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:beranda_admin.php');
}
require_once("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8">
    <title>Login Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center text-gray-900 dark:text-white font-sans transition-colors duration-500">

    <div class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-xl p-8 w-full max-w-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-teal-500 dark:text-teal-400">Login Administrator</h2>
            <!-- Toggle Dark Mode -->
            <button id="themeToggle" class="relative w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300 overflow-hidden">
                <span id="iconSun" class="absolute opacity-0 scale-0 transition-all duration-300 ease-in-out">☀️</span>
                <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all duration-300 ease-in-out">🌙</span>
            </button>
        </div>

        <form action="cek_login.php" method="post" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                <input type="text" name="username" id="username" required
                    class="mt-1 block w-full bg-gray-200 dark:bg-gray-700 border border-gray-400 dark:border-gray-600 rounded-md shadow-sm text-gray-900 dark:text-white
                    focus:ring-teal-400 focus:border-teal-400 focus:outline-none px-4 py-2">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full bg-gray-200 dark:bg-gray-700 border border-gray-400 dark:border-gray-600 rounded-md shadow-sm text-gray-900 dark:text-white
                    focus:ring-teal-400 focus:border-teal-400 focus:outline-none px-4 py-2">
            </div>

            <div class="flex justify-between items-center">
                <input type="submit" name="login" value="Login"
                    class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600 transition cursor-pointer">
                <input type="reset" name="cancel" value="Cancel"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition cursor-pointer">
            </div>
        </form>

        <!-- Ikon Home & Footer -->
        <div class="mt-8 flex flex-col items-center space-y-2">
            <a href="../home.php" class="flex items-center space-x-1 text-teal-400 hover:text-white transition">
                <i data-feather="home" class="w-5 h-5"></i>
                <span class="text-sm">Kembali</span>
            </a>
            <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?php echo date('Y'); ?> - Ramdan Prayitno</p>
        </div>
    </div>

    <!-- Feather Icons & Toggle Script -->
    <script>
        feather.replace();

        const html = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const iconSun = document.getElementById('iconSun');
        const iconMoon = document.getElementById('iconMoon');

        function updateIcon() {
            const isDark = html.classList.contains('dark');
            if (isDark) {
                iconSun.classList.remove('opacity-100', 'scale-100');
                iconSun.classList.add('opacity-0', 'scale-0');
                iconMoon.classList.remove('opacity-0', 'scale-0');
                iconMoon.classList.add('opacity-100', 'scale-100');
            } else {
                iconMoon.classList.remove('opacity-100', 'scale-100');
                iconMoon.classList.add('opacity-0', 'scale-0');
                iconSun.classList.remove('opacity-0', 'scale-0');
                iconSun.classList.add('opacity-100', 'scale-100');
            }
        }

        if (localStorage.getItem('theme') === 'light') {
            html.classList.remove('dark');
        } else {
            html.classList.add('dark');
        }
        updateIcon();

        toggleBtn.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
            updateIcon();
        });
    </script>

</body>

</html>