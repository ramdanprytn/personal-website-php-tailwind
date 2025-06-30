<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8">
    <title>Tambah About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen font-sans transition-colors duration-500">

    <!-- Header -->
    <header class="bg-gray-100 dark:bg-gray-800 text-teal-600 dark:text-teal-400 text-center py-6 shadow flex justify-between items-center px-6">
        <h1 class="text-3xl font-bold">Tambah Data About</h1>
        <!-- Toggle Dark Mode -->
        <button id="themeToggle" class="relative w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300 overflow-hidden">
            <span id="iconSun" class="absolute opacity-0 scale-0 transition-all duration-300 ease-in-out">☀️</span>
            <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all duration-300 ease-in-out">🌙</span>
        </button>
    </header>

    <div class="max-w-7xl mx-auto mt-10 px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-teal-600 dark:text-teal-400 mb-6 text-center border-b border-teal-400 dark:border-teal-500 pb-2">MENU</h2>
            <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                <li><a href="beranda_admin.php" class="block hover:text-teal-400">Beranda</a></li>
                <li><a href="data_artikel.php" class="block hover:text-teal-400">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block hover:text-teal-400">Kelola Gallery</a></li>
                <li><a href="about.php" class="block text-teal-600 dark:text-teal-400 font-bold">About</a></li>
                <li>
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <form action="proses_add_about.php" method="post" class="space-y-6">
                <div>
                    <label for="about" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">About</label>
                    <textarea id="about" name="about" rows="6" required
                        class="w-full p-3 rounded-md border border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-teal-500 focus:border-teal-500"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-teal-500 text-white px-5 py-2 rounded hover:bg-teal-600 transition">Simpan</button>
                    <a href="about.php"
                        class="bg-gray-600 text-white px-5 py-2 rounded hover:bg-gray-700 transition">Batal</a>
                </div>
            </form>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-10 text-sm text-gray-600 dark:text-gray-400">
        &copy; <?php echo date('Y'); ?> | Created by Ramdan Prayitno
    </footer>

    <!-- Theme Toggle Script -->
    <script>
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