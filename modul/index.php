<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($page) {
    case 'mahasiswa':
        include 'mahasiswa.php';
        $mahasiswa = new Mahasiswa();
        switch ($action) {
            case 'index':
                $mahasiswa->index();
                break;
            case 'create':
                $mahasiswa->create();
                break;
            case 'store':
                $mahasiswa->store();
                break;
            case 'edit':
                $mahasiswa->edit();
                break;
            case 'update':
                $mahasiswa->update();
                break;
            case 'delete':
                $mahasiswa->delete();
                break;
        }
        break;
    default:
        include 'home.php';
        break;
}
