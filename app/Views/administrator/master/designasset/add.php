<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Add Design Asset</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Tambah Asset Redesign</h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> <?= esc((string) session()->getFlashdata('failed')) ?></div>
                    <?php endif; ?>
                    <div class="card card-custom">
                        <form method="POST" action="<?= base_url('adminsite/master/designasset/runadd') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Group <span class="text-danger">*</span></label>
                                            <input name="designasset_group" type="text" class="form-control" placeholder="home" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Key <span class="text-danger">*</span></label>
                                            <input name="designasset_key" type="text" class="form-control" placeholder="hero-logo" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label <span class="text-danger">*</span></label>
                                            <input name="designasset_label" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label EN</label>
                                            <input name="designasset_label_en" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Source <span class="text-danger">*</span></label>
                                            <select name="designasset_source" class="form-control js-designasset-source" required>
                                                <option value="redesign">Redesign Asset</option>
                                                <option value="upload">Upload CMS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Directory</label>
                                            <input name="designasset_directory" type="text" class="form-control" value="image">
                                            <span class="form-text text-muted">Default menggunakan assets/landing/image.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="designasset_sort" class="form-control" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group js-redesign-file-group">
                                    <label>Redesign File <span class="text-danger">*</span></label>
                                    <select name="designasset_file_redesign" class="form-control">
                                        <option value="">Pilih file redesign</option>
                                        <?php foreach ($assetFiles as $file): ?>
                                            <option value="<?= esc($file) ?>"><?= esc($file) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group js-upload-file-group d-none">
                                    <label>Upload File <span class="text-danger">*</span></label>
                                    <input type="file" name="designasset_file_upload" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml">
                                </div>
                                <div class="form-group">
                                    <label>Alt Text</label>
                                    <input name="designasset_alt" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="designasset_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
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
