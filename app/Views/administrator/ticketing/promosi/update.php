<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
        <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Update Promosi Tiket </h5>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted"> Base </a></li>
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted"> Update Promosi Tiket </a></li>
        </ul>
        </div>
    </div>
    </div>
</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
    <div class=" container ">
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label"> Update Promosi Tiket <span class="d-block text-muted pt-2 font-size-sm">Edit data promosi beserta syarat &amp; ketentuan</span></h3>
        </div>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')):?>
                <div class="alert alert-success alert-dismissible"><strong>Berhasil!</strong> Data berhasil diperbarui.</div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible"><strong>Gagal!</strong> Proses update data gagal.</div>
            <?php endif;?>
            <div class="card card-custom">
                <form method="POST" action="<?= base_url('adminsite/ticketing/promosi/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Judul ID <span class="text-danger">*</span></label>
                            <input type="text" name="promosi_title" class="form-control" value="<?= esc($rs["promosi_title"]);?>"/>
                            <input type="hidden" name="promosi_id" value="<?= $rs["promosi_id"];?>">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi ID <span class="text-danger">*</span></label>
                            <textarea name="promosi_desc" class="form-control" id="kt-ckeditor-1" rows="6"><?= $rs["promosi_desc"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Judul EN</label>
                            <input type="text" name="promosi_title_en" class="form-control" value="<?= esc($rs["promosi_title_en"] ?? '');?>"/>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi EN</label>
                            <textarea name="promosi_desc_en" class="form-control" id="kt-ckeditor-2" rows="6"><?= $rs["promosi_desc_en"] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Syarat &amp; Ketentuan ID</label>
                            <textarea name="promosi_tnc" class="form-control" id="kt-ckeditor-3" rows="6"><?= $rs["promosi_tnc"] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Syarat &amp; Ketentuan EN</label>
                            <textarea name="promosi_tnc_en" class="form-control" id="kt-ckeditor-4" rows="6"><?= $rs["promosi_tnc_en"] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/promosi/'.$rs["promosi_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Ganti gambar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="promosi_pict" accept=".png,.jpg,.jpeg">
                                    <input type="hidden" value="<?= $rs["promosi_pict"];?>" name="promosi_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Batal">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link Promosi (URL)</label>
                            <input name="promosi_link" type="url" class="form-control" placeholder="https://" value="<?= esc($rs['promosi_link'] ?? '');?>"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/promosi');?>" class="btn btn-secondary">Batal</a>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
<!--end::Content-->
<?= $this->endSection() ?>
