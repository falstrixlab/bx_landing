<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$faqSharkAsset = bxsea_design_asset('visit', 'faq_shark', 'assets/landing/image/shark2.png');
$faqQuestionIconAsset = bxsea_design_asset('visit', 'faq_question_icon', 'assets/landing/image/Group 1171274846.svg');
$faqChevronAsset = bxsea_design_asset('visit', 'faq_chevron', 'assets/landing/image/icons8-chevron-down-24.png');
$faqWaveAsset = bxsea_design_asset('visit', 'faq_wave', 'assets/landing/image/wave-partnerships.png');
$faqHeroAsset = bxsea_design_asset('visit', 'hero_contact', 'assets/landing/image/bxsea_image_bg-tenant.png');
?>

<section class="sectionBanner">
  <img class="shark3" src="<?= $faqSharkAsset; ?>" alt="">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $faqHeroAsset; ?>" alt="">
    </div>
    <div class="row descBanner padding-banner">
      <h1 class="banner-title"><?= esc(bxsea_plain_text($faqdesc[0]['masterdesc_title'] ?? ''));?></h1>
      <p class="banner-description"><?= esc(bxsea_plain_text($faqdesc[0]['masterdesc_desc'] ?? ''));?></p>
    </div>
  </div>
</section>

<section class="FAQs">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (!empty($faqgeneral)): ?>
        <div class="title-question"><h1>Most Frequently Asked Questions</h1></div>
        <?php foreach ($faqgeneral as $idx => $fq): ?>
        <div class="faq <?= $idx === 0 ? 'active' : ''; ?>">
          <div class="question">
            <div class="header-question">
              <h4><?= esc(bxsea_plain_text($fq['faq_title_en'] ?? ($fq['faq_title'] ?? '')));?></h4>
            </div>
            <img class="arrow" src="<?= $faqChevronAsset; ?>" alt="">
          </div>
          <div class="answer">
            <hr>
            <p><?= esc(bxsea_plain_text($fq['faq_desc_en'] ?? ($fq['faq_desc'] ?? '')));?></p>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($faqother)): ?>
        <div class="title-question"><h1>Ticket Information</h1></div>
        <?php foreach ($faqother as $fq): ?>
        <div class="faq">
          <div class="question">
            <div class="header-question">
              <h4><?= esc(bxsea_plain_text($fq['faq_title_en'] ?? ($fq['faq_title'] ?? '')));?></h4>
            </div>
            <img class="arrow" src="<?= $faqChevronAsset; ?>" alt="">
          </div>
          <div class="answer">
            <hr>
            <p><?= esc(bxsea_plain_text($fq['faq_desc_en'] ?? ($fq['faq_desc'] ?? '')));?></p>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($faqfacility)): ?>
        <div class="title-question"><h1>Visitors and Facilities</h1></div>
        <?php foreach ($faqfacility as $fq): ?>
        <div class="faq">
          <div class="question">
            <div class="header-question">
              <h4><?= esc(bxsea_plain_text($fq['faq_title_en'] ?? ($fq['faq_title'] ?? '')));?></h4>
            </div>
            <img class="arrow" src="<?= $faqChevronAsset; ?>" alt="">
          </div>
          <div class="answer">
            <hr>
            <p><?= esc(bxsea_plain_text($fq['faq_desc_en'] ?? ($fq['faq_desc'] ?? '')));?></p>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<section class="Partnership">
  <img class="wave-partnerships" src="<?= $faqWaveAsset; ?>" alt="">
  <div class="box-partnerships">
    <div class="container">
      <div class="title-partnerships">
        <h1>Belum menemukan jawaban yang Anda cari?</h1>
      </div>
      <div class="desc-partnerships">
        <p>Jika pertanyaan Anda belum terjawab, silahkan kirim email kepada kami di <?= esc($setup[0]['setup_email'] ?? 'info.bxsea@jayarealproperty.com');?> atau hubungi kami di <?= esc($setup[0]['setup_phone'] ?? '+62 21 38897770');?>. Kami akan dengan senang hati membantu Anda.</p>
      </div>
      <div class="btn-partnerships">
        <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami <img class="arrow-right-btn-partnerships" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
