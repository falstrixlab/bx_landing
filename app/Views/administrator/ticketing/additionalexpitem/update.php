<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Update Item</h5>
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
                <form method="POST" action="<?= base_url('adminsite/ticketing/additionalexpitem/runupdate');?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <input type="hidden" name="item_id" value="<?= $getdata[0]['item_id'];?>">
                        <input type="hidden" name="oldpicture" value="<?= $getdata[0]['item_image'];?>">
                        <input type="hidden" name="old_duration_icon" value="<?= $getdata[0]['item_duration_icon'];?>">
                        <input type="hidden" name="old_schedule_icon" value="<?= $getdata[0]['item_schedule_icon'];?>">
                        <input type="hidden" name="old_location_icon" value="<?= $getdata[0]['item_location_icon'];?>">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input name="item_title_id" type="text" class="form-control" value="<?= esc($getdata[0]['item_title_id']);?>" required/>
                        </div>
                        <div class="form-group">
                            <label>Title EN</label>
                            <input name="item_title_en" type="text" class="form-control" value="<?= esc($getdata[0]['item_title_en'] ?? '');?>"/>
                        </div>
                        <div class="form-group">
                            <label>Description ID</label>
                            <textarea name="item_desc_id" class="form-control" rows="4"><?= $getdata[0]['item_desc_id'] ?? '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN</label>
                            <textarea name="item_desc_en" class="form-control" rows="4"><?= $getdata[0]['item_desc_en'] ?? '';?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration ID</label>
                                    <textarea name="item_duration_id" class="form-control" rows="3"><?= esc($getdata[0]['item_duration_id'] ?? '');?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration EN</label>
                                    <textarea name="item_duration_en" class="form-control" rows="3"><?= esc($getdata[0]['item_duration_en'] ?? '');?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Duration Icon</label>
                            <?php if(!empty($getdata[0]['item_duration_icon'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/upload/additional_exp_item/'.$getdata[0]['item_duration_icon'])?>" alt="Duration Icon" style="max-width:50px;max-height:50px;">
                                <small class="d-block text-muted">Current icon</small>
                            </div>
                            <?php endif; ?>
                            <input name="item_duration_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current icon</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule ID</label>
                                    <textarea name="item_schedule_id" class="form-control" rows="3"><?= esc($getdata[0]['item_schedule_id'] ?? '');?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule EN</label>
                                    <textarea name="item_schedule_en" class="form-control" rows="3"><?= esc($getdata[0]['item_schedule_en'] ?? '');?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Schedule Icon</label>
                            <?php if(!empty($getdata[0]['item_schedule_icon'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/upload/additional_exp_item/'.$getdata[0]['item_schedule_icon'])?>" alt="Schedule Icon" style="max-width:50px;max-height:50px;">
                                <small class="d-block text-muted">Current icon</small>
                            </div>
                            <?php endif; ?>
                            <input name="item_schedule_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current icon</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location ID</label>
                                    <textarea name="item_location_id" class="form-control" rows="3"><?= esc($getdata[0]['item_location_id'] ?? '');?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location EN</label>
                                    <textarea name="item_location_en" class="form-control" rows="3"><?= esc($getdata[0]['item_location_en'] ?? '');?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Location Icon</label>
                            <?php if(!empty($getdata[0]['item_location_icon'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/upload/additional_exp_item/'.$getdata[0]['item_location_icon'])?>" alt="Location Icon" style="max-width:50px;max-height:50px;">
                                <small class="d-block text-muted">Current icon</small>
                            </div>
                            <?php endif; ?>
                            <input name="item_location_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current icon</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text ID</label>
                                    <input name="item_button_id" type="text" class="form-control" value="<?= esc($getdata[0]['item_button_id'] ?? '');?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text EN</label>
                                    <input name="item_button_en" type="text" class="form-control" value="<?= esc($getdata[0]['item_button_en'] ?? '');?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Background Image</label>
                            <?php if(!empty($getdata[0]['item_image'])): ?>
                            <div class="image-input image-input-outline mb-3" style="background-image: url(<?= base_url('assets/upload/additional_exp_item/'.$getdata[0]['item_image'])?>);width:200px;height:150px;background-size:cover;"></div>
                            <?php endif; ?>
                            <input name="item_image" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="item_status" class="form-control">
                                <option value="1" <?= $getdata[0]['item_status'] == 1 ? 'selected' : '';?>>Active</option>
                                <option value="0" <?= $getdata[0]['item_status'] == 0 ? 'selected' : '';?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Update Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/additionalexpitem');?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
