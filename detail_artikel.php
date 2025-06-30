<?php
include "koneksi.php";

if (!isset($_GET['id_artikel'])) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$id = $_GET['id_artikel'];
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Artikel tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <title><?php echo htmlspecialchars($data['nama_artikel']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white font-sans transition-colors duration-300">

    <!-- Navbar -->
    <header class="bg-gray-100 dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="home.php" class="text-xl font-bold text-teal-500 dark:text-teal-400 hover:text-gray-900 dark:hover:text-white transition">
                MyWebsite
            </a>
            <nav class="flex space-x-6 items-center text-gray-800 dark:text-white font-medium">
                <a href="home.php" class="hover:text-teal-400">Home</a>
                <a href="about.php" class="hover:text-teal-400">About</a>
                <a href="gallery.php" class="hover:text-teal-400">Gallery</a>
                <a href="artikel.php" class="hover:text-teal-400">Artikel</a>
                <button id="themeToggle" class="relative w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300 overflow-hidden">
                    <span id="iconSun" class="absolute opacity-0 scale-0 transition-all duration-300 ease-in-out">☀️</span>
                    <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all duration-300 ease-in-out">🌙</span>
                </button>
                <a href="admin/login.php" class="inline-flex items-center border border-teal-400 px-4 py-1 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300">
                    Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Konten Artikel -->
    <main class="max-w-4xl mx-auto mt-10 px-6 py-8 bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md transition">
        <h1 class="text-3xl font-bold text-teal-600 dark:text-teal-400 mb-4"><?php echo htmlspecialchars($data['nama_artikel']); ?></h1>
        <article class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
            <?php echo nl2br(htmlspecialchars($data['isi_artikel'])); ?>
        </article>
        <div class="mt-6">
            <a href="artikel.php" class="text-teal-500 hover:underline">&larr; Kembali ke daftar artikel</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-16">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?php echo date('Y'); ?> | Created by Ramdan Prayitno</p>
    </footer>

    <!-- Script Toggle Dark Mode -->
    <script>
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