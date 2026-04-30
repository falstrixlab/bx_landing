<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tambah Item – Learn Section</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Tambah Konten <em>Edukasi &amp; Konservasi</em></h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Proses data gagal.</div>
                    <?php endif; ?>
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorinfo/learn/runadd') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="visitorinfo_section" value="learn">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title ID <span class="text-danger">*</span></label>
                                            <input name="visitorinfo_title" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title EN</label>
                                            <input name="visitorinfo_title_en" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label ID <small class="text-muted">(misal: EDUKASI)</small></label>
                                            <input name="visitorinfo_label" type="text" class="form-control" placeholder="Cth: EDUKASI">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label EN <small class="text-muted">(e.g.: LEARN)</small></label>
                                            <input name="visitorinfo_label_en" type="text" class="form-control" placeholder="e.g.: LEARN">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description ID <span class="text-danger">*</span></label>
                                    <textarea name="visitorinfo_desc" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <textarea name="visitorinfo_desc_en" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image <small class="text-muted">(gambar kartu edukasi)</small></label>
                                    <input type="file" name="visitorinfo_image" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="visitorinfo_sort" class="form-control" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="visitorinfo_status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Simpan" class="btn btn-success mr-2">
                                <a href="<?= base_url('adminsite/visit/visitorinfo/learn') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
