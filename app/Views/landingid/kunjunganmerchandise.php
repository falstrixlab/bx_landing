<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$merchHeroAsset = bxsea_design_asset('merchandise', 'hero', 'assets/landing/image/bxsea_image_bg-tenant.png');
$merchTitle = 'Yuk! Bawa pulang merchandise BXSea';
$merchDesc = 'Jadikan momen petualanganmu di BXSea semakin berkesan dengan koleksi merchandise resmi kami. Temukan pilihan favorit untuk dibawa pulang sebagai kenang-kenangan spesial.';
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $merchHeroAsset; ?>" alt="">
    </div>
    <div class="title-merchandise descBanner2">
      <h1>OFFICIAL MERCHANDISE</h1>
    </div>
  </div>
</section>

<section class="Merchandise">
  <div class="container">
    <div class="title-merchandise2">
      <h1><?= esc($merchTitle);?></h1>
      <p><?= esc($merchDesc);?></p>
    </div>

    <section id="Filter">
      <div class="row">
        <div class="box-category-merchan">
          <div class="category-merchan">
            <p>Kategori</p>
            <img src="<?= base_url('assets/landing/');?>image/icons8-chevron-down-24-black.png" alt="">
          </div>
        </div>
        <div class="col-lg-8 indicator-merchan-web">
          <a href="#" class="button active" data-filter="all">Semua barang</a>
          <?php foreach ($mercat as $cat): ?>
          <a href="#" class="button" data-filter="cat-<?= (int) $cat['merchandisecat_id'];?>"><?= esc($cat['merchandisecat_name'] ?? '');?></a>
          <?php endforeach; ?>
        </div>
        <p class="text-merchan-center">Pembelian hanya dapat dilakukan langsung di toko merchandise resmi BXSea.</p>
      </div>

      <div class="row box-center box-merchandise-card" id="merchandise-grid">
      <?php foreach ($merchandise as $me): ?>
      <div class="col-lg-3 col-md-4 work-item mb-200" data-item="cat-<?= (int)($me['merchandise_category'] ?? 0);?>">
        <div class="items-owlmerchandise">
          <div class="image-merchandise">
            <img src="<?= bxsea_asset_url('merchandise', $me['merchandise_pict'] ?? '', 'assets/landing/image/produk-merchan.png');?>" alt="<?= esc($me['merchandise_title'] ?? '');?>" class="img-fluid">
          </div>
          <div class="title-merchan">
            <h3><?= esc($me['merchandise_title'] ?? '');?></h3>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <div class="download-merchan">
        <button class="btn-more" id="btn-load-more" type="button">Lihat Lebih Banyak</button>
      </div>
      </div>
    </section>
  </div>
</section>

<script>
var itemsPerPage = 8;
var currentShown = 0;
var currentFilter = 'all';

function filterMerchandise(filter) {
  currentFilter = filter;
  currentShown = 0;
  var items = document.querySelectorAll('#merchandise-grid .work-item');
  items.forEach(function(item) {
    item.style.display = 'none';
  });
  document.querySelectorAll('#Filter .button').forEach(function(btn) {
    btn.classList.toggle('active', btn.getAttribute('data-filter') === filter);
  });
  loadMoreMerchandise();
}

function loadMoreMerchandise() {
  var items = Array.from(document.querySelectorAll('#merchandise-grid .work-item')).filter(function(item) {
    return currentFilter === 'all' || item.getAttribute('data-item') === currentFilter;
  });
  var nextBatch = items.slice(currentShown, currentShown + itemsPerPage);
  nextBatch.forEach(function(item) { item.style.display = ''; });
  currentShown += nextBatch.length;
  document.getElementById('btn-load-more').style.display = currentShown >= items.length ? 'none' : '';
}

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('#Filter .button').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      filterMerchandise(button.getAttribute('data-filter'));
    });
  });
  document.getElementById('btn-load-more').addEventListener('click', loadMoreMerchandise);
  filterMerchandise('all');
});
</script>

<?= $this->endSection() ?>
