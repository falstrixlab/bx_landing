<?= $this->extend('landingid/landingbase') ?>
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
    'title' => 'Jalur Ramah Kursi Roda',
    'desc' => 'BXSea sepenuhnya dapat diakses oleh kursi roda! Ini mencakup semua pintu masuk, jalur pejalan kaki, semua area, lift, serta fasilitas pendukung lainnya.',
    'image' => $guideWheelchairAsset,
  ],
  [
    'title' => 'Elevator',
    'desc' => 'Akses lift tersedia untuk memudahkan perpindahan antar area bagi seluruh pengunjung yang membutuhkan.',
    'image' => $guideElevatorAsset,
  ],
  [
    'title' => 'Toilet Disabilitas',
    'desc' => 'Toilet disabilitas tersedia untuk memastikan kenyamanan pengunjung selama berada di BXSea.',
    'image' => $guideToiletAsset,
  ],
];

$guideCards = [];
foreach (array_slice($guide ?? [], 0, 3) as $index => $item) {
  $guideCards[] = [
    'title' => bxsea_plain_text($item['guide_title'] ?? $fallbackGuideCards[$index]['title']),
    'desc' => bxsea_plain_text($item['guide_desc'] ?? $fallbackGuideCards[$index]['desc']),
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
    <h5 class="title"><?= esc(bxsea_plain_text($guidedesc[0]['masterdesc_title'] ?? 'Selamat Datang di BXSea!'));?></h5>
    <p class="desc"><?= esc(bxsea_plain_text($guidedesc[0]['masterdesc_desc'] ?? 'BXSea Oceanarium senantiasa menjaga seluruh pengunjung, memastikan semua atraksi dapat diakses oleh siapa saja! Jelajahi dunia bawah laut tanpa batas.'));?></p>
    <h6 class="sub-title mt-4">Bagi Pengunjung dengan Keterbatasan Mobilitas</h6>
    <p class="sub-desc">BXSea sepenuhnya dapat diakses oleh kursi roda! Ini mencakup semua pintu masuk, jalur pejalan kaki, semua area, lift, serta fasilitas pendukung lainnya</p>
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
    <p class="note">Demi kenyamanan ekstra, BXSea menyediakan sejumlah kursi roda terbatas yang dapat disewa di meja Guest Services kami</p>
  </div>
</section>

<section class="contactus3">
  <div class="container">
    <div class="title-contactus3">
      <h1>Hubungi Kami</h1>
      <p>Jika Anda memiliki pertanyaan atau kendala mengenai Aksesibilitas di BXSea, silakan hubungi kami dan kami akan segera memberikan jawabannya.</p>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus3">
          <a href="<?= esc($setup[0]['setup_customer'] ?? '#');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactCustomerAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><p>Customer Services</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus2">
        <div class="card-contactus3">
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $setup[0]['setup_phone'] ?? '');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactWhatsappAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><p>Whatsapp</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 box-card-contactus3">
        <div class="card-contactus3">
          <a href="mailto:<?= esc($setup[0]['setup_email'] ?? '');?>">
            <div class="image-contactus3"><img class="img-fluid" src="<?= $contactEmailAsset; ?>" alt=""></div>
            <div class="desc-card-contactus3"><br><p>Email</p></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
