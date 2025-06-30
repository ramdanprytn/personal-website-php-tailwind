<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Validasi ID
if (!isset($_GET['id_artikel']) || !is_numeric($_GET['id_artikel'])) {
    die("ID Artikel tidak valid.");
}

$id = mysqli_real_escape_string($db, $_GET['id_artikel']);
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = '$id'";
$query = mysqli_query($db, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data artikel tidak ditemukan.");
}

$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen font-sans">
    <!-- Header -->
    <header class="bg-gray-800 text-teal-400 text-center py-6 shadow">
        <h1 class="text-3xl font-bold">Edit Artikel</h1>
    </header>

    <div class="max-w-7xl mx-auto mt-10 px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-teal-400 mb-6 text-center border-b border-teal-500 pb-2">MENU</h2>
            <ul class="space-y-3 text-gray-300">
                <li><a href="beranda_admin.php" class="block hover:text-teal-400">Beranda</a></li>
                <li><a href="data_artikel.php" class="block text-teal-400 font-bold">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block hover:text-teal-400">Kelola Gallery</a></li>
                <li><a href="about.php" class="block hover:text-teal-400">About</a></li>
                <li>
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-500 hover:underline font-medium">Logout</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3 bg-gray-800 rounded-xl shadow p-6">
            <form action="proses_edit_artikel.php" method="post" class="space-y-6">
                <input type="hidden" name="id_artikel" value="<?php echo htmlspecialchars($data['id_artikel']); ?>">

                <!-- Judul -->
                <div>
                    <label for="nama_artikel" class="block text-sm font-medium text-gray-300 mb-2">Judul Artikel</label>
                    <input type="text" id="nama_artikel" name="nama_artikel" required
                        value="<?php echo htmlspecialchars($data['nama_artikel']); ?>"
                        class="w-full p-3 rounded-md border border-gray-600 bg-gray-900 text-white focus:ring-teal-500 focus:border-teal-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                    <select id="kategori" name="kategori" required
                        class="w-full p-3 rounded-md border border-gray-600 bg-gray-900 text-white focus:ring-teal-500 focus:border-teal-500">
                        <?php
                        $kategori_list = ['UI/UX', 'Web Development', 'Cybersecurity', 'Data Science', 'Programming', 'Lainnya'];
                        foreach ($kategori_list as $kategori) {
                            $selected = ($data['kategori'] === $kategori) ? 'selected' : '';
                            echo "<option value=\"$kategori\" $selected>$kategori</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Isi Artikel -->
                <div>
                    <label for="isi_artikel" class="block text-sm font-medium text-gray-300 mb-2">Isi Artikel</label>
                    <textarea id="isi_artikel" name="isi_artikel" rows="6" required
                        class="w-full p-3 rounded-md border border-gray-600 bg-gray-900 text-white focus:ring-teal-500 focus:border-teal-500"><?php echo htmlspecialchars($data['isi_artikel']); ?></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-teal-500 text-white px-5 py-2 rounded hover:bg-teal-600 transition">Update</button>
                    <a href="data_artikel.php"
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