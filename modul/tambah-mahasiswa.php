<?php
// Include file class database
require_once '../class/Database.php';

// Inisialisasi class database
$db = new Database();

// Inisialisasi variabel error
$error = '';

// Proses tambah data mahasiswa
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    // Validasi input data
    if (empty($nim) || empty($nama) || empty($jurusan) || empty($alamat)) {
        $error = 'Semua kolom harus diisi';
    } else {
        // Proses tambah data
        $result = $db->insert('mahasiswa', [
            'nim' => $nim,
            'nama' => $nama,
            'jurusan' => $jurusan,
            'alamat' => $alamat
        ]);

        if ($result) {
            header('Location: index.php?page=mahasiswa');
            exit;
        } else {
            $error = 'Gagal menambahkan data';
        }
    }
}

// Include file template header
include '../template/header.php';
?>
<body>
    <?php include '../template/sidebar.php'; ?>

    <div class="main">
        <h1>Tambah Data Mahasiswa</h1>

        <?php if ($error) : ?>
            <div class="alert danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn">Simpan</button>
                <a href="index.php?page=mahasiswa" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
<?php include '../template/footer.php'; ?>
