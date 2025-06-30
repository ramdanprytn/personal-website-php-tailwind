<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Web | Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
</head>

<body class="bg-[#f7f9f8] text-gray-900 dark:bg-gray-900 dark:text-white font-sans transition-colors duration-500">

    <!-- Navbar -->
    <header class="bg-gray-100 dark:bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex-1">
                <a href="home.php" class="text-2xl font-bold text-teal-500 dark:text-teal-400 hover:text-gray-900 dark:hover:text-white transition">MyWebsite</a>
            </div>
            <div class="flex-1 flex justify-center">
                <nav class="flex space-x-6 font-medium text-gray-800 dark:text-white">
                    <a href="home.php" class="hover:text-teal-400 transition">Home</a>
                    <a href="about.php" class="hover:text-teal-400 transition">About</a>
                    <a href="gallery.php" class="hover:text-teal-400 transition">Gallery</a>
                    <a href="artikel.php" class="hover:text-teal-400 transition">Artikel</a>
                </nav>
            </div>
            <div class="flex-1 flex justify-end items-center space-x-4">
                <button id="themeToggle" class="w-10 h-10 flex items-center justify-center border border-teal-400 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300 overflow-hidden relative">
                    <span id="iconSun" class="absolute opacity-0 scale-0 transition-all duration-300 ease-in-out">☀️</span>
                    <span id="iconMoon" class="absolute opacity-100 scale-100 transition-all duration-300 ease-in-out">🌙</span>
                </button>
                <a href="admin/login.php" class="border border-teal-400 px-4 py-1.5 rounded-full hover:bg-teal-400 hover:text-gray-900 transition duration-300">Login</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-6 mt-6">
        <h2 class="text-2xl text-center font-bold mb-8 text-teal-400 border-b border-teal-600 pb-2" data-aos="fade-up">Galeri Foto</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php
            $sql = "SELECT * FROM tbl_gallery ORDER BY id_gallery DESC";
            $query = mysqli_query($db, $sql);
            while ($data = mysqli_fetch_array($query)) {
                $imgPath = 'images/' . htmlspecialchars($data['foto']);
                echo "<div class='bg-gray-100 dark:bg-gray-800 p-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105 hover:shadow-xl cursor-pointer' onclick=\"showPreview('$imgPath')\" data-aos='zoom-in'>";
                echo "<img src='$imgPath' alt='" . htmlspecialchars($data['judul']) . "' class='w-full h-64 object-cover rounded-lg mb-3 transition-transform duration-300'>";
                echo "<h3 class='text-lg font-semibold text-teal-500 dark:text-teal-400'>" . htmlspecialchars($data['judul']) . "</h3>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
        <img id="previewImage" src="" class="max-w-3xl max-h-[80vh] rounded-lg shadow-2xl border-4 border-white dark:border-gray-800">
        <button onclick="hidePreview()" class="absolute top-4 right-4 text-white text-3xl hover:text-red-400">&times;</button>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-16">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?= date('Y') ?> | Created by Ramdan Prayitno</p>
    </footer>

    <!-- Toggle Theme -->
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

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    <!-- Preview Modal Script -->
    <script>
        const modal = document.getElementById('previewModal');
        const modalImg = document.getElementById('previewImage');

        function showPreview(src) {
            modalImg.src = src;
            modal.classList.remove('hidden');
        }

        function hidePreview() {
            modal.classList.add('hidden');
            modalImg.src = '';
        }

        // Close modal if click outside image
        modal.addEventListener('click', e => {
            if (e.target === modal) hidePreview();
        });
    </script>
</body>

</html>