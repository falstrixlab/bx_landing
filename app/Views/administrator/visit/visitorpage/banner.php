<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Banner Section</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Visit</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">VI – Banner</a></li>
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

            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Banner Section
                            <span class="d-block text-muted pt-2 font-size-sm">Teks yang tampil di atas hero image halaman Informasi Pengunjung</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorpage/runupdate') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="submit" value="1">
                            <input type="hidden" name="visitorpage_id" value="<?= esc((string) ($banner['visitorpage_id'] ?? '')) ?>">
                            <input type="hidden" name="visitorpage_key" value="banner">
                            <input type="hidden" name="visitorpage_pict1_temp" value="<?= esc($banner['visitorpage_pict1'] ?? '') ?>">
                            <input type="hidden" name="visitorpage_pict2_temp" value="<?= esc($banner['visitorpage_pict2'] ?? '') ?>">
                            <input type="hidden" name="_redirect" value="<?= base_url('adminsite/visit/visitorpage/banner') ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Judul Banner ID <span class="text-danger">*</span></label>
                                            <input name="visitorpage_title" type="text" class="form-control" value="<?= esc($banner['visitorpage_title'] ?? '') ?>" placeholder="Cth: INFORMASI PENGUNJUNG">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Judul Banner EN</label>
                                            <input name="visitorpage_title_en" type="text" class="form-control" value="<?= esc($banner['visitorpage_title_en'] ?? '') ?>" placeholder="e.g.: VISITOR INFORMATION">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deskripsi Banner ID</label>
                                            <input name="visitorpage_desc" type="text" class="form-control" value="<?= esc(strip_tags($banner['visitorpage_desc'] ?? '')) ?>" placeholder="Cth: Maksimalkan kunjungan Anda di BXSea!">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deskripsi Banner EN</label>
                                            <input name="visitorpage_desc_en" type="text" class="form-control" value="<?= esc(strip_tags($banner['visitorpage_desc_en'] ?? '')) ?>" placeholder="e.g.: Make the most of your visit to BXSea.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Simpan Banner" class="btn btn-success mr-2">
                                <a href="<?= base_url('adminsite/visit/visitorpage') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
