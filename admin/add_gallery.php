<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <title>Tambah Gambar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen font-sans transition duration-500">
    <!-- Header -->
    <header class="bg-gray-100 dark:bg-gray-800 text-teal-600 dark:text-teal-400 text-center py-6 shadow flex justify-between items-center px-6">
        <h1 class="text-3xl font-bold">Tambah Gambar ke Gallery</h1>

        <!-- Theme Toggle -->
        <button id="themeToggle" class="relative w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-black transition duration-300 overflow-hidden">
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
                <li><a href="data_gallery.php" class="block text-teal-600 dark:text-teal-400 font-bold">Kelola Gallery</a></li>
                <li><a href="about.php" class="block hover:text-teal-400">About</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <form action="proses_add_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Judul Gambar</label>
                    <input type="text" id="judul" name="judul" required
                        class="w-full p-3 border border-gray-400 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label for="foto" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Pilih Gambar</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required onchange="previewImage(event)"
                        class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-700">
                    <div class="mt-4">
                        <img id="preview" class="w-48 h-48 object-cover rounded-lg hidden border border-teal-400">
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-teal-600 text-white px-5 py-2 rounded hover:bg-teal-700 transition">Simpan</button>
                    <a href="data_gallery.php"
                        class="bg-gray-600 text-white px-5 py-2 rounded hover:bg-gray-700 transition">Batal</a>
                </div>
            </form>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-10 text-sm text-gray-600 dark:text-gray-400">
        &copy; <?php echo date('Y'); ?> | Created by Ramdan Prayitno
    </footer>

    <!-- Scripts -->
    <script>
        // Preview Gambar
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('preview');
            reader.onload = function() {
                preview.src = reader.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Toggle Tema
        const html = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const iconSun = document.getElementById('iconSun');
        const iconMoon = document.getElementById('iconMoon');

        function updateIcon() {
            const isDark = html.classList.contains('dark');
            iconSun.classList.toggle('opacity-100', !isDark);
            iconSun.classList.toggle('scale-100', !isDark);
            iconSun.classList.toggle('opacity-0', isDark);
            iconSun.classList.toggle('scale-0', isDark);

            iconMoon.classList.toggle('opacity-100', isDark);
            iconMoon.classList.toggle('scale-100', isDark);
            iconMoon.classList.toggle('opacity-0', !isDark);
            iconMoon.classList.toggle('scale-0', !isDark);
        }

        // Default tema dari localStorage
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