<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<?php
$premiumHeroAsset = bxsea_design_asset('premium', 'hero', 'assets/landing/image/bxsea_image_bg-addons.png');
$premiumWaveAsset = bxsea_design_asset('premium', 'wave', 'assets/landing/image/wave-additional-exp-desc.png');
$premiumDurationIconAsset = bxsea_design_asset('premium', 'duration_icon', 'assets/landing/image/bxsea_icon_duration_add_ons.png');
$premiumTicketIconAsset = bxsea_design_asset('premium', 'ticket_icon', 'assets/landing/image/bxsea_icon_ticket_add_ons.png');
$premiumLocationIconAsset = bxsea_design_asset('premium', 'location_icon', 'assets/landing/image/bxsea_icon_location_add_ons.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset = bxsea_design_asset('visit', 'contact_card_email', 'assets/landing/image/sosmed3.png');

$premiumBannerTitle = 'PREMIUM EXPERIENCES';
$premiumIntroTitle = 'Explore More Than the Main Journey';
$premiumIntroDesc = 'Our oceanarium experiences are designed to spark curiosity and build a deeper connection between people and marine life. Discover a range of extra experiences created to be both educational and entertaining.';
$premiumNote = 'These experiences are not included in the main admission ticket and can only be purchased directly on-site.';

$normalizePremiumTextEn = static function (?string $value, ?string $fallback = null): string {
  $text = bxsea_plain_text($value ?: $fallback);
  $text = str_ireplace('Ons-site', 'On-site', $text);
  return trim($text);
};

$normalizePremiumTitleEn = static function (?string $value, ?string $fallback = null): string {
  $text = bxsea_plain_text($value ?: $fallback);
  if (strcasecmp($text, 'KELANAKAIA') === 0) {
    return 'KELANA KAIA';
  }
  return $text;
};
?>
<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $premiumHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title"><?= esc($premiumBannerTitle);?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="additional-experience-detail">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4">
        <div class="left-grid d-flex flex-column justify-content-between">
          <div class="box-typo-additional-experience-detail">
            <div class="title-additional-exp-detail">
              <h1><?= esc($premiumIntroTitle);?></h1>
            </div>
            <div class="desc-additional-exp-detail">
              <p><?= esc($premiumIntroDesc);?></p>
            </div>
          </div>
          <div class="notes-additional-experience-detail">
            <p><?= esc($premiumNote); ?></p>
          </div>
        </div>
      </div>
      <?php if (!empty($experience)): ?>
      <?php foreach ($experience as $exp): ?>
      <?php if (($exp['experience_status'] ?? '') != '0'): ?>
      <?php
        $experienceTitle = $normalizePremiumTitleEn($exp['experience_title_en'] ?? '', $exp['experience_title'] ?? '');
        $experienceDesc = $normalizePremiumTextEn($exp['experience_desc_en'] ?? '', $exp['experience_desc'] ?? '');
        $experienceDuration = $normalizePremiumTextEn($exp['experience_duration_en'] ?? '', $exp['experience_duration'] ?? '');
        $experienceSchedule = $normalizePremiumTextEn($exp['experience_schedule_en'] ?? '', $exp['experience_schedule'] ?? '');
        $experienceAudience = $normalizePremiumTextEn($exp['experience_age_en'] ?? '', $exp['experience_age'] ?? '');
        $experienceLink = trim((string) ($exp['experience_link'] ?? 'https://ticket.bxsea.co.id/group'));
        $priceValue = $exp['experience_price_en'] ?? $exp['experience_price'] ?? '';
        $priceLabel = is_numeric($priceValue) ? 'Rp ' . number_format((float) $priceValue, 0, ',', '.') : $normalizePremiumTextEn((string) $priceValue);
      ?>
      <div class="col-md-6 col-lg-4">
        <div class="box-additional-exp-detail">
          <div class="image-box-additional-exp-detail">
            <?php if (!empty($exp['experience_pict'])): ?>
            <img src="<?= bxsea_asset_url('experience', $exp['experience_pict'] ?? '', 'assets/landing/image/boat-tour-image.png');?>" alt="<?= esc($experienceTitle);?>">
            <?php else: ?>
            <img src="<?= $premiumHeroAsset; ?>" alt="<?= esc($experienceTitle);?>">
            <?php endif; ?>
            <div class="desc-box-additional-exp-detail">
              <img class="img-wave-additional-exp-detail" src="<?= $premiumWaveAsset; ?>" alt="">
              <div class="box-white">
                <h4><?= esc($experienceTitle);?></h4>
                <p><?= esc($experienceDesc);?></p>
                <?php if ($experienceDuration !== ''): ?>
                <div class="duration">
                  <img src="<?= $premiumDurationIconAsset; ?>" alt="">
                  <p>Duration: <?= esc($experienceDuration);?></p>
                </div>
                <?php endif; ?>
                <?php if ($priceLabel !== ''): ?>
                <div class="prize">
                  <img src="<?= $premiumTicketIconAsset; ?>" alt="">
                  <div class="time">
                    <div class="weekday">
                      <p>Price: <?= esc($priceLabel);?></p>
                    </div>
                    <?php if ($experienceSchedule !== ''): ?>
                    <div class="weekend">
                      <p><?= esc($experienceSchedule);?></p>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endif; ?>
                <?php if ($experienceAudience !== ''): ?>
                <div class="location">
                  <img src="<?= $premiumLocationIconAsset; ?>" alt="">
                  <p><?= esc($experienceAudience);?></p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="btn-ticket-add-ons">
            <a href="<?= esc($experienceLink);?>" target="_blank" rel="noopener noreferrer">Get BXSea Tickets Now</a>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2"><h1>Contact Us</h1></div>
    <div class="row box-contact">
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus2">
          <a href="<?= esc($setup[0]['setup_customer'] ?? '#');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactCustomerAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>Customer Services</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus2">
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $setup[0]['setup_phone'] ?? '');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactWhatsappAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>WhatsApp</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus2">
          <a href="mailto:<?= esc($setup[0]['setup_email'] ?? '');?>">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactEmailAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>Email</p></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
  <?= $this->endSection() ?>