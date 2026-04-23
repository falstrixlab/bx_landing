<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Update Included Item</h5>
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
                <form method="POST" action="<?= base_url('adminsite/ticketing/schoolincluded/runupdate');?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <input type="hidden" name="included_id" value="<?= $getdata[0]['included_id'];?>">
                        <input type="hidden" name="oldpicture" value="<?= $getdata[0]['included_image'];?>">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input name="included_title_id" type="text" class="form-control" value="<?= esc($getdata[0]['included_title_id']);?>" required/>
                        </div>
                        <div class="form-group">
                            <label>Title EN</label>
                            <input name="included_title_en" type="text" class="form-control" value="<?= esc($getdata[0]['included_title_en'] ?? '');?>"/>
                        </div>
                        <div class="form-group">
                            <label>Description ID</label>
                            <textarea name="included_desc_id" class="form-control" rows="4"><?= $getdata[0]['included_desc_id'] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN</label>
                            <textarea name="included_desc_en" class="form-control" rows="4"><?= $getdata[0]['included_desc_en'] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <?php if(!empty($getdata[0]['included_image'])): ?>
                            <div class="image-input image-input-outline mb-3" style="background-image: url(<?= base_url('assets/upload/school_included/'.$getdata[0]['included_image'])?>);width:200px;height:150px;background-size:cover;"></div>
                            <?php endif; ?>
                            <input name="included_image" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="included_status" class="form-control">
                                <option value="1" <?= $getdata[0]['included_status'] == 1 ? 'selected' : '';?>>Active</option>
                                <option value="0" <?= $getdata[0]['included_status'] == 0 ? 'selected' : '';?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Update Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/schoolincluded');?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
