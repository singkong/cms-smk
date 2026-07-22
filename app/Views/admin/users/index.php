<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Manajemen<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('errors')): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="d-flex">
        <div><i class="ti ti-alert-circle me-2"></i></div>
        <div>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= $error ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <a class="btn-close" data-bs-dismiss="alert"></a>
</div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengguna</h3>
                <div class="card-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="ti ti-plus icon"></i> Tambah Pengguna
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Login Terakhir</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $i => $user): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        <?php if ($user->photo): ?>
                                        <span class="avatar me-2" style="background-image: url(<?= base_url('uploads/avatars/' . $user->photo) ?>)"></span>
                                        <?php else: ?>
                                        <span class="avatar me-2" style="background-image: url(https://ui-avatars.com/api/?name=<?= urlencode($user->full_name) ?>&background=2563eb&color=fff&size=40)"></span>
                                        <?php endif; ?>
                                        <div class="flex-fill">
                                            <div class="font-weight-medium"><?= esc($user->full_name) ?></div>
                                            <div class="text-muted">
                                                <a href="#" class="text-reset">@<?= esc($user->username) ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted"><?= esc($user->email) ?></span>
                                </td>
                                <td>
                                    <?php foreach ($user->role_list as $role): ?>
                                        <?php
                                        $badgeColor = 'bg-blue';
                                        if ($role->slug === 'superadmin') $badgeColor = 'bg-purple';
                                        elseif ($role->slug === 'admin') $badgeColor = 'bg-blue';
                                        elseif ($role->slug === 'operator') $badgeColor = 'bg-cyan';
                                        elseif ($role->slug === 'editor') $badgeColor = 'bg-green';
                                        elseif ($role->slug === 'guru') $badgeColor = 'bg-teal';
                                        elseif ($role->slug === 'guest') $badgeColor = 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $badgeColor ?> me-1"><?= esc($role->name) ?></span>
                                    <?php endforeach; ?>
                                    <?php if (empty($user->role_list)): ?>
                                        <span class="badge bg-secondary">No Role</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted">
                                    <?= $user->last_login ? date('d M Y H:i', strtotime($user->last_login)) : 'Belum pernah' ?>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#editUser<?= $user->id ?>" title="Edit">
                                            <i class="ti ti-pencil icon"></i>
                                        </button>
                                        <?php if ($user->id != session()->get('id')): ?>
                                        <a href="/admin/users/delete/<?= $user->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus pengguna <?= esc($user->full_name) ?>?')" title="Hapus">
                                            <i class="ti ti-trash icon"></i>
                                        </a>
                                        <?php else: ?>
                                        <span class="btn btn-sm btn-icon disabled" title="Tidak dapat menghapus diri sendiri">
                                            <i class="ti ti-trash icon"></i>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">Belum ada pengguna</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/users/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-user-plus icon me-2"></i>Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Nama lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Default: password123">
                                <small class="form-hint">Kosongkan untuk menggunakan password default.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Foto Profil</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="mt-2">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        <span class="form-check-label">Akun Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Roles</label>
                            <div class="row g-2">
                                <?php foreach ($roles as $role): ?>
                                <div class="col-auto">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="<?= $role->id ?>">
                                        <span class="form-check-label"><?= esc($role->name) ?></span>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check icon"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modals -->
<?php if (!empty($users)): ?>
<?php foreach ($users as $user): ?>
<div class="modal fade" id="editUser<?= $user->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/users/update/<?= $user->id ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-pencil icon me-2"></i>Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control" value="<?= esc($user->full_name) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= esc($user->username) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($user->email) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan = tidak diubah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ganti Foto (opsional)</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="mt-2">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= $user->is_active ? 'checked' : '' ?>>
                                        <span class="form-check-label">Akun Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Roles</label>
                            <div class="row g-2">
                                <?php
                                $userRoleIds = array_column($user->role_list, 'id');
                                ?>
                                <?php foreach ($roles as $role): ?>
                                <div class="col-auto">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="<?= $role->id ?>" <?= in_array($role->id, $userRoleIds) ? 'checked' : '' ?>>
                                        <span class="form-check-label"><?= esc($role->name) ?></span>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check icon"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
