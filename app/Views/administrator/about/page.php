<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Halaman Tentang Kami</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">About</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Konten Halaman</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success alert-dismissible"><strong>Berhasil!</strong> Data berhasil disimpan.</div>
        <?php endif;?>
        <?php if(session()->getFlashdata('failed')):?>
            <div class="alert alert-danger alert-dismissible"><strong>Gagal!</strong> Data gagal disimpan.</div>
        <?php endif;?>

        <?php $ap = $aboutPage ?? []; ?>

        <!-- ===== SECTION 1: Intro Title & Description ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#sec1" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 1 — Judul & Deskripsi Intro <span class="d-block text-muted pt-2 font-size-sm">(.about-title, .about-desc)</span></h3>
                </div>
            </div>
            <div id="sec1" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/about/page/update/intro');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <div class="form-group">
                        <label>Title ID</label>
                        <input type="text" name="intro_title_id" class="form-control" value="<?= esc($ap['intro_title_id']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Title EN</label>
                        <input type="text" name="intro_title_en" class="form-control" value="<?= esc($ap['intro_title_en']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Description ID <small class="text-muted">(HTML diizinkan)</small></label>
                        <textarea name="intro_desc_id" class="form-control" rows="5"><?= $ap['intro_desc_id']??'';?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description EN <small class="text-muted">(HTML allowed)</small></label>
                        <textarea name="intro_desc_en" class="form-control" rows="5"><?= $ap['intro_desc_en']??'';?></textarea>
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 1</button></div>
            </form>
            </div>
        </div>

        <!-- ===== SECTION 2: Sub-Circle Header ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#sec2" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 2 — Teks Header Lingkaran Statistik <span class="d-block text-muted pt-2 font-size-sm">(.title-about-circle)</span></h3>
                </div>
            </div>
            <div id="sec2" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/about/page/update/subcircle');?>">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <div class="form-group">
                        <label>Sub Deskripsi ID</label>
                        <input type="text" name="subcircle_desc_id" class="form-control" value="<?= esc($ap['subcircle_desc_id']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Sub Deskripsi EN</label>
                        <input type="text" name="subcircle_desc_en" class="form-control" value="<?= esc($ap['subcircle_desc_en']??'');?>"/>
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 2</button></div>
            </form>
            </div>
        </div>

        <!-- ===== SECTION 3: Bubbles ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#sec3" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 3 — Statistik Gelembung (7 Bubble) <span class="d-block text-muted pt-2 font-size-sm">(.about-bubble)</span></h3>
                </div>
            </div>
            <div id="sec3" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/about/page/update/bubbles');?>">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <p class="text-muted"><small>HTML dasar diizinkan (seperti &lt;br&gt;&lt;span&gt;...&lt;/span&gt;)</small></p>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-light"><strong>Bubble <?= $i; ?></strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Bubble <?= $i; ?> ID</label>
                                <input type="text" name="bubble<?= $i; ?>_id" class="form-control" value="<?= $ap['bubble'.$i.'_id']??'';?>"/>
                                <small class="text-muted">Contoh: 7,354m² &lt;br&gt;&lt;span&gt;Luas Area&lt;/span&gt;</small>
                            </div>
                            <div class="form-group">
                                <label>Bubble <?= $i; ?> EN</label>
                                <input type="text" name="bubble<?= $i; ?>_en" class="form-control" value="<?= $ap['bubble'.$i.'_en']??'';?>"/>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 3</button></div>
            </form>
            </div>
        </div>

        <!-- ===== SECTION 4: Gallery ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#sec4" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 4 — Galeri Foto (3 Gambar) <span class="d-block text-muted pt-2 font-size-sm">(.about-gallery)</span></h3>
                </div>
            </div>
            <div id="sec4" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/about/page/update/gallery');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <?php foreach([1,2,3] as $g): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-light"><strong>Gambar Gallery <?= $g; ?></strong></div>
                        <div class="card-body">
                            <?php if(!empty($ap['gallery_'.$g])): ?>
                            <div class="mb-3">
                                <img src="<?= base_url('assets/upload/about/gallery/'.$ap['gallery_'.$g]);?>" style="max-height:150px;border-radius:8px;" class="img-fluid">
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Upload Gambar <?= $g; ?> <small class="text-muted">(JPG/PNG, kosongkan jika tidak diganti)</small></label>
                                <input type="file" name="gallery_<?= $g; ?>" class="form-control" accept=".jpg,.jpeg,.png"/>
                                <input type="hidden" name="gallery_<?= $g; ?>_temp" value="<?= esc($ap['gallery_'.$g]??'');?>"/>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 4</button></div>
            </form>
            </div>
        </div>

        <!-- ===== SECTION 5: Text Block ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#sec5" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 5 — Blok Teks (Kiri: Gambar & Desc, Kanan: 2 Sub-Blok) <span class="d-block text-muted pt-2 font-size-sm">(.about-text-block)</span></h3>
                </div>
            </div>
            <div id="sec5" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/about/page/update/textblock');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white"><strong>Kolom Kiri (col-lg-5) — Gambar &amp; Deskripsi</strong></div>
                        <div class="card-body">
                            <?php if(!empty($ap['textblock_image'])): ?>
                            <div class="mb-3"><img src="<?= base_url('assets/upload/about/'.$ap['textblock_image']);?>" style="max-height:150px;border-radius:8px;" class="img-fluid"></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Upload Gambar <small class="text-muted">(kosongkan jika tidak diganti)</small></label>
                                <input type="file" name="textblock_image" class="form-control" accept=".jpg,.jpeg,.png"/>
                                <input type="hidden" name="textblock_image_temp" value="<?= esc($ap['textblock_image']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi ID <small class="text-muted">(HTML diizinkan)</small></label>
                                <textarea name="textblock_left_desc_id" class="form-control" rows="4"><?= $ap['textblock_left_desc_id']??'';?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN <small class="text-muted">(HTML allowed)</small></label>
                                <textarea name="textblock_left_desc_en" class="form-control" rows="4"><?= $ap['textblock_left_desc_en']??'';?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white"><strong>Kolom Kanan (col-lg-7) — Sub-Blok 1 (misal: Konservasi)</strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title ID</label>
                                <input type="text" name="textblock_title1_id" class="form-control" value="<?= esc($ap['textblock_title1_id']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Title EN</label>
                                <input type="text" name="textblock_title1_en" class="form-control" value="<?= esc($ap['textblock_title1_en']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi ID</label>
                                <textarea name="textblock_desc1_id" class="form-control" rows="4"><?= esc($ap['textblock_desc1_id']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN</label>
                                <textarea name="textblock_desc1_en" class="form-control" rows="4"><?= esc($ap['textblock_desc1_en']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Teks Tombol ID</label>
                                <input type="text" name="textblock_btn1_id" class="form-control" value="<?= esc($ap['textblock_btn1_id']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Button Text EN</label>
                                <input type="text" name="textblock_btn1_en" class="form-control" value="<?= esc($ap['textblock_btn1_en']??'');?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-warning"><strong>Kolom Kanan (col-lg-7) — Sub-Blok 2 (misal: Komunitas)</strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title ID</label>
                                <input type="text" name="textblock_title2_id" class="form-control" value="<?= esc($ap['textblock_title2_id']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Title EN</label>
                                <input type="text" name="textblock_title2_en" class="form-control" value="<?= esc($ap['textblock_title2_en']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi ID</label>
                                <textarea name="textblock_desc2_id" class="form-control" rows="4"><?= esc($ap['textblock_desc2_id']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN</label>
                                <textarea name="textblock_desc2_en" class="form-control" rows="4"><?= esc($ap['textblock_desc2_en']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Teks Tombol ID</label>
                                <input type="text" name="textblock_btn2_id" class="form-control" value="<?= esc($ap['textblock_btn2_id']??'');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Button Text EN</label>
                                <input type="text" name="textblock_btn2_en" class="form-control" value="<?= esc($ap['textblock_btn2_en']??'');?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 5</button></div>
            </form>
            </div>
        </div>

    </div>
</div>
</div>
<?= $this->endSection() ?>
