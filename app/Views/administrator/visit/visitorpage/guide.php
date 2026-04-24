<?= $this->extend('administrator/layoutadmin') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Guide Section</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Visit</a></li>
                        <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Panduan Pengunjung</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible mb-4"><strong>Success!</strong> Data berhasil disimpan.</div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('failed')): ?>
                <div class="alert alert-danger alert-dismissible mb-4"><strong>Failed!</strong> Gagal menyimpan data.</div>
            <?php endif; ?>

            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Tab Panduan Pengunjung <span class="d-block text-muted pt-2 font-size-sm">4 tab di .vi-guide-section — klik Edit untuk ubah konten tiap tab</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $tabs = [
                        ['key' => 'guide_gettinghere', 'label_id' => 'Cara Menuju ke Sini', 'label_en' => 'Getting Here', 'data' => $guide_gettinghere],
                        ['key' => 'guide_howto',       'label_id' => 'Panduan Menjelajah',  'label_en' => 'How to Explore', 'data' => $guide_howto],
                        ['key' => 'guide_explore',     'label_id' => 'Cara Menjelajah',     'label_en' => 'Ways to Explore', 'data' => $guide_explore],
                        ['key' => 'guide_app',         'label_id' => 'BXSea Explore App',   'label_en' => 'BXSea App', 'data' => $guide_app],
                    ];
                    ?>
                    <table class="table table-bordered" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Key</th>
                                <th>Tab Label (ID)</th>
                                <th>Tab Label (EN)</th>
                                <th>Konten (ID)</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabs as $i => $tab):
                                $row = $tab['data'];
                            ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><code><?= esc($tab['key']) ?></code></td>
                                <td><?= esc($row['visitorpage_title'] ?? $tab['label_id']) ?></td>
                                <td><?= esc($row['visitorpage_title_en'] ?? $tab['label_en']) ?></td>
                                <td class="text-truncate" style="max-width:260px;">
                                    <?= esc(mb_substr(strip_tags($row['visitorpage_desc'] ?? '–'), 0, 100)) ?>
                                    <?php if (strlen(strip_tags($row['visitorpage_desc'] ?? '')) > 100): ?>…<?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['visitorpage_id'])): ?>
                                    <a class="btn btn-icon btn-sm btn-light-warning pulse pulse-warning" href="<?= base_url('adminsite/visit/visitorpage/update/' . $row['visitorpage_id']) ?>">
                                        <i class="flaticon-edit-1 icon-lg" title="Edit Tab"></i>
                                        <span class="pulse-ring"></span>
                                    </a>
                                    <?php else: ?>
                                    <a class="btn btn-icon btn-sm btn-light-success pulse pulse-success" href="<?= base_url('adminsite/visit/visitorpage/add/' . esc($tab['key'])) ?>">
                                        <i class="flaticon-plus icon-lg" title="Tambah Tab"></i>
                                        <span class="pulse-ring"></span>
                                    </a>
                                    <?php endif; ?>
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
