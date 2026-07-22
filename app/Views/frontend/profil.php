<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;">
    <div class="hero-content container"><h1 class="hero-title" style="font-size:2.2rem;">Profil Sekolah</h1></div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#f8fafc" d="M0,48L48,53C96,59,192,69,288,64C384,59,480,37,576,37C672,37,768,59,864,64C960,69,1056,59,1152,53C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path></svg></div>
</section>

<section data-aos="fade-up">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Tentang <?= esc($setting->nama_sekolah) ?></h3>
                <p class="lead text-muted"><?= nl2br(esc($setting->deskripsi ?? '')) ?></p>
                <div class="row g-3 mt-3">
                    <?php foreach ([['ti ti-id','NPSN',$setting->npsn??'-'],['ti ti-certificate','NSS',$setting->nss??'-'],['ti ti-star-filled text-warning','Akreditasi',$setting->akreditasi??'-'],['ti ti-building-community','Status',$setting->status??'-'],['ti ti-map-pin text-danger','Alamat',$setting->alamat??'-'],['ti ti-phone text-success','Telepon',$setting->telepon??'-'],['ti ti-mail text-info','Email',$setting->email??'-'],['ti ti-world','Website',$setting->website??'-']] as $info): ?>
                    <div class="col-md-6"><div class="d-flex gap-3 align-items-start"><div class="fs-4 mt-1"><i class="<?= $info[0] ?> icon"></i></div><div><strong><?= $info[1] ?></strong><br><span class="text-muted"><?= esc($info[2]) ?></span></div></div></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4"><div class="card-elevate p-4 text-center"><img src="<?= base_url('uploads/'.($setting->foto_kepsek??'default-kepsek.jpg')) ?>" class="kepsek-photo mb-3 mx-auto" style="display:block;" alt="Kepsek"><h5 class="fw-bold"><?= esc($setting->kepsek??'') ?></h5><p class="text-muted small mb-0">Kepala Sekolah<br>NIP. <?= esc($setting->nip_kepsek??'-') ?></p><hr><p class="small text-muted fst-italic mb-0">&ldquo;<?= $setting->sambutan ?? '' ?>&rdquo;</p></div></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
