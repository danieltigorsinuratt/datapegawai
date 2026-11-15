<?php

session_start();

if (!isset($_SESSION['user'])) {
    exit;
}

require_once '../../../koneksi/koneksi.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';

try {
    if (!empty($keyword)) {

        $sql = "SELECT * FROM pegawai 
                WHERE nama LIKE :keyword 
                   OR nip LIKE :keyword 
                   OR jabatan LIKE :keyword 
                   OR divisi LIKE :keyword 
                ORDER BY nip ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['keyword' => "%$keyword%"]);
    } else {

        $sql = "SELECT * FROM pegawai ORDER BY nip ASC";
        $stmt = $pdo->query($sql);
    }
    $pegawai = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<tr><td colspan='8' class='text-center py-4 text-danger'>Gagal memuat data.</td></tr>";
    exit;
}

if (!empty($pegawai)): 
    $no = 1; 
    foreach ($pegawai as $row): ?>
        <tr>
            <td class="text-muted"><?= $no++ ?></td>
            <td>
                <span class="fw-semibold text-primary"><?= htmlspecialchars($row['nip']) ?></span>
            </td>
            <td>
                <div class="fw-bold text-dark"><?= htmlspecialchars($row['nama']) ?></div>
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
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group">
                    <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="form.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary" title="Ubah Data">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button" 
                            class="btn btn-outline-danger" 
                            title="Hapus Data" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalHapus" 
                            data-id="<?= $row['id'] ?>" 
                            data-nama="<?= htmlspecialchars($row['nama']) ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php endforeach; 
else: ?>
    <tr>
        <td colspan="8" class="text-center py-5 text-muted">
            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
            Tidak ada data pegawai yang sesuai dengan kata kunci pencarian.
        </td>
    </tr>
<?php endif; ?>
