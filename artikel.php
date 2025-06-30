<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Web | Artikel</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        gray: {
                            100: '#f4f4f4',
                            800: '#1f2937',
                        },
                        teal: {
                            400: '#38b2ac',
                            500: '#319795',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white font-sans transition-colors duration-500">

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

    <!-- Form Pencarian + Filter -->
    <form method="GET" class="max-w-4xl mx-auto px-4 mt-10" data-aos="fade-down">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <!-- Input Pencarian -->
            <div class="md:col-span-2 flex items-center bg-white dark:bg-gray-800 rounded-full p-2 shadow-md hover:ring-2 hover:ring-teal-400 transition">
                <input type="text" name="search" placeholder="Cari artikel..."
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                    class="flex-1 px-4 py-2 bg-transparent text-gray-900 dark:text-white focus:outline-none" />
                <button type="submit" class="text-teal-500 hover:text-teal-400 px-4 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Dropdown Kategori -->
            <div>
                <select name="kategori" onchange="this.form.submit()"
                    class="w-full px-4 py-2 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-teal-400 hover:ring-2 hover:ring-teal-400 transition">
                    <option value="">Semua Kategori</option>
                    <?php
                    $kat_query = mysqli_query($db, "SELECT DISTINCT kategori FROM tbl_artikel WHERE kategori IS NOT NULL AND kategori != ''");
                    while ($kat = mysqli_fetch_array($kat_query)) {
                        $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $kat['kategori']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($kat['kategori']) . "' $selected>" . htmlspecialchars($kat['kategori']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
        <!-- Artikel Utama -->
        <section class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-teal-500 dark:text-teal-400 border-b border-teal-500 pb-2">Artikel Terbaru</h2>
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                <?php
                $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
                $kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($db, $_GET['kategori']) : '';
                $sql = "SELECT * FROM tbl_artikel WHERE 1";
                if ($search !== '') {
                    $sql .= " AND (nama_artikel LIKE '%$search%' OR isi_artikel LIKE '%$search%' OR kategori LIKE '%$search%')";
                }
                if ($kategori !== '') {
                    $sql .= " AND kategori = '$kategori'";
                }
                $sql .= " ORDER BY id_artikel DESC";
                $query = mysqli_query($db, $sql);

                $animations = ['fade-up', 'fade-right', 'fade-left', 'zoom-in'];
                $index = 0;

                while ($data = mysqli_fetch_array($query)) {
                    $aos = $animations[$index % count($animations)];
                    $index++;

                    echo "<div data-aos='$aos' class='border-b border-gray-300 dark:border-gray-700 pb-4 hover:bg-gray-100 dark:hover:bg-gray-700 p-4 rounded-md transition duration-300 hover:shadow-md'>";
                    echo "<p class='text-sm text-teal-500 dark:text-teal-400 font-medium mb-1'>Kategori: " . htmlspecialchars($data['kategori']) . "</p>";
                    echo "<a href='detail_artikel.php?id_artikel=" . $data['id_artikel'] . "' class='text-lg font-semibold text-gray-900 dark:text-white hover:text-teal-500 dark:hover:text-teal-300 transition block'>" . htmlspecialchars($data['nama_artikel']) . "</a>";
                    $ringkasan = substr(strip_tags($data['isi_artikel']), 0, 150) . '...';
                    echo "<p class='mt-1 text-gray-600 dark:text-gray-400'>" . htmlspecialchars($ringkasan) . "</p>";
                    echo "<a href='detail_artikel.php?id_artikel=" . $data['id_artikel'] . "' class='text-teal-500 dark:text-teal-400 hover:underline text-sm'>Baca selengkapnya →</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>

        <!-- Sidebar -->
        <aside class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-lg font-bold mb-4 text-teal-500 dark:text-teal-400 border-b border-teal-500 pb-2">Daftar Artikel</h2>
            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                <?php
                $query = mysqli_query($db, "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC");
                while ($data = mysqli_fetch_array($query)) {
                    echo "<li><a href='detail_artikel.php?id_artikel=" . $data['id_artikel'] . "' class='hover:text-teal-400 transition block'>" . htmlspecialchars($data['nama_artikel']) . "</a></li>";
                }
                ?>
            </ul>
        </aside>

    </main>


    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 mt-16">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?= date('Y') ?> | Created by Ramdan Prayitno</p>
    </footer>

    <!-- Toggle Theme Script -->
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

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>