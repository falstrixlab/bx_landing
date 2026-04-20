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
  <link rel="stylesheet" href="<?= base_url('assets/landing/');?>style.css">
  <link rel="shortcut icon" href="<?= bxsea_design_asset('global', 'favicon', 'assets/landing/image/logo-BXSea.png');?>" type="image/x-icon">
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


  <div class="loader-wrap"><svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#007bff" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,128C560,96,640,64,720,53.3C800,43,880,53,960,74.7C1040,96,1120,128,1200,138.7C1280,149,1360,139,1400,133.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg></div>
        
  <div class="top-bar">
          <div class="container top-bar-flex">
            <div class="right-topbar">
              <div class="sosmed-topbar">
              <?php foreach($sosmed_header_a AS $sha) {?>
                  <a href="<?= $sha['mastersocialmedia_link'];?>" target="_blank">
                  <img src="<?= bxsea_asset_url('socialmedia', $sha['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sha['mastersocialmedia_name'] ?? '', 'header'));?>" alt="">
                  </a>
                <?php } ?>
              </div>
              <div class="dropdown">
                <div class="select">
                    <img src="<?= bxsea_design_asset('global', 'globe_icon', 'assets/landing/image/globe.svg');?>" alt="">
                    <span class="selected">INDONESIA</span>
                    <div class="caret me-2"></div>
                </div>
                <div class="menu">
                    <li><a href="<?= base_url('en');?>">ENGLISH</a></li>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="second-bar">
          <div class="container top-bar-flex2">
            <div class="left-topbar-brand">
              <a href="<?= base_url('id');?>">
                <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="">
              </a>
            </div>
            <div class="right-topbar">
              <div class="time-secondbar">
                <img src="<?= base_url('assets/landing/');?>image/Group 1171275397.png" alt="">
                <div class="time-block">
                  <h6><?= $setup[0]['setup_operation_day'];?></h6>
                  <p><?= $setup[0]['setup_operation_duration'];?></p>
                </div>
              </div>
              <div class="adress-secondbar">
                <img src="<?= base_url('assets/landing/');?>image/Group 1171275396.png" alt="">
                <div class="address-block">
                  <h6><a target="_blank" href="<?= $setup[0]['setup_gmaps'];?>" style="text-decoration: none; color:black;"><?= esc(bxsea_plain_text($setup[0]['setup_address'] ?? 'Bintaro Xchange Mall'));?></a></h6>
                </div>
              </div>
            </div>
          </div>
        </div>


        <header>
          <div class="header-navbar-contact">
            <nav class="nav">
              <div class="container navbar__menu">
                  <a class="navbar-responsive" href="<?= base_url('id');?>">
                    <img src="<?= bxsea_design_asset('global', 'site_logo', 'assets/landing/image/logo-BXSea.png');?>" alt="">
                  </a>
                  <div class="dropdown-">
                    <div class="select2">
                        <img src="<?= bxsea_design_asset('global', 'globe_icon', 'assets/landing/image/globe.svg');?>" alt="">
                        <span class="selected2">IDN</span>
                        <div class="caret2 me-2"></div>
                    </div>
                    <div class="menu2">
                        <li><a href="<?= base_url('en');?>">ENG</a></li>
                    </div>
                  </div>
                  <div class="toggle__menu" id="toggle-menu">
                    <i class="fa-solid fa-bars-staggered"></i>
                  </div>
                  <ul class="nav__list" id="nav-menu">
                    <div class="close__menu" id="close-menu">
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                    <li><a href="<?= base_url('/id');?>">Beranda</a></li>
    
                    <li class="dropdown__menu-"><div class="text-dropdown-menu"><p>Tiket Masuk</p><div class="arr-down"></div></div>
                        
                        <div class="megamenu">
                            <ul class="content">
                                <div class="title-megamenu-item">
                                  <h4>Harga</h4>
                                </div>
                                <li class="megamenu__item">
                                    <div class="megamenu__link">
                                        <a href="<?= base_url('/id/tiket/harga');?>">Harga Tiket</a>
                                    </div>
                                </li>
                                <li class="megamenu__item">
                                    <div class="megamenu__link">
                                        <a href="<?= base_url('/id/tiket/promosi');?>">Promosi</a>
                                    </div>
                                </li>
                            </ul>
    
                            <ul class="content">
                              <div class="title-megamenu-item">
                                <h4>Program Lainnya</h4>
                              </div>
                              <li class="megamenu__item">
                                  <div class="megamenu__link">
                                      <a href="<?= base_url('/id/tiket/pengalaman-premium');?>">Pengalaman Premium</a>
                                  </div>
                              </li>
                              <li class="megamenu__item">
                                  <div class="megamenu__link">
                                      <a href="<?= base_url('/id/tiket/program-kunjungan-sekolah');?>">Program Kunjungan Sekolah</a>
                                  </div>
                              </li>
                              <li class="megamenu__item">
                                <div class="megamenu__link">
                                    <a href="<?= base_url('/id/tiket/momen-istimewa');?>">Momen Istimewa</a>
                                </div>
                            </li>
                          </ul>
                        </div>
    
                    </li>
    
    
                    <li class="dropdown__menu-"><div class="text-dropdown-menu"><p>Jelajah</p><div class="arr-down"></div></div>
    
                      <div class="megamenu">
                        <ul class="content">
                            <div class="title-megamenu-item">
                              <h4>Jelajahi BXSea</h4>
                            </div>
                            <li class="megamenu__item">
                                <div class="megamenu__link">
                                    <a href="<?= base_url('/id/journey/journey-utama');?>">Journey Utama</a>
                                </div>
                            </li>
                            <li class="megamenu__item">
                              <div class="megamenu__link">
                                  <a href="<?= base_url('/id/journey/pertunjukan');?>">Pertunjukan</a>
                              </div>
                          </li>
                        </ul>
                      </div>
    
                    </li>
    
    
                    <li class="dropdown__menu-"><div class="text-dropdown-menu"><p>Kunjungan</p><div class="arr-down"></div></div>
                    
                      <div class="megamenu">
                        <ul class="content">
                            <div class="title-megamenu-item">
                              <h4>Rencanakan Kunjungan</h4>
                            </div>
                            <li class="megamenu__item">
                                <div class="megamenu__link">
                                    <a href="<?= base_url('/id/kunjungan/jadwal-aquarium');?>">Jadwal Aquarium</a>
                                </div>
                            </li>
                            <li class="megamenu__item">
                              <div class="megamenu__link">
                                  <a href="<?= base_url('/id/kunjungan/denah');?>">Denah BXSea</a>
                              </div>
                          </li>
                            <li class="megamenu__item">
                                <div class="megamenu__link">
                                    <a href="<?= base_url('/id/kunjungan/panduan-aksesibilitas');?>">Panduan Aksesibilitas</a>
                                </div>
                            </li>
                        </ul>
    
                        <ul class="content">
                          <div class="title-megamenu-item">
                            <h4>More Info</h4>
                          </div>
                          <li class="megamenu__item">
                              <div class="megamenu__link">
                                  <a href="<?= base_url('/id/kunjungan/tenant');?>">Tenant Kami</a>
                              </div>
                          </li>
                          <li class="megamenu__item">
                              <div class="megamenu__link">
                                  <a href="<?= base_url('/id/kunjungan/merchandise');?>">Merchandise</a>
                              </div>
                          </li>
                          <li class="megamenu__item">
                            <div class="megamenu__link">
                                <a href="<?= base_url('/id/kunjungan/faq');?>">FAQ</a>
                            </div>
                          </li>
                          <li class="megamenu__item">
                            <div class="megamenu__link">
                                <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami</a>
                            </div>
                          </li>
                        </ul>
                      </div>
                    
                    </li>
                    <li><a href="<?= base_url('/id/berita');?>">Berita Terbaru</a></li>

                    <div class="contact">
                      <a href="https://ticket.bxsea.co.id/">Pesan sekarang</a>
                    </div>

                    <div class="sosmed-topbar2">
                    <?php foreach($sosmed_header_b AS $shb) {?>
                  <a href="<?= $shb['mastersocialmedia_link'];?>" target="_blank">
                  <img src="<?= bxsea_asset_url('socialmedia', $shb['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($shb['mastersocialmedia_name'] ?? '', 'header'));?>" alt="">
                  </a>
                <?php } ?>
                    </div>

                  </ul>
                
                
              </div>
            </nav>
          </div>
        </header>
    
        <?= $this->renderSection('content'); ?>

        <footer class="shadow">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="brand-footer">
                  <img src="<?= bxsea_design_asset('global', 'footer_holding', 'assets/landing/image/Jaya Property True White.png');?>" alt="">
                  <img src="<?= bxsea_design_asset('global', 'footer_company', 'assets/landing/image/logo_footer.png');?>" alt="">
                </div>
                <div class="place-footer">
                  <h4><?= $setup[0]['setup_title'];?></h4>
                </div>
                <div class="address-footer">
                  <p><?= $setup[0]['setup_address'];?></p>
                </div>
              </div>
              <div class="col-lg-2 box-center">
                  <div class="navbar-footer">
                    <h4>Rencanakan Kunjungan</h4>
                    <div class="items-navbar-footer">
                      <a href="<?= base_url('/id/tiket/harga');?>">Harga Tiket</a>
                    </div>
                    <div class="items-navbar-footer">
                      <a href="<?= base_url('/id/kunjungan/jadwal-aquarium');?>">Jadwal Aquarium</a>
                    </div>
                    <div class="items-navbar-footer">
                      <a href="<?= base_url('/id/kunjungan/denah');?>">Denah BXSea</a>
                    </div>
                    <div class="items-navbar-footer">
                      <a href="<?= base_url('/id/kunjungan/panduan-aksesibilitas');?>">Panduan Aksesibilitas</a>
                    </div>
                  </div>
              </div>
              <div class="col-lg-2 box-center">
                <div class="navbar-footer">
                  <h4>Info Lengkapnya</h4>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/tentang-kami');?>">Tentang Kami</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/kunjungan/tenant');?>">Tenant Kami</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/kunjungan/merchandise');?>">Merchandise</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/kunjungan/faq');?>">FAQ</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/berita');?>">Berita Terbaru</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Hubungi Kami</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/kunjungan/hubungi-kami');?>">Kemitraan</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 box-center">
                <div class="navbar-footer">
                  <h4>Kebijakan</h4>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/syarat-ketentuan');?>">Syarat dan Ketentuan</a>
                  </div>
                  <div class="items-navbar-footer">
                    <a href="<?= base_url('/id/privasi');?>">Privasi</a>
                  </div>
                </div>
              </div>
              <div class="social-footer">
                <?php foreach($sosmed AS $sosmed) {?>
                <a href="<?= $sosmed['mastersocialmedia_link'];?>" target="_blank">
                  <div class="<?= $sosmed['mastersocialmedia_name'];?>">
                    <img src="<?= bxsea_asset_url('socialmedia', $sosmed['mastersocialmedia_logo'] ?? '', bxsea_social_icon_fallback($sosmed['mastersocialmedia_name'] ?? '', 'footer'));?>" alt="">
                    <p>bxsea_official</p>
                  </div>
                </a>
                <?php } ?>
              </div>
              <div class="bg-darkline"></div>
              <div class="copyright">
                <p>Copyright . All Rights Reserved.</p>
              </div>
            </div>
          </div>
        </footer>




  <script src="<?= base_url('assets/landing/');?>bootstrap/js/jquery3.6.3.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>owl-carousel/dist/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>gsap-public (3)/gsap-public/minified/gsap.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>splide-4.1.3/splide-4.1.3/dist/js/splide.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>splide-extension-auto-scroll-master/splide-extension-auto-scroll-master/dist/js/splide-extension-auto-scroll.min.js"></script>
  <script src="<?= base_url('assets/landing/');?>main.js?v=20260418b"></script>



  <script>
      var splide = new Splide( '.Schoolpackage-program-slide', {
          perPage    : 3,
          pagination : false,
          arrows : false,
          gap : 5,
          breakpoints: {
                767: {
                perPage: 1,
                arrows: true,
                },
                768: {
                perPage: 2,
                arrows: true,
                },
            },
        } );
        splide.mount( window.splide.Extensions );


       // $('html').css({overflowX: 'hidden'});
    </script>

</body>
</html>