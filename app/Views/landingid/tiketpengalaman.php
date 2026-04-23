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
              <h1><?= !empty($additional[0]['additional_title_id']) ? esc(bxsea_plain_text($additional[0]['additional_title_id'])) : 'Jelajahi Lebih dari Sekedar Journey Utama';?></h1>
            </div>
            <div class="desc-additional-exp-detail">
              <p><?= !empty($additional[0]['additional_desc_id']) ? esc(bxsea_plain_text($additional[0]['additional_desc_id'])) : 'Tujuan Oceanarium kami adalah untuk menginspirasi rasa ingin tahu dan membangun ikatan antara manusia dan satwa. Temukan berbagai pengalaman tambahan yang dirancang khusus untuk mengedukasi sekaligus menghibur!';?></p>
            </div>
          </div>
          <div class="notes-additional-experience-detail">
            <p><?= !empty($additional[0]['additional_notes_id']) ? esc(bxsea_plain_text($additional[0]['additional_notes_id'])) : 'Tiket ini tidak termasuk dalam tiket masuk utama dan hanya dapat dibeli langsung di lokasi (on-site).';?></p>
          </div>
        </div>
      </div>
      <?php if (!empty($additionalitems)): ?>
      <?php foreach ($additionalitems as $item): ?>
      <div class="col-md-6 col-lg-4">
        <div class="box-additional-exp-detail">
          <div class="image-box-additional-exp-detail">
            <?php if (!empty($item['item_image'])): ?>
            <img src="<?= bxsea_asset_url('additional_exp_item', $item['item_image'], 'assets/landing/image/boat-tour-image.png');?>" alt="<?= esc($item['item_title_id'] ?? '');?>">
            <?php else: ?>
            <img src="<?= $premiumHeroAsset; ?>" alt="<?= esc($item['item_title_id'] ?? '');?>">
            <?php endif; ?>
            <div class="desc-box-additional-exp-detail">
              <img class="img-wave-additional-exp-detail" src="<?= $premiumWaveAsset; ?>" alt="">
              <div class="box-white">
                <h4><?= !empty($item['item_title_id']) ? esc($item['item_title_id']) : '';?></h4>
                <p><?= !empty($item['item_desc_id']) ? strip_tags($item['item_desc_id'], '<br>') : '';?></p>
                <?php if (!empty($item['item_duration_id'])): ?>
                <div class="duration">
                  <img src="<?= !empty($item['item_duration_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_duration_icon'], 'assets/landing/image/duration-icon.svg') : $premiumDurationIconAsset; ?>" alt="Duration Icon">
                  <p><?= nl2br(esc(str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_duration_id'])));?></p>
                </div>
                <?php endif; ?>
                <?php if (!empty($item['item_schedule_id'])): ?>
                <div class="prize">
                  <img src="<?= !empty($item['item_schedule_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_schedule_icon'], 'assets/landing/image/ticket-icon.svg') : $premiumTicketIconAsset; ?>" alt="Schedule Icon">
                  <div class="time">
                    <div class="weekday">
                      <p><?= nl2br(esc(str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_schedule_id'])));?></p>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($item['item_location_id'])): ?>
                <div class="location">
                  <img src="<?= !empty($item['item_location_icon']) ? bxsea_asset_url('additional_exp_item', $item['item_location_icon'], 'assets/landing/image/location-icon.svg') : $premiumLocationIconAsset; ?>" alt="Location Icon">
                  <p><?= nl2br(esc(str_ireplace(['<br>', '<br/>', '<br />'], "\n", $item['item_location_id'])));?></p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if (!empty($item['item_button_id'])): ?>
          <div class="btn-ticket-add-ons">
            <a href="https://bxsea.com/id/ticket" target="_blank" rel="noopener noreferrer"><?= esc($item['item_button_id']);?></a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="col-12 text-center py-5">
        <p>Tidak ada data pengalaman tambahan saat ini.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
