<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Welcome Section</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Visit</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Welcome &amp; Jam Operasional</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible mb-4"><strong>Success!</strong> Data berhasil disimpan.</div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('failed')): ?>
                <div class="alert alert-danger alert-dismissible mb-4"><strong>Failed!</strong> Gagal menyimpan data.</div>
            <?php endif; ?>

            <!-- Welcome Section Form -->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Welcome Section <span class="d-block text-muted pt-2 font-size-sm">Konten .vi-welcome-section (judul, deskripsi, 2 gambar)</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorpage/runupdate') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="submit" value="1">
                            <input type="hidden" name="visitorpage_id" value="<?= esc((string) ($welcome['visitorpage_id'] ?? '')) ?>">
                            <input type="hidden" name="visitorpage_key" value="welcome">
                            <input type="hidden" name="visitorpage_pict1_temp" value="<?= esc($welcome['visitorpage_pict1'] ?? '') ?>">
                            <input type="hidden" name="visitorpage_pict2_temp" value="<?= esc($welcome['visitorpage_pict2'] ?? '') ?>">
                            <input type="hidden" name="_redirect" value="<?= base_url('adminsite/visit/visitorpage/welcome') ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title ID</label>
                                            <input name="visitorpage_title" type="text" class="form-control" value="<?= esc($welcome['visitorpage_title'] ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title EN</label>
                                            <input name="visitorpage_title_en" type="text" class="form-control" value="<?= esc($welcome['visitorpage_title_en'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description ID</label>
                                    <textarea name="visitorpage_desc" class="form-control js-quill-editor" data-editor="quill" rows="6"><?= $welcome['visitorpage_desc'] ?? '' ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <textarea name="visitorpage_desc_en" class="form-control js-quill-editor" data-editor="quill" rows="6"><?= $welcome['visitorpage_desc_en'] ?? '' ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gambar 1 (Upload)</label>
                                            <input type="file" name="visitorpage_pict1" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                                            <?php if (!empty($welcome['visitorpage_pict1'])): ?>
                                                <div class="mt-2">
                                                    <img src="<?= base_url('assets/upload/visitorpage/' . esc($welcome['visitorpage_pict1'])) ?>" style="max-height:100px; border-radius:6px;">
                                                    <p class="text-muted mt-1 font-size-sm"><?= esc($welcome['visitorpage_pict1']) ?></p>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-muted mt-1 font-size-sm">Belum ada gambar</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gambar 2 (Upload)</label>
                                            <input type="file" name="visitorpage_pict2" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                                            <?php if (!empty($welcome['visitorpage_pict2'])): ?>
                                                <div class="mt-2">
                                                    <img src="<?= base_url('assets/upload/visitorpage/' . esc($welcome['visitorpage_pict2'])) ?>" style="max-height:100px; border-radius:6px;">
                                                    <p class="text-muted mt-1 font-size-sm"><?= esc($welcome['visitorpage_pict2']) ?></p>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-muted mt-1 font-size-sm">Belum ada gambar</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Simpan Welcome" class="btn btn-success mr-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Jam Operasional Form -->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Jam Operasional <span class="d-block text-muted pt-2 font-size-sm">Konten jam operasional di .vi-welcome-section (tampil sebagai HTML)</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorpage/runupdate') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="submit" value="1">
                            <input type="hidden" name="visitorpage_id" value="<?= esc((string) ($hours['visitorpage_id'] ?? '')) ?>">
                            <input type="hidden" name="visitorpage_key" value="hours">
                            <input type="hidden" name="visitorpage_pict1_temp" value="<?= esc($hours['visitorpage_pict1'] ?? '') ?>">
                            <input type="hidden" name="visitorpage_pict2_temp" value="<?= esc($hours['visitorpage_pict2'] ?? '') ?>">
                            <input type="hidden" name="_redirect" value="<?= base_url('adminsite/visit/visitorpage/welcome') ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Judul ID <small class="text-muted">(misal: Jam Operasional)</small></label>
                                            <input name="visitorpage_title" type="text" class="form-control" value="<?= esc($hours['visitorpage_title'] ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Judul EN <small class="text-muted">(e.g.: Opening Hours)</small></label>
                                            <input name="visitorpage_title_en" type="text" class="form-control" value="<?= esc($hours['visitorpage_title_en'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Konten Jam Operasional ID <small class="text-muted">(gunakan editor untuk format tabel/list jam)</small></label>
                                    <textarea name="visitorpage_desc" class="form-control js-quill-editor" data-editor="quill" rows="8"><?= $hours['visitorpage_desc'] ?? '' ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Konten Jam Operasional EN</label>
                                    <textarea name="visitorpage_desc_en" class="form-control js-quill-editor" data-editor="quill" rows="8"><?= $hours['visitorpage_desc_en'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Simpan Jam Operasional" class="btn btn-success mr-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
