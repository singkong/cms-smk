<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('errors')): ?>
<div class="alert alert-danger"><?php foreach (session()->getFlashdata('errors') as $e): ?><div><?= $e ?></div><?php endforeach; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3 class="card-title"><?= isset($post) ? 'Edit' : 'Tambah' ?> Postingan</h3></div>
    <div class="card-body">
        <form action="<?= isset($post) ? '/admin/posts/update/' . $post->id : '/admin/posts/store' ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label required">Judul</label>
                    <input type="text" name="title" class="form-control" value="<?= old('title', $post->title ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label required">Tipe</label>
                    <select name="type" class="form-select" required>
                        <option value="berita" <?= old('type', $post->type ?? '') === 'berita' ? 'selected' : '' ?>>Berita</option>
                        <option value="pengumuman" <?= old('type', $post->type ?? '') === 'pengumuman' ? 'selected' : '' ?>>Pengumuman</option>
                        <option value="agenda" <?= old('type', $post->type ?? '') === 'agenda' ? 'selected' : '' ?>>Agenda</option>
                        <option value="prestasi" <?= old('type', $post->type ?? '') === 'prestasi' ? 'selected' : '' ?>>Prestasi</option>
                        <option value="halaman" <?= old('type', $post->type ?? '') === 'halaman' ? 'selected' : '' ?>>Halaman</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Tanpa Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->id ?>" <?= old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' ?>><?= esc($cat->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="published" <?= old('status', $post->status ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= old('status', $post->status ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-3 pb-2">
                    <label class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_featured" value="1" <?= old('is_featured', $post->is_featured ?? 0) ? 'checked' : '' ?>><span class="form-check-label">Featured</span></label>
                    <label class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_headline" value="1" <?= old('is_headline', $post->is_headline ?? 0) ? 'checked' : '' ?>><span class="form-check-label">Headline</span></label>
                </div>
                <div class="col-12">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="excerpt" class="form-control" rows="2"><?= old('excerpt', $post->excerpt ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <?php if (isset($post) && $post->image): ?>
                    <div class="mt-2"><img src="<?= base_url('uploads/posts/' . $post->image) ?>" style="max-height:120px;" class="rounded" alt=""></div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label class="form-label required">Konten</label>
                    <textarea name="content" class="form-control ckeditor" rows="18"><?= old('content', $post->content ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <div class="hr-text">SEO</div>
                </div>
                <div class="col-md-4"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="<?= old('meta_title', $post->meta_title ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Meta Keywords</label><input type="text" name="meta_keywords" class="form-control" value="<?= old('meta_keywords', $post->meta_keywords ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2"><?= old('meta_description', $post->meta_description ?? '') ?></textarea></div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/admin/posts" class="btn btn-ghost-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
