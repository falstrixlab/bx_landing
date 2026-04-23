<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Why BXSEA Section</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Ticketing</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Why BXSEA</a></li>
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
                    <h3 class="card-label">Manage Why BXSEA Section <span class="d-block text-muted pt-2 font-size-sm">Update why-bxsea content</span></h3>
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
                    <form method="POST" action="<?= base_url('adminsite/ticketing/schoolwhybxsea/'.(!empty($getdata) ? 'runupdate' : 'runadd'));?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <?php $rs = !empty($getdata[0]) ? $getdata[0] : []; ?>
                        <div class="card-body">
                            <?php if(!empty($rs['why_id'])): ?>
                            <input type="hidden" name="why_id" value="<?= $rs['why_id'];?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Title ID <span class="text-danger">*</span></label>
                                <input name="why_title_id" type="text" class="form-control" placeholder="Mengapa BXSEA" value="<?= esc($rs['why_title_id'] ?? '');?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Title EN</label>
                                <input name="why_title_en" type="text" class="form-control" placeholder="Why BXSEA" value="<?= esc($rs['why_title_en'] ?? '');?>"/>
                            </div>
                            <div class="form-group">
                                <label>Content ID (HTML Support) <span class="text-danger">*</span></label>
                                <textarea name="why_content_id" class="form-control" id="kt-ckeditor-1" rows="10"><?= $rs['why_content_id'] ?? '';?></textarea>
                                <small class="text-muted">Supports HTML tags including ul, li, strong, etc.</small>
                            </div>
                            <div class="form-group">
                                <label>Content EN (HTML Support)</label>
                                <textarea name="why_content_en" class="form-control" id="kt-ckeditor-2" rows="10"><?= $rs['why_content_en'] ?? '';?></textarea>
                                <small class="text-muted">Supports HTML tags including ul, li, strong, etc.</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Save Data" class="btn btn-success mr-2">
                            <a href="<?= base_url('adminsite/ticketing/schoolwhybxsea');?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
