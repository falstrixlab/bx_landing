<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Design Assets</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Master</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Design Assets</a></li>
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
                        <h3 class="card-label">Asset Slot Redesign <span class="d-block text-muted pt-2 font-size-sm">Sinkronisasi asset frontend dengan file redesign dan upload CMS.</span></h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?= base_url('adminsite/master/designasset/add') ?>" class="btn btn-primary font-weight-bolder">New Record</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible"><strong>Success!</strong> Proses data berhasil.</div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> <?= esc((string) session()->getFlashdata('failed')) ?></div>
                    <?php endif; ?>
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Group</th>
                                <th>Key</th>
                                <th>Label</th>
                                <th>Source</th>
                                <th>Sort</th>
                                <th>Status</th>
                                <th style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getdata as $rs): ?>
                                <?php
                                    $previewUrl = '';
                                    $isPreviewImage = false;
                                    if (($rs['designasset_source'] ?? 'redesign') === 'upload' && ! empty($rs['designasset_file'])) {
                                        $previewUrl = base_url('assets/upload/designasset/' . $rs['designasset_file']);
                                    } elseif (! empty($rs['designasset_file'])) {
                                        $previewUrl = base_url('assets/landing/' . trim((string) ($rs['designasset_directory'] ?? 'image'), '/') . '/' . $rs['designasset_file']);
                                    }

                                    $extension = strtolower((string) pathinfo((string) ($rs['designasset_file'] ?? ''), PATHINFO_EXTENSION));
                                    $isPreviewImage = in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp', 'svg'], true);
                                ?>
                                <tr>
                                    <td>
                                        <?php if ($previewUrl !== '' && $isPreviewImage): ?>
                                            <img src="<?= esc($previewUrl) ?>" alt="preview" style="max-height:60px; max-width:100px; border-radius:8px;">
                                        <?php elseif (! empty($rs['designasset_file'])): ?>
                                            <a href="<?= esc($previewUrl) ?>" target="_blank" rel="noopener noreferrer"><?= esc($rs['designasset_file']) ?></a>
                                        <?php else: ?>
                                            <span class="text-muted">No preview</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="label label-pill label-inline label-light-primary"><?= esc($rs['designasset_group']) ?></span></td>
                                    <td><code><?= esc($rs['designasset_key']) ?></code></td>
                                    <td>
                                        <div class="font-weight-bold"><?= esc($rs['designasset_label']) ?></div>
                                        <?php if (! empty($rs['designasset_label_en'])): ?>
                                            <div class="text-muted font-size-sm"><?= esc($rs['designasset_label_en']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="label label-pill label-inline label-light-info"><?= esc(ucfirst((string) $rs['designasset_source'])) ?></span></td>
                                    <td><?= esc((string) ($rs['designasset_sort'] ?? 0)) ?></td>
                                    <td>
                                        <?php if ((int) ($rs['designasset_status'] ?? 0) === 1): ?>
                                            <span class="label label-pill label-inline label-light-success">Active</span>
                                        <?php else: ?>
                                            <span class="label label-pill label-inline label-light-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-sm btn-light-warning pulse pulse-warning mr-2" href="<?= base_url('adminsite/master/designasset/update/' . $rs['designasset_id']) ?>">
                                            <i class="flaticon-edit-1 icon-lg" title="Edit Asset"></i>
                                            <span class="pulse-ring"></span>
                                        </a>
                                        <a class="btn btn-sm btn-icon btn-light-danger pulse pulse-danger mr-2 btn-delete-confirm" href="<?= base_url('adminsite/master/designasset/delete/' . $rs['designasset_id']) ?>">
                                            <i class="flaticon2-trash icon-lg" title="Delete Asset"></i>
                                            <span class="pulse-ring"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
