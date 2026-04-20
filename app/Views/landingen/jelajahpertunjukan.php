<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">
    <div class="hero-wrap2">
      <div class="overlay-darkblue-bg-banner"></div>
      <div class="hero-image2">
        <img src="<?= base_url('assets/landing/');?>image/banner-show.png" alt="">
      </div>
      <div class="container">
          <div class="row descBanner2">
             <div class="col-lg-12 box-premium">
                <div class="desc-premium">
                  <h1 class="banner-title"><?= esc(bxsea_plain_text($showheader[0]['masterdesc_title_en'] ?? 'SHOW TIME'));?></h1>
                  <p><?= esc(bxsea_plain_text($showheader[0]['masterdesc_desc_en'] ?? ''));?></p>
                </div>
             </div>
          </div>  
      </div>
    </div>
  </section>


  <img class="bg-guide2" src="<?= base_url('assets/landing/');?>image/Rectangle 19546.png" alt="">


  <section class="ShowBXSea">
    <img class="akar5" src="<?= base_url('assets/landing/');?>image/akar 1.png" alt="">
    <img class="akar6" src="<?= base_url('assets/landing/');?>image/akar 1.png" alt="">
    <div class="container">
      <div class="title-detail-schoolpackage">
        <img class="fox2" src="<?= base_url('assets/landing/');?>image/fox.png" alt="">
        <h1>Show Time!</h1>
      </div>
      <div class="showbx-filter-tabs">
        <button class="showbx-filter-tab active" data-showbx="regular">REGULAR SHOWS</button>
        <button class="showbx-filter-tab" data-showbx="seapecial">SEA-PECIAL SHOWS</button>
      </div>
      <div class="row">
        <?php foreach($show AS $sh) {?>
        <div class="col-lg-4 col-md-6 mb-200 box-show showbx-card" data-showbx="<?= esc($sh['show_type'] ?? 'regular');?>">
          <div class="hand">
            <img class="img-fluid hand-image" src="<?= base_url('assets/upload/show/'.$sh['show_pict']);?>" alt="<?= esc($sh['show_title_en'] ?? '');?>">
            <div class="overlay-show">
              <div class="desc-ooverlay-show">
                <div class="title-show">
                  <h2><?= esc($sh['show_title_en'] ?? $sh['show_title'] ?? '');?></h2>
                </div>
                <div class="desc-show">
                  <p><?= esc(bxsea_plain_text($sh['show_desc_en'] ?? $sh['show_desc'] ?? ''));?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="title-hand">
            <h1><?= esc($sh['show_title_en'] ?? $sh['show_title'] ?? '');?></h1>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="download-map">
        <a href="<?= base_url('en/kunjungan/jadwal-aquarium');?>">Show Schedule</a>
      </div>
    </div>
  </section>

<script>
document.querySelectorAll('.showbx-filter-tab').forEach(function(btn) {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.showbx-filter-tab').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
    var filter = btn.getAttribute('data-showbx');
    document.querySelectorAll('.showbx-card').forEach(function(card) {
      card.style.display = (filter === 'all' || card.getAttribute('data-showbx') === filter) ? '' : 'none';
    });
  });
});
document.querySelectorAll('.showbx-card').forEach(function(card) {
  if (card.getAttribute('data-showbx') !== 'regular') card.style.display = 'none';
});
</script>

  <?= $this->endSection() ?>