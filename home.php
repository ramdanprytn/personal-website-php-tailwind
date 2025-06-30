<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="dark transition-colors duration-500">

<head>
    <meta charset="UTF-8" />
    <title>Home | Personal Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        };
    </script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white font-sans transition-colors duration-300">

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

    <!-- Hero Section -->
    <section id="hero" class="min-h-screen flex flex-col lg:flex-row items-center justify-between px-8 lg:px-24 py-12 bg-white dark:bg-gray-900 transition relative overflow-hidden">
        <!-- Text -->
        <div class="max-w-xl mb-12 lg:mb-0 text-center lg:text-left" data-aos="fade-right">
            <p class="text-sm uppercase text-teal-500 dark:text-teal-400 tracking-widest">Hello There!</p>
            <h1 class="text-4xl lg:text-5xl font-bold my-4 leading-tight">Welcome To <br> My Website</h1>
            <p id="typewriter" class="text-gray-600 dark:text-gray-400 mb-6 h-6"></p>
            <div class="flex flex-wrap gap-4 justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="200">
                <a href="about.php" class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">About Me</a>
                <a href="mailto:youremail@example.com" class="px-6 py-3 border border-teal-500 text-teal-600 dark:text-teal-400 rounded-lg hover:bg-teal-50 dark:hover:bg-gray-800 transition">Hire Me</a>
            </div>
        </div>

        <!-- Image -->
        <div class="relative" data-aos="fade-left">
            <img src="asset/profil.webp" alt="Foto Profil" class="w-64 h-64 lg:w-80 lg:h-80 object-cover rounded-full border-4 border-white dark:border-gray-800 shadow-lg relative z-10">
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; <?php echo date('Y'); ?> Ramdan Prayitno. All rights reserved.</p>
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

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000
        });
    </script>

    <!-- Typewriter Script -->
    <script>
        const words = ["UI/UX Enthusiast", "Frontend Developer", "Web Designer"];
        let wordIndex = 0,
            charIndex = 0;
        const typeElement = document.getElementById("typewriter");

        function type() {
            if (charIndex < words[wordIndex].length) {
                typeElement.textContent += words[wordIndex].charAt(charIndex++);
                setTimeout(type, 100);
            } else {
                setTimeout(erase, 2000);
            }
        }

        function erase() {
            if (charIndex > 0) {
                typeElement.textContent = words[wordIndex].substring(0, --charIndex);
                setTimeout(erase, 50);
            } else {
                wordIndex = (wordIndex + 1) % words.length;
                setTimeout(type, 500);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            if (typeElement) type();
        });
    </script>
</body>

</html>