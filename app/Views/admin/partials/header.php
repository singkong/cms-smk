<div class="page-header d-print-none" style="position:sticky;top:0;z-index:100;background:#f1f5f9;margin:0;padding:16px 0;border-bottom:1px solid #e2e8f0;">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title mb-0"><?= esc($title ?? 'Dashboard') ?></h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-none d-md-block text-end">
                        <div class="fw-semibold small"><?= esc(session()->get('full_name')) ?></div>
                        <div class="text-muted" style="font-size:.75rem;">
                            <?php
                            $roleNames = ['superadmin'=>'Super Admin','admin'=>'Admin','operator'=>'Operator','editor'=>'Editor','guru'=>'Guru'];
                            $roles = session()->get('roles') ?? [];
                            echo esc(implode(', ', array_map(fn($x) => $roleNames[$x] ?? $x, $roles)));
                            ?>
                        </div>
                    </div>
                    <span class="avatar avatar-sm bg-primary rounded-3 fw-bold">
                        <?= strtoupper(substr(session()->get('full_name') ?? 'U', 0, 1)) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
