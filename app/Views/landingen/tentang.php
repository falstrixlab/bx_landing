<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$ap = $aboutPage ?? [];
$aboutHeroAsset  = bxsea_design_asset('about', 'hero',        'assets/landing/image/bxsea_image_bg-tenant.png');
$aboutOctopus    = bxsea_design_asset('about', 'octopus',     'assets/landing/image/gurita.png');
$aboutGallery1   = !empty($ap['gallery_1']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_1']) : bxsea_design_asset('about', 'gallery_1', 'assets/landing/image/image-aboutus2.png');
$aboutGallery2   = !empty($ap['gallery_2']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_2']) : bxsea_design_asset('about', 'gallery_2', 'assets/landing/image/image-aboutus.png');
$aboutGallery3   = !empty($ap['gallery_3']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_3']) : bxsea_design_asset('about', 'gallery_3', 'assets/landing/image/image-aboutus2.png');
$aboutMainImage  = !empty($ap['textblock_image']) ? base_url('assets/upload/about/'.$ap['textblock_image']) : bxsea_design_asset('about', 'main_image', 'assets/landing/image/bxsea_image_aboutus.png');
$aboutIntroTitle = !empty($ap['intro_title_en']) ? $ap['intro_title_en'] : 'Xtraordinary Xperience at Sea and Forest';
$aboutIntroHtml  = !empty($ap['intro_desc_en'])  ? $ap['intro_desc_en']  : '<p>BXSea is the premier aquarium destination in South Tangerang, created as an edutainment experience for all ages to discover the wonders of marine life. Located beneath Bintaro Jaya Xchange Mall 2, we inspire deeper connections between people and aquatic life. Discover the unique characteristics of our animals, from Moray Eels and Humboldt Penguins to the Giant Pacific Octopus, while exploring an environment designed for learning, conservation, and unforgettable family moments.</p>';
$subcircleDesc   = !empty($ap['subcircle_desc_en']) ? $ap['subcircle_desc_en'] : 'BXSea is home to a vast diversity of marine life!';
$bubbles = [];
for ($i = 1; $i <= 7; $i++) {
    $bubbles[$i] = !empty($ap['bubble'.$i.'_en']) ? $ap['bubble'.$i.'_en'] : '';
}
$bubbleDefaults = [
    1 => '7,354m² <br><span>Total Area</span>',
    2 => '54 <br><span>Aquarium Displays</span>',
    3 => '~25,000<br><span>Biota</span>',
    4 => '4.5 Million Litres<br><span>Water Capacity</span>',
    5 => '140 <br><span>Species</span>',
    6 => '10 <br><span>Terrariums</span>',
    7 => '44 Aquariums<br><span>Freshwater &amp; Saltwater</span>',
];
$leftDesc   = !empty($ap['textblock_left_desc_en']) ? $ap['textblock_left_desc_en'] : 'BXSea has the <strong>largest underwater dome and tunnel in Southeast Asia!</strong> Stretching 35 metres long, 2.4 metres wide and 2.8 metres high, marvel at the diversity of fish, sharks, rays, and more!';
$block1Title = !empty($ap['textblock_title1_en']) ? $ap['textblock_title1_en'] : 'Conservation';
$block1Desc  = !empty($ap['textblock_desc1_en'])  ? $ap['textblock_desc1_en']  : 'BXSea is committed to the protection and conservation of marine life while delivering educational experiences rooted in real conservation efforts. Through breeding endangered species and helping restore damaged habitats, we aim to inspire every visitor to protect marine ecosystems and keep our waters healthy for the future.';
$block1Btn   = !empty($ap['textblock_btn1_en'])   ? $ap['textblock_btn1_en']   : 'See our full Conservation Stories';
$block2Title = !empty($ap['textblock_title2_en']) ? $ap['textblock_title2_en'] : 'Community';
$block2Desc  = !empty($ap['textblock_desc2_en'])  ? $ap['textblock_desc2_en']  : 'Community is the heart of BXSea. We work to connect families and visitors of all ages with the wonders of marine life, building a shared sense of care for the ocean and its inhabitants through education that can create positive change for future generations.';
$block2Btn   = !empty($ap['textblock_btn2_en'])   ? $ap['textblock_btn2_en']   : 'See our School Visit Program';
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $aboutHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title">ABOUT US</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="custom-about">
  <img class="gurita-about" src="<?= $aboutOctopus; ?>" alt="">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-lg-8 mx-auto">
        <h2 class="about-title"><?= esc($aboutIntroTitle);?></h2>
        <div class="about-desc"><?= $aboutIntroHtml; ?></div>
      </div>
    </div>

    <div class="title-about-circle">
      <p><?= esc($subcircleDesc); ?></p>
    </div>
    <div class="row justify-content-center text-center mb-5 py-5 about-bubble">
      <div class="col-sm-6 col-md-4 circle-box1"><div class="circle1"><?= !empty($bubbles[1]) ? $bubbles[1] : $bubbleDefaults[1]; ?></div></div>
      <div class="col-sm-6 col-md-4 circle-box2"><div class="circle2"><?= !empty($bubbles[2]) ? $bubbles[2] : $bubbleDefaults[2]; ?></div></div>
      <div class="col-sm-6 col-md-4 circle-box3"><div class="circle3"><?= !empty($bubbles[3]) ? $bubbles[3] : $bubbleDefaults[3]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box4"><div class="circle4"><?= !empty($bubbles[4]) ? $bubbles[4] : $bubbleDefaults[4]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box5"><div class="circle5"><?= !empty($bubbles[5]) ? $bubbles[5] : $bubbleDefaults[5]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box6"><div class="circle6"><?= !empty($bubbles[6]) ? $bubbles[6] : $bubbleDefaults[6]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box7"><div class="circle7"><?= !empty($bubbles[7]) ? $bubbles[7] : $bubbleDefaults[7]; ?></div></div>
    </div>

    <div class="row g-3 my-5 py-5 abpout-gallery">
      <div class="col-md-4"><img src="<?= $aboutGallery1; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery2; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery3; ?>" class="img-fluid gallery-img"></div>
    </div>

    <div class="row align-items-start g-4 my-5 py-5 about-text-block">
      <div class="col-lg-5">
        <div class="about-card d-flex flex-column align-items-center">
          <img class="img-fluid" src="<?= $aboutMainImage; ?>">
          <p><?= bxsea_render_html($leftDesc, '<p><br><strong><em><ul><ol><li><h4><h5><h6><span><div>');?></p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="about-text-block">
          <h4><?= esc($block1Title); ?></h4>
          <p><?= esc(bxsea_plain_text($block1Desc)); ?></p>
          <div class="about-button">
            <a href="<?= base_url('/en/berita');?>"><?= esc($block1Btn); ?> <span class="arrow-right-about-button">></span></a>
          </div>
          <h4><?= esc($block2Title); ?></h4>
          <p><?= esc(bxsea_plain_text($block2Desc)); ?></p>
          <div class="about-button">
            <a href="<?= base_url('/en/tiket/program-kunjungan-sekolah');?>"><?= esc($block2Btn); ?> <span class="arrow-right-about-button">></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
