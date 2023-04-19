<?php
// Include file class database
require_once 'class/Database.php';

// Inisialisasi class database
$db = new Database();

// Include file template header
include 'template/header.php';
?>
<body>
    <?php
    // Include file template sidebar
    include 'template/sidebar.php';

    // Proses routing aplikasi
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'mahasiswa':
                include 'modul/mahasiswa.php';
                break;
            case 'tambah-mahasiswa':
                include 'modul/tambah-mahasiswa.php';
                break;
            case 'edit-mahasiswa':
                include 'modul/edit-mahasiswa.php';
                break;
            case 'hapus-mahasiswa':
                include 'modul/hapus-mahasiswa.php';
                break;
            default:
                include 'modul/home.php';
                break;
        }
    } else {
        include 'modul/home.php';
    }
    ?>
</body>
<?php
// Include file template footer
include 'template/footer.php';
?>
