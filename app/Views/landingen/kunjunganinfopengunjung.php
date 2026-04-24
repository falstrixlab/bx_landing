<?= $this->extend('landingen/landingbase') ?>
<?= $this->section('content') ?>

<?php
$defaultRules = [
  [
    'visitorinfo_title' => 'Be Respectful and Mindful',
    'visitorinfo_desc' => 'Public holidays and peak hours can be busier, so please stay aware of the comfort of other guests around you.',
    'visitorinfo_icon' => 'bxsea_icon_respectfull.png',
  ],
  [
    'visitorinfo_title' => 'Children Must Be Supervised',
    'visitorinfo_desc' => 'For your child’s safety, the protection of marine life, and the comfort of all visitors, please ensure children are supervised at all times.',
    'visitorinfo_icon' => 'bxsea_icon_children.png',
  ],
  [
    'visitorinfo_title' => 'No Camera Flash',
    'visitorinfo_desc' => 'Please turn off your camera flash when taking photos, as bright flashes can stress or startle our animals.',
    'visitorinfo_icon' => 'bxsea_icon_no_flash.png',
  ],
  [
    'visitorinfo_title' => 'No Food or Drinks Allowed',
    'visitorinfo_desc' => 'Please do not bring food or drinks into BXSea. This helps protect our animals from contamination, spills, and improper feeding.',
    'visitorinfo_icon' => 'bxsea_icon_no_food.png',
  ],
];

$defaultLearn = [
  [
    'visitorinfo_title' => 'Information Tablets',
    'visitorinfo_desc' => 'Located throughout the Long Journey zone, our information tablets share deeper details and fascinating facts about BXSea species.',
    'visitorinfo_image' => 'bxsea_image_information_tablets.png',
  ],
  [
    'visitorinfo_title' => 'Touch Pool',
    'visitorinfo_desc' => 'Gently interact with sea stars, sea urchins, and other coastal creatures with guidance from our education team.',
    'visitorinfo_image' => 'bxsea_image_touchpool_visitor.png',
  ],
  [
    'visitorinfo_title' => 'BXSea Explore App',
    'visitorinfo_desc' => 'Discover each species through detailed profiles and supporting information available in the BXSea app.',
    'visitorinfo_image' => 'bxsea_image_bxsea_app.png',
  ],
  [
    'visitorinfo_title' => 'Conservation Zone',
    'visitorinfo_desc' => 'Step into our Mangrove Zone and see how BXSea helps protect threatened species from across the globe.',
    'visitorinfo_image' => 'bxsea_image_zona_konservasi.png',
  ],
  [
    'visitorinfo_title' => 'Interactive Table',
    'visitorinfo_desc' => 'Explore BXSea areas and species through our interactive tables placed in key public zones.',
    'visitorinfo_image' => 'bxsea_image_meja_interaktif.png',
  ],
];

$rules = !empty($visitorInfoRules) ? $visitorInfoRules : $defaultRules;
$learnItems = !empty($visitorInfoLearn) ? $visitorInfoLearn : $defaultLearn;
$visitorHeroAsset = bxsea_design_asset('visit', 'hero_visitor', 'assets/landing/image/bxsea_image_bg-visitor.png');
$visitorPenguin1 = bxsea_design_asset('visit', 'visitor_penguin_1', 'assets/landing/image/bxsea_image_penguin_visitor_information.png');
$visitorPenguin2 = bxsea_design_asset('visit', 'visitor_penguin_2', 'assets/landing/image/bxsea_image_penguin_visitor_information2.png');
$visitorLocationIcon = bxsea_design_asset('visit', 'visitor_location_icon', 'assets/landing/image/bxsea_icon_location.png');
$visitorByTrain1 = bxsea_design_asset('visit', 'visitor_by_train_1', 'assets/landing/image/bxsea_image_bytrain.png');
$visitorByTrain2 = bxsea_design_asset('visit', 'visitor_by_train_2', 'assets/landing/image/bxsea_image_bytrain2.png');
$visitorByVehicle1 = bxsea_design_asset('visit', 'visitor_by_vehicle_1', 'assets/landing/image/bxsea_image_byvehicle.png');
$visitorByVehicle2 = bxsea_design_asset('visit', 'visitor_by_vehicle_2', 'assets/landing/image/bxsea_image_byvehicle2.png');
$visitorByBus = bxsea_design_asset('visit', 'visitor_by_bus', 'assets/landing/image/bxsea_image_bybus.png');
$visitorGettingAround = bxsea_design_asset('visit', 'visitor_getting_around', 'assets/landing/image/bxsea_image_gettingaround.png');
$visitorWaysToExplore = bxsea_design_asset('visit', 'visitor_ways_to_explore', 'assets/landing/image/bxsea_image_waystoexplore.png');
$visitorGuideApp1 = bxsea_design_asset('visit', 'visitor_guide_app_1', 'assets/landing/image/bxsea_image_guideapp.png');
$visitorGuideApp2 = bxsea_design_asset('visit', 'visitor_guide_app_2', 'assets/landing/image/bxsea_image_guideapp2.png');
$visitorGuideApp3 = bxsea_design_asset('visit', 'visitor_guide_app_3', 'assets/landing/image/bxsea_image_guideapp3.png');
$visitorGuideApp4 = bxsea_design_asset('visit', 'visitor_guide_app_4', 'assets/landing/image/bxsea_image_guideapp4.png');
$visitorGuideApp5 = bxsea_design_asset('visit', 'visitor_guide_app_5', 'assets/landing/image/bxsea_image_guideapp5.png');
$visitorAppStore = bxsea_design_asset('visit', 'visitor_app_store', 'assets/landing/image/bxsea_image_appstore.png');
$visitorPlayStore = bxsea_design_asset('visit', 'visitor_play_store', 'assets/landing/image/bxsea_image_playstore.png');
$visitorCtaWave = bxsea_design_asset('visit', 'faq_wave', 'assets/landing/image/wave-partnerships.png');
$visitorArrowWhite = bxsea_design_asset('visit', 'arrow_white', 'assets/landing/image/arrow-right-white.png');

$vpd = $visitorPageData ?? [];
$vpBanner  = $vpd['banner']  ?? [];
$vpWelcome = $vpd['welcome'] ?? [];
$vpHours   = $vpd['hours']   ?? [];
$vpImages1 = !empty($vpWelcome['visitorpage_pict1'])
    ? bxsea_asset_url('visitorpage', $vpWelcome['visitorpage_pict1'], '')
    : $visitorPenguin1;
$vpImages2 = !empty($vpWelcome['visitorpage_pict2'])
    ? bxsea_asset_url('visitorpage', $vpWelcome['visitorpage_pict2'], '')
    : $visitorPenguin2;
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="container">
      <div class="hero-image2">
        <img src="<?= $visitorHeroAsset; ?>" alt="Visitor information background">
      </div>
      <div class="row descBanner padding-banner">
        <h1 class="banner-title"><?= esc($vpBanner['visitorpage_title_en'] ?? 'VISITOR INFORMATION') ?></h1>
        <p class="banner-description"><?= esc($vpBanner['visitorpage_desc_en'] ?? 'Make the most of your visit to BXSea.') ?></p>
      </div>
    </div>
  </div>
</section>

<section class="vi-welcome-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <h2 class="vi-welcome-title"><?= esc($vpWelcome['visitorpage_title_en'] ?? 'Welcome to BXSea') ?></h2>
        <p class="vi-welcome-desc"><?= esc(bxsea_plain_text($vpWelcome['visitorpage_desc_en'] ?? 'Our oceanarium welcomes guests of all ages to explore the beauty of marine biodiversity.')) ?></p>
        <div class="vi-grid-image-top-sections d-flex gap-3">
          <div class="vi-grid-image-item">
            <img src="<?= esc($vpImages1) ?>" alt="Visitor activity" class="img-fluid">
          </div>
          <div class="vi-grid-image-item">
            <img src="<?= esc($vpImages2) ?>" alt="Visitor arrival" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="vi-hours-card">
          <h4 class="vi-hours-title"><?= esc($vpHours['visitorpage_title_en'] ?? 'Opening Hours') ?></h4>
          <?= bxsea_render_html($vpHours['visitorpage_desc_en'] ?? '<p>BXSea Oceanarium is open every day.</p>', '<p><br><strong><em><ul><ol><li><h1><h2><h3><h4>') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vi-know-section">
  <div class="container">
    <h2 class="vi-section-title">Know Before You Arrive</h2>
    <div class="row justify-content-center g-4 vi-know-grid">
      <?php foreach ($rules as $rule): ?>
      <div class="col-md-6 col-xl-3">
        <div class="vi-know-card">
          <div class="vi-know-card-box">
            <div class="vi-know-icon">
              <?php
                $ruleIconPath = !empty($visitorInfoRules)
                  ? bxsea_asset_url('visitorinfo', $rule['visitorinfo_icon'] ?? '', 'assets/landing/image/bxsea_icon_respectfull.png')
                  : base_url('assets/landing/image/' . ($rule['visitorinfo_icon'] ?? 'bxsea_icon_respectfull.png'));
              ?>
              <img src="<?= esc($ruleIconPath) ?>" alt="<?= esc($rule['visitorinfo_title'] ?? 'Visitor rule') ?>">
            </div>
            <h4><?= esc(bxsea_plain_text($rule['visitorinfo_title'] ?? '')) ?></h4>
            <p><?= esc(bxsea_plain_text($rule['visitorinfo_desc'] ?? '')) ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="vi-learn-section">
  <div class="container">
    <h2 class="vi-section-title vi-section-title--light">Learn & Conserve With Us</h2>
    <div class="vi-learn-carousel owl-carousel owl-theme">
      <?php foreach ($learnItems as $item): ?>
      <div class="vi-learn-card">
        <div class="vi-learn-card-image">
          <?php
            $learnImagePath = !empty($visitorInfoLearn)
              ? bxsea_asset_url('visitorinfo', $item['visitorinfo_image'] ?? '', 'assets/landing/image/bxsea_image_information_tablets.png')
              : base_url('assets/landing/image/' . ($item['visitorinfo_image'] ?? 'bxsea_image_information_tablets.png'));
          ?>
          <img src="<?= esc($learnImagePath) ?>" alt="<?= esc($item['visitorinfo_title'] ?? 'Visitor information') ?>">
        </div>
        <div class="vi-learn-card-body">
          <span><?= esc($item['visitorinfo_label_en'] ?? ($item['visitorinfo_label'] ?? 'LEARN')) ?></span>
          <h4><?= esc(bxsea_plain_text($item['visitorinfo_title'] ?? '')) ?></h4>
          <p><?= esc(bxsea_plain_text($item['visitorinfo_desc'] ?? '')) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="vi-guide-section">
  <div class="container">
    <h2 class="vi-section-title">Visitor Guide</h2>
    <div class="vi-guide-tabs">
      <button class="vi-guide-tab active" data-target="getting-here">Getting Here</button>
      <button class="vi-guide-tab" data-target="how-to-explore">Explore Guide</button>
      <button class="vi-guide-tab" data-target="explore-app">Ways to Explore</button>
      <button class="vi-guide-tab" data-target="bxsea-app">BXSea Explore App</button>
    </div>

    <!-- Panel: Getting Here -->
    <div class="vi-guide-panel active" id="getting-here">
      <div class="row g-4">
        <div class="col-lg-4">
          <span>PLAN YOUR VISIT</span>
          <h5>Directions &amp; Parking</h5>
          <div class="vi-guide-info-box">
            <div class="vi-guide-info-icon">
              <img src="<?= $visitorLocationIcon ?>" alt="BXSea location">
            </div>
            <div class="vi-guide-location">
              <p class="bold-text">Our Location</p>
              <p class="vi-guide-address">Bintaro Jaya Xchange Mall, <b class="bold-text">B1 Floor</b>, Jalan Sektor VII No.2 Lt. B1 - B2, Pondok Jaya, Pondok Aren, South Tangerang, Banten 15277</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="vi-accordion">
            <!-- BY TRAIN -->
            <div class="vi-accordion-item">
              <div class="vi-accordion-header" onclick="toggleAccordion(this)">
                <span>BY TRAIN</span>
                <i class="fa-solid fa-chevron-down vi-accordion-icon"></i>
              </div>
              <div class="vi-accordion-body">
                <div class="vi-accordion-padding">
                  <p>BXSea is located in <b class="bold-text">Bintaro Jaya Xchange Mall 2</b>, with direct access from Jurangmangu Station. Simply walk through the connecting tunnel that leads straight into the mall.</p>
                  <p>Before heading home, stop by <b class="bold-text">BXBirds</b>, our mini aviary that can be visited free of charge!</p>
                  <div class="grid-image">
                    <img src="<?= $visitorByTrain1 ?>" alt="">
                    <img src="<?= $visitorByTrain2 ?>" alt="">
                  </div>
                </div>
              </div>
            </div>
            <!-- BY PRIVATE VEHICLE -->
            <div class="vi-accordion-item">
              <div class="vi-accordion-header" onclick="toggleAccordion(this)">
                <span>PRIVATE VEHICLE</span>
                <i class="fa-solid fa-chevron-down vi-accordion-icon"></i>
              </div>
              <div class="vi-accordion-body">
                <div class="vi-accordion-padding">
                  <p>BXSea is located in <b class="bold-text">Bintaro Jaya Xchange Mall 2</b> and can be reached via several toll road access points. Spacious parking is available for guests arriving by private vehicle.</p>
                  <b class="bold-text">Toll Road Access</b>
                  <p>Option 1: From Jakarta</p>
                  <ol type="1">
                    <li>Enter the JORR toll road toward Bintaro.</li>
                    <li>Exit at Bintaro–Pondok Aren gate.</li>
                    <li>Turn left toward Jl. Boulevard Bintaro Jaya.</li>
                  </ol>
                  <p>Option 2: From Serpong</p>
                  <ol type="1">
                    <li>Enter Jakarta–Serpong toll road toward Bintaro.</li>
                    <li>Turn left at Bintaro–Pondok Aren exit gate.</li>
                    <li>Turn right to Jl. Tegal Rotan Raya toward Jl. Boulevard Bintaro Jaya.</li>
                    <li>Make a U-turn and turn left toward BXChange Mall.</li>
                  </ol>
                  <b class="bold-text">Parking</b>
                  <p>BXSea can be accessed from both BXChange Mall 1 and Mall 2 parking areas. For the closest access, we recommend parking at Mall 2, Level B2!</p>
                  <div class="grid-image">
                    <img src="<?= $visitorByVehicle1 ?>" alt="">
                    <img src="<?= $visitorByVehicle2 ?>" alt="">
                  </div>
                </div>
              </div>
            </div>
            <!-- BY BUS -->
            <div class="vi-accordion-item">
              <div class="vi-accordion-header" onclick="toggleAccordion(this)">
                <span>BY BUS</span>
                <i class="fa-solid fa-chevron-down vi-accordion-icon"></i>
              </div>
              <div class="vi-accordion-body">
                <div class="vi-accordion-padding">
                  <b class="bold-text">IN-TRANS</b>
                  <p>BXSea is located in <b class="bold-text">Bintaro Jaya Xchange Mall 2</b> and can be reached using In-Trans, the free shuttle bus service operating around the Bintaro Jaya area.</p>
                  <p>There are 4 available routes you can take to BXSea:</p>
                  <ul>
                    <li>Bus No. 1: Bintaro &gt; Kebayoran</li>
                    <li>Bus No. 2: Bintaro &gt; Emerald</li>
                    <li>Bus No. 3: BXChange Mall &gt; St. Pondok Ranji</li>
                    <li>Bus No. 4: BXChange Mall &gt; Graha Raya</li>
                  </ul>
                  <img class="bybus" src="<?= $visitorByBus ?>" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Panel: Explore Guide -->
    <div class="vi-guide-panel" id="how-to-explore">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="vi-guide-title">
            <h1>Oceanarium Map</h1>
          </div>
          <div class="vi-guide-desc">
            <p>Explore our marine life with ease using the Oceanarium Map. Download it directly to your device!</p>
          </div>
          <div class="vi-guide-button"><a href="<?= base_url('en/kunjungan/denah') ?>">View Oceanarium Map <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
          <div class="vi-guide-title">
            <h1>Accessibility Guide</h1>
          </div>
          <div class="vi-guide-desc">
            <p>BXSea is for everyone! Check out our Accessibility Guide to make your visit as comfortable as possible.</p>
          </div>
          <div class="vi-guide-button"><a href="<?= base_url('en/kunjungan/panduan-aksesibilitas') ?>">View Accessibility Guide <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
        </div>
        <div class="col-lg-6">
          <div class="image-getting-around"><img class="img-fluid" src="<?= $visitorGettingAround ?>" alt="Explore guide"></div>
        </div>
      </div>
    </div>

    <!-- Panel: Ways to Explore -->
    <div class="vi-guide-panel" id="explore-app">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="image-getting-around d-flex justify-content-center"><img class="img-fluid" src="<?= $visitorWaysToExplore ?>" alt="Ways to explore"></div>
        </div>
        <div class="col-lg-6">
          <div class="vi-guide-title">
            <h1>Show Schedule</h1>
          </div>
          <div class="vi-guide-desc">
            <p>Make the most of your BXSea visit by checking the Show Schedule first! Learn more about our marine life through various educational shows.</p>
            <p>No additional ticket is needed to watch our daily shows.</p>
          </div>
          <div class="vi-guide-button"><a href="<?= base_url('en/kunjungan/jadwal-aquarium') ?>">View Show Schedule <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
          <div class="vi-guide-title">
            <h1>Food &amp; Beverages</h1>
          </div>
          <div class="vi-guide-desc">
            <p>Enjoy delicious food from our various tenants!</p>
          </div>
          <div class="vi-guide-button"><a href="<?= base_url('en/kunjungan/tenant') ?>">View Our Tenants <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
        </div>
      </div>
    </div>

    <!-- Panel: BXSea App -->
    <div class="vi-guide-panel" id="bxsea-app">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7">
          <div class="vi-guide-images">
            <div class="row g-3">
              <div class="col-6 d-flex justify-content-end"><img src="<?= $visitorGuideApp1 ?>" class="img-fluid vi-guide-img" alt="BXSea Explore App"></div>
              <div class="col-6"><img src="<?= $visitorGuideApp2 ?>" class="img-fluid vi-guide-img" alt="BXSea Explore App"></div>
              <div class="col-4 d-flex justify-content-end"><img src="<?= $visitorGuideApp3 ?>" class="img-fluid vi-guide-img" alt="BXSea Explore App"></div>
              <div class="col-4 d-flex justify-content-center"><img src="<?= $visitorGuideApp4 ?>" class="img-fluid vi-guide-img" alt="BXSea Explore App"></div>
              <div class="col-4"><img src="<?= $visitorGuideApp5 ?>" class="img-fluid vi-guide-img" alt="BXSea Explore App"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="custom-guide-text">
            <h2 class="guide-title">Digital Guide</h2>
            <p class="guide-desc">Don't miss the <span>BXSea Explore</span> app for an even more exciting adventure at BXSea!</p>
            <ol class="guide-list">
              <li>Navigate your journey directly in the app via Bluetooth sensors placed throughout each zone.</li>
              <li>Discover each species through detailed and comprehensive profiles available in the app!</li>
              <li>Complete various missions along the way for your BXSea Buddy through fun in-app games.</li>
            </ol>
            <div class="vi-guide-app-badges">
              <a href="#" class="vi-guide-app-badge"><img src="<?= $visitorAppStore ?>" alt="App Store"></a>
              <a href="#" class="vi-guide-app-badge"><img src="<?= $visitorPlayStore ?>" alt="Play Store"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="Partnership">
  <img class="wave-partnerships" src="<?= $visitorCtaWave ?>" alt="">
  <div class="box-partnerships">
    <div class="container">
      <div class="title-partnerships"><h1>Can’t find what you’re looking for?</h1></div>
      <div class="desc-partnerships"><p>Take a look at our Frequently-Asked Questions to have your question answered.</p></div>
      <div class="btn-partnerships"><a href="<?= base_url('en/kunjungan/faq') ?>">FAQ <img class="arrow-right-btn-partnerships" src="<?= $visitorArrowWhite ?>" alt=""></a></div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  // Owl Carousel – Learn Section
  $(document).ready(function() {
    if ($('.vi-learn-carousel').length) {
      $('.vi-learn-carousel').owlCarousel({
        loop: false,
        margin: 24,
        nav: true,
        dots: true,
        responsive: {
          0:    { items: 1 },
          576:  { items: 2 },
          992:  { items: 3 }
        }
      });
    }

    // Tab switching
    $('.vi-guide-tab').on('click', function() {
      var target = $(this).data('target');
      $('.vi-guide-tab').removeClass('active');
      $(this).addClass('active');
      $('.vi-guide-panel').removeClass('active');
      $('#' + target).addClass('active');
    });
  });

  // Accordion for Getting Here
  function toggleAccordion(header) {
    var item = header.parentElement;
    var body = item.querySelector('.vi-accordion-body');
    var icon = header.querySelector('.vi-accordion-icon');
    var isOpen = item.classList.contains('open');
    // Close all siblings
    var siblings = item.parentElement.querySelectorAll('.vi-accordion-item');
    siblings.forEach(function(sib) {
      sib.classList.remove('open');
      sib.querySelector('.vi-accordion-body').style.maxHeight = null;
      var sibIcon = sib.querySelector('.vi-accordion-icon');
      if (sibIcon) sibIcon.style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
      item.classList.add('open');
      body.style.maxHeight = body.scrollHeight + 'px';
      if (icon) icon.style.transform = 'rotate(180deg)';
    }
  }
</script>
<?= $this->endSection() ?>