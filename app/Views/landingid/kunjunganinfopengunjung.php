<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$defaultRules = [
  [
    'visitorinfo_title' => 'Saling Menghargai dan Peduli',
    'visitorinfo_desc' => 'Hari libur dan jam sibuk biasanya akan sedikit lebih ramai, jadi harap tetap memperhatikan kenyamanan di sekitar Anda',
    'visitorinfo_icon' => 'bxsea_icon_respectfull.png',
  ],
  [
    'visitorinfo_title' => 'Anak-anak Harus dalam Pengawasan',
    'visitorinfo_desc' => 'Demi keselamatan buah hati Anda, perlindungan biota laut, serta kenyamanan seluruh pengunjung, harap selalu dampingi dan pastikan anak-anak berada dalam pengawasan Anda setiap saat!',
    'visitorinfo_icon' => 'bxsea_icon_children.png',
  ],
  [
    'visitorinfo_title' => 'Dilarang Menggunakan Flash Kamera',
    'visitorinfo_desc' => 'Mohon matikan flash kamera Anda saat memotret, karena cahayanya dapat menyilaukan, membuat stres, atau mengejutkan biota kami',
    'visitorinfo_icon' => 'bxsea_icon_no_flash.png',
  ],
  [
    'visitorinfo_title' => 'Dilarang Membawa Makanan atau Minuman',
    'visitorinfo_desc' => 'Mohon tidak membawa makanan dan minuman ke dalam BXSea. Hal ini demi melindungi biota dari risiko kontaminasi, tumpahan, serta pemberian makan yang tidak sesuai aturan',
    'visitorinfo_icon' => 'bxsea_icon_no_food.png',
  ],
];

$defaultLearn = [
  [
    'visitorinfo_title' => 'Tablet Informasi',
    'visitorinfo_desc' => 'Tersedia di setiap akuarium di seluruh zona Long Journey, Tablet Informasi kami menyajikan detail mendalam serta fakta-fakta menarik mengenai setiap biota di BXSea',
    'visitorinfo_image' => 'bxsea_image_information_tablets.png',
  ],
  [
    'visitorinfo_title' => 'Touch Pool',
    'visitorinfo_desc' => 'Sentuh dan pelajari bintang laut, bulu babi, serta makhluk pesisir lainnya dengan lembut, dengan panduan langsung dari pemandu edukasi kami',
    'visitorinfo_image' => 'bxsea_image_touchpool_visitor.png',
  ],
  [
    'visitorinfo_title' => 'BXSea Explore App',
    'visitorinfo_desc' => 'Jelajahi setiap spesies melalui profil lengkap dan mendalam yang tersedia di aplikasi ini!',
    'visitorinfo_image' => 'bxsea_image_bxsea_app.png',
  ],
  [
    'visitorinfo_title' => 'Zona Konservasi',
    'visitorinfo_desc' => 'Masuki Zona Mangrove kami dan saksikan bagaimana kami menjaga kelestarian spesies terancam punah dari seluruh dunia',
    'visitorinfo_image' => 'bxsea_image_zona_konservasi.png',
  ],
  [
    'visitorinfo_title' => 'Meja Interaktif',
    'visitorinfo_desc' => 'Jelajahi berbagai area dan biota di seluruh BXSea melalui meja interaktif kami',
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

$visitorGuideTabs = [
  ['target' => 'getting-here', 'label' => 'Cara Menuju ke Sini'],
  ['target' => 'how-to-explore', 'label' => 'Panduan Menjelajah'],
  ['target' => 'explore-app', 'label' => 'Cara Menjelajah'],
  ['target' => 'bxsea-app', 'label' => 'BXSea Explore App'],
];

$visitorGuideGettingHereItems = [
  [
    'title' => 'NAIK KERETA',
    'body' => '<p>BXSea terletak di Bintaro Jaya Xchange Mall 2, yang memiliki akses langsung ke Stasiun Jurangmangu. Cukup berjalan kaki melalui terowongan penghubung yang akan mengarahkan Anda langsung ke area mal.</p><p>Saat hendak pulang, jangan lewatkan burung-burung cantik di BXBirds, aviari mini kami yang dapat dikunjungi secara gratis!</p>',
    'images' => [$visitorByTrain1, $visitorByTrain2],
    'singleImage' => '',
  ],
  [
    'title' => 'KENDARAAN PRIBADI',
    'body' => '<p>BXSea terletak di Bintaro Jaya Xchange Mall 2 dan dapat diakses melalui berbagai ruas jalan tol. Tersedia area parkir yang luas bagi Anda yang membawa kendaraan pribadi.</p><p><strong>Akses Jalan Tol</strong></p><p>Opsi 1: Dari Jakarta</p><ol type="1"><li>Masuk ke Tol JORR ke arah Bintaro.</li><li>Keluar melalui gerbang Tol Bintaro–Pondok Aren.</li><li>Belok kiri ke arah Jl. Boulevard Bintaro Jaya.</li></ol><p>Opsi 2: Dari Serpong</p><ol type="1"><li>Masuk ke Tol Jakarta–Serpong ke arah Bintaro.</li><li>Belok kiri di gerbang keluar Bintaro–Pondok Aren.</li><li>Belok kanan di Jl. Tegal Rotan Raya menuju Jl. Boulevard Bintaro Jaya.</li><li>Putar balik dan belok kiri menuju BXChange Mall.</li></ol><p><strong>Parkir</strong></p><p>BXSea dapat diakses melalui area parkir BXchange Mall 1 maupun Mall 2. Untuk posisi parkir terdekat dengan BXSea, Anda disarankan parkir di Mall 2, Lantai B2!</p>',
    'images' => [$visitorByVehicle1, $visitorByVehicle2],
    'singleImage' => '',
  ],
  [
    'title' => 'NAIK BUS',
    'body' => '<p><strong>IN-TRANS</strong></p><p>BXSea terletak di Bintaro Jaya Xchange Mall 2 dan dapat diakses menggunakan In-Trans, layanan bus jemputan (shuttle bus) gratis yang beroperasi di wilayah Bintaro Jaya.</p><p>Terdapat 4 rute yang dapat Anda pilih untuk menuju BXSea:</p><ul><li>Bus Nomor 1: Bintaro &gt; Kebayoran</li><li>Bus Nomor 2: Bintaro &gt; Emerald</li><li>Bus Nomor 3: BXChange Mall &gt; St. Pondok Ranji</li><li>Bus Nomor 4: BXChange Mall &gt; Graha Raya</li></ul>',
    'images' => [],
    'singleImage' => $visitorByBus,
  ],
];
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="container">
      <div class="hero-image2">
        <img src="<?= $visitorHeroAsset; ?>" alt="">
      </div>
      <div class="row descBanner padding-banner">
        <h1 class="banner-title">INFORMASI PENGUNJUNG</h1>
        <p class="banner-description">Maksimalkan kunjungan Anda di BXSea!</p>
      </div>
    </div>
  </div>
</section>

<section class="vi-welcome-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <h2 class="vi-welcome-title">Selamat Datang di BXSea!</h2>
        <p class="vi-welcome-desc">Oceanarium kami mengundang pengunjung dari berbagai kalangan untuk menjelajahi keanekaragaman laut yang memukau di BXSea. Agar kunjungan Anda lebih maksimal, harap ikuti langkah-langkah sederhana berikut demi menjaga lingkungan yang aman dan nyaman bagi kita semua</p>
        <div class="vi-grid-image-top-sections d-flex gap-3">
          <div class="vi-grid-image-item">
            <img src="<?= $visitorPenguin1; ?>" alt="Activity Room" class="img-fluid">
          </div>
          <div class="vi-grid-image-item">
            <img src="<?= $visitorPenguin2; ?>" alt="Arrival" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="vi-hours-card">
          <h4 class="vi-hours-title">Jam Operasional</h4>
          <p class="vi-hours-desc">BXSea Oceanarium buka <strong>setiap hari</strong>.</p>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Senin:</p>
            <p class="vi-hours-day">10:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Selasa:</p>
            <p class="vi-hours-day">10:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Rabu:</p>
            <p class="vi-hours-day">10:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Kamis:</p>
            <p class="vi-hours-day">10:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Jumat:</p>
            <p class="vi-hours-day">10:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Sabtu:</p>
            <p class="vi-hours-day">09:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-row">
            <p class="vi-hours-time">Minggu:</p>
            <p class="vi-hours-day">09:00 – 22:00 WIB</p>
          </div>
          <div class="vi-hours-divider"></div>
          <div class="vi-hours-row-light">
            <p class="vi-hours-day">Pembelian Tiket Terakhir pukul 21:00 setiap hari</p>
          </div>
          <div class="vi-hours-row-light">
            <p class="vi-hours-time-light">* Seluruh waktu yang tertera dalam WIB (Waktu Indonesia Barat)</p>
          </div>
          <div class="vi-hours-row-light">
            <p class="vi-hours-time-light">* Jam operasional dapat berubah sewaktu-waktu</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vi-know-section">
  <div class="container">
    <h2 class="vi-section-title">Hal yang Perlu Diketahui Sebelum Berkunjung</h2>
    <div class="row justify-content-center g-4 vi-know-grid">
      <?php foreach ($rules as $rule): ?>
      <div class="col-md-6 col-xl-3">
        <div class="vi-know-card">
          <div class="vi-know-card-box">
            <div class="vi-know-icon">
              <?php
              $ruleIcon = !empty($rule['visitorinfo_icon']) && !str_contains($rule['visitorinfo_icon'], '.')
                  ? $rule['visitorinfo_icon']
                  : ($rule['visitorinfo_icon'] ?? '');
              $ruleIconUrl = !empty($visitorInfoRules)
                  ? bxsea_asset_url('visitorinfo', $rule['visitorinfo_icon'] ?? '', 'assets/landing/image/bxsea_icon_respectfull.png')
                  : base_url('assets/landing/');
              $ruleIconPath = !empty($visitorInfoRules)
                  ? $ruleIconUrl
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
    <h2 class="vi-section-title vi-section-title--light">Edukasi &amp; Konservasi Bersama BXSea</h2>
    <div class="vi-learn-carousel owl-carousel owl-theme">
      <?php foreach ($learnItems as $item): ?>
      <div class="vi-learn-card">
        <div class="vi-learn-card-image">
          <?php
          $learnImagePath = !empty($visitorInfoLearn)
              ? bxsea_asset_url('visitorinfo', $item['visitorinfo_image'] ?? '', 'assets/landing/image/bxsea_image_information_tablets.png')
              : base_url('assets/landing/image/' . ($item['visitorinfo_image'] ?? 'bxsea_image_information_tablets.png'));
          ?>
          <img src="<?= esc($learnImagePath) ?>" alt="<?= esc($item['visitorinfo_title'] ?? 'Visitor info') ?>">
        </div>
        <div class="vi-learn-card-body">
          <span>EDUKASI</span>
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
    <h2 class="vi-section-title">Panduan Pengunjung</h2>
    <div class="vi-guide-tabs">
      <?php foreach ($visitorGuideTabs as $index => $tab): ?>
      <button class="vi-guide-tab<?= $index === 0 ? ' active' : '' ?>" data-target="<?= esc($tab['target']) ?>" onclick="switchVisitorGuideTab(this)"><?= esc($tab['label']) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="vi-guide-panel active" id="getting-here">
      <div class="row g-4">
        <div class="col-lg-4">
          <span>RENCANAKAN KUNJUNGAN ANDA</span>
          <h5>Petunjuk Jalan &amp; Parkir</h5>
          <div class="vi-guide-info-box">
            <div class="vi-guide-info-icon">
              <img src="<?= $visitorLocationIcon ?>" alt="Lokasi BXSea">
            </div>
            <div class="vi-guide-location">
              <p>Lokasi Kami</p>
              <p class="vi-guide-address">Bintaro Jaya Xchange Mall, Lantai B1 Jalan Sektor VII No.2 Lt. B1 - B2, Pondok Jaya, Pondok Aren, Kota Tangerang Selatan, Banten 15277</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="vi-accordion">
            <?php foreach ($visitorGuideGettingHereItems as $guideItem): ?>
            <div class="vi-accordion-item">
              <div class="vi-accordion-header" onclick="toggleAccordion(this)">
                <span><?= esc($guideItem['title']) ?></span>
                <i class="fa-solid fa-chevron-down vi-accordion-icon"></i>
              </div>
              <div class="vi-accordion-body">
                <div class="vi-accordion-padding">
                  <?= bxsea_render_html($guideItem['body'], '<p><br><strong><em><ul><ol><li>') ?>
                  <?php if (!empty($guideItem['images'])): ?>
                  <div class="grid-image">
                    <?php foreach ($guideItem['images'] as $guideImage): ?>
                    <img src="<?= esc($guideImage) ?>" alt="<?= esc($guideItem['title']) ?>">
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                  <?php if (!empty($guideItem['singleImage'])): ?>
                  <img class="bybus" src="<?= esc($guideItem['singleImage']) ?>" alt="<?= esc($guideItem['title']) ?>">
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="vi-guide-panel" id="how-to-explore">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="vi-guide-title"><h1>Denah Oceanarium</h1></div>
          <div class="vi-guide-desc"><p>Jelajahi beragam kehidupan laut kami dengan mudah menggunakan Denah Oceanarium. Unduh langsung ke perangkat Anda!</p></div>
          <div class="vi-guide-button"><a href="<?= base_url('id/kunjungan/denah') ?>">Lihat Denah Oceanarium <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
          <div class="vi-guide-title"><h1>Panduan Aksesibilitas</h1></div>
          <div class="vi-guide-desc"><p>BXSea hadir untuk semua! Simak Panduan Aksesibilitas kami agar kunjungan Anda berjalan senyaman mungkin</p></div>
          <div class="vi-guide-button"><a href="<?= base_url('id/kunjungan/panduan-aksesibilitas') ?>">Lihat Panduan Aksesibilitas <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
        </div>
        <div class="col-lg-6">
          <div class="image-getting-around"><img class="img-fluid" src="<?= $visitorGettingAround ?>" alt="Panduan menjelajah"></div>
        </div>
      </div>
    </div>

    <div class="vi-guide-panel" id="explore-app">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="image-getting-around d-flex justify-content-center"><img class="img-fluid" src="<?= $visitorWaysToExplore ?>" alt="Cara menjelajah"></div>
        </div>
        <div class="col-lg-6">
          <div class="vi-guide-title"><h1>Jadwal Pertunjukan</h1></div>
          <div class="vi-guide-desc"><p>Maksimalkan kunjungan Anda di BXSea dengan memeriksa Jadwal Pertunjukan terlebih dahulu! Pelajari lebih dalam tentang kehidupan laut kami melalui berbagai pertunjukan edukatif.</p><p>Tidak diperlukan tiket tambahan untuk menyaksikan pertunjukan harian kami.</p></div>
          <div class="vi-guide-button"><a href="<?= base_url('id/kunjungan/jadwal-aquarium') ?>">Lihat Jadwal Pertunjukan <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
          <div class="vi-guide-title"><h1>Makanan &amp; Minuman</h1></div>
          <div class="vi-guide-desc"><p>Nikmati hidangan lezat dari berbagai tenan kami!</p></div>
          <div class="vi-guide-button"><a href="<?= base_url('id/kunjungan/tenant') ?>">Lihat Tenan Kami <div class="arrow-right-vi-guide-button">&gt;</div></a></div>
        </div>
      </div>
    </div>

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
            <h2 class="guide-title">Panduan Digital</h2>
            <p class="guide-desc">Jangan lewatkan aplikasi <strong>BXSea Explore</strong> untuk petualangan yang lebih seru di BXSea!</p>
            <ol class="guide-list">
              <li>Pandu perjalanan Anda langsung di aplikasi melalui sensor Bluetooth di setiap zona.</li>
              <li>Jelajahi setiap spesies melalui profil lengkap dan detail yang tersedia di aplikasi ini.</li>
              <li>Selesaikan berbagai misi sepanjang perjalanan untuk BXSea Buddy Anda dengan permainan yang menyenangkan.</li>
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
      <div class="title-partnerships">
        <h1>Belum menemukan yang Anda cari?</h1>
      </div>
      <div class="desc-partnerships">
        <p>Simak Pertanyaan Umum (FAQ) kami untuk menemukan jawaban yang Anda butuhkan</p>
      </div>
      <div class="btn-partnerships">
        <a href="<?= base_url('id/kunjungan/faq') ?>">FAQ<img class="arrow-right-btn-partnerships" src="<?= $visitorArrowWhite ?>" alt=""></a>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
