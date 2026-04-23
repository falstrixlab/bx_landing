<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Add Item</h5>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <?php if(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Data insert failed.</div>
                <?php endif;?>
                <form method="POST" action="<?= base_url('adminsite/ticketing/additionalexpitem/runadd');?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input name="item_title_id" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Title EN</label>
                            <input name="item_title_en" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Description ID</label>
                            <textarea name="item_desc_id" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN</label>
                            <textarea name="item_desc_en" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration ID</label>
                                    <textarea name="item_duration_id" class="form-control" rows="3" placeholder="e.g., Senin - Kamis: Rp45.000"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration EN</label>
                                    <textarea name="item_duration_en" class="form-control" rows="3" placeholder="e.g., Mon - Thu: Rp45,000"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Duration Icon</label>
                            <input name="item_duration_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Upload icon image (PNG/SVG recommended, max 100x100px)</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule ID</label>
                                    <textarea name="item_schedule_id" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule EN</label>
                                    <textarea name="item_schedule_en" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Schedule Icon</label>
                            <input name="item_schedule_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Upload icon image (PNG/SVG recommended, max 100x100px)</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location ID</label>
                                    <textarea name="item_location_id" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location EN</label>
                                    <textarea name="item_location_en" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Location Icon</label>
                            <input name="item_location_icon" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Upload icon image (PNG/SVG recommended, max 100x100px)</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text ID</label>
                                    <input name="item_button_id" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text EN</label>
                                    <input name="item_button_en" type="text" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Background Image</label>
                            <input name="item_image" type="file" class="form-control" accept="image/*"/>
                            <small class="text-muted">Recommended: 800x600px</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="item_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Save Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/additionalexpitem');?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
