<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Visitor Info</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Visit</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Visitor Info</a></li>
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
                        <h3 class="card-label">Visitor Info Content <span class="d-block text-muted pt-2 font-size-sm">Konten rules dan edukasi untuk halaman informasi pengunjung</span></h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?= base_url('adminsite/visit/visitorinfo/add') ?>" class="btn btn-primary font-weight-bolder">New Record</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible"><strong>Success!</strong> Proses data berhasil.</div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible"><strong>Failed!</strong> Proses data gagal.</div>
                    <?php endif; ?>
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Section</th>
                                <th>Title</th>
                                <th>Sort</th>
                                <th>Status</th>
                                <th style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($getdata as $rs): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><span class="label label-pill label-inline label-light-primary"><?= esc($rs['visitorinfo_section']) ?></span></td>
                                    <td><?= esc($rs['visitorinfo_title']) ?></td>
                                    <td><?= esc((string) $rs['visitorinfo_sort']) ?></td>
                                    <td>
                                        <?php if ((int) ($rs['visitorinfo_status'] ?? 0) === 1): ?>
                                            <span class="label label-pill label-inline label-light-success">Active</span>
                                        <?php else: ?>
                                            <span class="label label-pill label-inline label-light-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-sm btn-light-warning pulse pulse-warning mr-2" href="<?= base_url('adminsite/visit/visitorinfo/update/' . $rs['visitorinfo_id']) ?>">
                                            <i class="flaticon-edit-1 icon-lg" title="Edit Content"></i>
                                            <span class="pulse-ring"></span>
                                        </a>
                                        <a class="btn btn-sm btn-icon btn-light-danger pulse pulse-danger mr-2 btn-delete-confirm" href="<?= base_url('adminsite/visit/visitorinfo/delete/' . $rs['visitorinfo_id']) ?>">
                                            <i class="flaticon2-trash icon-lg" title="Delete Content"></i>
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
