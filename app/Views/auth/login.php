<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= esc($setting->nama_sekolah ?? 'CMS') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <style>
        body { min-height: 100vh; display: grid; place-content: center; background: var(--tblr-bg-surface); }
        .login-card { width: 400px; max-width: 90vw; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card card-md">
            <div class="card-body">
                <div class="text-center mb-4">
                    <span class="avatar avatar-lg bg-primary rounded mb-3">S</span>
                    <h2 class="h2"><?= esc($setting->nama_sekolah ?? 'CMS Sekolah') ?></h2>
                    <p class="text-muted">Silakan login untuk melanjutkan</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form action="/login" method="post" autocomplete="off">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Username atau Email</label>
                        <div class="input-group input-group-flat">
                            <span class="input-group-text"><i class="ti ti-user icon"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group input-group-flat">
                            <span class="input-group-text"><i class="ti ti-lock icon"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-check"><input type="checkbox" name="remember" class="form-check-input" value="1"><span class="form-check-label">Ingat saya</span></label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            <a href="/" class="text-muted"><i class="ti ti-arrow-left icon me-1"></i> Kembali ke Beranda</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>
</html>
