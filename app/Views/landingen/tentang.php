<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$aboutHeroAsset  = bxsea_design_asset('about', 'hero',        'assets/landing/image/bxsea_image_bg-tenant.png');
$aboutOctopus    = bxsea_design_asset('about', 'octopus',     'assets/landing/image/gurita.png');
$aboutGallery1   = bxsea_design_asset('about', 'gallery_1',   'assets/landing/image/image-aboutus2.png');
$aboutGallery2   = bxsea_design_asset('about', 'gallery_2',   'assets/landing/image/image-aboutus.png');
$aboutGallery3   = bxsea_design_asset('about', 'gallery_3',   'assets/landing/image/image-aboutus2.png');
$aboutMainImage  = bxsea_design_asset('about', 'main_image',  'assets/landing/image/bxsea_image_aboutus.png');
$aboutIntroTitle = 'Xtraordinary Xperience at Sea and Forest';
$aboutIntroHtml  = '<p>BXSea is the premier aquarium destination in South Tangerang, created as an edutainment experience for all ages to discover the wonders of marine life. Located beneath Bintaro Jaya Xchange Mall 2, we inspire deeper connections between people and aquatic life. Discover the unique characteristics of our animals, from Moray Eels and Humboldt Penguins to the Giant Pacific Octopus, while exploring an environment designed for learning, conservation, and unforgettable family moments.</p>';
$aboutConservationDesc = 'BXSea is committed to the protection and conservation of marine life while delivering educational experiences rooted in real conservation efforts. Through breeding endangered species and helping restore damaged habitats, we aim to inspire every visitor to protect marine ecosystems and keep our waters healthy for the future.';
$aboutCommunityDesc = 'Community is the heart of BXSea. We work to connect families and visitors of all ages with the wonders of marine life, building a shared sense of care for the ocean and its inhabitants through education that can create positive change for future generations.';
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
        <?php if ($aboutIntroHtml !== ''): ?>
        <div class="about-desc"><?= $aboutIntroHtml; ?></div>
        <?php else: ?>
        <div class="about-desc"><p>BXSea is the premier aquarium destination in South Tangerang, created as an edutainment experience for all ages to discover the wonders of marine life. Located beneath Bintaro Jaya Xchange Mall 2, BXSea brings people closer to the beauty of sea and forest in one memorable journey.</p></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="title-about-circle">
      <p>BXSea is home to a vast diversity of marine life!</p>
    </div>
    <div class="row justify-content-center text-center mb-5 py-5">
      <div class="col-sm-6 col-md-4 circle-box1"><div class="circle1">7,354m² <br><span>Total Area</span></div></div>
      <div class="col-sm-6 col-md-4 circle-box2"><div class="circle2">54 <br><span>Aquarium Displays</span></div></div>
      <div class="col-sm-6 col-md-4 circle-box3"><div class="circle3">~25,000<br><span>Biota</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box4"><div class="circle4">4.5 Million Litres<br><span>Water Capacity</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box5"><div class="circle5">140 <br><span>Species</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box6"><div class="circle6">10 <br><span>Terrariums</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box7"><div class="circle7">44 Aquariums<br><span>Freshwater &amp; Saltwater</span></div></div>
    </div>

    <div class="row g-3 my-5 py-5">
      <div class="col-md-4"><img src="<?= $aboutGallery1; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery2; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery3; ?>" class="img-fluid gallery-img"></div>
    </div>

    <div class="row align-items-start g-4 my-5 py-5">
      <div class="col-lg-5">
        <div class="about-card d-flex flex-column align-items-center">
          <img class="img-fluid" src="<?= $aboutMainImage; ?>">
          <p>BXSea has the <strong>largest underwater dome and tunnel in Southeast Asia!</strong> Stretching 35 metres long, 2.4 metres wide and 2.8 metres high, marvel at the diversity of fish, sharks, rays, and more!</p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="about-text-block">
          <h4>Conservation</h4>
          <p><?= esc($aboutConservationDesc);?></p>
          <div class="about-button">
            <a href="<?= base_url('/en/berita');?>">See our full Conservation Stories <div class="arrow-right-about-button">></div></a>
          </div>
          <h4>Community</h4>
          <p><?= esc($aboutCommunityDesc);?></p>
          <div class="about-button">
            <a href="<?= base_url('/en/tiket/program-kunjungan-sekolah');?>">See our School Visit Program <div class="arrow-right-about-button">></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
