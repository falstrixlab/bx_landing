<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<?php
    $previewUrl = '';
    $isPreviewImage = false;
    if (($getdata['designasset_source'] ?? 'redesign') === 'upload' && ! empty($getdata['designasset_file'])) {
        $previewUrl = base_url('assets/upload/designasset/' . $getdata['designasset_file']);
    } elseif (! empty($getdata['designasset_file'])) {
        $previewUrl = base_url('assets/landing/' . trim((string) ($getdata['designasset_directory'] ?? 'image'), '/') . '/' . $getdata['designasset_file']);
    }

    $extension = strtolower((string) pathinfo((string) ($getdata['designasset_file'] ?? ''), PATHINFO_EXTENSION));
    $isPreviewImage = in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp', 'svg'], true);
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Update Design Asset</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Update Asset Redesign</h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> <?= esc((string) session()->getFlashdata('failed')) ?></div>
                    <?php endif; ?>
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/master/designasset/runupdate') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="designasset_id" value="<?= esc((string) $getdata['designasset_id']) ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Group <span class="text-danger">*</span></label>
                                            <input name="designasset_group" type="text" class="form-control" value="<?= esc($getdata['designasset_group']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Key <span class="text-danger">*</span></label>
                                            <input name="designasset_key" type="text" class="form-control" value="<?= esc($getdata['designasset_key']) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label <span class="text-danger">*</span></label>
                                            <input name="designasset_label" type="text" class="form-control" value="<?= esc($getdata['designasset_label']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label EN</label>
                                            <input name="designasset_label_en" type="text" class="form-control" value="<?= esc($getdata['designasset_label_en'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Source <span class="text-danger">*</span></label>
                                            <select name="designasset_source" class="form-control js-designasset-source" required>
                                                <option value="redesign" <?= (($getdata['designasset_source'] ?? 'redesign') === 'redesign') ? 'selected' : '' ?>>Redesign Asset</option>
                                                <option value="upload" <?= (($getdata['designasset_source'] ?? 'redesign') === 'upload') ? 'selected' : '' ?>>Upload CMS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Directory</label>
                                            <input name="designasset_directory" type="text" class="form-control" value="<?= esc($getdata['designasset_directory'] ?? 'image') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="designasset_sort" class="form-control" value="<?= esc((string) ($getdata['designasset_sort'] ?? 0)) ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group js-redesign-file-group <?= (($getdata['designasset_source'] ?? 'redesign') === 'upload') ? 'd-none' : '' ?>">
                                    <label>Redesign File <span class="text-danger">*</span></label>
                                    <select name="designasset_file_redesign" class="form-control">
                                        <option value="">Pilih file redesign</option>
                                        <?php foreach ($assetFiles as $file): ?>
                                            <option value="<?= esc($file) ?>" <?= (($getdata['designasset_file'] ?? '') === $file) ? 'selected' : '' ?>><?= esc($file) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group js-upload-file-group <?= (($getdata['designasset_source'] ?? 'redesign') === 'upload') ? '' : 'd-none' ?>">
                                    <label>Upload File</label>
                                    <input type="file" name="designasset_file_upload" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml">
                                </div>
                                <div class="form-group">
                                    <label>Alt Text</label>
                                    <input name="designasset_alt" type="text" class="form-control" value="<?= esc($getdata['designasset_alt'] ?? '') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="designasset_status" class="form-control">
                                        <option value="1" <?= ((int) ($getdata['designasset_status'] ?? 1) === 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= ((int) ($getdata['designasset_status'] ?? 1) === 0) ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <?php if ($previewUrl !== '' && $isPreviewImage): ?>
                                    <div class="form-group">
                                        <label>Current Preview</label>
                                        <div><img src="<?= esc($previewUrl) ?>" alt="preview" style="max-height:120px; max-width:220px; border-radius:12px;"></div>
                                    </div>
                                <?php elseif ($previewUrl !== ''): ?>
                                    <div class="form-group">
                                        <label>Current File</label>
                                        <div><a href="<?= esc($previewUrl) ?>" target="_blank" rel="noopener noreferrer"><?= esc($getdata['designasset_file']) ?></a></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                                <a href="<?= base_url('adminsite/master/designasset') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var sourceSelect = document.querySelector('.js-designasset-source');
    var redesignGroup = document.querySelector('.js-redesign-file-group');
    var uploadGroup = document.querySelector('.js-upload-file-group');

    function syncDesignAssetSource() {
        var isUpload = sourceSelect && sourceSelect.value === 'upload';
        redesignGroup.classList.toggle('d-none', isUpload);
        uploadGroup.classList.toggle('d-none', !isUpload);
    }

    if (sourceSelect) {
        sourceSelect.addEventListener('change', syncDesignAssetSource);
        syncDesignAssetSource();
    }
});
</script>
<?= $this->endSection() ?>
