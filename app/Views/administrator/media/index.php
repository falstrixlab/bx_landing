<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Media Manager</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">System</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Media Manager</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <strong>Success!</strong> <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <div class="row mb-6">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card card-custom gutter-b shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted text-uppercase font-size-sm">Total File</div>
                            <div class="font-size-h2 font-weight-bolder"><?= esc((string) ($mediaStats['total_files'] ?? 0)) ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card card-custom gutter-b shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted text-uppercase font-size-sm">Total Gambar</div>
                            <div class="font-size-h2 font-weight-bolder"><?= esc((string) ($mediaStats['total_images'] ?? 0)) ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mb-4">
                    <div class="card card-custom gutter-b shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted text-uppercase font-size-sm">Ukuran Media</div>
                            <div class="font-size-h2 font-weight-bolder"><?= esc(number_format((($mediaStats['total_size'] ?? 0) / 1024 / 1024), 2)) ?> MB</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-custom gutter-b mb-7">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Upload Media Baru</h3>
                    </div>
                </div>
                <form method="POST" action="<?= base_url(getenv('bxsea.admin') . '/media/upload') ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih gambar</label>
                            <input type="file" name="file" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml" required>
                            <span class="form-text text-muted">Maksimal 5 MB. File akan disimpan ke folder editor agar bisa dipakai di Quill dan modul CMS.</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </form>
            </div>

            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Library Media</h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($mediaFiles)): ?>
                        <div class="alert alert-light">Belum ada file media yang tersedia.</div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($mediaFiles as $file): ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                                    <div class="card card-custom card-stretch gutter-b shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-4 text-center">
                                                <?php if ($file['is_image']): ?>
                                                    <img src="<?= esc($file['url']) ?>" alt="<?= esc($file['name']) ?>" style="width:100%;height:180px;object-fit:cover;border-radius:12px;">
                                                <?php else: ?>
                                                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height:180px;">
                                                        <span class="font-size-h3 font-weight-bold text-muted">FILE</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="mb-3">
                                                <div class="font-weight-bolder text-dark text-truncate"><?= esc($file['name']) ?></div>
                                                <div class="text-muted font-size-sm text-truncate"><?= esc($file['folder']) ?></div>
                                                <div class="text-muted font-size-sm"><?= esc(number_format($file['size'] / 1024, 1)) ?> KB</div>
                                                <div class="text-muted font-size-sm"><?= esc($file['updated_at']) ?></div>
                                            </div>
                                            <div class="mt-auto d-flex flex-column">
                                                <input type="text" class="form-control form-control-sm mb-2" readonly value="<?= esc($file['url']) ?>">
                                                <a href="<?= base_url(getenv('bxsea.admin') . '/media/delete/' . $file['delete_key']) ?>" class="btn btn-sm btn-light-danger btn-delete-confirm">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
