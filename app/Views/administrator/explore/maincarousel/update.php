<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Main Carousel</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Explore</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Edit Main Carousel</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Edit Data Carousel <span class="d-block text-muted pt-2 font-size-sm">Explore Main Journey Carousel</span></h3>
                </div>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success alert-dismissible"><strong>Success!</strong> Data berhasil diperbarui.</div>
                <?php endif;?>
                <?php if(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Data gagal diperbarui.</div>
                <?php endif;?>
                <?php if(session()->getFlashdata('invalidate')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Error!</strong> File tidak valid.</div>
                <?php endif;?>
                <div class="card card-custom">
                    <form method="POST" action="<?= base_url('adminsite/explore/maincarousel/runupdate');?>" enctype="multipart/form-data">
                        <?php foreach($getdata AS $rs):?>
                        <div class="card-body" style="background-color:#F3F6F9;">
                            <input type="hidden" name="carousel_id" value="<?= $rs['carousel_id'];?>">
                            <div class="form-group">
                                <label>Title ID <span class="text-danger">*</span></label>
                                <input name="carousel_title_id" type="text" class="form-control" value="<?= esc($rs['carousel_title_id']??'');?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Title EN <span class="text-danger">*</span></label>
                                <input name="carousel_title_en" type="text" class="form-control" value="<?= esc($rs['carousel_title_en']??'');?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Description ID</label>
                                <textarea name="carousel_desc_id" class="form-control" rows="4"><?= esc($rs['carousel_desc_id']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN</label>
                                <textarea name="carousel_desc_en" class="form-control" rows="4"><?= esc($rs['carousel_desc_en']??'');?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label><br>
                                <div class="image-input image-input-outline" id="kt_main_carousel_img">
                                    <div class="image-input-wrapper" style="background-image:url(<?= base_url('assets/upload/maincarousel/'.esc($rs['carousel_image']??''))?>)"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="Ganti Gambar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="carousel_image" accept=".png,.jpg,.jpeg">
                                        <input type="hidden" name="carousel_image_temp" value="<?= esc($rs['carousel_image']??'');?>">
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Batal">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-success mr-2">
                            <a href="<?= base_url('adminsite/explore/maincarousel');?>" class="btn btn-secondary">Batal</a>
                        </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
