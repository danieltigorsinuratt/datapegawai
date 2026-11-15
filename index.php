<?php

session_start();
require_once 'koneksi/koneksi.php';

if (isset($_SESSION['user'])) {
    header("Location: resources/views/dashboard/index.php");
    exit;
}

$pesan_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {

            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user'] = [
                    'id'            => $user['id'],
                    'username'      => $user['username'],
                    'nama'          => $user['nama_lengkap']
                ];

                header("Location: resources/views/dashboard/index.php");
                exit;
            } else {
                $pesan_error = "Username atau Password tidak sesuai.";
            }
        } catch (PDOException $e) {
            $pesan_error = "Koneksi gagal.";
        }
    } else {
        $pesan_error = "Harap isi Username dan Password.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Data Pegawai</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    
    <link rel="stylesheet" href="resources/css/style.css?v=<?= time() ?>">
</head>
<body>

<div class="login-centered-container min-vh-100 d-flex align-items-center justify-content-center p-3">
    <div class="login-card">
        
        
        <div class="brand-logo-container text-center mb-3">
            <img src="img/logo.png" alt="logo" class="brand-logo mx-auto">
        </div>

        
        <div class="text-center mb-4">
            <h1 class="login-title">Sign In</h1>
            <p class="login-subtitle mb-0">data pegawai</p>
        </div>

        
        <?php if (!empty($pesan_error)): ?>
            <div class="alert alert-danger py-2 px-3 mb-3" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i>
                <?= htmlspecialchars($pesan_error) ?>
            </div>
        <?php endif; ?>

        
        <form action="" method="POST" id="loginForm" novalidate>
            
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" 
                       placeholder="Masukkan username" 
                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" 
                       required autocomplete="username">
                <div class="invalid-feedback">
                    Harap masukkan username.
                </div>
            </div>

            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group has-validation">
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Masukkan password" required autocomplete="current-password">
                    <button class="btn btn-toggle-password" type="button" id="togglePassword" aria-label="Lihat Password">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                    <div class="invalid-feedback">
                        Harap masukkan password.
                    </div>
                </div>
            </div>

            
            <button type="submit" class="btn btn-primary-blue w-100">
                Login
            </button>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="resources/js/app.js"></script>

</body>
</html>
