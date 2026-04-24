<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Update Visitor Info</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Update Konten Visitor Info</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/visit/visitorinfo/runupdate') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="visitorinfo_id" value="<?= esc((string) $getdata['visitorinfo_id']) ?>">
                                <input type="hidden" name="back_url" value="<?= esc($back_url ?? base_url('adminsite/visit/visitorinfo')) ?>">
                                <div class="form-group">
                                    <label>Section <span class="text-danger">*</span></label>
                                    <select name="visitorinfo_section" class="form-control" required>
                                        <option value="rule" <?= ($getdata['visitorinfo_section'] === 'rule') ? 'selected' : '' ?>>Rule</option>
                                        <option value="learn" <?= ($getdata['visitorinfo_section'] === 'learn') ? 'selected' : '' ?>>Learn</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Title ID <span class="text-danger">*</span></label>
                                    <input name="visitorinfo_title" type="text" class="form-control" value="<?= esc($getdata['visitorinfo_title']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Title EN</label>
                                    <input name="visitorinfo_title_en" type="text" class="form-control" value="<?= esc($getdata['visitorinfo_title_en'] ?? '') ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label ID <small class="text-muted">(untuk section Learn, misal: EDUKASI)</small></label>
                                            <input name="visitorinfo_label" type="text" class="form-control" value="<?= esc($getdata['visitorinfo_label'] ?? '') ?>" placeholder="Cth: EDUKASI">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label EN</label>
                                            <input name="visitorinfo_label_en" type="text" class="form-control" value="<?= esc($getdata['visitorinfo_label_en'] ?? '') ?>" placeholder="e.g.: LEARN">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description ID <span class="text-danger">*</span></label>
                                    <textarea name="visitorinfo_desc" class="form-control js-quill-editor" data-editor="quill" rows="6"><?= $getdata['visitorinfo_desc'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <textarea name="visitorinfo_desc_en" class="form-control js-quill-editor" data-editor="quill" rows="6"><?= $getdata['visitorinfo_desc_en'] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="file" name="visitorinfo_icon" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml">
                                            <?php if (!empty($getdata['visitorinfo_icon'])): ?>
                                                <div class="mt-3"><img src="<?= base_url('assets/upload/visitorinfo/' . $getdata['visitorinfo_icon']) ?>" alt="icon" style="max-height:90px;"></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="visitorinfo_image" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml">
                                            <?php if (!empty($getdata['visitorinfo_image'])): ?>
                                                <div class="mt-3"><img src="<?= base_url('assets/upload/visitorinfo/' . $getdata['visitorinfo_image']) ?>" alt="image" style="max-height:90px;"></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="visitorinfo_sort" class="form-control" value="<?= esc((string) ($getdata['visitorinfo_sort'] ?? 0)) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="visitorinfo_status" class="form-control">
                                                <option value="1" <?= ((int) ($getdata['visitorinfo_status'] ?? 1) === 1) ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= ((int) ($getdata['visitorinfo_status'] ?? 1) === 0) ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                                <a href="<?= esc($back_url ?? base_url('adminsite/visit/visitorinfo')) ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
