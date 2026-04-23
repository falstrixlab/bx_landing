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
$premiumIntroTitle = !empty($additional[0]['additional_title_en']) ? bxsea_plain_text($additional[0]['additional_title_en']) : 'Explore More Than the Main Journey';
$premiumIntroDesc = !empty($additional[0]['additional_desc_en']) ? bxsea_plain_text($additional[0]['additional_desc_en']) : 'Our oceanarium experiences are designed to spark curiosity and build a deeper connection between people and marine life. Discover a range of extra experiences created to be both educational and entertaining.';
$premiumNote = !empty($additional[0]['additional_notes_en']) ? bxsea_plain_text($additional[0]['additional_notes_en']) : 'These experiences are not included in the main admission ticket and can only be purchased directly on-site.';

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
      <?php if (!empty($additionalitems)): ?>
      <?php foreach ($additionalitems as $item): ?>
      <?php
        $itemTitle = bxsea_plain_text($item['item_title_en'] ?? $item['item_title_id'] ?? '');
        $itemDesc = bxsea_plain_text($item['item_desc_en'] ?? $item['item_desc_id'] ?? '');
        $itemDuration = str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_duration_en'] ?? $item['item_duration_id'] ?? '');
        $itemSchedule = str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_schedule_en'] ?? $item['item_schedule_id'] ?? '');
        $itemLocation = str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_location_en'] ?? $item['item_location_id'] ?? '');
        $itemButton = bxsea_plain_text($item['item_button_en'] ?? $item['item_button_id'] ?? '');
      ?>
      <div class="col-md-6 col-lg-4">
        <div class="box-additional-exp-detail">
          <div class="image-box-additional-exp-detail">
            <?php if (!empty($item['item_image'])): ?>
            <img src="<?= bxsea_asset_url('additional_exp_item', $item['item_image'], 'assets/landing/image/boat-tour-image.png');?>" alt="<?= esc($itemTitle);?>">
            <?php else: ?>
            <img src="<?= $premiumHeroAsset; ?>" alt="<?= esc($itemTitle);?>">
            <?php endif; ?>
            <div class="desc-box-additional-exp-detail">
              <img class="img-wave-additional-exp-detail" src="<?= $premiumWaveAsset; ?>" alt="">
              <div class="box-white">
                <h4><?= esc($itemTitle);?></h4>
                <p><?= esc($itemDesc);?></p>
                <?php if ($itemDuration !== ''): ?>
                <div class="duration">
                  <img src="<?= !empty($item['item_duration_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_duration_icon'], 'assets/landing/image/duration-icon.svg') : $premiumDurationIconAsset; ?>" alt="Duration Icon">
                  <p><?= nl2br(esc($itemDuration));?></p>
                </div>
                <?php endif; ?>
                <?php if ($itemSchedule !== ''): ?>
                <div class="prize">
                  <img src="<?= !empty($item['item_schedule_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_schedule_icon'], 'assets/landing/image/ticket-icon.svg') : $premiumTicketIconAsset; ?>" alt="Schedule Icon">
                  <div class="time">
                    <div class="weekday">
                      <p><?= nl2br(esc($itemSchedule));?></p>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php if ($itemLocation !== ''): ?>
                <div class="location">
                  <img src="<?= !empty($item['item_location_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_location_icon'], 'assets/landing/image/location-icon.svg') : $premiumLocationIconAsset; ?>" alt="Location Icon">
                  <p><?= nl2br(esc($itemLocation));?></p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if ($itemButton !== ''): ?>
          <div class="btn-ticket-add-ons">
            <a href="https://bxsea.com/en/ticket" target="_blank" rel="noopener noreferrer"><?= esc($itemButton);?></a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="col-12 text-center py-5">
        <p>No additional experiences data available.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
  <?= $this->endSection() ?>