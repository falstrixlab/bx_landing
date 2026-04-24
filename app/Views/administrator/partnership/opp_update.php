<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Partnership Opportunity</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="<?= base_url('adminsite/partnership/content');?>" class="text-muted">Konten Partnership</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Edit Opportunity</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header py-3">
                <div class="card-title"><h3 class="card-label">Edit Card Opportunity</h3></div>
            </div>
            <?php $opp = $getdata[0] ?? []; ?>
            <form method="POST" action="<?= base_url('adminsite/partnership/opportunity/runupdate');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <input type="hidden" name="opp_id" value="<?= esc($opp['opp_id']??'');?>"/>
                <div class="card-body" style="background:#F3F6F9;">
                    <?php if(session()->getFlashdata('failed')):?><div class="alert alert-danger"><strong>Gagal!</strong> Data gagal disimpan.</div><?php endif;?>
                    <div class="form-group">
                        <label>Gambar Saat Ini</label>
                        <?php if(!empty($opp['opp_image'])): ?>
                        <div class="mb-2"><img src="<?= base_url('assets/upload/partnership/'.$opp['opp_image']);?>" style="max-height:150px;border-radius:8px;" class="img-fluid"></div>
                        <?php else: ?><p class="text-muted small">Belum ada gambar.</p><?php endif; ?>
                        <label>Upload Gambar Baru <small class="text-muted">(kosongkan jika tidak diganti)</small></label>
                        <input type="file" name="opp_image" class="form-control" accept=".jpg,.jpeg,.png"/>
                        <input type="hidden" name="opp_image_temp" value="<?= esc($opp['opp_image']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Title ID <span class="text-danger">*</span></label>
                        <input type="text" name="opp_title_id" class="form-control" value="<?= esc($opp['opp_title_id']??'');?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Title EN <span class="text-danger">*</span></label>
                        <input type="text" name="opp_title_en" class="form-control" value="<?= esc($opp['opp_title_en']??'');?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi ID</label>
                        <textarea name="opp_desc_id" class="form-control" rows="4"><?= esc($opp['opp_desc_id']??'');?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description EN</label>
                        <textarea name="opp_desc_en" class="form-control" rows="4"><?= esc($opp['opp_desc_en']??'');?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="opp_sort" class="form-control" value="<?= esc($opp['opp_sort']??0);?>"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success mr-2">Simpan Perubahan</button>
                    <a href="<?= base_url('adminsite/partnership/content');?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
