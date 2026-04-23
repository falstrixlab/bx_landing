<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Add Memory</h5>
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
                <form method="POST" action="<?= base_url('adminsite/ticketing/momentmemories/runadd');?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input name="memory_title_id" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Title EN</label>
                            <input name="memory_title_en" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Carousel Image <span class="text-danger">*</span></label>
                            <input name="memory_image" type="file" class="form-control" accept="image/*" required/>
                            <small class="text-muted">Recommended: 1200x800px</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="memory_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Save Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/momentmemories');?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
