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
    <title>Kelola Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen font-sans transition-colors duration-500">

    <!-- Header -->
    <header class="bg-gray-100 dark:bg-gray-800 text-teal-600 dark:text-teal-400 py-6 px-6 shadow flex justify-between items-center">
        <h1 class="text-3xl font-bold">Kelola Gallery</h1>
        <!-- Toggle Theme -->
        <button id="themeToggle" class="w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300">
            <span id="iconSun" class="absolute opacity-0 scale-0 transition-all">☀️</span>
            <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all">🌙</span>
        </button>
    </header>

    <div class="max-w-7xl mx-auto mt-10 px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-teal-600 dark:text-teal-400 mb-6 text-center border-b border-teal-400 dark:border-teal-500 pb-2">MENU</h2>
            <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                <li><a href="beranda_admin.php" class="block hover:text-teal-400">Beranda</a></li>
                <li><a href="data_artikel.php" class="block hover:text-teal-400">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block font-bold text-teal-500 dark:text-teal-400">Kelola Gallery</a></li>
                <li><a href="about.php" class="block hover:text-teal-400">About</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Daftar Gallery</h2>
                <a href="add_gallery.php" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 transition">+ Tambah Gambar</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php
                $sql = "SELECT * FROM tbl_gallery ORDER BY id_gallery DESC";
                $query = mysqli_query($db, $sql);

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        $judul = htmlspecialchars($data['judul']);
                        echo "<div class='bg-white dark:bg-gray-900 rounded-xl shadow hover:shadow-lg transition overflow-hidden'>";
                        echo "<img src='../images/{$data['foto']}' alt='{$judul}' class='w-full h-48 object-cover'>";
                        echo "<div class='p-4'>";
                        echo "<h3 class='text-lg font-semibold mb-2'>{$judul}</h3>";
                        echo "<div class='flex justify-between text-sm'>";
                        echo "<a href='edit_gallery.php?id_gallery={$data['id_gallery']}' class='text-teal-500 hover:underline'>Edit</a>";
                        echo "<a href='delete_gallery.php?id_gallery={$data['id_gallery']}'
                                onclick='return confirm(\"Yakin ingin menghapus?\")'
                                class='text-red-500 hover:underline'>Hapus</a>";
                        echo "</div></div></div>";
                    }
                } else {
                    echo "<div class='col-span-full text-center text-gray-500 dark:text-gray-400'>Belum ada gambar di galeri.</div>";
                }
                ?>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-center py-4 mt-10 text-sm">
        &copy; <?php echo date('Y'); ?> | Created by Ramdan Prayitno
    </footer>

    <!-- Dark Mode Script -->
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