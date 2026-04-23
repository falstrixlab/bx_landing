<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Additional Experience Header</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Ticketing</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Additional Experience Header</a></li>
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
                    <h3 class="card-label">Manage Additional Experience Header <span class="d-block text-muted pt-2 font-size-sm">Update header content for additional experience page</span></h3>
                </div>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success alert-dismissible"><strong>Success!</strong> Data updated successfully.</div>
                <?php endif;?>
                <?php if(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Data update failed.</div>
                <?php endif;?>
                <div class="card card-custom">
                    <form method="POST" action="<?= base_url('adminsite/ticketing/additionalexp/'.(!empty($getdata) ? 'runupdate' : 'runadd'));?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <?php $rs = !empty($getdata[0]) ? $getdata[0] : []; ?>
                        <div class="card-body">
                            <?php if(!empty($rs['additional_id'])): ?>
                            <input type="hidden" name="additional_id" value="<?= $rs['additional_id'];?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Title ID <span class="text-danger">*</span></label>
                                <input name="additional_title_id" type="text" class="form-control" placeholder="Enter title (Indonesian)" value="<?= esc($rs['additional_title_id'] ?? '');?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Title EN</label>
                                <input name="additional_title_en" type="text" class="form-control" placeholder="Enter title (English)" value="<?= esc($rs['additional_title_en'] ?? '');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Description ID <span class="text-danger">*</span></label>
                                <textarea name="additional_desc_id" class="form-control" id="kt-ckeditor-1" rows="6"><?= $rs['additional_desc_id'] ?? '';?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN</label>
                                <textarea name="additional_desc_en" class="form-control" id="kt-ckeditor-2" rows="6"><?= $rs['additional_desc_en'] ?? '';?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Notes ID</label>
                                <textarea name="additional_notes_id" class="form-control" id="kt-ckeditor-3" rows="4"><?= $rs['additional_notes_id'] ?? '';?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Notes EN</label>
                                <textarea name="additional_notes_en" class="form-control" id="kt-ckeditor-4" rows="4"><?= $rs['additional_notes_en'] ?? '';?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="submit" value="Save Data" class="btn btn-success mr-2">
                            <a href="<?= base_url('adminsite/ticketing/additionalexp');?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
