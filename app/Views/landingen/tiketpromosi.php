<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$promoHeroAsset = bxsea_design_asset('promotion', 'hero', 'assets/landing/image/banner/banner-promosi.png');
$promoShellAsset = bxsea_design_asset('promotion', 'shell', 'assets/landing/image/BXSea Asset plus-13 1.png');
$promoGrassAsset = bxsea_design_asset('promotion', 'grass', 'assets/landing/image/bg-grass.png');

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
      <div class="overlay-blue-bg-banner"></div>
        <div class="container">
          <div class="hero-image2">
            <img src="<?= $promoHeroAsset; ?>" alt="">
          </div>
            <div class="row descBanner padding-banner">
                <h1 class="banner-title">SPECIAL PROMOTIONS</h1>
                <p class="banner-description">Don't miss our latest offers.</p>
            </div>  
        </div>
    </div>
  </section>


  <section class="Promotions">
    <img class="kerang" src="<?= $promoShellAsset; ?>" alt="">
    <div class="container">
      <?php if (!empty($promo)): ?>
      <div class="row">
        <?php foreach ($promo as $pr): ?>
        <div class="col-lg-6 col-md-6 image-promotions mb-200">
          <img src="<?= bxsea_asset_url('promotion', $pr['promotion_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($pr['promotion_title_en'] ?? $pr['promotion_title'] ?? 'Promotion');?>">
        </div>
        <div class="col-lg-6 col-md-6 box-promotions">
          <div class="desc-promotions">
            <div class="title-promotions">
              <h1><?= esc($pr['promotion_title_en'] ?? $pr['promotion_title'] ?? '');?></h1>
            </div>
            <div class="body-promotions lato-font mb-200">
              <?= bxsea_render_html(bxsea_clean_promotion_html_en($pr['promotion_desc_en'] ?? ($pr['promotion_desc'] ?? ''))) ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <div class="text-center py-5"><p>No promotions are available right now.</p></div>
      <?php endif; ?>
    </div>
      <!-- <div class="footer-promotions">
              <a href="https://ticket.bxsea.co.id/">Pesan Sekarang</a>
            </div> -->
    <img class="grass17" src="<?= $promoGrassAsset; ?>" alt="">
  </section>
  <?= $this->endSection() ?>