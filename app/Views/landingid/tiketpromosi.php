<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$promoHeroAsset = bxsea_design_asset('promotion', 'hero', 'assets/landing/image/bxsea_image_bg-ticket.png');
$promoGrassAsset = bxsea_design_asset('promotion', 'grass', 'assets/landing/image/bg-grass.png');
$promoTitle = bxsea_plain_text($promoheader[0]['masterdesc_title'] ?? 'PROMO SPESIAL');
$promoDesc = bxsea_plain_text($promoheader[0]['masterdesc_desc'] ?? 'Jangan lewatkan penawaran terbaru dari kami!');

function bxsea_clean_promotion_html(?string $html): string
{
  $content = (string) $html;
  $content = str_replace('discount 50%', 'diskon 50%', $content);
  $content = str_replace('tenant BXc Mall pilhan', 'tenant BXc Mall pilihan', $content);
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

<section class="Promotions promotions-page">
  <div class="container">
    <?php if (!empty($promo)): ?>
    <?php foreach ($promo as $idx => $pr): ?>
    <div class="row g-5 promotion-row mb-5">
      <div class="col-md-6 col-lg-4 col-xl-3 image-promotions">
        <img src="<?= bxsea_asset_url('promosi', $pr['promosi_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promosi_title'] ?? '');?>" class="img-fluid">
      </div>
      <div class="col-md-6 col-lg-8 col-xl-9">
        <div class="box-promotions">
          <div class="desc-promotions">
            <div class="title-promotions">
              <h1><?= esc($pr['promosi_title'] ?? '');?></h1>
            </div>
            <div class="body-promotions">
              <?= bxsea_render_html(bxsea_clean_promotion_html($pr['promosi_desc'] ?? '')) ?>
            </div>
            <?php if (!empty($pr['promosi_tnc'])): ?>
            <div class="btn-detail-promotions">
              <a href="#" class="promo-tnc-trigger" data-popup="promoPopup_<?= $pr['promosi_id']?>">SYARAT &amp; KETENTUAN</a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php if (!empty($pr['promosi_tnc'])): ?>
    <div class="promotion-popup-overlay" id="promoPopup_<?= $pr['promosi_id']?>" role="dialog" aria-modal="true" aria-label="Syarat &amp; Ketentuan">
      <div class="promotion-popup">
        <div class="promotion-popup-header">
          <h3><?= esc($pr['promosi_title'] ?? '');?></h3>
          <button type="button" class="promotion-popup-close promo-tnc-close" aria-label="Tutup">&times;</button>
        </div>
        <div class="promotion-popup-body">
          <div class="promotion-popup-poster">
            <img src="<?= bxsea_asset_url('promosi', $pr['promosi_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promosi_title'] ?? '');?>">
          </div>
          <div class="promotion-popup-content">
            <h4>Syarat &amp; Ketentuan</h4>
            <?= bxsea_render_html($pr['promosi_tnc'] ?? '') ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="text-center py-5"><p>Belum ada promosi saat ini.</p></div>
    <?php endif; ?>
  </div>
  <img class="grass-gray-rotate2" src="<?= base_url('assets/landing/');?>image/grass-gray.png" alt="">
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
