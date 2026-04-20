<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>owl-carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>owl-carousel/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>splide-4.1.3/splide-4.1.3/dist/css/splide.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>evo-calendar/css/evo-calendar.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>evo-calendar/css/evo-calendar.royal-navy.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>style.css">
  <link rel="shortcut icon" href="<?= bxsea_design_asset('global', 'favicon', 'assets/landing/image/logo-BXSea.png');?>" type="image/x-icon">
  <script src="<?= base_url('assets/landing/');?>bootstrap/js/jquery3.6.3.min.js"></script>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5J9ERF53WJ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-5J9ERF53WJ');
  </script>
  <title><?= esc($title ?? 'BXSea');?> - BXSea</title>
</head>
<body class="wrapgrid">

  <?php
  $setupAddress = bxsea_plain_text($setup[0]['setup_address'] ?? 'Bintaro Xchange Mall');
  $setupTitle = bxsea_plain_text($setup[0]['setup_title'] ?? '') ?: 'BXSea';
  $topBarAddress = preg_replace('/Bintaro Jaya Xchange Mall[^,]*/i', 'Bintaro Xchange Mall', $setupAddress);
  $topBarAddress = trim(explode(',', $topBarAddress)[0] ?? $topBarAddress);
  if ($topBarAddress === '') {
      $topBarAddress = 'Bintaro Xchange Mall';
  }
    $topBarDuration = bxsea_plain_text($setup[0]['setup_operation_duration'] ?? '10:00 - 22:00');
    if ($topBarDuration !== '' && stripos($topBarDuration, 'pembelian tiket terakhir') === false) {
      $topBarDuration .= ' (Pembelian Tiket Terakhir pukul 21:00)';
    }
  $currentPath = trim((string) service('uri')->getPath(), '/');
  $isHome = $currentPath === 'id';
  $isTicket = str_starts_with($currentPath, 'id/tiket');
  $isJourney = str_starts_with($currentPath, 'id/journey');
  $isVisit = str_starts_with($currentPath, 'id/kunjungan');
  $isNews = str_starts_with($currentPath, 'id/berita');
  ?>

  <div class="loader-wrap">
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#007bff" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,128C560,96,640,64,720,53.3C800,43,880,53,960,74.7C1040,96,1120,128,1200,138.7C1280,149,1360,139,1400,133.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
    </svg>
  </div>

  <!-- Top Bar -->
  <div class="top-bar top-bar-bottom">
    <div class="container top-bar-flex">
      <div class="left-topbar">
        <div class="time-secondbar">
          <img src="<?= bxsea_design_asset('global', 'clock_icon_id', 'assets/landing/image/icons8-clock-40.png');?>" alt="">
          <div class="time-block">
            <h6><?= esc($setup[0]['setup_operation_day'] ?? 'Senin - Minggu');?></h6>
            <p><?= esc($topBarDuration);?></p>
          </div>
        </div>
        <div class="adress-secondbar">
          <img src="<?= bxsea_design_asset('global', 'location_icon_id', 'assets/landing/image/icons8-location-40.png');?>" alt="">
          <div class="address-block">
            <h6><a target="_blank" href="<?= esc($setup[0]['setup_gmaps'] ?? '#');?>" style="text-decoration:none;color:inherit;"><?= esc($topBarAddress);?></a></h6>
          </div>
        </div>
      </div>
      <div class="right-topbar">
        <div class="sosmed-topbar">
          <a href="#" id="search-icon-btn" onclick="openSearchPopup(); return false;">
            <img class="search-topbar" src="<?= bxsea_design_asset('global', 'search_icon', 'assets/landing/image/bxsea_icon_search.png');?>" alt="">
          </a>
          <?php if(!empty($sosmed_header_a)): foreach($sosmed_header_a AS $sha): ?>
          <a href="<?= esc($sha['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer">
            <img src="<?= bxsea_asset_url('socialmedia', $sha['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sha['mastersocialmedia_name'] ?? '', 'header'));?>" alt="<?= esc($sha['mastersocialmedia_name']);?>">
          </a>
          <?php endforeach; endif; ?>
        </div>
        <div class="dropdown">
          <div class="select">
            <img src="<?= bxsea_design_asset('global', 'globe_icon', 'assets/landing/image/globe.svg');?>" alt="">
            <span class="selected">ID</span>
            <div class="caret me-2"></div>
          </div>
          <div class="menu">
            <li><a href="<?= base_url('en');?>">EN</a></li>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Header / Navbar -->
  <div class="header-navbar-contact top-bar-animation header-navbar-contact-bottom">
    <nav class="nav">
      <div class="container navbar__menu">
        <a class="navbar-responsive" href="<?= base_url('id');?>">
          <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="BXSea Logo">
        </a>
        <div class="dropdown-">
          <div class="select2">
            <img src="<?= bxsea_design_asset('global', 'globe_icon', 'assets/landing/image/globe.svg');?>" alt="">
            <span class="selected2">ID</span>
            <div class="caret2 me-2"></div>
          </div>
          <div class="menu2">
            <li><a href="<?= base_url('en');?>">EN</a></li>
          </div>
        </div>
        <div class="toggle__menu" id="toggle-menu">
          <i class="fa-solid fa-bars-staggered"></i>
        </div>
        <ul class="nav__list" id="nav-menu">
          <div class="close__menu" id="close-menu">
            <i class="fa-solid fa-xmark"></i>
          </div>
          <a href="<?= base_url('id');?>" class="logo-bexsea">
            <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="BXSea Logo">
          </a>
          <li class="nav__link<?= $isHome ? ' is-active' : '';?>"><a href="<?= base_url('id');?>">Beranda</a></li>

          <li class="dropdown__menu-<?= $isTicket ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Tiket</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <div class="title-megamenu-item"><h4>Tiket</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/tiket/harga');?>">Pesan Tiket</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/tiket/promosi');?>">Promosi</a></div></li>
              </ul>
              <ul class="content">
                <div class="title-megamenu-item"><h4>Jelajahi BXSea Lebih Jauh</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/tiket/pengalaman-premium');?>">Add-Ons</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/tiket/program-kunjungan-sekolah');?>">Program Sekolah</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/tiket/momen-istimewa');?>">Momen Spesial</a></div></li>
              </ul>
            </div>
          </li>

          <li class="dropdown__menu-<?= $isJourney ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Jelajahi</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/journey/journey-utama');?>">Journey Utama</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/journey/pertunjukan');?>">Pertunjukan</a></div></li>
              </ul>
            </div>
          </li>

          <li class="dropdown__menu-<?= $isVisit ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Info Kunjungan</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <div class="title-megamenu-item"><h4>Rencanakan Kunjunganmu</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/informasi-pengunjung');?>">Informasi Pengunjung</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/jadwal-aquarium');?>">Jadwal Pertunjukan</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/denah');?>">Denah Oceanarium</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/panduan-aksesibilitas');?>">Panduan Aksesibilitas</a></div></li>
              </ul>
              <ul class="content">
                <div class="title-megamenu-item"><h4>Info Selengkapnya</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/tenant');?>">Tenant Kami</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/merchandise');?>">Merchandise</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/faq');?>">FAQ</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami</a></div></li>
              </ul>
            </div>
          </li>

          <li class="nav__link<?= $isNews ? ' is-active' : '';?>"><a href="<?= base_url('/id/berita');?>">Berita Terkini</a></li>

          <div class="contact">
            <a href="https://ticket.bxsea.co.id/" target="_blank" rel="noopener noreferrer">Pesan Tiket</a>
          </div>
          <div class="sosmed-topbar2">
            <?php if(!empty($sosmed_header_b)): foreach($sosmed_header_b AS $shb): ?>
            <a href="<?= esc($shb['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer">
              <img src="<?= bxsea_asset_url('socialmedia', $shb['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($shb['mastersocialmedia_name'] ?? '', 'header'));?>" alt="">
            </a>
            <?php endforeach; endif; ?>
          </div>
        </ul>
      </div>
    </nav>
  </div>

  <!-- Search Popup -->
  <div id="search-popup" class="search-popup" style="display:none;">
    <div class="search-popup-inner">
      <form action="<?= base_url('/id/berita');?>" method="get">
        <input type="text" name="q" placeholder="Cari berita, promosi...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <button onclick="closeSearchPopup()" class="close-search"><i class="fa-solid fa-xmark"></i></button>
    </div>
  </div>

  <?= $this->renderSection('content'); ?>

  <!-- Footer -->
  <footer class="shadow">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-between">
          <div class="social-footer">
            <?php if(!empty($sosmed)): foreach($sosmed AS $sm): ?>
            <a href="<?= esc($sm['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($sm['mastersocialmedia_name']);?>">
              <div class="<?= esc($sm['mastersocialmedia_name']);?>">
                <img src="<?= bxsea_asset_url('socialmedia', $sm['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sm['mastersocialmedia_name'] ?? '', 'footer'));?>" alt="<?= esc($sm['mastersocialmedia_name']);?>">
              </div>
            </a>
            <?php endforeach; endif; ?>
          </div>
          <div class="about-us-footer">
            <a href="<?= base_url('/id/tentang-kami');?>">Tentang Kami <img src="<?= base_url('assets/landing/image/arrow-right-white.png');?>" alt=""></a>
          </div>
        </div>
        <div class="col-lg-2 box-center">
          <div class="navbar-footer">
            <h4>Rencanakan Kunjunganmu</h4>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/tiket/harga');?>">Pesan Tiket</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/informasi-pengunjung');?>">Informasi Pengunjung</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/jadwal-aquarium');?>">Jadwal Pertunjukan</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/denah');?>">Denah Oceanarium</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/panduan-aksesibilitas');?>">Panduan Aksesibilitas</a></div>
          </div>
        </div>
        <div class="col-lg-2 box-center">
          <div class="navbar-footer">
            <h4>Informasi</h4>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/berita');?>">Berita Terkini</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/tenant');?>">Tenant Kami</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/merchandise');?>">Merchandise</a></div>
          </div>
        </div>
        <div class="col-lg-2 box-center">
          <div class="navbar-footer">
            <h4>Pusat Bantuan</h4>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/kunjungan/faq');?>">FAQ</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/syarat-ketentuan');?>">Syarat &amp; Ketentuan</a></div>
            <div class="items-navbar-footer"><a href="<?= base_url('/id/privasi');?>">Kebijakan Privasi</a></div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="brand-footer">
            <?php if(!empty($setup[0]['setup_footer_holding_pict'])): ?>
            <img src="<?= bxsea_design_asset('global', 'footer_holding', 'assets/landing/image/Jaya Property True White.png');?>" alt="">
            <?php endif; ?>
            <?php if(!empty($setup[0]['setup_footer_company_pict'])): ?>
            <img src="<?= bxsea_design_asset('global', 'footer_company', 'assets/landing/image/logo_footer.png');?>" alt="">
            <?php endif; ?>
          </div>
          <div class="address-footer">
            <p><?= esc($setupAddress);?></p>
          </div>
          <div class="corporate-footer">
            <div class="left-grid">
              <p>PT Jaya Real Property, Tbk.</p>
              <span>CBD Emerald Blok CE/A No. 1, Boulevard Bintaro Jaya, Tangerang 15227 Indonesia</span>
            </div>
            <div class="right-grid">
              <p>Jadilah Bagian dari Keluarga BXSea!</p>
              <div class="btn-partnerships-footer">
                <a href="<?= base_url('/id/kunjungan/partnership');?>">Gabung Sekarang</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="social-footer-mobile">
            <?php if(!empty($sosmed)): foreach($sosmed AS $sm): ?>
            <a href="<?= esc($sm['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($sm['mastersocialmedia_name']);?>">
              <div class="<?= esc($sm['mastersocialmedia_name']);?>">
                <img src="<?= bxsea_asset_url('socialmedia', $sm['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sm['mastersocialmedia_name'] ?? '', 'footer'));?>" alt="<?= esc($sm['mastersocialmedia_name']);?>">
              </div>
            </a>
            <?php endforeach; endif; ?>
          </div>
        </div>
        <div class="bg-darkline"></div>
        <div class="copyright">Copyright . All Rights Reserved.</div>
      </div>
    </div>
  </footer>

  <script src="<?= base_url('assets/landing/');?>bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>owl-carousel/dist/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>evo-calendar/js/evo-calendar.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>gsap-public/gsap-public/minified/gsap.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>splide-4.1.3/splide-4.1.3/dist/js/splide.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>splide-extension-auto-scroll-master/splide-extension-auto-scroll-master/dist/js/splide-extension-auto-scroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>main.js?v=20260418e"></script>
  <script>
    function mountSplideIfPresent(selector, options, extensions) {
      if (typeof Splide === 'undefined' || !document.querySelector(selector)) {
        return null;
      }

      var instance = new Splide(selector, options);
      instance.mount(extensions);

      return instance;
    }

    mountSplideIfPresent('.klien-splide', {
      perPage: 3,
      pagination: false,
      arrows: false,
      breakpoints: {
        767: {
          perPage: 2,
          arrows: true,
        },
        992: {
          perPage: 3,
        },
        1200: {
          perPage: 3,
        },
        1400: {
          perPage: 3,
        },
      },
    });

    let currentScroll = 0;
    let isScrollingDown = true;

    let tween = null;

    if (document.querySelector('.marquee__inner')) {
      tween = gsap.to('.marquee__inner', {
        xPercent: -100,
        repeat: -1,
        duration: 25,
        ease: 'linear',
      }).totalProgress(.5);
    }

    let index = 1;
    let timer;

    const moveTo = e => {
      showSlide((index = e));
    };

    const changeSlide = e => {
      showSlide((index += e));
    };

    const showSlide = e => {
      const images = document.querySelectorAll('.slider-item');

      if (!images.length) {
        return;
      }

      e > images.length ? (index = 1) : null;
      e < 1 ? (index = images.length) : null;

      for (let image of images) {
        image.style.opacity = '0';
      }

      images[index - 1].style.opacity = '1';
    };

    const autoSlide = () => {
      if (!document.querySelectorAll('.slider-item').length) {
        return;
      }

      timer = setInterval(() => {
        changeSlide(1);
      }, 3000);
    };

    showSlide(1);
    autoSlide();

    mountSplideIfPresent('.review-influencer-splide', {
      type: 'loop',
      pagination: false,
      gap: 15,
      snap: false,
      perPage: 1,
    });

    mountSplideIfPresent('.card-ticketing-splide', {
      gap: 25,
      snap: false,
      perPage: 4,
      pagination: false,
      arrows: false,
      breakpoints: {
        500: {
          perPage: 1,
          padding: '2rem',
          gap: 10,
        },
        768: {
          perPage: 2,
          gap: 10,
        },
        992: {
          perPage: 2,
          gap: 10,
        },
        1024: {
          perPage: 3,
          gap: 10,
        },
        1200: {
          perPage: 3,
          gap: 10,
        },
      },
    });

    mountSplideIfPresent('.card-ticketing-splide2', {
      gap: 25,
      snap: false,
      perPage: 2,
      pagination: false,
      arrows: false,
      breakpoints: {
        500: {
          perPage: 1,
          padding: '2rem',
          gap: 10,
        },
        768: {
          perPage: 2,
          gap: 10,
        },
        992: {
          perPage: 2,
          gap: 10,
        },
        1024: {
          perPage: 2,
          gap: 10,
        },
        1200: {
          perPage: 2,
          gap: 10,
        },
      },
    });

    mountSplideIfPresent('.card-ticketing-splide3', {
      gap: 25,
      snap: false,
      focus: 'center',
      perPage: 2,
      pagination: false,
      arrows: false,
      breakpoints: {
        500: {
          perPage: 1,
          padding: '2rem',
          gap: 10,
        },
        768: {
          perPage: 2,
          gap: 10,
        },
        992: {
          perPage: 2,
          gap: 10,
        },
        1024: {
          perPage: 2,
          gap: 10,
        },
        1200: {
          perPage: 2,
        },
        1440: {
          perPage: 2,
        },
      },
    });

    mountSplideIfPresent('.show-splide', {
      perPage: 1,
      perMove: 1,
      type: 'fade',
      pagination: false,
      arrows: true,
      gap: 0,
    }, window.splide.Extensions);

    mountSplideIfPresent('.review-cust-splide', {
      type: 'loop',
      gap: 15,
      snap: false,
      perPage: 1,
    });

    document.addEventListener('DOMContentLoaded', function() {
      if (typeof Splide === 'undefined' || !document.querySelector('#main-carousel') || !document.querySelector('#thumbnail-carousel')) {
        return;
      }

      var main = new Splide('#main-carousel', {
        type: 'fade',
        rewind: true,
        pagination: false,
        arrows: true,
      });

      var thumbnails = new Splide('#thumbnail-carousel', {
        fixedWidth: 135,
        fixedHeight: 135,
        rewind: true,
        perPage: 5,
        gap: 10,
        focus: 'center',
        type: 'loop',
        isNavigation: true,
        pagination: false,
        breakpoints: {
          600: {
            fixedWidth: 60,
            fixedHeight: 60,
          },
          768: {
            fixedWidth: 80,
            fixedHeight: 80,
          },
        },
      });

      main.sync(thumbnails);
      main.mount();
      thumbnails.mount();
    });

    function openSearchPopup() {
      document.getElementById('search-popup').style.display = 'flex';
    }
    function closeSearchPopup() {
      document.getElementById('search-popup').style.display = 'none';
    }
    document.addEventListener('keydown', function(e) {
      if(e.key === 'Escape') closeSearchPopup();
    });
  </script>
</body>
</html>

