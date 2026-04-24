<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$showHeroAsset = bxsea_design_asset('show', 'hero', 'assets/landing/image/bxsea_image_bg-show.png');
$showArrowAsset = bxsea_design_asset('show', 'arrow', 'assets/landing/image/arrow-right-blue.png');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $showHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1>PERTUNJUKAN</h1>
            <p><?= esc(bxsea_plain_text($showheader[0]['masterdesc_desc'] ?? 'Maksimalkan kunjungan Anda dengan menyaksikan pertunjukan-pertunjukan spektakuler kami!'));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ShowBXSea">
  <div class="container">
    <div class="title-detail-schoolpackage">
      <h1>Show Time!</h1>
    </div>
    <div class="showbx-filter-tabs">
      <button class="showbx-filter-tab active" data-showbx="regular">REGULAR SHOWS</button>
      <button class="showbx-filter-tab" data-showbx="seapecial">SEA-PECIAL SHOWS</button>
    </div>
    <div class="row">
      <?php foreach($show as $sh) { 
          $type = $sh['show_type'] ?? 'regular';
          $colClass = ($type === 'seapecial') ? 'col-lg-6' : 'col-lg-4';
        ?>
          <div class="<?= $colClass; ?> col-md-6 mb-200 box-show showbx-card"
              data-showbx="<?= esc($type); ?>">
            <div class="hand">
              <img 
                class="img-fluid hand-image" 
                src="<?= base_url('assets/upload/show/'.$sh['show_pict']);?>" 
                alt="<?= esc(bxsea_plain_text($sh['show_title_id'] ?? $sh['show_title'] ?? '')); ?>"
              >
              <div class="overlay-show">
                <div class="desc-ooverlay-show">

                  <div class="title-show">
                    <h2>
                      <?= esc(bxsea_plain_text($sh['show_title_id'] ?? $sh['show_title'] ?? '')); ?>
                    </h2>
                  </div>

                  <div class="desc-show">
                    <p>
                      <?= nl2br(esc(bxsea_plain_text($sh['show_desc_id'] ?? $sh['show_desc'] ?? ''))); ?>
                    </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    </div>
    <div class="btn-show">
      <a href="<?= base_url('/id/kunjungan/jadwal-aquarium');?>">Jadwal Pertunjukan <img class='arrow-right-btn-show' src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
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
// Initialize: show only regular by default
document.querySelectorAll('.showbx-card').forEach(function(card) {
  if (card.getAttribute('data-showbx') !== 'regular') card.style.display = 'none';
});
</script>

<?= $this->endSection() ?>
