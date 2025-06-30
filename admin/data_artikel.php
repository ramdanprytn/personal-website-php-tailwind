<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Ambil keyword pencarian jika ada
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($db, $_GET['keyword']) : '';
?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8">
    <title>Kelola Artikel</title>
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
        <h1 class="text-3xl font-bold">Kelola Artikel</h1>
        <!-- Toggle Theme -->
        <button id="themeToggle" class="w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300">
            <span id="iconSun" class="absolute opacity-0 scale-0 transition-all">☀️</span>
            <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all">🌙</span>
        </button>
    </header>

    <!-- Container -->
    <div class="max-w-7xl mx-auto mt-10 px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-teal-600 dark:text-teal-400 mb-6 text-center border-b border-teal-400 dark:border-teal-500 pb-2">MENU</h2>
            <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                <li><a href="beranda_admin.php" class="block hover:text-teal-400">Beranda</a></li>
                <li><a href="data_artikel.php" class="block font-bold text-teal-500 dark:text-teal-400">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block hover:text-teal-400">Kelola Gallery</a></li>
                <li><a href="about.php" class="block hover:text-teal-400">About</a></li>
                <li>
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-100 dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <form method="GET" class="flex items-center w-full md:w-auto gap-2">
                    <input type="text" name="keyword" placeholder="Cari judul artikel..." value="<?= htmlspecialchars($keyword) ?>"
                        class="px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white w-full md:w-64">
                    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600 transition">Cari</button>
                </form>
                <a href="add_artikel.php"
                    class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 transition">+ Tambah Artikel</a>
            </div>

            <div class="overflow-x-auto rounded">
                <table class="min-w-full text-sm text-left border border-gray-300 dark:border-gray-700 rounded overflow-hidden">
                    <thead class="bg-teal-700 text-white">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Judul</th>
                            <th class="p-3 border">Kategori</th>
                            <th class="p-3 border">Isi (Singkat)</th>
                            <th class="p-3 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                        <?php
                        $sql = "SELECT * FROM tbl_artikel";
                        if ($keyword !== '') {
                            $sql .= " WHERE nama_artikel LIKE '%$keyword%'";
                        }
                        $sql .= " ORDER BY id_artikel DESC";
                        $query = mysqli_query($db, $sql);
                        $no = 1;
                        if (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                                $isiSingkat = substr(strip_tags($data['isi_artikel']), 0, 100) . '...';
                                echo "<tr class='hover:bg-gray-200 dark:hover:bg-gray-800'>";
                                echo "<td class='border p-2 text-center'>" . $no++ . "</td>";
                                echo "<td class='border p-2'>" . htmlspecialchars($data['nama_artikel']) . "</td>";
                                echo "<td class='border p-2'>" . htmlspecialchars($data['kategori']) . "</td>";
                                echo "<td class='border p-2'>" . htmlspecialchars($isiSingkat) . "</td>";
                                echo "<td class='border p-2 text-center space-x-2'>
                                    <a href='edit_artikel.php?id_artikel={$data['id_artikel']}' class='text-teal-500 hover:underline'>Edit</a>
                                    <a href='delete_artikel.php?id_artikel={$data['id_artikel']}'
                                       onclick='return confirm(\"Yakin ingin menghapus?\")'
                                       class='text-red-500 hover:underline'>Hapus</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-6 text-gray-500 dark:text-gray-400'>Artikel tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-10 text-sm text-gray-500 dark:text-gray-400">
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