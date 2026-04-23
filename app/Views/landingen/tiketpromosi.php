<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$promoHeroAsset = bxsea_design_asset('promotion', 'hero', 'assets/landing/image/banner/banner-promosi.png');
$promoGrassAsset = bxsea_design_asset('promotion', 'grass', 'assets/landing/image/bg-grass.png');
$promoTitle = bxsea_plain_text($promoheader[0]['masterdesc_title_en'] ?? 'PROMO SPESIAL');
$promoDesc = bxsea_plain_text($promoheader[0]['masterdesc_desc_en'] ?? 'Jangan lewatkan penawaran terbaru dari kami!');

function bxsea_clean_promotion_html_en(?string $html): string
{
  $content = (string) $html;
  $content = preg_replace('/<p[^>]*>.*?Would you like me to help you draft a catchy social media caption for this promo\?.*?<\/p>/is', '', $content) ?? $content;
  $content = preg_replace('/<p>\s*<\/p>/i', '', $content) ?? $content;

  return trim($content);
}
?>

<section class="sectionBanner">
    <div class="hero-wrap2">
        <div class="container">
          <div class="hero-image2">
            <img src="<?= $promoHeroAsset; ?>" alt="">
          </div>
            <div class="row descBanner padding-banner">
              <h1 class="banner-title"><?= esc($promoTitle); ?></h1>
              <p class="banner-description"><?= esc($promoDesc); ?></p>
            </div>  
        </div>
    </div>
  </section>


  <section class="Promotions">
    <div class="container">
      <?php if (!empty($promo)): ?>
      <?php foreach ($promo as $pr): ?>
      <div class="row g-5 promotion-row mb-5">
        <div class="col-md-6 col-lg-4 col-xl-3 image-promotions">
          <img src="<?= bxsea_asset_url('promosi', $pr['promosi_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promosi_title_en'] ?? $pr['promosi_title'] ?? 'Promotion');?>" class="img-fluid">
        </div>
        <div class="col-md-6 col-lg-8 col-xl-9">
          <div class="box-promotions">
            <div class="desc-promotions">
              <div class="title-promotions">
                <h1><?= esc($pr['promosi_title_en'] ?? $pr['promosi_title'] ?? '');?></h1>
              </div>
              <div class="body-promotions lato-font mb-200">
                <?= bxsea_render_html(bxsea_clean_promotion_html_en($pr['promosi_desc_en'] ?? ($pr['promosi_desc'] ?? ''))) ?>
              </div>
              <?php $tnc = $pr['promosi_tnc_en'] ?? ($pr['promosi_tnc'] ?? ''); ?>
              <?php if (!empty($tnc)): ?>
              <div class="btn-detail-promotions">
                <a href="#" class="promo-tnc-trigger" data-popup="promoPopup_<?= $pr['promosi_id']?>">TERMS &amp; CONDITIONS</a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php if (!empty($tnc)): ?>
      <div class="promotion-popup-overlay" id="promoPopup_<?= $pr['promosi_id']?>" role="dialog" aria-modal="true" aria-label="Terms &amp; Conditions">
        <div class="promotion-popup">
          <div class="promotion-popup-header">
            <h3><?= esc($pr['promosi_title_en'] ?? $pr['promosi_title'] ?? '');?></h3>
            <button type="button" class="promotion-popup-close promo-tnc-close" aria-label="Close">&times;</button>
          </div>
          <div class="promotion-popup-body">
            <div class="promotion-popup-poster">
              <img src="<?= bxsea_asset_url('promosi', $pr['promosi_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promosi_title_en'] ?? $pr['promosi_title'] ?? '');?>">
            </div>
            <div class="promotion-popup-content">
              <h4>Terms &amp; Conditions</h4>
              <?= bxsea_render_html($tnc) ?>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="text-center py-5"><p>No promotions are available right now.</p></div>
      <?php endif; ?>
      <img class="grass-gray-rotate2" src="<?= base_url('assets/landing/');?>image/grass-gray.png" alt="">
    </div>
  </section>
  <?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(function () {
  function openPopup(id) {
    var el = document.getElementById(id);
    if (el) { el.classList.add('is-active'); document.body.classList.add('no-scroll'); }
  }
  function closePopup(el) {
    el.classList.remove('is-active');
    document.body.classList.remove('no-scroll');
  }
  document.addEventListener('click', function (e) {
    var trigger = e.target.closest('.promo-tnc-trigger');
    if (trigger) { e.preventDefault(); openPopup(trigger.dataset.popup); return; }
    var closeBtn = e.target.closest('.promo-tnc-close');
    if (closeBtn) { closePopup(closeBtn.closest('.promotion-popup-overlay')); return; }
    if (e.target.classList.contains('promotion-popup-overlay')) { closePopup(e.target); }
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.promotion-popup-overlay.is-active').forEach(function (el) { closePopup(el); });
    }
  });
}());
</script>
<?= $this->endSection() ?>