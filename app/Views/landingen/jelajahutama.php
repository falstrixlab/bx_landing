<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$journeyHeroAsset = bxsea_design_asset('journey', 'hero', 'assets/landing/image/bxsea_image_bg-mainjourney.png');
$journeyBadgeAsset = bxsea_design_asset('journey', 'badge', 'assets/landing/image/img-animal-focus.png');
$journeyWaveAsset = bxsea_design_asset('journey', 'wave', 'assets/landing/image/wave-additional-exp-desc.png');
$journeyArrowAsset = bxsea_design_asset('journey', 'arrow', 'assets/landing/image/arrow-right-mainjourney.png');
$additionalJourneys = array_values(array_filter($journey ?? [], fn($j) => in_array((string)($j['journey_zone'] ?? ''), ['19', '20'])));
$mainJourneys = array_values(array_filter($journey ?? [], fn($j) => !in_array((string)($j['journey_zone'] ?? ''), ['19', '20'])));
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $journeyHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title"><?= esc(bxsea_plain_text($journeyheader[0]['masterdesc_title_en'] ?? 'MAIN JOURNEY'));?></h1>
            <p><?= esc(bxsea_plain_text($journeyheader[0]['masterdesc_desc_en'] ?? ''));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container explore-mainjourney-section">
  <div class="badge"><img src="<?= $journeyBadgeAsset; ?>" alt=""></div>
  <h2 class="title">Explore Our Zones</h2>
  <p class="subtitle">Journey through our zones to experience the various wildlife habitats around the world!</p>
  <div class="owl-carousel owl-theme explore-mainjourney-carousel">
    <?php if(!empty($maincarousel)): ?>
    <?php foreach($maincarousel AS $mc): ?>
    <div class="card">
      <img src="<?= bxsea_asset_url('maincarousel', $mc['carousel_image']??'', 'assets/landing/image/bxsea_image_journey_zone1.png');?>" alt="<?= esc($mc['carousel_title_en']??'');?>" />
      <div class="info-box">
        <h3><?= esc(bxsea_plain_text($mc['carousel_title_en']??''));?></h3>
        <?php if(!empty($mc['carousel_zone'])): ?><span class="zone">ZONE: <?= esc($mc['carousel_zone']);?></span><?php endif; ?>
        <p><?= esc(bxsea_plain_text($mc['carousel_desc_en']??''));?></p>
      </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <?php foreach($journey AS $jn): ?>
    <div class="card">
      <img src="<?= bxsea_asset_url('journey', $jn['journey_animal_pict'] ?? ($jn['journey_pict'] ?? ''), 'assets/landing/image/bxsea_image_journey_zone1.png');?>" alt="<?= esc($jn['journey_title_en'] ?? '');?>" />
      <div class="info-box">
        <h3><?= esc(bxsea_plain_text($jn['journey_title_en'] ?? ''));?></h3>
        <?php if(!empty($jn['journey_zone'])): ?><span class="zone">ZONE: <?= esc($jn['journey_zone']);?></span><?php endif; ?>
        <p><?= esc(bxsea_plain_text($jn['journey_desc_en'] ?? ($jn['journey_desc'] ?? '')));?></p>
      </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<section class="journey-zone">
  <div class="container">
    <div class="row gy-4" id="journeyZoneGrid">
      <?php foreach($mainJourneys AS $jn): ?>
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="box-journey-zone"
             data-title="<?= esc(bxsea_plain_text($jn['journey_title_en']??($jn['journey_title']??'')));?>"
             data-zone="<?= esc($jn['journey_zone']??'');?>"
             data-desc="<?= esc(bxsea_plain_text($jn['journey_desc_en']??($jn['journey_desc']??'')));?>"
             data-img="<?= bxsea_asset_url('journey', $jn['journey_pict']??'', 'assets/landing/image/bxsea_image_journey_zone1.png');?>"
             data-popup-desc="<?= esc(bxsea_plain_text($jn['journey_popup_desc_en']??($jn['journey_popup_desc_id']??'')));?>"
             data-popup-pict1="<?= !empty($jn['journey_popup_pict1']) ? bxsea_asset_url('journey', $jn['journey_popup_pict1'], '') : '';?>"
             data-popup-pict1-label="<?= esc($jn['journey_popup_pict1_label_en']??($jn['journey_popup_pict1_label_id']??''));?>"
             data-popup-pict2="<?= !empty($jn['journey_popup_pict2']) ? bxsea_asset_url('journey', $jn['journey_popup_pict2'], '') : '';?>"
             data-popup-pict2-label="<?= esc($jn['journey_popup_pict2_label_en']??($jn['journey_popup_pict2_label_id']??''));?>">
          <div class="image-box-journey-zone">
            <img src="<?= bxsea_asset_url('journey', $jn['journey_pict'] ?? '', 'assets/landing/image/bxsea_image_journey_zone1.png');?>" alt="<?= esc($jn['journey_title_en'] ?? '');?>">
            <div class="desc-box-journey-zone">
              <img class="img-wave-journey-zone" src="<?= $journeyWaveAsset; ?>" alt="">
              <div class="box-white">
                <?php if(!empty($jn['journey_zone'])): ?><span>ZONE <?= esc($jn['journey_zone']);?></span><?php endif; ?>
                <h4><?= esc(bxsea_plain_text($jn['journey_title_en'] ?? ($jn['journey_title'] ?? '')));?></h4>
                <p><?= esc(bxsea_plain_text($jn['journey_desc_en'] ?? ($jn['journey_desc'] ?? '')));?></p>
              </div>
            </div>
          </div>
          <div class="btn-detail-journey-zone">
            <a href="#"><img src="<?= $journeyArrowAsset; ?>" alt=""></a>
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
        <?php foreach ($additionalJourneys as $jn): ?>
        <div class="box-journey-zone box-journey-zone-additional"
             data-title="<?= esc(bxsea_plain_text($jn['journey_title_en']??($jn['journey_title']??'')));?>"
             data-zone="<?= esc($jn['journey_zone']??'');?>"
             data-desc="<?= esc(bxsea_plain_text($jn['journey_desc_en']??($jn['journey_desc']??'')));?>"
             data-img="<?= bxsea_asset_url('journey', $jn['journey_pict']??'', 'assets/landing/image/behind-the-sea-image.png');?>"
             data-popup-desc="<?= esc(bxsea_plain_text($jn['journey_popup_desc_en']??($jn['journey_popup_desc_id']??'')));?>"
             data-popup-pict1="<?= !empty($jn['journey_popup_pict1']) ? bxsea_asset_url('journey', $jn['journey_popup_pict1'], '') : '';?>"
             data-popup-pict1-label="<?= esc($jn['journey_popup_pict1_label_en']??($jn['journey_popup_pict1_label_id']??''));?>"
             data-popup-pict2="<?= !empty($jn['journey_popup_pict2']) ? bxsea_asset_url('journey', $jn['journey_popup_pict2'], '') : '';?>"
             data-popup-pict2-label="<?= esc($jn['journey_popup_pict2_label_en']??($jn['journey_popup_pict2_label_id']??''));?>">
          <div class="image-box-journey-zone">
            <img src="<?= bxsea_asset_url('journey', $jn['journey_pict'] ?? '', 'assets/landing/image/behind-the-sea-image.png');?>" alt="<?= esc($jn['journey_title_en'] ?? ($jn['journey_title'] ?? ''));?>">
            <div class="desc-box-journey-zone">
              <img class="img-wave-journey-zone" src="<?= $journeyWaveAsset; ?>" alt="">
              <div class="box-white">
                <?php if(!empty($jn['journey_zone'])): ?><span>ZONE <?= esc($jn['journey_zone']);?></span><?php endif; ?>
                <h4><?= esc(bxsea_plain_text($jn['journey_title_en'] ?? ($jn['journey_title'] ?? '')));?></h4>
                <p><?= esc(bxsea_plain_text($jn['journey_desc_en'] ?? ($jn['journey_desc'] ?? '')));?></p>
              </div>
            </div>
          </div>
          <div class="btn-detail-journey-zone">
            <a href="#"><img src="<?= $journeyArrowAsset; ?>" alt=""></a>
          </div>
        </div>
        <?php endforeach; ?>
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
    var title = card.dataset.title || 'Journey Zone';
    var zone = card.dataset.zone || '';
    var description = card.dataset.desc || '';
    var imgSrc = card.dataset.img || '';
    var popupDesc = card.dataset.popupDesc || description;
    var pict1 = card.dataset.popupPict1 || '';
    var pict1Label = card.dataset.popupPict1Label || title;
    var pict2 = card.dataset.popupPict2 || '';
    var pict2Label = card.dataset.popupPict2Label || '';
    var normalizedZone = zone ? 'ZONE: ' + zone.replace(/^zone\s*/i,'') : '';
    titleEl.textContent = title;
    zoneEl.textContent = normalizedZone;
    descEl.textContent = popupDesc.trim();
    var gridHtml = '';
    if (pict1) {
      gridHtml += '<div class="journey-zone-modal-find-card"><img src="' + pict1 + '" alt="' + pict1Label + '"><p>' + pict1Label + '</p></div>';
    } else if (imgSrc) {
      gridHtml += '<div class="journey-zone-modal-find-card"><img src="' + imgSrc + '" alt="' + title + '"><p>' + title + '</p></div>';
    }
    if (pict2) {
      gridHtml += '<div class="journey-zone-modal-find-card"><img src="' + pict2 + '" alt="' + pict2Label + '"><p>' + pict2Label + '</p></div>';
    }
    findGridEl.innerHTML = gridHtml;
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