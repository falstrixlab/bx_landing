<?= $this->extend('landingen/landingbase') ?>
<?= $this->section('content') ?>

<?php
$schoolHeroAsset      = bxsea_design_asset('school', 'hero',          'assets/landing/image/bxsea_image_bg-school.png');
$included1            = bxsea_design_asset('school', 'included_1',    'assets/landing/image/bxsea_image_whats_included.png');
$included2            = bxsea_design_asset('school', 'included_2',    'assets/landing/image/bxsea_image_whats_included2.png');
$included3            = bxsea_design_asset('school', 'included_3',    'assets/landing/image/bxsea_image_whats_included3.png');
$included4            = bxsea_design_asset('school', 'included_4',    'assets/landing/image/bxsea_image_whats_included4.png');
$teacherImg           = bxsea_design_asset('school', 'teacher_image', 'assets/landing/image/bxsea_image_miss_ima.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset    = bxsea_design_asset('visit', 'contact_card_email', 'assets/landing/image/sosmed3.png');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $schoolHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner">
        <div class="col-lg-12 box-schoolpackage">
          <div class="desc-schoolpackage">
            <h1><?= esc(bxsea_plain_text($schoolprogramheader[0]['masterdesc_title_en'] ?? 'SCHOOL VISIT PROGRAM'));?></h1>
            <p class="text-mb300"><?= esc(bxsea_plain_text($schoolprogramheader[0]['masterdesc_desc_en'] ?? 'Our experienced tour guides will help your students explore the wonders of the underwater world.'));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="SchoolPackage">
  <div class="container">
    <div class="row mb-100">
      <div class="col-lg-7 order-lg-1 d-flex align-items-center">
        <div class="title-SchoolPackage">
          <h1><?= esc(bxsea_plain_text($schoolprogram[0]['schoolprogram_title_en'] ?? ($schoolprogram[0]['schoolprogram_title'] ?? 'Our Program')));?></h1>
          <p><?= esc(bxsea_plain_text($schoolprogram[0]['schoolprogram_desc_en'] ?? ($schoolprogram[0]['schoolprogram_desc'] ?? '')));?></p>
        </div>
      </div>
      <div class="col-lg-5 box-image-schoolpackage order-lg-2">
        <img class="img-fluid image-schoolpackage-" src="<?= bxsea_asset_url('schoolprogram', $schoolprogram[0]['schoolprogram_pict'] ?? '', 'assets/landing/image/image-school-package.png');?>" alt="">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="why-bxsea">
          <div class="container">
            <h2 class="title"><?= !empty($schoolwhybxsea[0]['why_title_en']) ? esc(bxsea_plain_text($schoolwhybxsea[0]['why_title_en'])) : (!empty($schoolwhybxsea[0]['why_title_id']) ? esc(bxsea_plain_text($schoolwhybxsea[0]['why_title_id'])) : 'Why Choose BXSea?');?></h2>
            <div class="list">
              <?= !empty($schoolwhybxsea[0]['why_content_en']) ? bxsea_render_html($schoolwhybxsea[0]['why_content_en'], '<p><br><strong><em><ul><ol><li><h4><h5><h6>') : (!empty($schoolwhybxsea[0]['why_content_id']) ? bxsea_render_html($schoolwhybxsea[0]['why_content_id'], '<p><br><strong><em><ul><ol><li><h4><h5><h6>') : '<p>An unforgettable educational experience awaits you at BXSea.</p>');?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="what-included py-5">
  <div class="container">
    <h2 class="text-center title mb-4">What's Included</h2>
    <?php if (!empty($schoolincluded)): ?>
    <div class="row g-4">
      <?php foreach ($schoolincluded as $item): ?>
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card custom-card h-100">
          <?php if (!empty($item['included_image'])): ?>
          <img src="<?= bxsea_asset_url('school_included', $item['included_image'], 'assets/landing/image/bxsea_image_included_default.png'); ?>" class="card-img-top" alt="<?= esc(bxsea_plain_text($item['included_title_en'] ?? $item['included_title_id'] ?? '')); ?>">
          <?php else: ?>
          <img src="<?= $included1; ?>" class="card-img-top" alt="">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= !empty($item['included_title_en']) ? esc(bxsea_plain_text($item['included_title_en'])) : (!empty($item['included_title_id']) ? esc(bxsea_plain_text($item['included_title_id'])) : ''); ?></h5>
            <p class="card-text"><?= !empty($item['included_desc_en']) ? esc(bxsea_plain_text($item['included_desc_en'])) : (!empty($item['included_desc_id']) ? esc(bxsea_plain_text($item['included_desc_id'])) : ''); ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="row g-4">
      <div class="col-12 text-center">
        <p>No data available at the moment.</p>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php if (!empty($teachertestimonial)): ?>
<section class="teacher-said">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 d-flex align-items-center justify-content-end">
        <div class="image-teacher-said-box">
          <div class="bullets"></div>
          <?php if (!empty($teachertestimonial[0]['teacher_image'])): ?>
          <img src="<?= bxsea_asset_url('school_teacher', $teachertestimonial[0]['teacher_image'], 'assets/landing/image/bxsea_image_teacher.png'); ?>" alt="<?= esc($teachertestimonial[0]['teacher_name'] ?? 'Teacher'); ?>">
          <?php else: ?>
          <img src="<?= $teacherImg; ?>" alt="Teacher">
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="teacher-said-box">
          <h2 class="title">Teacher Testimonials</h2>
          <p><?= !empty($teachertestimonial[0]['teacher_desc_en']) ? esc(bxsea_plain_text($teachertestimonial[0]['teacher_desc_en'])) : (!empty($teachertestimonial[0]['teacher_desc_id']) ? esc(bxsea_plain_text($teachertestimonial[0]['teacher_desc_id'])) : 'An amazing experience for our students.'); ?></p>
          <div class="image-teacher-said-box-mobile">
            <?php if (!empty($teachertestimonial[0]['teacher_image'])): ?>
            <img src="<?= bxsea_asset_url('school_teacher', $teachertestimonial[0]['teacher_image'], 'assets/landing/image/bxsea_image_teacher.png'); ?>" alt="<?= esc($teachertestimonial[0]['teacher_name'] ?? 'Teacher'); ?>">
            <?php else: ?>
            <img src="<?= $teacherImg; ?>" alt="Teacher">
            <?php endif; ?>
            <span><?= !empty($teachertestimonial[0]['teacher_name']) ? esc($teachertestimonial[0]['teacher_name']) : 'Teacher'; ?></span>
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
      <h1>Choose Your Program</h1>
    </div>
    <div class="bg-schoolpackage-slide">
      <div class="row gx-1">
        <div class="box-flex-package-program">
          <div class="title-schoolpackage-program">
            <h5><?= esc(bxsea_plain_text($schoolvisitdesc[0]['masterdesc_title_en'] ?? ($schoolvisitdesc[0]['masterdesc_title'] ?? 'The program will be divided into 3 grades for each package:')));?></h5>
            <div class="program">
              <?= esc(bxsea_plain_text($schoolvisitdesc[0]['masterdesc_desc_en'] ?? ($schoolvisitdesc[0]['masterdesc_desc'] ?? '')));?>
            </div>
          </div>
          <div class="brand-package">
            <img src="<?= base_url('assets/landing/');?>image/logo_footer.png" alt="">
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="package-grade mb-400">
            <ul class="package-left">
              <?php foreach($schoolvisit as $sv) {?>
              <li><?= esc(bxsea_plain_text($sv['schoolvisit_desc_en'] ?? ($sv['schoolvisit_desc'] ?? '')));?></li>
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
                      <?php foreach($schoolvisitbasic as $svb) { ?>
                        <?php if ($svb['schoolvisit_basic'] === "-" || $svb['schoolvisit_basic'] === '') { ?>
                        <li class="disabled"></li>
                        <?php } elseif (is_numeric($svb['schoolvisit_basic'])) { ?>
                        <li><?= esc($svb['schoolvisit_basic']);?></li>
                        <?php } else { ?>
                        <li><img src="<?= base_url('assets/landing/');?>image/ceklist-schoolpackage.png" alt="✓" style="width:28px;height:28px;"></li>
                        <?php } ?>
                      <?php } ?>
                    </ul>
                  </div>
                </li>
                <li class="splide__slide">
                  <div class="package-grade">
                    <ul class="package-centers">
                      <li class="bg-blue-package">Premium</li>
                      <?php foreach($schoolvisitpremium as $svp) { ?>
                        <?php if ($svp['schoolvisit_premium'] === "-" || $svp['schoolvisit_premium'] === '') { ?>
                        <li class="disabled"></li>
                        <?php } elseif (is_numeric($svp['schoolvisit_premium'])) { ?>
                        <li><?= esc($svp['schoolvisit_premium']);?></li>
                        <?php } else { ?>
                        <li><img src="<?= base_url('assets/landing/');?>image/ceklist-schoolpackage.png" alt="✓" style="width:28px;height:28px;"></li>
                        <?php } ?>
                      <?php } ?>
                    </ul>
                  </div>
                </li>
                <li class="splide__slide">
                  <div class="package-grade">
                    <ul class="package-centers">
                      <li class="bg-blue-package">Special BXperience</li>
                      <?php foreach($schoolvisitspecial as $svs) { ?>
                        <?php if ($svs['schoolvisit_special'] === "-" || $svs['schoolvisit_special'] === '') { ?>
                        <li class="disabled"></li>
                        <?php } elseif (is_numeric($svs['schoolvisit_special'])) { ?>
                        <li><?= esc($svs['schoolvisit_special']);?></li>
                        <?php } else { ?>
                        <li><img src="<?= base_url('assets/landing/');?>image/ceklist-schoolpackage.png" alt="✓" style="width:28px;height:28px;"></li>
                        <?php } ?>
                      <?php } ?>
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

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2">
      <h1>Book Now</h1>
      <p>Contact us to book a School Visit at BXSea Oceanarium!</p>
    </div>
    <div class="row box-contact">
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
        <div class="card-contactus2">
          <a href="<?= esc($setup[0]['setup_customer'] ?? '#');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactCustomerAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>Customer Services</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus2">
        <div class="card-contactus2">
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $setup[0]['setup_phone'] ?? '');?>" target="_blank" rel="noopener noreferrer">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactWhatsappAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>WhatsApp</p></div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus3">
        <div class="card-contactus2">
          <a href="mailto:<?= esc($setup[0]['setup_email'] ?? '');?>">
            <div class="image-contactus2"><img class="img-fluid" src="<?= $contactEmailAsset; ?>" alt=""></div>
            <div class="desc-card-contactus2"><p>Email</p></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var el = document.querySelector('.Schoolpackage-program-slide');
  if (el && window.Splide) {
    var schoolSplide = new Splide('.Schoolpackage-program-slide', {
      perPage   : 3,
      pagination: false,
      arrows    : false,
      gap       : 5,
      breakpoints: {
        767: { perPage: 1, arrows: true },
        992: { perPage: 2, arrows: true },
      },
    });
    schoolSplide.mount();
  }
});
</script>
<?= $this->endSection() ?>
