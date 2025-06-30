<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Personal Web</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white font-sans transition duration-500 ease-in-out">

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

    <!-- About Section -->
    <main class="max-w-6xl mx-auto px-6 py-16 bg-gray-100 dark:bg-gray-800 rounded-xl shadow-lg mt-10" data-aos="fade-up">
        <div class="text-center mb-12">
            <img src="asset/profil.webp" alt="Profile" class="w-32 h-32 rounded-full mx-auto border-4 border-teal-400 mb-4 shadow-md" data-aos="zoom-in">
            <h2 class="text-4xl font-bold mb-3">About Me</h2>
            <?php
            $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC LIMIT 1";
            $query = mysqli_query($db, $sql);
            $data = mysqli_fetch_array($query);
            echo "<p class='text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed'>" . htmlspecialchars($data['about']) . "</p>";
            ?>
            <a href="assets/CV-Ramdan.pdf" download class="mt-6 inline-block bg-teal-500 text-white px-6 py-2 rounded-full hover:bg-teal-600 transition duration-300 shadow-md">Download CV</a>
            <!-- Social Media Icons -->
            <div class="mt-6 flex justify-center gap-4" data-aos="fade-up">
                <a href="https://linkedin.com/in/ramdan" target="_blank" class="text-teal-500 dark:text-teal-400 hover:text-teal-700 dark:hover:text-white transition transform hover:scale-110">
                    <i class="fab fa-linkedin fa-lg"></i>
                </a>
                <a href="https://github.com/ramdan" target="_blank" class="text-teal-500 dark:text-teal-400 hover:text-teal-700 dark:hover:text-white transition transform hover:scale-110">
                    <i class="fab fa-github fa-lg"></i>
                </a>
                <a href="https://instagram.com/ramdan" target="_blank" class="text-teal-500 dark:text-teal-400 hover:text-teal-700 dark:hover:text-white transition transform hover:scale-110">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="mailto:cv@ramdan.com" class="text-teal-500 dark:text-teal-400 hover:text-teal-700 dark:hover:text-white transition transform hover:scale-110">
                    <i class="fas fa-envelope fa-lg"></i>
                </a>
            </div>

        </div>


        <div class="grid md:grid-cols-2 gap-12">
            <!-- Personal Details -->
            <div data-aos="fade-right">
                <h3 class="text-2xl font-semibold text-teal-500 dark:text-teal-400 mb-4">Personal Details</h3>
                <ul class="text-gray-700 dark:text-gray-300 space-y-3 text-base leading-relaxed">
                    <li><strong>Birthdate:</strong> 21-02-1992</li>
                    <li><strong>Phone:</strong> +91 99886644332</li>
                    <li><strong>Email:</strong> <a href="mailto:cv@ramdan.com" class="hover:underline text-teal-600 dark:text-teal-400">cv@ramdan.com</a></li>
                    <li><strong>Website:</strong> <a href="https://www.ramdan.com" target="_blank" class="hover:underline text-teal-600 dark:text-teal-400">www.ramdan.com</a></li>
                    <li><strong>Address:</strong> 123 London, UK</li>
                    <li><strong>Job Status:</strong> <span class="text-teal-500 dark:text-teal-400 font-semibold">FREELANCE</span></li>
                </ul>
            </div>

            <!-- Interests -->
            <div data-aos="fade-left">
                <h3 class="text-2xl font-semibold text-teal-500 dark:text-teal-400 mb-4">My Interests</h3>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-5">
                    <?php
                    $interests = [
                        ['icon' => 'fas fa-gamepad', 'label' => 'Games'],
                        ['icon' => 'fas fa-music', 'label' => 'Music'],
                        ['icon' => 'fas fa-plane', 'label' => 'Travel'],
                        ['icon' => 'fab fa-apple', 'label' => 'Mac OS'],
                        ['icon' => 'fas fa-film', 'label' => 'Cinema'],
                        ['icon' => 'fas fa-coffee', 'label' => 'Coffee'],
                        ['icon' => 'fas fa-car', 'label' => 'Cars'],
                        ['icon' => 'fas fa-dollar-sign', 'label' => 'Money'],
                    ];

                    foreach ($interests as $i) {
                        echo "<div class='flex flex-col items-center justify-center bg-gray-200 dark:bg-gray-700 p-4 rounded-lg hover:scale-105 transition-transform duration-300 ease-in-out hover:shadow-md'>";
                        echo "<i class='{$i['icon']} text-2xl text-teal-500 dark:text-teal-400 mb-2'></i>";
                        echo "<span class='text-gray-800 dark:text-white font-medium'>{$i['label']}</span>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-6 mt-16">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?= date('Y') ?> | Created by Ramdan Prayitno</p>
    </footer>

    <!-- Theme Toggle Script -->
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
            once: true,
            duration: 1000
        });
    </script>
</body>

</html>