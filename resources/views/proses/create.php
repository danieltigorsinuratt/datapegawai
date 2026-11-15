<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../../../koneksi/koneksi.php';

    $nip           = trim($_POST['nip']);
    $nama          = trim($_POST['nama']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan       = trim($_POST['jabatan']);
    $divisi        = $_POST['divisi'];
    $email         = trim($_POST['email']);
    $no_hp         = trim($_POST['no_hp']);
    $alamat        = trim($_POST['alamat']);

    try {

        $sql = "INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan, divisi, email, no_hp, alamat) 
                VALUES (:nip, :nama, :jenis_kelamin, :jabatan, :divisi, :email, :no_hp, :alamat)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nip'           => $nip,
            'nama'          => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan'       => $jabatan,
            'divisi'        => $divisi,
            'email'         => $email,
            'no_hp'         => $no_hp,
            'alamat'        => $alamat
        ]);

        header("Location: ../pegawai/index.php?pesan=sukses_tambah");
        exit;

    } catch (PDOException $e) {
        header("Location: ../pegawai/index.php?pesan=gagal");
        exit;
    }
} else {
    header("Location: ../pegawai/index.php");
    exit;
}
