<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Visitor Page Sections</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <?php if(session()->getFlashdata('success')):?>
                <div class="alert alert-success alert-dismissible mb-4">
                    <strong>Success!</strong> Data updated successfully.
                </div>
            <?php endif;?>
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Kelola Konten Halaman Info Pengunjung
                            <span class="d-block text-muted pt-2 font-size-sm">Edit setiap section halaman Informasi Pengunjung</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Key</th>
                                <th>Title (ID)</th>
                                <th>Title (EN)</th>
                                <th>Gambar 1</th>
                                <th>Gambar 2</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($getdata as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><code><?= esc($row['visitorpage_key']) ?></code></td>
                                <td><?= esc($row['visitorpage_title']) ?></td>
                                <td><?= esc($row['visitorpage_title_en']) ?></td>
                                <td>
                                    <?php if (!empty($row['visitorpage_pict1'])): ?>
                                        <img src="<?= base_url('assets/upload/visitorpage/' . esc($row['visitorpage_pict1'])) ?>" alt="" style="max-height:50px;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['visitorpage_pict2'])): ?>
                                        <img src="<?= base_url('assets/upload/visitorpage/' . esc($row['visitorpage_pict2'])) ?>" alt="" style="max-height:50px;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('adminsite/visit/visitorpage/update/' . $row['visitorpage_id']) ?>" class="btn btn-sm btn-primary">Edit</a>
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
