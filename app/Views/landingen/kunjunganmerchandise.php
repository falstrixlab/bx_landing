<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<?php
$merchHeroAsset = bxsea_design_asset('merchandise', 'hero', 'assets/landing/image/bxsea_image_bg-tenant.png');
$merchTitle = 'Take Home BXSea Merchandise';
$merchDesc = 'Bring your BXSea adventure home with our official merchandise collection. Discover memorable keepsakes that let every visit stay with you a little longer.';
?>

<section class="sectionBanner">       
    <div class="hero-wrap2">
        <div class="hero-image2">
          <img src="<?= $merchHeroAsset; ?>" alt="">
        </div>
        <div class="title-merchandise descBanner2">
        <h1><?= esc(bxsea_plain_text($merchandiseheader[0]['masterdesc_title_en'] ?? ''));?></h1>
        </div>
      </div>        
  </section>


  <section class="Merchandise">
    <div class="container">
      <div class="title-merchandise2">
        <h1><?= esc(bxsea_plain_text($merchandisedesc[0]['masterdesc_title_en'] ?? ''));?></h1>
        <p><?= esc(bxsea_plain_text($merchandisedesc[0]['masterdesc_desc_en'] ?? ''));?></p>
      </div>



      <section id="Filter">
        <div class="row">
          <div class="box-category-merchan">
            <div class="category-merchan">
              <p>Category</p>
              <img src="<?= base_url('assets/landing/');?>image/icons8-chevron-down-24-black.png" alt="">
            </div>
          </div>
          <div class="col-lg-8 indicator-merchan-web">
            <a href="#" class="button active" data-filter="all">All items</a>
            <?php foreach($mercat AS $cat) {?>
              <a href="#" class="button" data-filter="cat-<?= (int) $cat['merchandisecat_id'];?>"><?= esc($cat['merchandisecat_name_en'] ?? ($cat['merchandisecat_name'] ?? 'Category'))?>
              </a>
            <?php }?>
          </div>
          <p class="text-merchan-center">Purchases can only be made directly at the official BXSea merchandise store.</p>
        </div>
            
        <div class="row box-center box-merchandise-card" id="merchandise-grid">
          <?php foreach($merchandise AS $mr) {?>
          <div class="col-lg-3 col-md-4 work-item mb-200" data-item="cat-<?= (int) ($mr['merchandise_category'] ?? 0);?>">
            <div class="items-owlmerchandise">
              <div class="image-merchandise">
                <img src="<?= bxsea_asset_url('merchandise', $mr['merchandise_pict'] ?? '', 'assets/landing/image/produk-merchan.png');?>" alt="<?= esc($mr['merchandise_title_en'] ?? ($mr['merchandise_title'] ?? ''));?>">
              </div>
              <div class="title-merchan">
                <h3><?= esc($mr['merchandise_title_en'] ?? ($mr['merchandise_title'] ?? ''))?></h3>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="download-merchan">
            <button class="btn-more" id="btn-load-more" type="button">View More</button>
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
  document.querySelectorAll('#Filter .button').forEach(function(button) {
    button.classList.toggle('active', button.getAttribute('data-filter') === filter);
  });
  loadMoreMerchandise();
}

function loadMoreMerchandise() {
  var items = Array.from(document.querySelectorAll('#merchandise-grid .work-item')).filter(function(item) {
    return currentFilter === 'all' || item.getAttribute('data-item') === currentFilter;
  });
  var nextBatch = items.slice(currentShown, currentShown + itemsPerPage);
  nextBatch.forEach(function(item) {
    item.style.display = '';
  });
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