<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tambah Visitor Page Section</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Tambah Section: <code><?= esc($visitorpage_key) ?></code></h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('failed')):?>
                        <div class="alert alert-danger alert-dismissible mb-4">
                            <strong>Warning!</strong> Gagal menyimpan data.
                        </div>
                    <?php endif;?>
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorpage/runupdate') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="submit" value="1">
                                <input type="hidden" name="visitorpage_id" value="">
                                <input type="hidden" name="visitorpage_key" value="<?= esc($visitorpage_key) ?>">
                                <input type="hidden" name="visitorpage_pict1_temp" value="">
                                <input type="hidden" name="visitorpage_pict2_temp" value="">
                                <input type="hidden" name="_redirect" value="<?= base_url('adminsite/visit/visitorpage/guide') ?>">

                                <div class="form-group">
                                    <label>Key <span class="text-muted">(tidak dapat diubah)</span></label>
                                    <input type="text" class="form-control" value="<?= esc($visitorpage_key) ?>" readonly>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title ID</label>
                                            <input name="visitorpage_title" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title EN</label>
                                            <input name="visitorpage_title_en" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description ID</label>
                                    <textarea name="visitorpage_desc" class="form-control js-quill-editor" data-editor="quill" rows="8"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <textarea name="visitorpage_desc_en" class="form-control js-quill-editor" data-editor="quill" rows="8"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gambar 1 (Upload)</label>
                                            <input type="file" name="visitorpage_pict1" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gambar 2 (Upload)</label>
                                            <input type="file" name="visitorpage_pict2" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Tambah" class="btn btn-success mr-2">
                                <a href="<?= base_url('adminsite/visit/visitorpage/guide') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
