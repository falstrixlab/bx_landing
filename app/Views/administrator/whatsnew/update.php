<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center">
    <h5 class="text-dark font-weight-bold my-1 mr-5">Edit Artikel</h5>
  </div>
</div>
<div class="d-flex flex-column-fluid">
  <div class="container">
    <?php $row = $getdata[0] ?? []; ?>
    <div class="card card-custom gutter-b">
      <div class="card-header py-3">
        <div class="card-title"><h3 class="card-label">Edit Artikel</h3></div>
      </div>
      <div class="card-body">
        <form action="<?= base_url(getenv('bxsea.admin').'/whatsnew/runupdate/'.($row['article_id'] ?? ''));?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <input type="hidden" name="submit" value="1">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="article_title" class="form-control" value="<?= esc($row['article_title'] ?? '');?>" required>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="article_category" class="form-control">
              <option value="1" <?= ($row['article_category'] ?? '') == 1 ? 'selected' : '';?>>News</option>
              <option value="2" <?= ($row['article_category'] ?? '') == 2 ? 'selected' : '';?>>Awards &amp; Certifications</option>
              <option value="3" <?= ($row['article_category'] ?? '') == 3 ? 'selected' : '';?>>Conservation Stories</option>
            </select>
          </div>
          <div class="form-group">
            <label>Konten</label>
            <textarea name="article_desc" id="article_desc" class="form-control" rows="10"><?= $row['article_desc'] ?? '';?></textarea>
          </div>
          <div class="form-group">
            <label>Gambar Saat Ini</label>
            <?php if(!empty($row['article_pict'])): ?>
            <br><img id="preview_pict" src="<?= base_url('assets/upload/article/'.$row['article_pict']);?>" style="max-height:150px;" class="mb-2 d-block">
            <?php else: ?><img id="preview_pict" src="" style="max-height:150px;display:none;" class="mb-2 d-block">
            <?php endif; ?>
            <input type="file" name="article_pict" class="form-control-file" accept="image/*" onchange="previewImg(this,'preview_pict')">
          </div>
          <div class="d-flex justify-content-between">
            <a href="<?= base_url(getenv('bxsea.admin').'/whatsnew');?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function previewImg(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var el = document.getElementById(id);
      el.src = e.target.result;
      el.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<?= $this->endSection() ?>
