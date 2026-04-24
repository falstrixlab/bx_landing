<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Tambah Partnership Opportunity</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="<?= base_url('adminsite/partnership/content');?>" class="text-muted">Konten Partnership</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Tambah Opportunity</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header py-3">
                <div class="card-title"><h3 class="card-label">Tambah Card Opportunity</h3></div>
            </div>
            <form method="POST" action="<?= base_url('adminsite/partnership/opportunity/runadd');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <?php if(session()->getFlashdata('failed')):?><div class="alert alert-danger"><strong>Gagal!</strong> Data gagal disimpan.</div><?php endif;?>
                    <div class="form-group">
                        <label>Upload Gambar <small class="text-muted">(JPG/PNG)</small></label>
                        <input type="file" name="opp_image" class="form-control" accept=".jpg,.jpeg,.png"/>
                    </div>
                    <div class="form-group">
                        <label>Title ID <span class="text-danger">*</span></label>
                        <input type="text" name="opp_title_id" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Title EN <span class="text-danger">*</span></label>
                        <input type="text" name="opp_title_en" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi ID</label>
                        <textarea name="opp_desc_id" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description EN</label>
                        <textarea name="opp_desc_en" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="opp_sort" class="form-control" value="0"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    <a href="<?= base_url('adminsite/partnership/content');?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
