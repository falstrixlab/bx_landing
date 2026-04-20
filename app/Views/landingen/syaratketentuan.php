<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<?php $termsTitle = bxsea_plain_text($legal[0]['masterlegal_title_en'] ?? '') ?: 'Terms and Conditions'; ?>
<section class="sectionBanner">       
    <div class="hero-wrap2">
        <div class="overlay-blue-bg-banner"></div>
        <div class="hero-image2">
          <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
        </div>
        <div class="title-merchandise descBanner2">
          <h1><?= esc($termsTitle) ?></h1>
        </div>
      </div>        
  </section>


  <section class="SK">
    <div class="container">
        <div class="maxwidth">
            <?= bxsea_render_html($legal[0]['masterlegal_desc_en'] ?? '')?>
        </div>
    </div>
    <img class="grass17" src="<?= base_url('assets/landing/');?>image/bg-grass.png" alt="">
  </section>
  <?= $this->endSection() ?>