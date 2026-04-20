<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$specialHeroAsset = bxsea_design_asset('special', 'hero', 'assets/landing/image/bxsea_image_bg-special.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset = bxsea_design_asset('visit', 'contact_card_email', 'assets/landing/image/sosmed3.png');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $specialHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-schoolpackage">
          <div class="desc-schoolpackage">
            <h1><?= esc(bxsea_plain_text($momentheader[0]['masterdesc_title'] ?? 'PERAYAAN SPESIAL DI BXSEA'));?></h1>
            <p><?= esc(bxsea_plain_text($momentheader[0]['masterdesc_desc'] ?? 'Rayakan hari istimewa anda dengan suasana unik yang tidak terlupakan!'));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="Oncelifetime">
  <div class="container">
    <div class="title-once">
      <h1><?= esc(bxsea_plain_text($momentdesc[0]['masterdesc_title'] ?? 'Ciptakan Momen Tak Terlupakan di BXSea'));?></h1>
      <p><?= esc(bxsea_plain_text($momentdesc[0]['masterdesc_desc'] ?? 'Jadikan perayaan Anda benar-benar istimewa. Mulai dari pesta ulang tahun, acara kantor, hingga momen lamaran yang romantis.'));?></p>
    </div>
    <?php if (!empty($moment)): ?>
    <div class="event-section">
      <div class="owl-carousel owl-once">
        <?php foreach ($moment as $mo): ?>
        <div class="event-card">
          <?php if (!empty($mo['moment_pict'])): ?>
          <img src="<?= bxsea_asset_url('moment', $mo['moment_pict'] ?? '', 'assets/landing/image/image-once.png');?>" alt="<?= esc($mo['moment_title'] ?? '');?>" class="img-fluid">
          <?php endif; ?>
          <h3><?= esc($mo['moment_title'] ?? '');?></h3>
          <p><?= esc(strip_tags(substr($mo['moment_desc'] ?? '', 0, 200)));?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="memories-section">
  <div class="container">
    <h2 class="memories-title">OUR VISITORS MEMORIES</h2>
    <div class="memories-carousel-wrap">
      <div class="memories-wave memories-wave--top">
        <img src="<?= base_url('assets/landing/');?>image/bxsea_image_wave.png" alt="">
      </div>
      <button class="memories-arrow memories-arrow--prev" id="memories-prev">
        <img src="<?= base_url('assets/landing/');?>image/bxsea_image_arrow_left_moment.png" alt="prev">
      </button>
      <div class="owl-carousel owl-memories">
        <?php if (!empty($moment)): ?>
          <?php foreach ($moment as $memory): ?>
          <div class="memories-slide">
            <img src="<?= !empty($memory['moment_pict']) ? bxsea_asset_url('moment', $memory['moment_pict'], 'assets/landing/image/image-once.png') : base_url('assets/landing/image/bxsea_image_bg-special.png'); ?>" alt="<?= esc($memory['moment_title'] ?? 'Visitor Memory') ?>" class="img-fluid">
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="memories-slide"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_memories.png" alt="Memory 1" class="img-fluid"></div>
          <div class="memories-slide"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_memories2.png" alt="Memory 2" class="img-fluid"></div>
          <div class="memories-slide"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_memories3.png" alt="Memory 3" class="img-fluid"></div>
          <div class="memories-slide"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_memories4.png" alt="Memory 4" class="img-fluid"></div>
        <?php endif; ?>
      </div>
      <button class="memories-arrow memories-arrow--next" id="memories-next">
        <img src="<?= base_url('assets/landing/');?>image/bxsea_image_arrow_right_moment.png" alt="next">
      </button>
      <div class="memories-wave memories-wave--bottom">
        <img src="<?= base_url('assets/landing/');?>image/bxsea_image_wave2.png" alt="">
      </div>
    </div>
  </div>
</section>

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2"><h1>Pesan Sekarang</h1></div>
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
            <div class="desc-card-contactus2"><p>Whatsapp</p></div>
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
