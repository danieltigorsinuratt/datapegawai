<aside class="sidebar">
    
    
    <div class="sidebar-header">
        <img src="<?= $base ?>img/logo.png" alt="logo" class="sidebar-logo">
        <div>
            <div class="sidebar-brand-text">Data Pegawai</div>
            <div class="sidebar-brand-sub">panel sistem</div>
        </div>
    </div>

    
    <div class="sidebar-content">
        <div class="sidebar-heading">menu utama</div>
        <ul class="sidebar-nav">

            
            <li class="sidebar-nav-item">
                <a href="<?= $base ?>resources/views/dashboard/index.php" class="sidebar-nav-link <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            
            <li class="sidebar-nav-item">
                <a href="<?= $base ?>resources/views/pegawai/index.php" class="sidebar-nav-link <?= (isset($activeMenu) && $activeMenu === 'pegawai') ? 'active' : '' ?>">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Pegawai</span>
                </a>
            </li>

            
            <li class="sidebar-nav-item">
                <a href="<?= $base ?>resources/views/pegawai/form.php" class="sidebar-nav-link <?= (isset($activeMenu) && $activeMenu === 'tambah') ? 'active' : '' ?>">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Tambah Pegawai</span>
                </a>
            </li>

        </ul>

        
        <div class="sidebar-heading">lainnya</div>
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="#" class="sidebar-nav-link text-danger" data-bs-toggle="modal" data-bs-target="#modalKeluar">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </div>

    
    <div class="sidebar-footer">
        <div class="user-badge">
            <div class="user-avatar-placeholder">
                <?= strtoupper(substr($_SESSION['user']['nama'], 0, 1)) ?>
            </div>
            <div class="user-info-text">
                <div class="user-name"><?= htmlspecialchars($_SESSION['user']['nama']) ?></div>
                <div class="user-role">Admin</div>
            </div>
        </div>
    </div>

</aside>

<div class="main-wrapper">
    

    <header class="top-navbar">
        <h2 class="top-title"><?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?></h2>
        <div class="text-muted small">
            <?= date('d M Y') ?>
        </div>
    </header>
