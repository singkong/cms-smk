<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header"><h3 class="card-title">Pengaturan Website</h3></div>
    <div class="card-body">
        <form action="/admin/settings/update" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <ul class="nav nav-tabs mb-3" id="settingTabs">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#general">Umum</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#seo">SEO</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#sosmed">Sosial Media</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#smtp">SMTP Email</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="general">
                    <div class="row g-3">
                        <?php
                        $fields = ['nama_sekolah' => 'Nama Sekolah','nama_singkat' => 'Nama Singkat','npsn' => 'NPSN','nss' => 'NSS','status' => 'Status','akreditasi' => 'Akreditasi','alamat' => 'Alamat','kode_pos' => 'Kode Pos','telepon' => 'Telepon','fax' => 'Fax','email' => 'Email','website' => 'Website','kepsek' => 'Kepala Sekolah','nip_kepsek' => 'NIP Kepsek','jam_operasional' => 'Jam Operasional'];
                        foreach ($fields as $key => $label): ?>
                        <div class="col-md-6"><label class="form-label"><?= $label ?></label><input type="text" name="<?= $key ?>" class="form-control" value="<?= esc($setting->$key ?? '') ?>"></div>
                        <?php endforeach; ?>
                        <div class="col-md-12"><label class="form-label">Sambutan Kepala Sekolah</label><textarea name="sambutan" class="form-control ckeditor" rows="4"><?= esc($setting->sambutan ?? '') ?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Visi</label><textarea name="visi" class="form-control ckeditor" rows="3"><?= esc($setting->visi ?? '') ?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Misi</label><textarea name="misi" class="form-control ckeditor" rows="3"><?= esc($setting->misi ?? '') ?></textarea></div>
                        <div class="col-md-12"><label class="form-label">Sejarah</label><textarea name="sejarah" class="form-control ckeditor" rows="4"><?= esc($setting->sejarah ?? '') ?></textarea></div>
                        <div class="col-12"><label class="form-label">Deskripsi Singkat</label><textarea name="deskripsi" class="form-control" rows="2"><?= esc($setting->deskripsi ?? '') ?></textarea></div>
                        <div class="col-md-4"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control" accept="image/*"></div>
                        <div class="col-md-4"><label class="form-label">Favicon</label><input type="file" name="favicon" class="form-control" accept="image/*"></div>
                        <div class="col-md-4"><label class="form-label">Foto Kepsek</label><input type="file" name="foto_kepsek" class="form-control" accept="image/*"></div>
                        <div class="col-12"><label class="form-label">Google Maps Embed</label><textarea name="maps" class="form-control" rows="3"><?= esc($setting->maps ?? '') ?></textarea></div>
                        <div class="col-12"><label class="form-label">Footer Text</label><input type="text" name="footer_text" class="form-control" value="<?= esc($setting->footer_text ?? '') ?>"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="seo">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2"><?= esc($setting->meta_description ?? '') ?></textarea></div>
                        <div class="col-12"><label class="form-label">Meta Keywords</label><input type="text" name="meta_keywords" class="form-control" value="<?= esc($setting->meta_keywords ?? '') ?>"></div>
                        <div class="col-md-6"><label class="form-label">Google Analytics ID</label><input type="text" name="google_analytics" class="form-control" value="<?= esc($setting->google_analytics ?? '') ?>" placeholder="G-XXXXXXXXXX"></div>
                        <div class="col-md-6"><label class="form-label">Google Search Console</label><input type="text" name="google_search_console" class="form-control" value="<?= esc($setting->google_search_console ?? '') ?>"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sosmed">
                    <div class="row g-3">
                        <?php foreach (['facebook' => 'Facebook','instagram' => 'Instagram','youtube' => 'YouTube','tiktok' => 'TikTok','whatsapp' => 'WhatsApp (628xxx)'] as $k => $l): ?>
                        <div class="col-md-6"><label class="form-label"><?= $l ?></label><input type="text" name="<?= $k ?>" class="form-control" value="<?= esc($setting->$k ?? '') ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="smtp">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">SMTP Host</label><input type="text" name="smtp_host" class="form-control" value="<?= esc($setting->smtp_host ?? '') ?>"></div>
                        <div class="col-md-3"><label class="form-label">Port</label><input type="text" name="smtp_port" class="form-control" value="<?= esc($setting->smtp_port ?? '587') ?>"></div>
                        <div class="col-md-3"><label class="form-label">Encryption</label><select name="smtp_encryption" class="form-select"><option value="tls">TLS</option><option value="ssl">SSL</option></select></div>
                        <div class="col-md-6"><label class="form-label">Username</label><input type="text" name="smtp_username" class="form-control" value="<?= esc($setting->smtp_username ?? '') ?>"></div>
                        <div class="col-md-6"><label class="form-label">Password</label><input type="password" name="smtp_password" class="form-control" value="<?= esc($setting->smtp_password ?? '') ?>"></div>
                    </div>
                </div>
            </div>
            <div class="mt-3"><button type="submit" class="btn btn-primary">Simpan Semua Pengaturan</button></div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
