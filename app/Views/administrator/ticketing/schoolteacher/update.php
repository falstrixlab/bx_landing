<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Update Teacher Testimonial</h5>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <?php if(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Data update failed.</div>
                <?php endif;?>
                <form method="POST" action="<?= base_url('adminsite/ticketing/schoolteacher/runupdate');?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <input type="hidden" name="teacher_id" value="<?= $getdata[0]['teacher_id'];?>">
                        <input type="hidden" name="oldpicture" value="<?= $getdata[0]['teacher_image'];?>">
                        <div class="form-group">
                            <label>Teacher Name <span class="text-danger">*</span></label>
                            <input name="teacher_name" type="text" class="form-control" value="<?= esc($getdata[0]['teacher_name']);?>" required/>
                        </div>
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <textarea name="teacher_title_id" class="form-control" rows="3" required><?= $getdata[0]['teacher_title_id'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Title EN</label>
                            <textarea name="teacher_title_en" class="form-control" rows="3"><?= $getdata[0]['teacher_title_en'] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description ID <span class="text-danger">*</span></label>
                            <textarea name="teacher_desc_id" class="form-control" id="kt-ckeditor-1" rows="6"><?= $getdata[0]['teacher_desc_id'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN</label>
                            <textarea name="teacher_desc_en" class="form-control" id="kt-ckeditor-2" rows="6"><?= $getdata[0]['teacher_desc_en'] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <?php if(!empty($getdata[0]['teacher_image'])): ?>
                            <div class="image-input image-input-outline mb-3" style="background-image: url(<?= base_url('assets/upload/school_teacher/'.$getdata[0]['teacher_image'])?>);width:200px;height:150px;background-size:cover;"></div>
                            <?php endif; ?>
                            <input name="teacher_image" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current photo</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Update Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/schoolteacher');?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
