<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:30vh;"><div class="hero-content container"><h1 class="hero-title" style="font-size:2rem;">Kontak Kami</h1></div><div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#f8fafc" d="M0,48L48,53C96,59,192,69,288,64C384,59,480,37,576,37C672,37,768,59,864,64C960,69,1056,59,1152,53C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path></svg></div></section>

<section data-aos="fade-up"><div class="container">
    <?php if(session()->getFlashdata('success')): ?><div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
    <div class="row g-5">
        <div class="col-lg-5">
            <h4 class="fw-bold mb-4">Hubungi Kami</h4>
            <?php foreach([['ti ti-map-pin fs-3 text-danger','Alamat',$setting->alamat??''],['ti ti-phone fs-3 text-success','Telepon',$setting->telepon??''],['ti ti-mail fs-3 text-info','Email',$setting->email??''],['ti ti-world fs-3 text-primary','Website',$setting->website??''],['ti ti-clock fs-3 text-warning','Jam Operasional',$setting->jam_operasional??'']] as $c): ?>
            <div class="d-flex gap-3 mb-4"><div><i class="<?= $c[0] ?> icon"></i></div><div><strong><?= $c[1] ?></strong><br><span class="text-muted"><?= nl2br(esc($c[2])) ?></span></div></div>
            <?php endforeach; ?>
            <?php if($setting->maps??false): ?><div class="rounded overflow-hidden mt-3"><?= $setting->maps ?></div><?php endif; ?>
        </div>
        <div class="col-lg-7">
            <div class="card-elevate p-4 p-md-5"><h4 class="fw-bold mb-4">Kirim Pesan</h4>
                <form action="/kontak/send" method="post"><?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label fw-semibold">Nama</label><input type="text" name="name" class="form-control rounded-3" required></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Email</label><input type="email" name="email" class="form-control rounded-3" required></div>
                        <div class="col-12"><label class="form-label fw-semibold">Subjek</label><input type="text" name="subject" class="form-control rounded-3" required></div>
                        <div class="col-12"><label class="form-label fw-semibold">Pesan</label><textarea name="message" class="form-control rounded-3" rows="5" required></textarea></div>
                        <div class="col-12"><button type="submit" class="btn btn-primary rounded-pill px-5"><i class="ti ti-send icon me-2"></i> Kirim Pesan</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div></section>
<?= $this->endSection() ?>
