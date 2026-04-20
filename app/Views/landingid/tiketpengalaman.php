<?= $this->extend('landingid/landingbase') ?>
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

$normalizePremiumText = static function (?string $value): string {
  $text = bxsea_plain_text($value);
  $text = str_ireplace('Ons-site', 'On-site', $text);
  return trim($text);
};

$normalizePremiumTitle = static function (?string $value): string {
  $text = bxsea_plain_text($value);
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
            <h1 class="banner-title"><?= esc(bxsea_plain_text($premiumheader[0]['masterdesc_title'] ?? 'PENGALAMAN TAMBAHAN'));?></h1>
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
              <h1><?= esc(bxsea_plain_text($premiumheader[0]['masterdesc_title'] ?? 'Jelajahi Lebih dari Sekedar Journey Utama'));?></h1>
            </div>
            <div class="desc-additional-exp-detail">
              <p><?= esc(bxsea_plain_text($premiumdesc[0]['masterdesc_desc'] ?? 'Tujuan Oceanarium kami adalah untuk menginspirasi rasa ingin tahu dan membangun ikatan antara manusia dan satwa. Temukan berbagai pengalaman tambahan yang dirancang khusus untuk mengedukasi sekaligus menghibur!'));?></p>
            </div>
          </div>
          <div class="notes-additional-experience-detail">
            <p><?= esc(bxsea_plain_text($premiumheader[0]['masterdesc_desc'] ?? 'Tiket ini tidak termasuk dalam tiket masuk utama dan hanya dapat dibeli langsung di lokasi (on-site).')) ?></p>
          </div>
        </div>
      </div>
      <?php if (!empty($experience)): ?>
      <?php foreach ($experience as $exp): ?>
      <?php if (($exp['experience_status'] ?? '') != '0'): ?>
      <div class="col-md-6 col-lg-4">
        <div class="box-additional-exp-detail">
          <div class="image-box-additional-exp-detail">
            <?php if (!empty($exp['experience_pict'])): ?>
            <img src="<?= bxsea_asset_url('experience', $exp['experience_pict'] ?? '', 'assets/landing/image/boat-tour-image.png');?>" alt="<?= esc($exp['experience_title'] ?? '');?>">
            <?php else: ?>
            <img src="<?= $premiumHeroAsset; ?>" alt="<?= esc($exp['experience_title'] ?? '');?>">
            <?php endif; ?>
            <div class="desc-box-additional-exp-detail">
              <img class="img-wave-additional-exp-detail" src="<?= $premiumWaveAsset; ?>" alt="">
              <div class="box-white">
                <h4><?= esc($normalizePremiumTitle($exp['experience_title'] ?? ''));?></h4>
                <p><?= esc($normalizePremiumText($exp['experience_desc'] ?? ''));?></p>
                <?php if (!empty($exp['experience_duration'])): ?>
                <div class="duration">
                  <img src="<?= $premiumDurationIconAsset; ?>" alt="">
                  <p>Durasi: <?= esc($exp['experience_duration']);?></p>
                </div>
                <?php endif; ?>
                <?php if (!empty($exp['experience_price'])): ?>
                <?php $priceLabel = is_numeric($exp['experience_price']) ? 'Rp ' . number_format((float) $exp['experience_price'], 0, ',', '.') : $normalizePremiumText($exp['experience_price'] ?? ''); ?>
                <div class="prize">
                  <img src="<?= $premiumTicketIconAsset; ?>" alt="">
                  <div class="time">
                    <div class="weekday">
                      <p>Harga: <?= esc($priceLabel);?></p>
                    </div>
                    <?php if (!empty($exp['experience_schedule'])): ?>
                    <div class="weekend">
                      <p><?= esc($normalizePremiumText($exp['experience_schedule']));?></p>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($exp['experience_age'])): ?>
                <div class="location">
                  <img src="<?= $premiumLocationIconAsset; ?>" alt="">
                  <p><?= esc($normalizePremiumText($exp['experience_age']));?></p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if (!empty($exp['experience_link'])): ?>
          <div class="btn-ticket-add-ons">
            <a href="<?= esc($exp['experience_link']);?>" target="_blank" rel="noopener noreferrer">Dapatkan Tiket BXSea Sekarang</a>
          </div>
          <?php endif; ?>
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
    <div class="title-contactus2"><h1>Hubungi Kami</h1></div>
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
