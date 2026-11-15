<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php");
    exit;
}

require_once '../../../koneksi/koneksi.php';

$is_edit = isset($_GET['id']) && !empty($_GET['id']);
$pageTitle = $is_edit ? "Edit Data Pegawai" : "Tambah Data Pegawai";
$activeMenu = $is_edit ? "pegawai" : "tambah";

$data = [
    'id'            => '',
    'nip'           => '',
    'nama'          => '',
    'jenis_kelamin' => 'Laki-laki',
    'jabatan'       => '',
    'divisi'        => 'Teknologi Informasi',
    'email'         => '',
    'no_hp'         => '',
    'alamat'        => ''
];

if ($is_edit) {

    $stmt = $pdo->prepare("SELECT * FROM pegawai WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $_GET['id']]);
    $pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pegawai) {
        $data = $pegawai;
    } else {
        header("Location: index.php?pesan=gagal");
        exit;
    }
} else {

    $stmt = $pdo->query("SELECT MAX(CAST(nip AS UNSIGNED)) AS max_nip FROM pegawai");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nomor = $row['max_nip'] + 1;
    $data['nip'] = sprintf("%03d", $nomor);
}

include_once '../komponen/head.php';
include_once '../komponen/sidebar.php';
?>

<main class="main-content">

    <div class="card border-0 shadow-sm bg-white" style="border-radius: 16px; border: 1px solid var(--border-color) !important; max-width: 850px; margin: 0 auto;">
        
        
        <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1" style="color: #111827;"><?= $pageTitle ?></h4>
                <p class="text-muted small mb-0">Silakan isi formulir data pegawai di bawah ini dengan lengkap dan benar.</p>
            </div>
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        
        <div class="p-4">
            <form action="../proses/<?= $is_edit ? 'update.php' : 'create.php' ?>" method="POST" id="pegawaiForm">
                
                <?php if ($is_edit): ?>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <?php endif; ?>

                <div class="row g-3">
                    
                    
                    <div class="col-md-6">
                        <label for="nip" class="form-label">Nomor Pegawai</label>
                        <input type="text" class="form-control" id="nip" name="nip" 
                               value="<?= htmlspecialchars($data['nip']) ?>" readonly 
                               style="background-color: #f1f5f9; cursor: not-allowed; font-weight: 600; color: #1E3A5F;">
                        <small class="text-muted" style="font-size: 11.5px;">Nomor dibuat otomatis oleh sistem.</small>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               placeholder="Contoh: Daniel Sinurat" 
                               value="<?= htmlspecialchars($data['nama']) ?>" required>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" style="border-radius: 12px; padding: 13px 16px;" required>
                            <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" 
                               placeholder="Contoh: Web Developer" 
                               value="<?= htmlspecialchars($data['jabatan']) ?>" required>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="divisi" class="form-label">Divisi / Bagian <span class="text-danger">*</span></label>
                        <select name="divisi" id="divisi" class="form-select" style="border-radius: 12px; padding: 13px 16px;" required>
                            <option value="Teknologi Informasi" <?= ($data['divisi'] == 'Teknologi Informasi') ? 'selected' : '' ?>>Teknologi Informasi</option>
                            <option value="Sumber Daya Manusia" <?= ($data['divisi'] == 'Sumber Daya Manusia') ? 'selected' : '' ?>>Sumber Daya Manusia</option>
                            <option value="Keuangan" <?= ($data['divisi'] == 'Keuangan') ? 'selected' : '' ?>>Keuangan</option>
                            <option value="Operasional" <?= ($data['divisi'] == 'Operasional') ? 'selected' : '' ?>>Operasional</option>
                            <option value="Pemasaran" <?= ($data['divisi'] == 'Pemasaran') ? 'selected' : '' ?>>Pemasaran</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="nama@perusahaan.com" 
                               value="<?= htmlspecialchars($data['email']) ?>" required>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" 
                               placeholder="Contoh: 08123456789" 
                               value="<?= htmlspecialchars($data['no_hp']) ?>" required>
                    </div>

                    
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                                  placeholder="Masukkan alamat pegawai"><?= htmlspecialchars($data['alamat']) ?></textarea>
                    </div>

                </div>

                
                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="index.php" class="btn btn-outline-secondary" style="padding: 10px 20px; border-radius: 10px;">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 10px;">
                        <i class="bi bi-save me-1"></i> Simpan Pegawai
                    </button>
                </div>

            </form>
        </div>

    </div>

</main>

<?php
include_once '../komponen/footer.php';
?>
