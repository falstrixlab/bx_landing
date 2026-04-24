<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$featureSlides = array_slice($homefiturslider ?? [], 0, 4);
$allShows = $show ?? [];
$regularSlides = array_values(array_slice(array_filter($allShows, static fn($s) => ($s['show_type'] ?? 'regular') === 'regular'), 0, 4));
$seapecialSlides = array_values(array_slice(array_filter($allShows, static fn($s) => ($s['show_type'] ?? 'regular') === 'seapecial'), 0, 4));
// Fallback: jika salah satu kosong, gunakan semua data
if (empty($regularSlides)) { $regularSlides = array_values(array_slice($allShows, 0, 4)); }
if (empty($seapecialSlides)) { $seapecialSlides = array_values(array_slice($allShows, 0, 4)); }
$partnerSlides = array_slice($homepartner ?? [], 0, 1);
$homeTicketCategories = array_values(array_filter($ticketcat ?? [], static function ($category) {
  return in_array((int) ($category['ticketcat_id'] ?? 0), [1, 2], true);
}));
$homeEventItems = array_slice($homepromo ?? [], 0, 4);
$reviewTitle = bxsea_plain_text($homeinfluencertitle[0]['masterdesc_title'] ?? 'INFLUENCER REVIEW');
$featuredArticle = $articletop[0] ?? null;
$marqueeStarAsset = bxsea_design_asset('home', 'marquee_star', 'assets/landing/image/3d_cartoon_style_red_starfish_with_yellow_dots_icon-removebg-preview 1.png');
$shortcutTicketAsset = bxsea_design_asset('home', 'shortcut_ticket', 'assets/landing/image/book-ticket-icon-bxsea.png');
$shortcutMapAsset = bxsea_design_asset('home', 'shortcut_map', 'assets/landing/image/oceanarium-icon-bxsea.png');
$shortcutShowAsset = bxsea_design_asset('home', 'shortcut_show', 'assets/landing/image/show-icon-bxsea.png');
$shortcutVisitorAsset = bxsea_design_asset('home', 'shortcut_visitor', 'assets/landing/image/visitor-information-icon-bxsea.png');
$shortcutContactAsset = bxsea_design_asset('home', 'shortcut_contact', 'assets/landing/image/contactus-icon-bxsea.png');
$ticketLocationIconAsset = bxsea_design_asset('ticket', 'location_icon', 'assets/landing/image/dashicons_location.png');
$experienceHeading = bxsea_plain_text($homedescexperience[0]['masterdesc_title'] ?? '');
$experienceDescription = bxsea_plain_text($homedescexperience[0]['masterdesc_desc'] ?? '');
$experienceSectionPict = $homedescexperience[0]['masterdesc_pict'] ?? '';
$partnerHeading = bxsea_plain_text($hometitlepartner[0]['masterdesc_title'] ?? '') ?: 'Partner Kami';
$normalizeTenantSummary = static function (?string $value, ?string $title = null, int $limit = 135): string {
  $text = bxsea_plain_text($value);
  $text = str_ireplace('souvernir', 'souvenir', $text);

  if ($title && stripos($title, 'BXSea Merchandise Store') !== false) {
    $text = 'Abadikan petualanganmu di BXSea dengan koleksi merchandise resmi kami yang bisa dibawa pulang sebagai kenang-kenangan spesial.';
  }

  if ($limit > 0) {
    if (function_exists('mb_substr')) {
      $text = mb_substr($text, 0, $limit);
    } else {
      $text = substr($text, 0, $limit);
    }
  }

  return trim($text);
};
$defaultReviewSlides = [
  [
    'text' => 'Ini paket lengkap untuk liburan karena nyaman, seru! aku suka banget ke BXSea. Pasti aku dan keluarga bakal ke sini lagi',
    'name' => 'Asri Welas',
    'image' => base_url('assets/landing/image/testi1.jpg'),
  ],
  [
    'text' => 'Happy bisa main di BXSea karena deket dari rumah jadi bisa bawa keluarga. Next mau ke sini lagi kalau udah ada pinguinnya!',
    'name' => 'Aiman Ricky',
    'image' => base_url('assets/landing/image/testi2.jpg'),
  ],
];
$reviewSlides = [];
$appendReviewSlide = static function (array &$target, string $text, string $name, string $image): void {
  $text = trim($text);
  $name = trim($name);

  if ($text === '' || $name === '') {
    return;
  }

  $target[] = [
    'text' => $text,
    'name' => $name,
    'image' => $image,
  ];
};

foreach (array_slice($hometestimoni ?? [], 0, 6) as $slide) {
  $appendReviewSlide(
    $reviewSlides,
    bxsea_plain_text($slide['testimoni_desc'] ?? ''),
    bxsea_plain_text($slide['testimoni_name'] ?? ''),
    bxsea_asset_url('testimoni', $slide['testimoni_pict'] ?? '', 'assets/landing/image/testi1.jpg')
  );
}

foreach (array_slice($homeinfluencer ?? [], 0, 6) as $slide) {
  $appendReviewSlide(
    $reviewSlides,
    bxsea_plain_text($slide['homeinfluencer_review'] ?? ''),
    bxsea_plain_text($slide['homeinfluencer_name'] ?? ''),
    bxsea_asset_url('influencer', $slide['homeinfluencer_pict'] ?? '', 'assets/landing/image/testi2.jpg')
  );
}

if (count($reviewSlides) < 2) {
  foreach ($defaultReviewSlides as $slide) {
    $reviewSlides[] = $slide;

    if (count($reviewSlides) >= 2) {
      break;
    }
  }
}

$reviewSlides = array_slice($reviewSlides, 0, 6);
?>

<!-- Marquee Announcement -->
<?php if(!empty($homeannouncement)): ?>
<section class="marquee">
  <div class="marquee__inner">
    <?php foreach($homeannouncement AS $ann): ?>
    <div class="marquee__part">
      <p><?= esc(bxsea_plain_text($ann['homeannouncement_text'] ?? ''));?></p>
      <div class="star">
        <img src="<?= $marqueeStarAsset; ?>" alt="">
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- Banner Section -->
<section class="section-banner">
  <div class="oceanariumtours">
    <div class="container-full">
      <div class="row top-section">
        <div class="shortcut-btn">
          <div class="btn-rounded">
            <a href="<?= base_url('/id/tiket/harga');?>">
              <img src="<?= $shortcutTicketAsset; ?>" alt="">
              <p>Pesan Tiket</p>
            </a>
            <a href="<?= base_url('/id/kunjungan/denah');?>">
              <img src="<?= $shortcutMapAsset; ?>" alt="">
              <p>Denah Oceanarium</p>
            </a>
            <a href="<?= base_url('/id/journey/pertunjukan');?>">
              <img src="<?= $shortcutShowAsset; ?>" alt="">
              <p>Pertunjukan</p>
            </a>
            <a href="<?= base_url('/id/kunjungan/informasi-pengunjung');?>">
              <img src="<?= $shortcutVisitorAsset; ?>" alt="">
              <p>Informasi Pengunjung</p>
            </a>
            <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">
              <img src="<?= $shortcutContactAsset; ?>" alt="">
              <p>Hubungi Kami</p>
            </a>
          </div>
        </div>
        <div class="owl-carousel owl-theme owl-oceanarium-tours">
          <?php if(!empty($featureSlides)): foreach($featureSlides AS $hfs): ?>
          <div class="oceanarium-tours-image">
            <div class="image-banner-owl-oceanariumtours">
              <img class="" src="<?= bxsea_asset_url('fiturslide', $hfs['homefitureslide_pict'] ?? '', 'assets/landing/image/rajaampat-carousel.png');?>" alt="<?= esc($hfs['homefiturslide_title']);?>">
              <div class="overlay-bg-images-owl-oceanariumtours"></div>
            </div>
            <div class="overlay-oceanariumtours">
              <div class="top-lit-title"></div>
              <div class="desc-overlay-oceanariumtours">
                <h4><?= esc($hfs['homefiturslide_title']);?></h4>
                <p><?= esc(bxsea_plain_text($hfs['homefiturslide_shortdesc'] ?? ''));?></p>
              </div>
              <div class="btn-overlay-oceanariumtours">
                <a href="<?= base_url('/id/journey/journey-utama');?>">Jelajahi Semua Zona</a>
                <img class="image-chevron-oceanariumtours" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt="">
              </div>
            </div>
          </div>
          <?php endforeach; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Additional Experience -->
<?php if(!empty($ticketexperience)): ?>
<section class="container additional-experience home-additional-experience">
  <div class="left-grid">
    <div class="title-additional-exp">
      <h1><?= $experienceHeading ? esc($experienceHeading) : 'Kenali <br> Lebih Dalam';?><img class="arrow-right-additional-exp" src="<?= base_url('assets/landing/');?>image/arrow-right-blue.png" alt=""></h1>
    </div>
    <div class="desc-additional-exp">
      <p><?= esc($experienceDescription ?: 'Pengalaman tambahan kami membawa Anda jauh lebih dekat dengan kehidupan laut!');?></p>
    </div>
    <?php if (!empty($experienceSectionPict)): ?>
    <div class="image-additional-exp-section">
      <img src="<?= base_url('assets/upload/masterdesc/' . esc($experienceSectionPict)) ?>" alt="" class="img-fluid">
    </div>
    <?php endif; ?>
  </div>
  <div class="right-grid owl-carousel owl-additional-exp">
    <?php foreach($ticketexperience AS $exp): ?>
    <a class="box-additional-exp" href="<?= base_url('/id/tiket/pengalaman-premium'); ?>">
      <div class="image-box-additional-exp">
        <img src="<?= bxsea_asset_url('experience', $exp['experience_pict'] ?? '', 'assets/landing/image/boat-tour-image.png');?>" alt="<?= esc($exp['experience_title']);?>">
        <div class="desc-box-additional-exp">
          <img class="img-wave-additional-exp" src="<?= base_url('assets/landing/');?>image/wave-additional-exp-desc.png" alt="">
          <div class="box-white">
            <h4><?= esc($exp['experience_title']);?></h4>
            <p><?= esc(substr(bxsea_plain_text($exp['experience_desc'] ?? ''), 0, 100));?></p>
          </div>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- Shows -->
<?php if(!empty($show)): ?>
<section class="showocean">
  <div class="flex-show">
    <div class="box-title-show-ocean">
      <h1>Pertunjukan Spektakuler</h1>
      <div class="show-filter-tabs">
        <button class="show-filter-tab active" data-show="regular">REGULAR SHOWS</button>
        <button class="show-filter-tab" data-show="seapecial">SEA-PECIAL SHOWS</button>
      </div>
      <div class="relative-show">
        <h6>REGULAR SHOWS</h6>
        <img class="bg-show" src="<?= base_url('assets/landing/');?>image/bg-show.png" alt="">
        <div class="splide show-splide" role="group" aria-label="">
          <div class="splide__track">
            <ul class="splide__list">
              <?php foreach($regularSlides AS $sh): ?>
              <li class="splide__slide">
                <a href="<?= base_url('/id/journey/pertunjukan');?>">
                  <img class="img-fluid" src="<?= bxsea_asset_url('show', $sh['show_poster'] ?? '', 'assets/landing/image/bxsea_image_regular_show.png');?>" alt="<?= esc($sh['show_title']);?>">
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="box-title-show-ocean">
      <div class="relative-show2">
        <h6>SEA-PECIAL SHOWS</h6>
        <img class="bg-show2" src="<?= base_url('assets/landing/');?>image/bg-show2.png" alt="">
        <div class="splide show-splide2" role="group" aria-label="">
          <div class="splide__track">
            <ul class="splide__list">
              <?php foreach($seapecialSlides AS $sh): ?>
              <li class="splide__slide">
                <a href="<?= base_url('/id/journey/pertunjukan');?>">
                  <img class="img-fluid" src="<?= bxsea_asset_url('show', $sh['show_poster'] ?: ($sh['show_pict'] ?? ''), 'assets/landing/image/bxsea_image_special_show.png');?>" alt="<?= esc($sh['show_title']);?>">
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="btn-show-schedule">
        <a href="<?= base_url('/id/journey/pertunjukan');?>">View Show Schedule <img class="arrow-right-btn-show-schedule" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($homeEventItems)): ?>
<section class="event">
  <div class="left-grid">
    <div class="title-event">
      <h1>Event</h1>
    </div>
    <div class="desc-event">
      <p>Berbagai acara seru kami hadirkan setiap saat!</p>
    </div>
  </div>
  <div class="right-grid-box">
    <div class="right-grid">
      <?php foreach ($homeEventItems as $promoItem): ?>
      <?php $promoHref = !empty($promoItem['promotion_link']) ? esc($promoItem['promotion_link']) : base_url('/id/promo/event'); ?>
      <a class="box-event" href="<?= $promoHref; ?>" <?= !empty($promoItem['promotion_link']) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
        <div class="image-box-event">
          <img src="<?= bxsea_asset_url('promotion', $promoItem['promotion_pict'] ?? '', 'assets/landing/image/image-promotions.png');?>" alt="<?= esc($promoItem['promotion_title'] ?? 'Event');?>">
          <div class="desc-box-event">
            <div class="box-white">
              <h4><?= esc($promoItem['promotion_title'] ?? 'Event');?></h4>
              <p><?= esc(substr(bxsea_plain_text($promoItem['promotion_desc'] ?? ''), 0, 130));?>...</p>
            </div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="cta-ig-tiktok-event">
      <p><img src="<?= base_url('assets/landing/');?>image/arrow-right-event.png" alt=""> Kunjungi <a href="https://instagram.com/bxsea_official?igshid=OGQ5ZDc2ODk2ZA==" target="_blank" rel="noopener noreferrer">Instagram</a> dan <a href="https://www.tiktok.com/@bxsea_official?_t=8hl0H4KuNA0&_r=1" target="_blank" rel="noopener noreferrer">TikTok</a> kami untuk update acara terbaru</p>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Reviews / Testimonial -->
<?php if(!empty($reviewSlides)): ?>
<section class="review-influencer">
  <img class="frog" src="<?= base_url('assets/landing/');?>image/frog.png" alt="">
  <div class="image-absolute-review">
    <img class="image-absolute-review-influencer" src="<?= base_url('assets/landing/image/image-review-influencer4.png'); ?>" alt="">
    <img class="image-absolute-review-influencer2" src="<?= base_url('assets/landing/image/image-review-influencer2.png'); ?>" alt="">
    <img class="image-absolute-review-influencer3" src="<?= base_url('assets/landing/image/image-review-influencer3.png'); ?>" alt="">
    <img class="image-absolute-review-influencer4" src="<?= base_url('assets/landing/image/image-review-influencer1.png'); ?>" alt="">
  </div>
  <div class="container">
    <div class="background-white-review-influencer"></div>
    <div class="title-review-influencer">
      <h1><?= esc($reviewTitle); ?></h1>
    </div>
    <div class="splide review-influencer-splide" role="group" aria-label="">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach($reviewSlides AS $tst): ?>
          <li class="splide__slide">
            <div class="activies-said">
              <p><?= esc($tst['text']);?></p>
            </div>
            <div class="image-activies">
              <img src="<?= esc($tst['image']);?>" alt="">
              <p class="name-activies"><?= esc($tst['name']);?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Tenant Section -->
<?php if(!empty($tenantpict)): ?>
<section class="Tenantus">
  <div class="container">
    <div class="title-tenantus">
      <h1>Tenant Kami</h1>
    </div>
  </div>
  <section class="thumbnail-carousel splide" aria-label="">
    <div class="splide__track">
      <ul class="splide__list">
        <?php foreach($tenantpict AS $tp): ?>
        <li class="splide__slide">
          <img src="<?= bxsea_asset_url('tenant', $tp['tenant_thumbnail_pict'] ?? '', 'assets/landing/image/image-card-tenant5.png');?>" alt="Tenant">
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <section class="main-carousel splide" aria-label="">
    <div class="splide__track">
      <ul class="splide__list">
        <?php foreach($tenantdesc AS $td): ?>
        <li class="splide__slide">
            <div class="title-main-carousel">
              <h1><?= esc(bxsea_plain_text($td['tenant_title'] ?? ''));?></h1>
            </div>
            <p><?= esc($normalizeTenantSummary($td['tenant_desc'] ?? '', $td['tenant_title'] ?? ''));?></p>
            <?php if (!empty($td['tenant_location'] ?? '')): ?>
            <p><span class="bold-text">Location :</span> <?= esc($td['tenant_location'] ?? '');?></p>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <div class="btn-find-out-more-tenants">
    <a href="<?= base_url('/id/kunjungan/tenant');?>">Jelajahi Lebih Lanjut <img class="arrow-btn-find-out-more-tenants" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
  </div>
</section>
<?php endif; ?>

<!-- News Section -->
<?php if(!empty($articletop)): ?>
<section class="new-information">
  <img class="snake" src="<?= base_url('assets/landing/');?>image/snake.png" alt="">
  <div class="title-new-information-mobile">
    <h1><?= esc(bxsea_plain_text($homedescnews[0]['masterdesc_title'] ?? 'Kabar Terbaru di BXSea'));?></h1>
  </div>
  <div class="desc-new-information-mobile">
    <p><?= esc(bxsea_plain_text($homedescnews[0]['masterdesc_desc'] ?? 'Jangan lewatkan kabar terbaru mengenai berbagai aktivitas seru dan biota kesayangan kami di BXSea!'));?></p>
  </div>
  <div class="row box-new-information">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 left-grid">
      <div class="title-new-information">
        <h1><?= esc(bxsea_plain_text($homedescnews[0]['masterdesc_title'] ?? 'Kabar Terbaru di BXSea'));?></h1>
      </div>
      <div class="desc-new-information">
        <p><?= esc(bxsea_plain_text($homedescnews[0]['masterdesc_desc'] ?? 'Jangan lewatkan kabar terbaru mengenai berbagai aktivitas seru dan biota kesayangan kami di BXSea!'));?></p>
      </div>
      <div class="cta-news">
        <div class="latest-news">
          <a href="<?= base_url('/id/berita');?>">Berita Terbaru <img class="arrow-right-latest-news" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
        </div>
        <div class="conversation-stories">
          <a href="<?= base_url('/id/berita');?>">Cerita Konservasi <img class="arrow-right-conversation-stories" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 center-grid text-center">
      <a href="<?= $featuredArticle ? base_url('/id/berita/detail/' . $featuredArticle['article_id']) : base_url('/id/berita');?>">
        <img src="<?= bxsea_asset_url('article', $featuredArticle['article_pict'] ?? '', 'assets/landing/image/bxsea_image_information.png');?>" class="img-fluid" alt="<?= esc($featuredArticle['article_title'] ?? 'Berita BXSea');?>">
      </a>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 right-grid d-flex flex-column justify-content-end">
      <div class="title-news">
        <h1><?= esc(bxsea_plain_text($featuredArticle['article_title'] ?? 'Berita Terbaru BXSea'));?></h1>
      </div>
      <div class="desc-news">
        <p><?= esc(substr(bxsea_plain_text($featuredArticle['article_desc'] ?? ''), 0, 220));?>...</p>
      </div>
      <div class="date-news">
        <p><?= !empty($featuredArticle['article_created_date']) ? date('Y-m-d', strtotime($featuredArticle['article_created_date'])) : '';?></p>
      </div>
      <div class="read-more-news">
        <a href="<?= $featuredArticle ? base_url('/id/berita/detail/' . $featuredArticle['article_id']) : base_url('/id/berita');?>">Baca Selengkapnya <img class="arrow-right-read-more-news" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
  
<!-- Ticket Section -->
<?php if(!empty($ticketregular)): ?>
<section class="ticketing">
  <div class="container">
    <img class="octopus-ticket" src="<?= base_url('assets/landing/');?>image/octopus.png" alt="">
    <div class="head-title-ticketing">
      <h1>Pesan Tiket Anda</h1>
      <p>Dapatkan tiket BXSea sekarang untuk menjelajahi berbagai spesies laut unik yang belum pernah Anda temui sebelumnya di Indonesia!</p>
    </div>
    <div class="box-nav-ticketing">
      <?php if(!empty($homeTicketCategories)): foreach($homeTicketCategories AS $index => $tcat): ?>
      <a class="link-ourwork<?= $index === 0 ? ' active' : ''; ?>" data-target="#work<?= $tcat['ticketcat_id'];?>" href="#work<?= $tcat['ticketcat_id'];?>">
        <div class="title-ourwork">
          <p><?= esc($tcat['ticketcat_name']);?></p>
        </div>
      </a>
      <?php endforeach; endif; ?>
    </div>

    <?php if(!empty($homeTicketCategories)): foreach($homeTicketCategories AS $index => $tcat): ?>
    <div class="ticket-tab-panel<?= $index === 0 ? ' is-active' : ''; ?>" id="work<?= $tcat['ticketcat_id'];?>">
      <div class="title-lityhide">
        <p>
          <?php if ((int) $tcat['ticketcat_id'] === 1): ?><?= esc(bxsea_plain_text($homedescticketreguler[0]['masterdesc_desc'] ?? 'Max. pembelian 10 tiket dalam 1x transaksi'));?>
          <?php else: ?><?= esc(bxsea_plain_text($homedescticketgroup[0]['masterdesc_desc'] ?? 'Min. pembelian 20 tiket dalam 1x transaksi'));?><?php endif; ?>
        </p>
      </div>
      <div class="splide <?= (int) $tcat['ticketcat_id'] === 1 ? 'card-ticketing-splide' : 'card-ticketing-splide2'; ?>" role="group" aria-label="">
        <div class="splide__track">
          <ul class="splide__list">
            <?php 
              $tvar = 'ticketregular';
              if($tcat['ticketcat_id'] == 2) $tvar = 'ticketgroup';
            ?>
            <?php foreach($$tvar AS $tkt): ?>
            <li class="splide__slide box-card-ticketing">
              <div class="card-ticketing">
                <div class="overlay-bg-card"></div>
                <div class="image-card-ticketing">
                  <img src="<?= bxsea_asset_url('ticket', $tkt['ticket_pict'] ?? '', 'assets/landing/image/bxsea-image-ticket-regular.png');?>" alt="<?= esc($tkt['ticket_title']);?>">
                </div>
                <div class="overlay-card-ticketing">
                  <div class="desc-card-ticketing">
                    <div class="title-card"><h3><?= esc(bxsea_plain_text($tkt['ticket_title'] ?? ''));?></h3></div>
                    <p><?= esc(bxsea_plain_text($tkt['ticket_schedule'] ?? '')); ?></p>
                    <?php if(!empty($tkt['ticket_subtitle'])): ?><p><?= esc(bxsea_plain_text($tkt['ticket_subtitle']));?></p><?php endif; ?>
                    <div class="body-card-ticketing">
                      <p>Rp <?= number_format($tkt['ticket_price'],0,',','.');?></p>
                      <?php if(!empty($tkt['ticket_total_journey'])): ?>
                      <div class="location-card-ticketing">
                        <img src="<?= $ticketLocationIconAsset; ?>" alt="">
                        <p><?= esc($tkt['ticket_total_journey']);?></p>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="footer-card-ticketing">
                      <div class="link-buy-card-ticketing">
                        <?php if(!empty($tkt['ticket_link'])): ?>
                        <a class="bg-blue-ticket" href="<?= esc($tkt['ticket_link']);?>" target="_blank" rel="noopener noreferrer">Beli Sekarang!</a>
                        <?php else: ?>
                        <a<?= (int) $tcat['ticketcat_id'] === 2 ? ' class="bg-blue-ticket"' : ''; ?> href="javascript:void(0)">Segera Hadir</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <?php endforeach; endif; ?>
    <div class="details-card-ticketing">
      <a href="<?= base_url('/id/tiket/pengalaman-premium');?>">Lihat Add-Ons <img class="arrow-right-details-card-ticketing" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Partner / Client Section -->
<?php if(!empty($partnerSlides)): ?>
<section class="klienOcean">
  <img class="treasure-client" src="<?= base_url('assets/landing/');?>image/treasure.png" alt="">
  <div class="container">
    <div class="title-klienOcean">
      <h2><?= esc($partnerHeading);?></h2>
    </div>
    <div class="row">
      <div class="splide klien-splide" role="group" aria-label="">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach($partnerSlides AS $partner): ?>
            <li class="splide__slide">
              <img class="img-fluid" src="<?= bxsea_asset_url('partner', $partner['partner_pict'] ?? '', 'assets/landing/image/image-partner3.png');?>" alt="<?= esc($partner['partner_title']);?>">
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Partnership CTA -->
<section class="Partnership">
  <img class="wave-partnerships" src="<?= base_url('assets/landing/');?>image/wave-partnerships.png" alt="">
  <div class="box-partnerships">
    <div class="container">
      <div class="title-partnerships">
        <h1>Mau Menjadi Mitra Kami?</h1>
      </div>
      <div class="desc-partnerships">
        <p>Kami sangat antusias untuk membangun kemitraan yang bermakna dalam mendukung edukasi, konservasi, serta pengalaman yang tak terlupakan di BXSea.</p>
      </div>
      <div class="btn-partnerships">
        <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami <img class="arrow-right-btn-partnerships" src="<?= base_url('assets/landing/');?>image/arrow-right-white.png" alt=""></a>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
