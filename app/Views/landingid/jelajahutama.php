<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$journeyHeroAsset = bxsea_design_asset('journey', 'hero', 'assets/landing/image/bxsea_image_bg-mainjourney.png');
$journeyBadgeAsset = bxsea_design_asset('journey', 'badge', 'assets/landing/image/img-animal-focus.png');
$journeyWaveAsset = bxsea_design_asset('journey', 'wave', 'assets/landing/image/wave-additional-exp-desc.png');
$journeyArrowAsset = bxsea_design_asset('journey', 'arrow', 'assets/landing/image/arrow-right-mainjourney.png');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="overlay-blue-bg-banner"></div>
    <div class="hero-image2">
      <img src="<?= $journeyHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title"><?= esc(bxsea_plain_text($journeyheader[0]['masterdesc_title'] ?? 'JOURNEY UTAMA'));?></h1>
            <p><?= esc(bxsea_plain_text($journeyheader[0]['masterdesc_desc'] ?? ''));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container explore-mainjourney-section">
  <div class="badge"><img src="<?= $journeyBadgeAsset; ?>" alt=""></div>
  <h2 class="title">Jelajahi Zona Kami</h2>
  <p class="subtitle">Jelajahi berbagai zona kami dan rasakan pengalaman mengunjungi beragam habitat biota dari seluruh dunia!</p>
  <div class="owl-carousel owl-theme explore-mainjourney-carousel">
    <?php foreach($journey AS $jn): ?>
    <div class="card">
      <img src="<?= bxsea_asset_url('journey', $jn['journey_animal_pict'] ?? ($jn['journey_pict'] ?? ''), 'assets/landing/image/bxsea_image_journey_zone1.png');?>" alt="<?= esc($jn['journey_title'] ?? '');?>" />
      <div class="info-box">
        <h3><?= esc(bxsea_plain_text($jn['journey_title'] ?? ''));?></h3>
        <?php if(!empty($jn['journey_zone'])): ?><span class="zone">ZONA: <?= esc($jn['journey_zone']);?></span><?php endif; ?>
        <p><?= esc(bxsea_plain_text($jn['journey_desc'] ?? ''));?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="journey-zone">
  <div class="container">
    <div class="row gy-4" id="journeyZoneGrid">
      <?php foreach($journey AS $jn): ?>
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="box-journey-zone">
          <div class="image-box-journey-zone">
            <img src="<?= bxsea_asset_url('journey', $jn['journey_pict'] ?? '', 'assets/landing/image/bxsea_image_journey_zone1.png');?>" alt="<?= esc($jn['journey_title'] ?? '');?>">
            <div class="desc-box-journey-zone">
              <img class="img-wave-journey-zone" src="<?= $journeyWaveAsset; ?>" alt="">
              <div class="box-white">
                <?php if(!empty($jn['journey_zone'])): ?><span>ZONE <?= esc($jn['journey_zone']);?></span><?php endif; ?>
                <h4><?= esc(bxsea_plain_text($jn['journey_title'] ?? ''));?></h4>
                <p><?= esc(bxsea_plain_text($jn['journey_desc'] ?? ''));?></p>
              </div>
            </div>
          </div>
          <div class="btn-detail-journey-zone">
            <a href="#javascript"><img src="<?= $journeyArrowAsset; ?>" alt=""></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="btn-load-more">View All</div>
  <div class="container">
    <div class="additional-journey-zone">
      <div class="left-grid">
        <div class="title">
          <p>Additional Zones</p>
        </div>
      </div>
      <div class="right-grid">
        <div class="box-journey-zone box-journey-zone-additional">
          <div class="image-box-journey-zone">
            <img src="<?= bxsea_design_asset('journey', 'behind_the_sea_pict', 'assets/landing/image/behind-the-sea-image.png');?>" alt="Behind The Sea">
            <div class="desc-box-journey-zone">
              <img class="img-wave-journey-zone" src="<?= $journeyWaveAsset; ?>" alt="">
              <div class="box-white">
                <span>ZONE 19</span>
                <h4>Behind The Sea</h4>
                <p>Program Behind The Sea kami membawa Anda lebih dekat dengan dunia bawah air! Pengunjung akan mendapatkan akses eksklusif untuk melihat sisi lain dari BXSea. Mulai dari karantina biota dan Life Support System akuarium, hingga persiapan makanan dan laboratorium kualitas air puaskan rasa ingin tahu Anda untuk melihat cara kerja internal di balik megahnya BXSea</p>
              </div>
            </div>
          </div>
          <div class="btn-detail-journey-zone">
            <a href="#javascript"><img src="<?= $journeyArrowAsset; ?>" alt=""></a>
          </div>
        </div>
        <div class="box-journey-zone box-journey-zone-additional">
          <div class="image-box-journey-zone">
            <img src="<?= bxsea_design_asset('journey', 'boat_tour_pict', 'assets/landing/image/boat-tour-image.png');?>" alt="Boat Tour">
            <div class="desc-box-journey-zone">
              <img class="img-wave-journey-zone" src="<?= $journeyWaveAsset; ?>" alt="">
              <div class="box-white">
                <span>ZONE 20</span>
                <h4>Boat Tour</h4>
                <p>Lihat lebih dekat biota kami tepat dari atas permukaan air! Ikuti Education Guide kami yang berpengalaman menyusuri rute sepanjang 80 meter yang mengelilingi Akuarium Utama (Main Tank), sambil mempelajari rahasia dunia bawah laut. Jangan lewatkan juga kesempatan untuk memberi makan ikan-ikan kami!</p>
              </div>
            </div>
          </div>
          <div class="btn-detail-journey-zone">
            <a href="#javascript"><img src="<?= $journeyArrowAsset; ?>" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="journey-zone-modal-overlay" id="journeyZoneModal" aria-hidden="true">
  <div class="journey-zone-modal" role="dialog" aria-modal="true" aria-labelledby="journeyZoneModalTitle">
    <img class="img-border-corner" src="<?= base_url('assets/landing/');?>image/border-corner-popup-journey.png" alt="">
    <button type="button" class="journey-zone-modal-close" id="closeJourneyZoneModal" aria-label="Close modal">×</button>
    <div class="journey-zone-modal-body">
      <div class="journey-zone-modal-intro">
        <div class="journey-zone-modal-intro-left">
          <h4 id="journeyZoneModalTitle">Sea Wave</h4>
          <span id="journeyZoneModalZone">ZONE: 1</span>
        </div>
        <div class="journey-zone-modal-intro-right">
          <p id="journeyZoneModalDesc"></p>
          <div class="journey-zone-modal-find">
            <h5>WHAT CAN I FIND?</h5>
            <div class="journey-zone-modal-find-grid" id="journeyZoneModalFindGrid"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var modal = document.getElementById('journeyZoneModal');
  var closeBtn = document.getElementById('closeJourneyZoneModal');
  var cards = document.querySelectorAll('.box-journey-zone');
  if (!modal || !closeBtn || !cards.length) return;
  var titleEl = document.getElementById('journeyZoneModalTitle');
  var zoneEl = document.getElementById('journeyZoneModalZone');
  var descEl = document.getElementById('journeyZoneModalDesc');
  var findGridEl = document.getElementById('journeyZoneModalFindGrid');

  function openModal() { modal.classList.add('is-active'); modal.setAttribute('aria-hidden','false'); document.body.classList.add('no-scroll'); }
  function closeModal() { modal.classList.remove('is-active'); modal.setAttribute('aria-hidden','true'); document.body.classList.remove('no-scroll'); }

  function setModalContent(card) {
    var titleNode = card.querySelector('.box-white h4');
    var zoneNode = card.querySelector('.box-white span');
    var descNode = card.querySelector('.box-white p');
    var imgNode = card.querySelector('.image-box-journey-zone > img');
    var title = titleNode ? titleNode.textContent : 'Journey Zone';
    var zone = zoneNode ? zoneNode.textContent : 'ZONE';
    var description = descNode ? descNode.textContent : '';
    var imgSrc = imgNode ? imgNode.getAttribute('src') : '';
    var zoneMatch = zone.match(/\d+/);
    var normalizedZone = zoneMatch ? 'ZONE: ' + zoneMatch[0] : zone;
    titleEl.textContent = title;
    zoneEl.textContent = normalizedZone;
    descEl.textContent = description.trim();
    findGridEl.innerHTML = '<div class="journey-zone-modal-find-card"><img src="' + imgSrc + '" alt="' + title + '"><p>' + title + '</p></div>';
  }

  cards.forEach(function(card) {
    card.addEventListener('click', function(e) {
      var link = e.target.closest('a');
      if (link) e.preventDefault();
      setModalContent(card);
      openModal();
    });
  });

  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
});
</script>

<?= $this->endSection(); ?>