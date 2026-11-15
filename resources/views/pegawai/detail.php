<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php");
    exit;
}

require_once '../../../koneksi/koneksi.php';

$pageTitle = "Detail Pegawai";
$activeMenu = "pegawai";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    header("Location: index.php");
    exit;
}

try {

    $stmt = $pdo->prepare("SELECT * FROM pegawai WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    $pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pegawai) {
        header("Location: index.php?pesan=gagal");
        exit;
    }

} catch (PDOException $e) {
    die("Gagal mengambil data dari database: " . $e->getMessage());
}

include_once '../komponen/head.php';
include_once '../komponen/sidebar.php';
?>

<main class="main-content">

    <div class="card border-0 shadow-sm bg-white" style="border-radius: 16px; border: 1px solid var(--border-color) !important; max-width: 800px; margin: 0 auto;">
        
        
        <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1" style="color: #111827;">Detail Profil Pegawai</h4>
                <p class="text-muted small mb-0">Informasi lengkap data kepegawaian.</p>
            </div>
            
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        
        <div class="p-4">
            <div class="row align-items-center mb-4 pb-3 border-bottom">
                <div class="col-auto">
                    <div class="user-avatar-placeholder" style="width: 72px; height: 72px; font-size: 28px; border-radius: 50%;">
                        <?= strtoupper(substr($pegawai['nama'], 0, 1)) ?>
                    </div>
                </div>
                <div class="col">
                    <h4 class="fw-bold mb-1" style="color: #111827;"><?= htmlspecialchars($pegawai['nama']) ?></h4>
                    <p class="text-muted mb-1"><?= htmlspecialchars($pegawai['jabatan']) ?> &bull; <?= htmlspecialchars($pegawai['divisi']) ?></p>
                    <span class="badge" style="background-color: #e8eef5; color: #1E3A5F; font-size: 13px;">
                        Nomor Pegawai: <?= htmlspecialchars($pegawai['nip']) ?>
                    </span>
                </div>
            </div>

            
            <table class="table table-borderless align-middle mb-4">
                <tr>
                    <td class="text-muted ps-0" style="width: 170px;">Jenis Kelamin</td>
                    <td class="fw-semibold text-dark">: <?= htmlspecialchars($pegawai['jenis_kelamin']) ?></td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">Alamat Email</td>
                    <td class="fw-semibold text-dark">: <?= htmlspecialchars($pegawai['email']) ?></td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">Nomor Telepon / WA</td>
                    <td class="fw-semibold text-dark">: <?= htmlspecialchars($pegawai['no_hp']) ?></td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">Alamat Tempat Tinggal</td>
                    <td class="fw-semibold text-dark">: <?= htmlspecialchars($pegawai['alamat']) ?></td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">Terdaftar Sejak</td>
                    <td class="fw-semibold text-dark">: <?= date('d F Y', strtotime($pegawai['created_at'])) ?></td>
                </tr>
            </table>

            
            <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                <a href="form.php?id=<?= $pegawai['id'] ?>" class="btn btn-primary" style="border-radius: 8px;">
                    <i class="bi bi-pencil-square me-1"></i> Ubah Data
                </a>
            </div>

        </div>

    </div>

</main>

<?php
include_once '../komponen/footer.php';
?>
