<?php
// Include file class database
require_once '../class/Database.php';

// Inisialisasi class database
$db = new Database();

// Inisialisasi variable default untuk error
$error = '';

// Ambil data mahasiswa berdasarkan id yang dipilih
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mahasiswa = $db->getMahasiswaById($id);

    // Jika data tidak ditemukan, redirect ke halaman utama
    if (!$mahasiswa) {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// Proses edit data mahasiswa
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];

    if (empty($nim) || empty($nama) || empty($jenis_kelamin) || empty($jurusan)) {
        $error = 'Semua field harus diisi!';
    } else {
        if ($db->updateMahasiswa($id, $nim, $nama, $jenis_kelamin, $jurusan)) {
            header("Location: index.php?page=mahasiswa");
            exit;
        } else {
            $error = 'Gagal mengupdate data!';
        }
    }
}

// Include file template header
include '../template/header.php';
?>

<body>
    <?php include '../template/sidebar.php'; ?>

    <div class="content">
        <h2>Edit Data Mahasiswa</h2>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mahasiswa['nim']; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $mahasiswa['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki" <?php if ($mahasiswa['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($mahasiswa['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

<?php include '../template/footer.php'; ?>
