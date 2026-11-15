<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php");
    exit;
}

require_once '../../../koneksi/koneksi.php';

$pageTitle = "Dashboard";
$activeMenu = "dashboard";

try {

    $stmt = $pdo->query("SELECT COUNT(*) FROM pegawai");
    $total_pegawai = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM pegawai WHERE jenis_kelamin = 'Laki-laki'");
    $total_laki = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM pegawai WHERE jenis_kelamin = 'Perempuan'");
    $total_perempuan = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT * FROM pegawai ORDER BY id DESC LIMIT 5");
    $daftar_pegawai = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Gagal mengambil data dari database: " . $e->getMessage());
}

include_once '../komponen/head.php';
include_once '../komponen/sidebar.php';
?>

<main class="main-content">
    
    
    <div class="welcome-banner">
        <h3 class="welcome-title">Selamat Datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?></h3>
        <p class="welcome-subtitle">
            Sistem Informasi Pencatatan dan Pengelolaan Data Pegawai Perusahaan.
        </p>
    </div>

    <div class="row g-4">
        
        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-title">total pegawai</div>
                <h2 class="stat-count"><?= $total_pegawai ?> <span class="fs-6 fw-normal text-muted">Orang</span></h2>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon-wrapper" style="background-color: #e8eef5; color: #1E3A5F;">
                    <i class="bi bi-gender-male"></i>
                </div>
                <div class="stat-title">pegawai laki-laki</div>
                <h2 class="stat-count"><?= $total_laki ?> <span class="fs-6 fw-normal text-muted">Orang</span></h2>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon-wrapper" style="background-color: #fdf2f8; color: #be185d;">
                    <i class="bi bi-gender-female"></i>
                </div>
                <div class="stat-title">pegawai perempuan</div>
                <h2 class="stat-count"><?= $total_perempuan ?> <span class="fs-6 fw-normal text-muted">Orang</span></h2>
            </div>
        </div>

    </div>

    
    <div class="card-table">
        <div class="card-table-header">
            <div>
                <h4 class="card-table-title">Daftar Pegawai Terbaru</h4>
                <span class="small text-muted">Data pegawai yang baru saja ditambahkan</span>
            </div>
            <div>
                <a href="<?= $base ?>resources/views/pegawai/index.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul me-1"></i>
                    Lihat Semua
                </a>
                <a href="<?= $base ?>resources/views/pegawai/form.php" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Pegawai
                </a>
            </div>
        </div>
        
        
        <div class="table-responsive">
            <table class="table custom-table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">no</th>
                        <th>nomor pegawai</th>
                        <th>nama lengkap</th>
                        <th>jabatan</th>
                        <th>divisi</th>
                        <th>jenis kelamin</th>
                        <th>kontak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftar_pegawai)): ?>
                        <?php $no = 1; foreach ($daftar_pegawai as $row): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td>
                                    <span class="fw-semibold text-primary"><?= htmlspecialchars($row['nip']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= htmlspecialchars($row['nama']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['email']) ?></small>
                                </td>
                                <td><?= htmlspecialchars($row['jabatan']) ?></td>
                                <td><?= htmlspecialchars($row['divisi']) ?></td>
                                <td>
                                    <?php if ($row['jenis_kelamin'] === 'Laki-laki'): ?>
                                        <span class="badge-gender badge-gender-l">Laki-laki</span>
                                    <?php else: ?>
                                        <span class="badge-gender badge-gender-p">Perempuan</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-muted"><?= htmlspecialchars($row['no_hp']) ?></small>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data pegawai yang terdaftar.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php
include_once '../komponen/footer.php';
?>
