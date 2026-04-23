<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$guideHeroAsset = bxsea_design_asset('guide', 'hero', 'assets/landing/image/bxsea_image_bg-visitor.png');
$guideWheelchairAsset = bxsea_design_asset('guide', 'wheelchair', 'assets/landing/image/bxsea_image_wheelchair.png');
$guideElevatorAsset = bxsea_design_asset('guide', 'elevator', 'assets/landing/image/bxsea_image_elevator.png');
$guideToiletAsset = bxsea_design_asset('guide', 'toilet', 'assets/landing/image/bxsea_image_disabledtoilets.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset = bxsea_design_asset('visit', 'contact_card_email', 'assets/landing/image/sosmed3.png');

$fallbackGuideCards = [
    [
        'title' => 'Wheelchair-Friendly Path',
        'desc' => 'BXSea is fully wheelchair accessible, including entrances, walkways, all major areas, elevators, and supporting facilities.',
        'image' => $guideWheelchairAsset,
    ],
    [
        'title' => 'Elevator',
        'desc' => 'Dedicated elevator access is available for guests who need a more comfortable route between levels.',
        'image' => $guideElevatorAsset,
    ],
    [
        'title' => 'Accessible Toilets',
        'desc' => 'Accessible toilets are available to support a more comfortable and inclusive visit throughout BXSea.',
        'image' => $guideToiletAsset,
    ],
];

$guideCards = [];
foreach (array_slice($guide ?? [], 0, 3) as $index => $item) {
    $guideCards[] = [
        'title' => bxsea_plain_text($item['guide_title_en'] ?? ($item['guide_title'] ?? $fallbackGuideCards[$index]['title'])),
        'desc' => bxsea_plain_text($item['guide_desc_en'] ?? ($item['guide_desc'] ?? $fallbackGuideCards[$index]['desc'])),
        'image' => bxsea_asset_url('guide', $item['guide_pict'] ?? '', $fallbackGuideCards[$index]['image']),
    ];
}

if ($guideCards === []) {
    $guideCards = $fallbackGuideCards;
}

$guideHeroTitle = bxsea_plain_text($guideheader[0]['masterdesc_title_en'] ?? 'ACCESSIBILITY GUIDE');
$guideHeroTitle = str_ireplace('Accessibility Guidelines', 'Accessibility Guide', $guideHeroTitle);
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $guideHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title"><?= esc($guideHeroTitle); ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="accessibility-guide">
  <div class="container">
    <h5 class="title"><?= esc(bxsea_plain_text($guidedesc[0]['masterdesc_title_en'] ?? 'Welcome to BXSea!')); ?></h5>
    <p class="desc"><?= esc(bxsea_plain_text($guidedesc[0]['masterdesc_desc_en'] ?? 'BXSea Oceanarium welcomes every guest and works to ensure all attractions can be accessed comfortably. Explore the underwater world without limits.')); ?></p>
    <h6 class="sub-title mt-4">For Visitors with Reduced Mobility</h6>
    <p class="sub-desc">BXSea is fully wheelchair accessible! This includes all entrances, walkways, exhibits, elevators, and facilities. </p>
    <div class="row mt-2 g-4">
      <?php foreach ($guideCards as $card): ?>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="<?= $card['image']; ?>" class="img-fluid" alt="<?= esc($card['title']); ?>">
          <p><?= esc($card['desc']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="note">For added convenience, BXSea offers a limited number of wheelchairs available for rent at our Guest Services desk. </p>
  </div>
</section>

<section class="contactus3">
  <div class="container">
    <div class="title-contactus3">
      <h1>Contact Us</h1>
      <p>If you have any questions or concerns about Accessibility at BXSea, please reach out to us and we will have them answered immediately. </p>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus3">
          <a href="<?= esc($setup[0]['setup_customer'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactCustomerAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><p>Customer Services</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus2">
        <div class="card-contactus3">
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $setup[0]['setup_phone'] ?? ''); ?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactWhatsappAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><p>WhatsApp</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus3">
        <div class="card-contactus3">
          <a href="mailto:<?= esc($setup[0]['setup_email'] ?? ''); ?>">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactEmailAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><p>Email</p></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>