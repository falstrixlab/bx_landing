<!DOCTYPE html>
<html lang="en">
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
  <title><?= $title;?> - BXSea</title>
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
    if ($topBarDuration !== '' && stripos($topBarDuration, 'last ticket') === false && stripos($topBarDuration, 'pembelian') === false) {
      $topBarDuration .= ' (Last Ticket Purchase at 21:00)';
    }
  $currentPath = trim((string) service('uri')->getPath(), '/');
  $isHome = $currentPath === 'en';
  $isTicket = str_starts_with($currentPath, 'en/tiket');
  $isJourney = str_starts_with($currentPath, 'en/journey');
  $isVisit = str_starts_with($currentPath, 'en/kunjungan');
  $isNews = str_starts_with($currentPath, 'en/berita');
  ?>
  <div class="loader-wrap"><svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#007bff" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,128C560,96,640,64,720,53.3C800,43,880,53,960,74.7C1040,96,1120,128,1200,138.7C1280,149,1360,139,1400,133.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg></div>

  <div class="top-bar top-bar-bottom">
    <div class="container top-bar-flex">
      <div class="left-topbar">
        <div class="time-secondbar">
          <img src="<?= bxsea_design_asset('global', 'clock_icon_en', 'assets/landing/image/icons8-clock-40.png');?>" alt="">
          <div class="time-block">
            <p><?= esc($setup[0]['setup_operation_day_en'] ?? 'Monday - Sunday');?></p>
            <p><?= esc($topBarDuration);?></p>
          </div>
        </div>
        <div class="adress-secondbar">
          <img src="<?= bxsea_design_asset('global', 'location_icon_en', 'assets/landing/image/icons8-location-40.png');?>" alt="">
          <div class="address-block">
            <p><a target="_blank" href="<?= esc($setup[0]['setup_gmaps'] ?? '#');?>" style="text-decoration:none;color:inherit;"><?= esc($topBarAddress);?></a></p>
          </div>
        </div>
      </div>
      <div class="right-topbar">
        <div class="sosmed-topbar">
          <a href="#" id="search-icon-btn" onclick="openSearchPopup(); return false;">
            <img class="search-topbar" src="<?= bxsea_design_asset('global', 'search_icon', 'assets/landing/image/bxsea_icon_search.png');?>" alt="">
          </a>
          <?php foreach($sosmed_header_a AS $sha): ?>
          <a href="<?= esc($sha['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer">
            <img src="<?= bxsea_asset_url('socialmedia', $sha['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sha['mastersocialmedia_name'] ?? '', 'header'));?>" alt="<?= esc($sha['mastersocialmedia_name'] ?? '');?>">
          </a>
          <?php endforeach; ?>
        </div>
        <div class="dropdown">
          <div class="select">
            <img src="<?= bxsea_design_asset('global', 'globe_icon', 'assets/landing/image/globe.svg');?>" alt="">
            <span class="selected">EN</span>
            <div class="caret me-2"></div>
          </div>
          <div class="menu">
            <li><a href="<?= base_url('id');?>">ID</a></li>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="header-navbar-contact top-bar-animation header-navbar-contact-bottom">
    <nav class="nav">
      <div class="container navbar__menu">
        <a class="navbar-responsive" href="<?= base_url('en');?>">
          <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="BXSea Logo">
        </a>
        <div class="mobile-menu">
          <div class="dropdown2">
            <div class="select2">
              <span class="selected2">EN</span>
              <div class="caret2 me-2"></div>
            </div>
            <div class="menu2">
              <li><a href="<?= base_url('id');?>">ID</a></li>
            </div>
          </div>
          <div class="toggle__menu" id="toggle-menu">
            <i class="fa-solid fa-bars-staggered"></i>
          </div>
        </div>
        <ul class="nav__list" id="nav-menu">
          <div class="close__menu" id="close-menu">
            <i class="fa-solid fa-xmark"></i>
          </div>
          <a href="<?= base_url('en');?>" class="logo-bexsea">
            <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="BXSea Logo">
          </a>
          <li class="nav__link<?= $isHome ? ' is-active' : '';?>"><a href="<?= base_url('en');?>">Home</a></li>

          <li class="dropdown__menu-<?= $isTicket ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Ticket</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <div class="title-megamenu-item"><h4>Ticket</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/tiket/harga');?>">Book Tickets</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/tiket/promosi');?>">Promotion</a></div></li>
              </ul>
              <ul class="content">
                <div class="title-megamenu-item"><h4>Explore More</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/tiket/pengalaman-premium');?>">Add-Ons</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/tiket/program-kunjungan-sekolah');?>">School Programs</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/tiket/momen-istimewa');?>">Special Occasions</a></div></li>
              </ul>
            </div>
          </li>

          <li class="dropdown__menu-<?= $isJourney ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Explore</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/journey/journey-utama');?>">Main Journey</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/journey/pertunjukan');?>">Show</a></div></li>
              </ul>
            </div>
          </li>

          <li class="dropdown__menu-<?= $isVisit ? ' is-active' : '';?>">
            <div class="text-dropdown-menu"><p>Visit</p><div class="arr-down"></div></div>
            <div class="megamenu">
              <ul class="content">
                <div class="title-megamenu-item"><h4>Plan Your Visit</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/informasi-pengunjung');?>">Visitor Information</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/jadwal-aquarium');?>">Show Schedule</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/denah');?>">Oceanarium Map</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/panduan-aksesibilitas');?>">Accessibility Guide</a></div></li>
              </ul>
              <ul class="content">
                <div class="title-megamenu-item"><h4>More Information</h4></div>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/tenant');?>">Our Tenants</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/merchandise');?>">Merchandise</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/faq');?>">FAQs</a></div></li>
                <li class="megamenu__item"><div class="megamenu__link"><a href="<?= base_url('/en/kunjungan/hubungi-kami');?>">Contact Us</a></div></li>
              </ul>
            </div>
          </li>

          <li class="nav__link<?= $isNews ? ' is-active' : '';?>"><a href="<?= base_url('/en/berita');?>">Latest News</a></li>

          <div class="contact-mobile">
            <a href="https://ticket.bxsea.co.id/" target="_blank" rel="noopener noreferrer">Book Tickets</a>
          </div>
          <div class="sosmed-topbar2">
            <?php foreach($sosmed_header_b AS $shb): ?>
            <a href="<?= esc($shb['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer">
              <img src="<?= bxsea_asset_url('socialmedia', $shb['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($shb['mastersocialmedia_name'] ?? '', 'header'));?>" alt="">
            </a>
            <?php endforeach; ?>
          </div>
        </ul>
        <div class="contact">
          <a href="https://ticket.bxsea.co.id/" target="_blank" rel="noopener noreferrer">Book Tickets</a>
        </div>
      </div>
    </nav>
  </div>

        <?= $this->renderSection('content'); ?>

        <footer class="shadow">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 d-flex flex-column justify-content-between">
                <div class="social-footer">
                  <?php foreach($sosmed AS $socialItem): ?>
                  <a href="<?= esc($socialItem['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($socialItem['mastersocialmedia_name']);?>">
                    <div class="<?= esc($socialItem['mastersocialmedia_name']);?>">
                      <img src="<?= bxsea_asset_url('socialmedia', $socialItem['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($socialItem['mastersocialmedia_name'] ?? '', 'footer'));?>" alt="<?= esc($socialItem['mastersocialmedia_name']);?>">
                    </div>
                  </a>
                  <?php endforeach; ?>
                </div>
                <div class="about-us-footer">
                  <a href="<?= base_url('/en/tentang-kami');?>">About Us <img src="<?= base_url('assets/landing/image/arrow-right-white.png');?>" alt=""></a>
                </div>
              </div>
              <div class="col-lg-2 box-center">
                <div class="navbar-footer">
                  <h4>Plan Your Visit</h4>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/tiket/harga');?>">Book Tickets</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/informasi-pengunjung');?>">Visitor Information</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/jadwal-aquarium');?>">Show Schedule</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/denah');?>">Oceanarium Maps</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/panduan-aksesibilitas');?>">Accessibility Guide</a></div>
                </div>
              </div>
              <div class="col-lg-2 box-center">
                <div class="navbar-footer">
                  <h4>Information</h4>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/berita');?>">Latest News</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/tenant');?>">Our Tenants</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/merchandise');?>">Merchandise</a></div>
                </div>
              </div>
              <div class="col-lg-2 box-center">
                <div class="navbar-footer">
                  <h4>Help &amp; Support</h4>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/hubungi-kami');?>">Contact Us</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/kunjungan/faq');?>">FAQs</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/syarat-ketentuan');?>">Terms & Conditions</a></div>
                  <div class="items-navbar-footer"><a href="<?= base_url('/en/privasi');?>">Privacy Policy</a></div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="brand-footer">
                  <img src="<?= bxsea_design_asset('global', 'footer_holding', 'assets/landing/image/Jaya Property True White.png');?>" alt="">
                  <img src="<?= bxsea_design_asset('global', 'footer_company', 'assets/landing/image/logo_footer.png');?>" alt="">
                </div>
                <div class="address-footer">
                  <p><?= esc($setupAddress);?></p>
                </div>
                <div class="corporate-footer">
                  <div class="left-grid">
                    <p>PT Jaya Real Property, Tbk.</p>
                    <span>CBD Emerald Block CE/A No. 1, Boulevard Bintaro Jaya, Tangerang 15227 Indonesia</span>
                  </div>
                  <div class="right-grid">
                    <p>Join The BXSea Family</p>
                    <div class="btn-partnerships-footer">
                      <a href="<?= base_url('/en/kunjungan/partnership');?>">Become Partners</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="social-footer-mobile">
                  <?php foreach($sosmed AS $socialItem): ?>
                  <a href="<?= esc($socialItem['mastersocialmedia_link']);?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($socialItem['mastersocialmedia_name']);?>">
                    <div class="<?= esc($socialItem['mastersocialmedia_name']);?>">
                      <img src="<?= bxsea_asset_url('socialmedia', $socialItem['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($socialItem['mastersocialmedia_name'] ?? '', 'footer'));?>" alt="<?= esc($socialItem['mastersocialmedia_name']);?>">
                    </div>
                  </a>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="bg-darkline"></div>
              <div class="copyright">Copyright 2026 . All Rights Reserved.</div>
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
        <script src="<?= base_url('assets/landing/');?>main.js?v=20260423"></script>

      <script>
      var swiper = new Swiper(".mySwiper", {
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
                slidesPerView: 5,
                grid: {
                    rows: 2,
                },
                spaceBetween: 0,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    320: {
                      slidesPerView: 1,
                      grid: {
                      rows: 1,
                      },
                    },
                    576: {
                      slidesPerView: 2,
                      grid: {
                      rows: 1,
                      },
                    },
                    768: {
                      slidesPerView: 2,
                      grid: {
                      rows: 2,
                      },
                    },
                    1024: {
                      slidesPerView: 4,
                      grid: {
                      rows: 2,
                      },
                    },
                    1200: {
                      slidesPerView: 5,
                      grid: {
                      rows: 2,
                      },
                    },
                },
            });

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
        focus: 'center',
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

      // Prefer Splide marquee when present; otherwise fall back to GSAP marquee
      (function () {
        if (typeof Splide !== 'undefined' && document.querySelector('.marquee-splide')) {
          document.querySelectorAll('.marquee-splide').forEach(function (el) {
            try {
              var spl = new Splide(el, {
                type: 'loop',
                perPage: 1,
                perMove: 1,
                arrows: false,
                pagination: false,
                drag: false,
                autoWidth: true,
                autoScroll: {
                  speed: 1,
                  pauseOnHover: true,
                  autoStart: true,
                },
              });
              var AutoScroll = window.splide && window.splide.Extensions && window.splide.Extensions.AutoScroll;
              if (AutoScroll) spl.mount({ AutoScroll: AutoScroll });
              else spl.mount();
            } catch (e) {
              console.error('Splide marquee init error', e);
            }
          });
          return;
        }

        var tween = null;
        if (document.querySelector('.marquee__inner')) {
          tween = gsap.to('.marquee__inner', {
            xPercent: -100,
            repeat: -1,
            duration: 25,
            ease: 'linear',
          }).totalProgress(.5);
        }
      })();



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




        var reviewSplide = mountSplideIfPresent('.review-influencer-splide', {
          type: 'loop',
          pagination: false,
          gap: 15,
          snap: false,
          perPage: 1,
        });

        if (reviewSplide) {
          function alignReviewArrows() {
            var activeSlide = document.querySelector('.review-influencer-splide .splide__slide.is-active.is-visible');
            var activies = activeSlide && activeSlide.querySelector('.image-activies');
            var arrowPrev = document.querySelector('.review-influencer-splide .splide__arrow--prev');
            var arrowNext = document.querySelector('.review-influencer-splide .splide__arrow--next');
            if (!activies || !arrowPrev || !arrowNext) return;
            var top = activies.offsetTop + activies.offsetHeight / 2;
            arrowPrev.style.top = top + 'px';
            arrowPrev.style.transform = 'translateY(-50%)';
            arrowNext.style.top = top + 'px';
            arrowNext.style.transform = 'translateY(-50%)';
          }
          setTimeout(alignReviewArrows, 0);
          reviewSplide.on('moved', alignReviewArrows);
        }


        mountSplideIfPresent('.card-ticketing-splide', {
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
          perPage    : 1,
          perMove    : 1,
          type  : 'fade',
          pagination : false,
          arrows : true,
          gap : 0,
        }, window.splide.Extensions);

        mountSplideIfPresent('.show-splide2', {
          perPage: 1,
          perMove: 1,
          type: 'fade',
          pagination: false,
          arrows: true,
          gap: 0,
        });


        mountSplideIfPresent('.review-cust-splide', {
          type: 'loop',
          gap: 15,
          snap: false,
          perPage: 1,
        });


        document.addEventListener( 'DOMContentLoaded', function () {
            if (typeof Splide === 'undefined' || !document.querySelector('.main-carousel') || !document.querySelector('.thumbnail-carousel')) {
              return;
            }

            var main = new Splide('.main-carousel', {
              type: 'fade',
              rewind: true,
              pagination: false,
              arrows: true,
            });

            var thumbnails = new Splide('.thumbnail-carousel', {
              rewind: false,
              perPage: 5,
              focus: 'center',
              type : 'loop',
              isNavigation: true,
              pagination: false,
              breakpoints: {
                768: {
                  fixedWidth: 90,
                  fixedHeight: 90,
                  type: 'slide',
                },
                600: {
                  fixedWidth: 60,
                  fixedHeight: 60,
                },
              },
            });

            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();
        });

      </script>

      <?= $this->renderSection('scripts'); ?>
      <script>
      const tl = gsap.timeline();

      tl.to('.loader-wrap', {
        y: -1200,
        duration: 2,
        ease: 'power4.inOut'
      });
      tl.to('.loader-wrap', {
        zIndex: -1,
        display: 'none',
      });
      </script>

</body>
</html>