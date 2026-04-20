<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
    <meta charset="utf-8" />
    <title>Dashboard Administrator | BXSEA</title>
    <meta name="description" content="Page with empty content" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <link href="<?= base_url();?>assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/plugins/global/plugins.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/plugins/custom/prismjs/prismjs.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/css/style.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/css/themes/layout/header/base/light5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/css/themes/layout/header/menu/light5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/css/themes/layout/brand/dark5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>assets/css/themes/layout/aside/dark5883.css?v=7.2.9" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= base_url();?>assets/image/logobxsea.png" />
    <?php
      $uri = service('uri');
      $segment2 = $uri->getSegment(2);
      $segment3 = $uri->getSegment(3);
      $isMasterMenu = $segment2 === 'master' && in_array($segment3, ['legal', 'socialmedia', 'designasset'], true);
      $isHomeMenu = $segment2 === 'home' || ($segment2 === 'master' && $segment3 === 'setup');
      $isNewsMenu = $segment2 === 'whatsnew' || ($segment2 === 'master' && $segment3 === 'article') || ($segment2 === 'category' && $segment3 === 'articlecategory');
    ?>
  </head>
  <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed ">
      <!--begin::Logo-->
      <a href="<?= base_url('adminsite/dashboard');?>">
        <img alt="Logo" src="<?= base_url('');?>assets/media/logos/logo-light.png" />
      </a>
      <!--end::Logo-->
      <!--begin::Toolbar-->
      <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
          <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Header Menu Mobile Toggle-->
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
          <span></span>
        </button>
        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
          <span class="svg-icon svg-icon-xl">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
        </button>
        <!--end::Topbar Mobile Toggle-->
      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
      <!--begin::Page-->
      <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
          <!--begin::Brand-->
          <div class="brand flex-column-auto " id="kt_brand">
            <!--begin::Logo-->
            <a href="<?= base_url('adminsite/dashboard');?>" class="brand-logo">
              <img alt="Logo" src="<?= base_url();?>assets/image/logobxsea_white.png" style="width:60%;"/>
            </a>
            <!--end::Logo-->
            <!--begin::Toggle-->
            <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
              <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                    <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
            </button>
            <!--end::Toolbar-->
          </div>
          <!--end::Brand-->
          <!--begin::Aside Menu-->
          <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
            <!--begin::Menu Container-->
            <div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
              <!--begin::Menu Nav-->
              <ul class="menu-nav ">
                <li class="menu-item <?= ($uri->getSegment(2) == "dashboard") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/dashboard');?>" class="menu-link ">
                    <i class="menu-icon flaticon-home"></i>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                <li class="menu-item <?= ($uri->getSegment(2) == "about") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/about');?>" class="menu-link ">
                    <i class="menu-icon flaticon2-paper-plane"></i>
                    <span class="menu-text">About</span>
                  </a>
                </li>
                <?php if(session()->get("role") == 1) {?>
                <li class="menu-item <?= ($uri->getSegment(2) == "user") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/user');?>" class="menu-link ">
                    <i class="menu-icon flaticon-user"></i>
                    <span class="menu-text">User</span>
                  </a>
                </li>
                <?php } ?>
                <li class="menu-section ">
                  <h4 class="menu-text">Custom</h4>
                  <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item  menu-item-submenu <?= $isMasterMenu ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-web"></i>
                    <span class="menu-text">Master</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <!-- <li class="menu-item <?= ($uri->getSegment(3) == "description") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/description');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Description</span>
                        </a>
                      </li> -->
                      <li class="menu-item <?= ($uri->getSegment(3) == "legal") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/legal');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Legal</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment3 == "socialmedia") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/socialmedia');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Social Media</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment3 == "designasset") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/designasset');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Design Assets</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                
                <li class="menu-section ">
                  <h4 class="menu-text">Layout & Content</h4>
                  <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item  menu-item-submenu <?= $isHomeMenu ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-graphic"></i>
                    <span class="menu-text">Home</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <li class="menu-item  menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                          <span class="menu-text">Home</span>
                        </span>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == null) ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Ringkasan Home</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "announcement") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/announcement');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Announcement</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "banner") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/banner');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Banner Utama</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "fiturslide") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/fiturslide');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Fitur Slide</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "description") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/description');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Deskripsi Section</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "testimoni") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/testimoni');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Review Pengunjung</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "influencer") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/influencer');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Influencer Review</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "partner") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/partner');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Partner</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "home" && $segment3 == "sosmedcontent") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/home/sosmedcontent');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Sosmed Content</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "master" && $segment3 == "setup") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/setup');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Setup Landing</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-item  menu-item-submenu <?= ($segment2 == "ticketing" || ($segment2 == 'category' && $segment3 == 'ticketcategory')) ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-layers"></i>
                    <span class="menu-text">Tiket</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <li class="menu-item  menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                          <span class="menu-text">Tiket</span>
                        </span>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "description") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/description');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Deskripsi Tiket</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == 'category' && $segment3 == 'ticketcategory') ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/category/ticketcategory');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Kategori Tiket</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "masterticket") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/masterticket');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Data Tiket</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "experience") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/experience');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Experience</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "promotion") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/promotion');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Promotion</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "moment") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/moment');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Moment</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "schoolprogram") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/schoolprogram');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">School Program</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "ticketing" && $segment3 == "schoolvisit") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/ticketing/schoolvisit');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">School Visit Program</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-item  menu-item-submenu <?= ($segment2 == "explore") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-interface-8"></i>
                    <span class="menu-text">Jelajahi</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <li class="menu-item  menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                          <span class="menu-text">Jelajahi</span>
                        </span>
                      </li>
                      <li class="menu-item <?= ($segment2 == "explore" && $segment3 == "description") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/explore/description');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Deskripsi Jelajahi</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "explore" && $segment3 == "journey") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/explore/journey');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Journey</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "explore" && $segment3 == "show") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/explore/show');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Show</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-item  menu-item-submenu <?= ($segment2 == "visit" || ($segment2 == 'category' && $segment3 == 'merchandisecategory')) ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-graphic"></i>
                    <span class="menu-text">Info Kunjungan</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <li class="menu-item  menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                          <span class="menu-text">Info Kunjungan</span>
                        </span>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "description") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/description');?>" class="menu-link ">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                          <span class="menu-text">Deskripsi Info Kunjungan</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "visitorinfo") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/visitorinfo');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Visitor Info</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "schedule") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/schedule');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Schedule</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "map") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/map');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Map</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "guide") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/guide');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Guide</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "tenant") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/tenant');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Tenant</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "merchandise") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/merchandise');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Merchandise</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == 'category' && $segment3 == 'merchandisecategory') ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/category/merchandisecategory');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Kategori Merchandise</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "faq") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/faq');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">FAQ</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == "visit" && $segment3 == "contact") ? "menu-item-active":"";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/visit/contact');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Contact</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <!-- Partnership Menu -->
                <li class="menu-item <?= ($uri->getSegment(2) == "partnership") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/partnership');?>" class="menu-link ">
                    <i class="menu-icon flaticon-users"></i>
                    <span class="menu-text">Kemitraan</span>
                  </a>
                </li>
                <li class="menu-item  menu-item-submenu <?= $isNewsMenu ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true" data-menu-toggle="hover">
                  <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-multimedia"></i>
                    <span class="menu-text">Berita Terkini</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                      <li class="menu-item  menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                          <span class="menu-text">Berita Terkini</span>
                        </span>
                      </li>
                      <li class="menu-item <?= (($segment2 == 'master' && $segment3 == 'article') || $segment2 == 'whatsnew') ? "menu-item-active" : "";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/master/article');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Artikel & Berita</span>
                        </a>
                      </li>
                      <li class="menu-item <?= ($segment2 == 'category' && $segment3 == 'articlecategory') ? "menu-item-active" : "";?>" aria-haspopup="true">
                        <a href="<?= base_url('adminsite/category/articlecategory');?>" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                          </i>
                          <span class="menu-text">Kategori Artikel</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="menu-item <?= ($uri->getSegment(2) == "subscribed") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/subscribed');?>" class="menu-link ">
                    <i class="menu-icon flaticon-cogwheel-1"></i>
                    <span class="menu-text">Subscribed</span>
                  </a>
                </li>
                <li class="menu-section ">
                  <h4 class="menu-text">System</h4>
                  <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item <?= ($uri->getSegment(2) == "media") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/media');?>" class="menu-link ">
                    <i class="menu-icon flaticon2-image-file"></i>
                    <span class="menu-text">Media Manager</span>
                  </a>
                </li>
                <li class="menu-item <?= ($uri->getSegment(2) == "settings") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/settings');?>" class="menu-link ">
                    <i class="menu-icon flaticon-settings"></i>
                    <span class="menu-text">Global Settings</span>
                  </a>
                </li>
                <li class="menu-item <?= ($uri->getSegment(2) == "profile") ? "menu-item-open menu-item-here" : "";?>" aria-haspopup="true">
                  <a href="<?= base_url('adminsite/profile');?>" class="menu-link ">
                    <i class="menu-icon flaticon2-user"></i>
                    <span class="menu-text">Profile</span>
                  </a>
                </li>
              </ul>
              <!--end::Menu Nav-->
            </div>
            <!--end::Menu Container-->
          </div>
          <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
          <!--begin::Header-->
          <div id="kt_header" class="header  header-fixed ">
            <!--begin::Container-->
            <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
              <!--begin::Header Menu Wrapper-->
              <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
                  <!--begin::Header Nav-->
                  <ul class="menu-nav ">
                    <li class="menu-item  menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                      <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Pages</span>
                        <i class="menu-arrow"></i>
                      </a>
                    </li>
                  </ul>
                  <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
              </div>
              <!--end::Header Menu Wrapper-->
              <!--begin::Topbar-->
              <div class="topbar">
                <!--begin::User-->
                <div class="topbar-item">
                  <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= session()->get("fullname"); ?></span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                      <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                    </span>
                  </div>
                </div>
                <!--end::User-->
              </div>
              <!--end::Topbar-->
            </div>
            <!--end::Container-->
          </div>
          <!--end::Header-->
          <?php if(session()->getFlashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show mx-5 mt-4" role="alert">
            <strong>Berhasil!</strong> <?= session()->getFlashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <?php endif; ?>
          <?php if(session()->getFlashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show mx-5 mt-4" role="alert">
            <strong>Error!</strong> <?= session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <?php endif; ?>
          <?= $this->renderSection('content'); ?>
          
          <!--begin::Footer-->
          <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
            <!--begin::Container-->
            <div class=" container-fluid  d-flex flex-column flex-md-row align-items-center justify-content-between">
              <!--begin::Copyright-->
              <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2"><?= date('Y');?>&copy;</span>
                <a href="javascript:void(0);" target="_blank" class="text-dark-75 text-hover-primary">BXSea Bintaro Jaya</a>
              </div>
              <!--end::Copyright-->
             
            </div>
            <!--end::Container-->
          </div>
          <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Page-->
    </div>
    <!--end::Main-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
      <!--begin::Header-->
      <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0"> User Profile
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
          <i class="ki ki-close icon-xs text-muted"></i>
        </a>
      </div>
      <!--end::Header-->
      <!--begin::Content-->
      <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
          <div class="symbol symbol-100 mr-5">
            <div class="symbol-label" style="background-image:url('<?= base_url();?>assets/image/gurita.png')">
            </div>
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"> <?= session()->get("fullname"); ?> </a>
            <div class="text-muted mt-1"> Administrator CMS </div>
            <div class="navi mt-2">
              <a href="#" class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-icon mr-1">
                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                      <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                          <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                        </g>
                      </svg>
                    </span>
                  </span>
                  <span class="navi-text text-muted text-hover-primary">-</span>
                </span>
              </a>
              <a href="<?= base_url('adminsite/logout')?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
            </div>
          </div>
        </div>
        <!--end::Header-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Demo Panel-->
    <script>
      var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
      var KTAppSettings = {
        "breakpoints": {
          "sm": 576,
          "md": 768,
          "lg": 992,
          "xl": 1200,
          "xxl": 1400
        },
        "colors": {
          "theme": {
            "base": {
              "white": "#ffffff",
              "primary": "#3699FF",
              "secondary": "#E5EAEE",
              "success": "#1BC5BD",
              "info": "#8950FC",
              "warning": "#FFA800",
              "danger": "#F64E60",
              "light": "#E4E6EF",
              "dark": "#181C32"
            },
            "light": {
              "white": "#ffffff",
              "primary": "#E1F0FF",
              "secondary": "#EBEDF3",
              "success": "#C9F7F5",
              "info": "#EEE5FF",
              "warning": "#FFF4DE",
              "danger": "#FFE2E5",
              "light": "#F3F6F9",
              "dark": "#D6D6E0"
            },
            "inverse": {
              "white": "#ffffff",
              "primary": "#ffffff",
              "secondary": "#3F4254",
              "success": "#ffffff",
              "info": "#ffffff",
              "warning": "#ffffff",
              "danger": "#ffffff",
              "light": "#464E5F",
              "dark": "#ffffff"
            }
          },
          "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#EBEDF3",
            "gray-300": "#E4E6EF",
            "gray-400": "#D1D3E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#7E8299",
            "gray-700": "#5E6278",
            "gray-800": "#3F4254",
            "gray-900": "#181C32"
          }
        },
        "font-family": "Poppins"
      };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?= base_url();?>assets/plugins/global/plugins.bundle5883.js?v=7.2.9"></script>
    <script src="<?= base_url();?>assets/plugins/custom/prismjs/prismjs.bundle5883.js?v=7.2.9"></script>
    <script src="<?= base_url();?>assets/js/scripts.bundle5883.js?v=7.2.9"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="<?= base_url();?>assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.js?v=7.2.9"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>
    <script src="<?= base_url();?>assets/plugins/custom/gmaps/gmaps5883.js?v=7.2.9"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?= base_url();?>assets/js/pages/widgets5883.js?v=7.2.9"></script>
    <!--end::Page Scripts-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?= base_url();?>assets/plugins/custom/datatables/datatables.bundle5883.js?v=7.2.9"></script>
    <!--end::Page Scripts-->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <?= $this->include('administrator/partials/admin_enhancements') ?>
  </body>
  <!--end::Body-->
</html>