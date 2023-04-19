<?php
// Include file class database
require_once '../class/Database.php';

// Inisialisasi class database
$db = new Database();

// Ambil parameter id dari URL
$id = $_GET['id'];

// Proses hapus data mahasiswa
if (isset($_POST['hapus'])) {
    $db->delete('mahasiswa', ['id' => $id]);
    header('Location: index.php?page=mahasiswa');
}

// Ambil data mahasiswa dari database berdasarkan id
$mahasiswa = $db->get('mahasiswa', '*', ['id' => $id]);

// Jika data tidak ditemukan, kembali ke halaman mahasiswa
if (!$mahasiswa) {
    header('Location: index.php?page=mahasiswa');
}

// Include file template header
include '../template/header.php';
?>
<body>
    <?php
    // Include file template sidebar
    include '../template/sidebar.php';
    ?>

    <div class="container mt-3">
        <h1 class="mb-3">Hapus Data Mahasiswa</h1>

        <form method="post">
            <p>Anda yakin ingin menghapus data mahasiswa dengan nama <strong><?= $mahasiswa['nama'] ?></strong>?</p>
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
            <a href="index.php?page=mahasiswa" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
<?php
// Include file template footer
include '../template/footer.php';
?>
