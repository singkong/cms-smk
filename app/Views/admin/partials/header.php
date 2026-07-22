<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle"><?= esc($pretitle ?? 'Overview') ?></div>
                <h2 class="page-title"><?= esc($title ?? 'Dashboard') ?></h2>
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
