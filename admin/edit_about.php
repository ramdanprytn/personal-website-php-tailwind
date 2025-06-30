<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

if (!isset($_GET['id_about']) || !is_numeric($_GET['id_about'])) {
    die("ID tidak valid.");
}

$id = mysqli_real_escape_string($db, $_GET['id_about']);
$sql = "SELECT * FROM tbl_about WHERE id_about = '$id'";
$query = mysqli_query($db, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit About</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen font-sans">
    <!-- Header -->
    <header class="bg-gray-800 text-teal-400 text-center py-6 shadow">
        <h1 class="text-3xl font-bold">Edit Data About</h1>
    </header>

    <div class="max-w-7xl mx-auto mt-10 px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-teal-400 mb-6 text-center border-b border-teal-500 pb-2">MENU</h2>
            <ul class="space-y-3 text-gray-300">
                <li><a href="beranda_admin.php" class="block hover:text-teal-400">Beranda</a></li>
                <li><a href="data_artikel.php" class="block hover:text-teal-400">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block hover:text-teal-400">Kelola Gallery</a></li>
                <li><a href="about.php" class="block text-teal-400 font-bold">About</a></li>
                <li>
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-800 rounded-xl shadow p-6">
            <form action="proses_edit_about.php" method="post" class="space-y-6">
                <input type="hidden" name="id_about" value="<?php echo htmlspecialchars($data['id_about']); ?>">

                <div>
                    <label for="about" class="block text-sm font-medium text-gray-300 mb-2">Tentang Saya</label>
                    <textarea id="about" name="about" rows="6" required
                        class="w-full p-3 rounded-md border border-gray-600 bg-gray-900 text-white focus:ring-teal-500 focus:border-teal-500"><?php echo htmlspecialchars($data['about']); ?></textarea>
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
    <footer class="bg-gray-800 text-center py-4 mt-10 text-sm text-gray-400">
        &copy; <?php echo date('Y'); ?> | Created by Ramdan Prayitno
    </footer>
</body>

</html>