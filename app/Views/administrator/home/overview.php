<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-1">
        <div class="d-flex align-items-baseline flex-wrap mr-5">
          <h5 class="text-dark font-weight-bold my-1 mr-5">CMS Home</h5>
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Landing</a></li>
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Home</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex flex-column-fluid">
    <div class="container bxsea-overview-page">
      <div class="card card-custom gutter-b bxsea-overview-hero">
        <div class="card-body">
          <span class="bxsea-overview-kicker">Urutan mengikuti homepage</span>
          <h2 class="bxsea-overview-title">Kelola semua section home tanpa pindah-pindah menu</h2>
          <p class="bxsea-overview-copy">Urutan modul di bawah disusun mengikuti struktur halaman depan BXSea. Area terkait yang sumber datanya masih dipakai dari menu lain tetap ditampilkan di bagian bawah supaya admin tidak bingung.</p>
        </div>
      </div>

      <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
        <div>
          <h3 class="font-weight-bolder mb-1">Section Utama Home</h3>
          <p class="text-muted mb-0">Mulai dari bagian atas sampai bawah homepage.</p>
        </div>
      </div>

      <div class="row">
        <?php foreach ($primarySections as $section): ?>
        <div class="col-xl-4 col-md-6 mb-5">
          <a href="<?= esc($section['href']); ?>" class="bxsea-overview-card card card-custom h-100">
            <div class="card-body">
              <span class="bxsea-overview-meta"><?= esc($section['meta']); ?></span>
              <h4><?= esc($section['title']); ?></h4>
              <p><?= esc($section['description']); ?></p>
              <span class="bxsea-overview-link">Buka modul</span>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="d-flex align-items-center justify-content-between flex-wrap mt-3 mb-4">
        <div>
          <h3 class="font-weight-bolder mb-1">Konten Terkait Yang Ikut Muncul Di Home</h3>
          <p class="text-muted mb-0">Section berikut tampil di homepage, tetapi sumber datanya masih berasal dari modul halaman lain.</p>
        </div>
      </div>

      <div class="row">
        <?php foreach ($relatedSections as $section): ?>
        <div class="col-xl-3 col-md-6 mb-5">
          <a href="<?= esc($section['href']); ?>" class="bxsea-overview-card bxsea-overview-card--related card card-custom h-100">
            <div class="card-body">
              <span class="bxsea-overview-meta"><?= esc($section['meta']); ?></span>
              <h4><?= esc($section['title']); ?></h4>
              <p><?= esc($section['description']); ?></p>
              <span class="bxsea-overview-link">Buka sumber data</span>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>