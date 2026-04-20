<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$promoHeroAsset = bxsea_design_asset('promotion', 'hero', 'assets/landing/image/bxsea_image_bg-ticket.png');
$promoShellAsset = bxsea_design_asset('promotion', 'shell', 'assets/landing/image/BXSea Asset plus-13 1.png');
$promoGrassAsset = bxsea_design_asset('promotion', 'grass', 'assets/landing/image/bg-grass.png');

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
    <div class="overlay-blue-bg-banner"></div>
    <div class="container">
      <div class="hero-image2">
        <img src="<?= $promoHeroAsset; ?>" alt="">
      </div>
      <div class="row descBanner padding-banner">
        <h1 class="banner-title">PROMO SPESIAL</h1>
        <p class="banner-description">Jangan lewatkan penawaran terbaru dari kami!</p>
      </div>
    </div>
  </div>
</section>

<section class="Promotions">
  <img class="kerang" src="<?= $promoShellAsset; ?>" alt="">
  <div class="container">
    <?php if (!empty($promo)): ?>
    <?php foreach ($promo as $idx => $pr): ?>
    <div class="row g-5 promotion-row mb-5">
      <div class="col-lg-4 col-md-6 image-promotions">
        <img src="<?= bxsea_asset_url('promotion', $pr['promotion_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promotion_title'] ?? '');?>" class="img-fluid">
      </div>
      <div class="col-lg-8">
        <div class="box-promotions">
          <div class="desc-promotions">
            <div class="title-promotions">
              <h1><?= esc($pr['promotion_title'] ?? '');?></h1>
            </div>
            <div class="body-promotions lato-font mb-200">
              <?= bxsea_render_html(bxsea_clean_promotion_html($pr['promotion_desc'] ?? '')) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="text-center py-5"><p>Belum ada promosi saat ini.</p></div>
    <?php endif; ?>
  </div>
  <img class="grass17" src="<?= $promoGrassAsset; ?>" alt="">
</section>

<?= $this->endSection() ?>
