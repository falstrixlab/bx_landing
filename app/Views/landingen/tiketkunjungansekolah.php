<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">       
          <div class="hero-wrap2">
            <div class="overlay-darkblue-bg-banner"></div>
            <div class="hero-image2">
              <img src="<?= base_url('assets/landing/');?>image/banner-schoolpackage.png" alt="">
            </div>
            <div class="container">
              <div class="row descBanner">
                 <div class="col-lg-12 box-schoolpackage">
                    <div class="desc-schoolpackage">
                      <h1><br> <?= esc(bxsea_plain_text($schoolprogramheader[0]['masterdesc_title_en'] ?? 'SCHOOL VISIT PROGRAM'));?></h1>
                      <p class="text-mb300">
                      <?= esc(bxsea_plain_text($schoolprogramheader[0]['masterdesc_desc_en'] ?? ''));?>
                      </p>
                    </div>
                 </div>

              </div>  
          </div>
          </div>
  </section>


  <img class="rectangle-darkblue" src="<?= base_url('assets/landing/')?>image/rectangle-dark-blue.png" alt="">


  <section class="SchoolPackage">
    <img class="grass18" src="<?= base_url('assets/landing/');?>image/bg-grass6.png" alt="">
    <img class="grass19" src="<?= base_url('assets/landing/');?>image/bg-grass3.png" alt="">
    <img class="grass20" src="<?= base_url('assets/landing/');?>image/bg-grass4.png" alt="">
    <img class="grass21" src="<?= base_url('assets/landing/');?>image/bg-grass5.png" alt="">
    <img class="grass26" src="<?= base_url('assets/landing/');?>image/ranting.png" alt="">
    <img class="grass27" src="<?= base_url('assets/landing/');?>image/grass17.png" alt="">
    <img class="grass28" src="<?= base_url('assets/landing/');?>image/grass14.png" alt="">
    <img class="grass29" src="<?= base_url('assets/landing/');?>image/grass14.png" alt="">
    <img class="grass30" src="<?= base_url('assets/landing/');?>image/grass14.png" alt="">
    <img class="grass31" src="<?= base_url('assets/landing/');?>image/bg-grass10.png" alt="">
    <img class="bird4" src="<?= base_url('assets/landing/');?>image/bird2.png" alt="">
    <img class="bird5" src="<?= base_url('assets/landing/');?>image/bird4.png" alt="">
    <img class="bird6" src="<?= base_url('assets/landing/');?>image/bird.png" alt="">
    <img class="bird7" src="<?= base_url('assets/landing/');?>mage/bird3.png" alt="">
    <img class="grass32" src="<?= base_url('assets/landing/');?>image/grass12.png" alt="">
    <div class="container">

      <div class="row mb-100">
          <div class="col-lg-6 order-lg-1 box-center-align">
              <div class="title-SchoolPackage">
                  <h1><?= esc(bxsea_plain_text($schoolprogram[0]['schoolprogram_title_en'] ?? ''));?></h1>
                  <p><?= esc(bxsea_plain_text($schoolprogram[0]['schoolprogram_desc_en'] ?? ''));?></p>
              </div>
          </div>
          <div class="col-lg-6 box-image-schoolpackage order-lg-2">
              <img class="iguana" src="<?= base_url('assets/landing/');?>image/BXSEA_Rainforest_Assets.png" alt="">
              <img class="img-fluid image-schoolpackage-" src="<?= base_url('assets/upload/schoolprogram/'.$schoolprogram[0]['schoolprogram_pict']);?>" alt="">
          </div>
      </div>

      <div class="row mb-100">
          <div class="col-lg-8 order-lg-2 box-center-align">
            <div class="title-SchoolPackage">
                <h1><?= esc(bxsea_plain_text($schoolprogram[1]['schoolprogram_title_en'] ?? ''));?></h1>
                <p><?= esc(bxsea_plain_text($schoolprogram[1]['schoolprogram_desc_en'] ?? ''));?></p>
            </div>
          </div>
          <div class="col-lg-4 box-image-schoolpackage order-lg-1">
            <img class="img-fluid image-schoolpackage-2" src="<?= base_url('assets/upload/schoolprogram/'.$schoolprogram[1]['schoolprogram_pict']);?>" alt="">
          </div>
      </div>

      <div class="row mb-100">
        <div class="col-lg-6  box-center-align">
          <div class="title-SchoolPackage">
            <p><?= esc(bxsea_plain_text($schoolprogram[2]['schoolprogram_desc_en'] ?? ''));?></p>
          </div>
        </div>
        <div class="col-lg-6 box-image-schoolpackage2">
          <img class="img-fluid image-schoolpackage-3" src="<?= base_url('assets/upload/schoolprogram/'.$schoolprogram[2]['schoolprogram_pict']);?>" alt="">
        </div>
      </div>
    
    </div>
    <img class="grass24" src="<?= base_url('assets/landing/');?>image/grass7.png" alt="">
    <img class="grass25" src="<?= base_url('assets/landing/');?>image/grass7.png" alt="">
  </section>


  <section class="contactus2">   
    <div class="container">
      <div class="title-contactus2">
        <h1>BUY NOW</h1>
        <p>You can book a visit to the oceanarium through the contact below</p>
      </div>
      <div class="row box-contact">
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
          <div class="card-contactus2">
            <a href="<?= $setup[0]['setup_customer']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <p>Customer Services</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus2">
          <div class="card-contactus2">
            <a href="https://wa.me/<?= $setup[0]['setup_phone']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed2.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <p>WhatsApp</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus3">
          <div class="card-contactus2">
            <a href="mailto:<?= $setup[0]['setup_email']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed3.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <br>
                <p>Email</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <img class="grass23" src="<?= base_url('assets/landing/');?>image/bg-grass2.png" alt="">
    <img class="grass22" src="<?= base_url('assets/landing/');?>image/grass16.png" alt="">
  </section>

  <?php if (!empty($schoolteachersaid)): ?>
  <section class="teacher-said">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 d-flex align-items-center justify-content-end">
          <div class="image-teacher-said-box">
            <div class="bullets"></div>
            <img src="<?= bxsea_design_asset('school', 'teacher_image', 'assets/landing/image/bxsea_image_miss_ima.png'); ?>" alt="Teacher">
          </div>
        </div>
        <div class="col-lg-7">
          <div class="teacher-said-box">
            <h2 class="title">Teacher Testimonials</h2>
            <p><?= esc(bxsea_plain_text($schoolteachersaid[0]['masterdesc_title_en'] ?? $schoolteachersaid[0]['masterdesc_title'] ?? ''));?></p>
            <div class="image-teacher-said-box-mobile">
              <img src="<?= bxsea_design_asset('school', 'teacher_image', 'assets/landing/image/bxsea_image_miss_ima.png'); ?>" alt="Teacher">
              <span><?= esc(bxsea_plain_text($schoolteachersaid[0]['masterdesc_desc_en'] ?? $schoolteachersaid[0]['masterdesc_desc'] ?? ''));?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="Schoolpackage-slide">
    <div class="container">
      <div class="title-schoolpackage-slide">
        <img class="bunglon" src="<?= base_url('assets/landing/');?>image/BXSEA Rainforest Assets.png" alt="">
        <h1>SPECIAL SCHOOL VISIT PROGRAM</h1>
      </div>
      <div class="bg-schoolpackage-slide">
        <img class="grass65" src="<?= base_url('assets/landing/');?>image/grass17.png" alt="">
        <img class="grass66" src="<?= base_url('assets/landing/');?>image/grass19.png" alt="">
        <img class="grass67" src="<?= base_url('assets/landing/');?>image/grass17.png" alt="">
        <div class="row gx-1">
          <div class="box-flex-package-program">
            <div class="title-schoolpackage-program">
              <h5><?= esc(bxsea_plain_text($schoolvisitdesc[0]['masterdesc_title_en'] ?? ''));?></h5>
              <div class="program">
              <?= esc(bxsea_plain_text($schoolvisitdesc[0]['masterdesc_desc_en'] ?? ''));?>
              </div>
            </div>
            <div class="brand-package">
              <img src="<?= base_url('assets/landing/');?>image/logo_footer.png" alt="">
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
              <div class="package-grade mb-400">
                <ul class="package-left">
                <?php foreach($schoolvisit AS $sv) {?>
                  <li><?= esc(bxsea_plain_text($sv['schoolvisit_desc_en'] ?? ''));?></li>
                  <?php } ?>
                </ul>
              </div>
          </div>
          <div class="col-lg-9 col-sm-6">
            <div class="splide Schoolpackage-program-slide" role="group" aria-label="">
              <div class="splide__track">
                <ul class="splide__list">
                  <li class="splide__slide">
                    <div class="package-grade">
                      <ul class="package-centers">
                        <li class="bg-blue-package">Basic</li>
                        <?php 
                          foreach($schoolvisitbasic AS $svb) {
                            if ($svb['schoolvisit_basic'] != "-") {
                        ?>
                            <li><?= $svb['schoolvisit_basic'];?></li>
                        <?php }else {?>
                          <li class="disabled"></li>
                        <?php }} ?>
                      </ul>
                    </div>
                  </li>
                  <li class="splide__slide">
                    <div class="package-grade">
                      <ul class="package-centers">
                        <li class="bg-blue-package">Premium</li>
                        <?php 
                          foreach($schoolvisitpremium AS $svp) {
                            if ($svp['schoolvisit_premium'] != "-") {
                        ?>
                        <li><?= $svp['schoolvisit_premium'];?></li>
                        <?php }else {?>
                          <li class="disabled"></li>
                        <?php }} ?>
                      </ul>
                    </div>
                  </li>
                  <li class="splide__slide">
                    <div class="package-grade">
                      <ul class="package-centers">
                        <li class="bg-blue-package">Special BXperience</li>
                        <?php 
                          foreach($schoolvisitspecial AS $svs) {
                            if ($svs['schoolvisit_special'] != "-") {
                        ?>
                        <li><?= $svs['schoolvisit_special'];?></li>
                        <?php }else {?>
                          <li class="disabled"></li>
                        <?php }} ?>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </section>
  <?= $this->endSection() ?>