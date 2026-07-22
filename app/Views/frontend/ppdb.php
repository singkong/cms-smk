<?= $this->extend('layouts/main') ?>
<?= $this->section('head') ?>
<style>
    .ppdb-hero {
        background: linear-gradient(135deg, #1e40af, #3b82f6, #8b5cf6);
        padding: 80px 0;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .ppdb-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 70% 30%, rgba(255,255,255,.1), transparent 60%);
    }
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="ppdb-hero text-center">
    <div class="container" style="position:relative;z-index:1;">
        <h1 class="display-4 fw-bold mb-3">PPDB <?= esc($setting->nama_sekolah ?? 'SMK') ?></h1>
        <p class="lead mb-2">Penerimaan Peserta Didik Baru</p>
        <p class="mb-4">Tahun Ajaran <?= esc($ppdb->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1)) ?></p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#alur" class="btn btn-light btn-lg px-4">Alur Pendaftaran</a>
            <?php if (!empty($ppdb->formulir_link ?? null)): ?>
                <a href="<?= esc($ppdb->formulir_link) ?>" class="btn btn-outline-light btn-lg px-4" target="_blank">
                    <i class="ti ti-download icon me-1"></i> Download Formulir
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="avatar avatar-lg bg-blue-lt rounded-circle mb-2">
                            <i class="ti ti-users icon text-blue" style="font-size:1.5rem;"></i>
                        </span>
                        <h5 class="mb-0">Pendaftar</h5>
                        <p class="text-muted mb-0"><?= esc($total_pendaftar ?? 0) ?> Orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="avatar avatar-lg bg-green-lt rounded-circle mb-2">
                            <i class="ti ti-calendar icon text-green" style="font-size:1.5rem;"></i>
                        </span>
                        <h5 class="mb-0">Dibuka</h5>
                        <p class="text-muted mb-0"><?= esc($ppdb->tanggal_buka ?? '-') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="avatar avatar-lg bg-red-lt rounded-circle mb-2">
                            <i class="ti ti-calendar-off icon text-red" style="font-size:1.5rem;"></i>
                        </span>
                        <h5 class="mb-0">Ditutup</h5>
                        <p class="text-muted mb-0"><?= esc($ppdb->tanggal_tutup ?? '-') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="avatar avatar-lg bg-yellow-lt rounded-circle mb-2">
                            <i class="ti ti-school icon text-yellow" style="font-size:1.5rem;"></i>
                        </span>
                        <h5 class="mb-0">Status</h5>
                        <p class="text-muted mb-0">
                            <?php if ($ppdb->is_open ?? false): ?>
                                <span class="badge bg-success">Dibuka</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Ditutup</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Persyaratan Pendaftaran</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($ppdb->persyaratan)): ?>
                            <div style="line-height:1.9;font-size:1.05rem;white-space:pre-line;">
                                <?= esc($ppdb->persyaratan) ?>
                            </div>
                        <?php else: ?>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="ti ti-check icon text-success me-2"></i> Fotokopi Ijazah SMP/sederajat (2 lembar)</li>
                                <li class="mb-2"><i class="ti ti-check icon text-success me-2"></i> Fotokopi SKHU/SKHUN (2 lembar)</li>
                                <li class="mb-2"><i class="ti ti-check icon text-success me-2"></i> Fotokopi Akta Kelahiran (2 lembar)</li>
                                <li class="mb-2"><i class="ti ti-check icon text-success me-2"></i> Fotokopi Kartu Keluarga (2 lembar)</li>
                                <li class="mb-2"><i class="ti ti-check icon text-success me-2"></i> Pas Foto 3x4 (4 lembar)</li>
                                <li><i class="ti ti-check icon text-success me-2"></i> Surat Keterangan Sehat dari Dokter</li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($ppdb->jadwal)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Jadwal Pendaftaran</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div style="line-height:1.9;font-size:1.05rem;white-space:pre-line;">
                            <?= esc($ppdb->jadwal) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="py-5" id="alur">
    <div class="container">
        <h3 class="fw-bold mb-5 text-center">Alur Pendaftaran</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-number mx-auto mb-3">1</div>
                        <h5>Pendaftaran</h5>
                        <p class="text-muted mb-0">Calon peserta didik melakukan pendaftaran sesuai jadwal yang telah ditentukan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-number mx-auto mb-3">2</div>
                        <h5>Verifikasi</h5>
                        <p class="text-muted mb-0">Panitia melakukan verifikasi berkas dan data calon peserta didik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-number mx-auto mb-3">3</div>
                        <h5>Pengumuman</h5>
                        <p class="text-muted mb-0">Pengumuman hasil seleksi dan daftar ulang bagi yang diterima</p>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($ppdb->alur)): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div style="line-height:1.9;font-size:1.05rem;white-space:pre-line;">
                            <?= esc($ppdb->alur) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($ppdb->biaya)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Biaya Pendidikan</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div style="line-height:1.9;font-size:1.05rem;white-space:pre-line;">
                            <?= esc($ppdb->biaya) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FORM PENDAFTARAN ONLINE -->
<section class="py-5" id="daftar">
    <div class="container">
        <h3 class="fw-bold mb-2 text-center">Formulir Pendaftaran Online</h3>
        <p class="text-muted text-center mb-4">Isi data diri Anda dengan lengkap dan benar</p>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible mb-4"><div class="d-flex"><i class="ti ti-check icon me-2"></i><div><?= session()->getFlashdata('success') ?></div></div><a class="btn-close" data-bs-dismiss="alert"></a></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible mb-4"><div class="d-flex"><i class="ti ti-alert-circle icon me-2"></i><div><?= session()->getFlashdata('error') ?></div></div><a class="btn-close" data-bs-dismiss="alert"></a></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible mb-4">
            <?php foreach (session()->getFlashdata('errors') as $e): ?><div><?= $e ?></div><?php endforeach; ?>
            <a class="btn-close" data-bs-dismiss="alert"></a>
        </div>
        <?php endif; ?>

        <?php if ($ppdb->is_open ?? false): ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <form action="/ppdb/register" method="post">
                            <?= csrf_field() ?>
                            <div class="row g-3">
                                <div class="col-12"><label class="form-label required">Nama Lengkap</label><input type="text" name="nama" class="form-control rounded-3" value="<?= old('nama') ?>" required></div>
                                <div class="col-md-6"><label class="form-label">NIK</label><input type="text" name="nik" class="form-control rounded-3" value="<?= old('nik') ?>" maxlength="20"></div>
                                <div class="col-md-6"><label class="form-label">Jenis Kelamin</label><select name="jk" class="form-select rounded-3"><option value="L" <?= old('jk') == 'L' ? 'selected' : '' ?>>Laki-laki</option><option value="P" <?= old('jk') == 'P' ? 'selected' : '' ?>>Perempuan</option></select></div>
                                <div class="col-md-6"><label class="form-label">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control rounded-3" value="<?= old('tempat_lahir') ?>"></div>
                                <div class="col-md-6"><label class="form-label">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control rounded-3" value="<?= old('tanggal_lahir') ?>"></div>
                                <div class="col-12"><label class="form-label required">Alamat Lengkap</label><textarea name="alamat" class="form-control rounded-3" rows="2" required><?= old('alamat') ?></textarea></div>
                                <div class="col-md-6"><label class="form-label required">No. Telepon / WA</label><input type="text" name="telepon" class="form-control rounded-3" value="<?= old('telepon') ?>" required></div>
                                <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control rounded-3" value="<?= old('email') ?>"></div>
                                <div class="col-md-6"><label class="form-label required">Asal Sekolah</label><input type="text" name="asal_sekolah" class="form-control rounded-3" value="<?= old('asal_sekolah') ?>" required></div>
                                <div class="col-md-6"><label class="form-label required">Pilih Jurusan</label>
                                    <select name="jurusan_id" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <?php foreach ($jurusans as $j): ?>
                                        <option value="<?= $j->id ?>" <?= old('jurusan_id') == $j->id ? 'selected' : '' ?>><?= esc($j->nama) ?> (<?= esc($j->singkatan) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" required id="agree"><label class="form-check-label" for="agree">Saya menyatakan data yang diisi benar dan valid</label></div></div>
                                <div class="col-12"><button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 w-100"><i class="ti ti-send icon me-2"></i> Daftar Sekarang</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="row justify-content-center"><div class="col-lg-6 text-center"><div class="card"><div class="card-body py-5">
            <i class="ti ti-clock icon text-muted" style="font-size:4rem;opacity:0.3;"></i>
            <h4 class="mt-3">Pendaftaran Belum Dibuka</h4>
            <p class="text-muted">Silakan cek kembali jadwal PPDB atau hubungi panitia.</p>
        </div></div></div></div>
        <?php endif; ?>
    </div>
</section>

<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h3 class="fw-bold mb-3">Informasi Lebih Lanjut</h3>
        <p class="mb-4">Hubungi kami untuk informasi lebih lanjut mengenai PPDB</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <?php if (!empty($setting->telepon)): ?>
                <a href="tel:<?= esc($setting->telepon) ?>" class="btn btn-light">
                    <i class="ti ti-phone icon me-1"></i> <?= esc($setting->telepon) ?>
                </a>
            <?php endif; ?>
            <?php if (!empty($setting->email)): ?>
                <a href="mailto:<?= esc($setting->email) ?>" class="btn btn-outline-light">
                    <i class="ti ti-mail icon me-1"></i> <?= esc($setting->email) ?>
                </a>
            <?php endif; ?>
            <?php if (!empty($setting->whatsapp)): ?>
                <a href="https://wa.me/<?= esc(str_replace(['+','-',' '], '', $setting->whatsapp)) ?>" class="btn btn-outline-light" target="_blank">
                    <i class="ti ti-brand-whatsapp icon me-1"></i> WhatsApp
                </a>
            <?php endif; ?>
            <a href="/kontak" class="btn btn-outline-light">
                <i class="ti ti-send icon me-1"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
