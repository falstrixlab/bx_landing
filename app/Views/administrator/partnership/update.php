<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center">
    <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Kemitraan</h5>
  </div>
</div>
<div class="d-flex flex-column-fluid">
  <div class="container">
    <?php $row = $getdata[0] ?? []; ?>
    <div class="card card-custom gutter-b">
      <div class="card-header py-3">
        <div class="card-title"><h3 class="card-label">Edit Data Kemitraan</h3></div>
      </div>
      <div class="card-body">
        <form action="<?= base_url(getenv('bxsea.admin').'/partnership/runupdate/'.($row['partnership_id'] ?? ''));?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <input type="hidden" name="submit" value="1">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="partnership_name" class="form-control" value="<?= esc($row['partnership_name'] ?? '');?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="partnership_email" class="form-control" value="<?= esc($row['partnership_email'] ?? '');?>">
          </div>
          <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="partnership_phone" class="form-control" value="<?= esc($row['partnership_phone'] ?? '');?>">
          </div>
          <div class="form-group">
            <label>Deskripsi/Pesan</label>
            <textarea name="partnership_desc" class="form-control" rows="5"><?= esc($row['partnership_desc'] ?? '');?></textarea>
          </div>
          <div class="form-group">
            <label>Foto Saat Ini</label>
            <?php if(!empty($row['partnership_pict'])): ?>
            <br><img src="<?= base_url('assets/upload/partnership/'.$row['partnership_pict']);?>" style="max-height:150px;" class="mb-2 d-block">
            <?php endif; ?>
            <input type="file" name="partnership_pict" class="form-control-file" accept="image/*">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="partnership_status" class="form-control">
              <option value="pending" <?= ($row['partnership_status'] ?? '') == 'pending' ? 'selected' : '';?>>Pending</option>
              <option value="approved" <?= ($row['partnership_status'] ?? '') == 'approved' ? 'selected' : '';?>>Approved</option>
              <option value="rejected" <?= ($row['partnership_status'] ?? '') == 'rejected' ? 'selected' : '';?>>Rejected</option>
            </select>
          </div>
          <div class="d-flex justify-content-between">
            <a href="<?= base_url(getenv('bxsea.admin').'/partnership');?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?= $this->endSection() ?>
