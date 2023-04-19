<?php
include_once("class/Database.php");
include_once("class/Form.php");

class Mahasiswa
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $data['title'] = "Data Mahasiswa";
        $data['mahasiswa'] = $this->db->get('mahasiswa');
        include 'templates/header.php';
        include 'templates/sidebar.php';
        include 'templates/mahasiswa/index.php';
        include 'templates/footer.php';
    }

    public function create()
    {
        $form = new Form('index.php?page=mahasiswa&action=store', 'Simpan');
        $form->addField('nama', 'Nama');
        $form->addField('nim', 'NIM');
        $form->addField('jurusan', 'Jurusan');
        $form->addField('alamat', 'Alamat');
        $form->displayForm();
    }

    public function store()
    {
        $data = [
            'nama' => $_POST['nama'],
            'nim' => $_POST['nim'],
            'jurusan' => $_POST['jurusan'],
            'alamat' => $_POST['alamat'],
        ];

        $this->db->insert('mahasiswa', $data);
        header('location: index.php?page=mahasiswa');
    }

    public function edit()
    {
        $form = new Form('index.php?page=mahasiswa&action=update', 'Update');
        $form->addField('nama', 'Nama');
        $form->addField('nim', 'NIM');
        $form->addField('jurusan', 'Jurusan');
        $form->addField('alamat', 'Alamat');

        $id = $_GET['id'];
        $mahasiswa = $this->db->get('mahasiswa', 'id=' . $id);

        $form->displayForm();
    }

    public function update()
    {
        $id = $_POST['id'];

        $data = [
            'nama' => $_POST['nama'],
            'nim' => $_POST['nim'],
            'jurusan' => $_POST['jurusan'],
            'alamat' => $_POST['alamat'],
        ];

        $this->db->update('mahasiswa', $data, 'id=' . $id);
        header('location: index.php?page=mahasiswa');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->db->delete('mahasiswa', 'id=' . $id);
        header('location: index.php?page=mahasiswa');
    }
}
