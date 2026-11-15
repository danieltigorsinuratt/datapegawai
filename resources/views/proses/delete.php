<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php");
    exit;
}

if (isset($_GET['id'])) {
    require_once '../../../koneksi/koneksi.php';

    $id = $_GET['id'];

    try {

        $stmt = $pdo->prepare("DELETE FROM pegawai WHERE id = :id");
        $stmt->execute(['id' => $id]);

        header("Location: ../pegawai/index.php?pesan=sukses_hapus");
        exit;

    } catch (PDOException $e) {
        header("Location: ../pegawai/index.php?pesan=gagal");
        exit;
    }
} else {
    header("Location: ../pegawai/index.php");
    exit;
}
