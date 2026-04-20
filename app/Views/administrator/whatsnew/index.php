<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <h5 class="text-dark font-weight-bold my-1 mr-5">Berita / What's New</h5>
  </div>
</div>
<div class="d-flex flex-column-fluid">
  <div class="container">
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success');?></div>
    <?php elseif(session()->getFlashdata('failed')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('failed');?></div>
    <?php endif; ?>
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title"><h3 class="card-label">Data Artikel / Berita</h3></div>
        <div class="card-toolbar">
          <a href="<?= base_url(getenv('bxsea.admin').'/whatsnew/add');?>" class="btn btn-primary font-weight-bolder">+ Tambah Artikel</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="kt_datatable">
            <thead><tr>
              <th>No</th><th>Gambar</th><th>Judul</th><th>Tanggal</th><th>Aksi</th>
            </tr></thead>
            <tbody>
              <?php $no=1; foreach($getdata AS $row): ?>
              <tr>
                <td><?= $no++;?></td>
                <td><img src="<?= base_url('assets/upload/article/'.$row['article_pict'] ?? '');?>" style="max-height:60px;"></td>
                <td><?= esc($row['article_title'] ?? '');?></td>
                <td><?= esc($row['article_created_date'] ?? '');?></td>
                <td>
                  <a href="<?= base_url(getenv('bxsea.admin').'/whatsnew/update/'.$row['article_id']);?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="<?= base_url(getenv('bxsea.admin').'/whatsnew/delete/'.$row['article_id']);?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
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
</div>
<?= $this->endSection() ?>
