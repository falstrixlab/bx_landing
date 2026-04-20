<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">       
    <div class="hero-wrap2">
      <div class="overlay-darkblue-bg-banner"></div>
      <div class="hero-image2">
        <img src="<?= base_url('assets/landing/');?>image/banner-oncelifetime.png" alt="">
      </div>
      <div class="container">
        <div class="row descBanner2">
           <div class="col-lg-12 box-schoolpackage">
              <div class="desc-schoolpackage">
                <h1><?= esc(bxsea_plain_text($momentheader[0]['masterdesc_title_en'] ?? 'ONCE IN A LIFETIME MOMENT'));?></h1>
              </div>
           </div>

        </div>  
    </div>
    </div>
  </section>


  <img class="rectangle-darkblue2" src="<?= base_url('assets/landing/');?>image/rectangle-dark-blue.png" alt="">


  <section class="Oncelifetime">
      <img class="grass34" src="<?= base_url('assets/landing/');?>image/grass18.png" alt="">
      <img class="akar3" src="<?= base_url('assets/landing/');?>image/akar 1.png" alt="">
      <img class="akar4" src="<?= base_url('assets/landing/');?>image/akar 1.png" alt="">
      <img class="fish11" src="<?= base_url('assets/landing/');?>image/BXSea Asset plus-17 1.png" alt="">
      <img class="fish12" src="<?= base_url('assets/landing/');?>image/BXSea bawal.png" alt="">
      <div class="container">
          <div class="title-once">
              <h1><?= esc(bxsea_plain_text($momentdesc[0]['masterdesc_title_en'] ?? 'Create an Unforgettable Moment at BXSea'));?>
              </h1>
              <p><?= esc(bxsea_plain_text($momentdesc[0]['masterdesc_desc_en'] ?? ''));?></p>
              <a href="<?= base_url('contact');?>">Hubungi kami</a>
          </div>
          <div class="row mb-5">
              <div class="col-lg-4 mb-200 order-lg-2">
                <div class="image-once">
                    <img src="<?= base_url('assets/upload/moment/'.$moment[0]['moment_pict']);?>" alt="">
                </div>
              </div>
              <div class="col-lg-8 mb-200 order-lg-1 box-align2">
                <div class="desc-image-once text-right">
                  <h1><?= esc(bxsea_plain_text($moment[0]['moment_title_en'] ?? ''));?></h1>
                  <p><?= esc(bxsea_plain_text($moment[0]['moment_desc_en'] ?? ''));?></p>
                </div>
              </div>
          </div>

          <div class="row mb-5">
            <div class="col-lg-5 mb-200">
              <div class="image-once">
                  <img src="<?= base_url('assets/upload/moment/'.$moment[1]['moment_pict']);?>" alt="">
              </div>
            </div>

            <div class="col-lg-7 mb-200 box-align">
                <div class="desc-image-once">
                  <h1><?= esc(bxsea_plain_text($moment[1]['moment_title_en'] ?? ''));?></h1>
                  <p><?= esc(bxsea_plain_text($moment[1]['moment_desc_en'] ?? ''));?></p>
                </div>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-lg-6 mb-200 order-lg-2">
              <div class="image-once">
                  <img src="<?= base_url('assets/upload/moment/'.$moment[2]['moment_pict']);?>" alt="">
              </div>
            </div>

            <div class="col-lg-6 mb-200 order-lg-1 box-align">
                <div class="desc-image-once text-right">
                  <h1><?= esc(bxsea_plain_text($moment[2]['moment_title_en'] ?? ''));?></h1>
                  <p><?= esc(bxsea_plain_text($moment[2]['moment_desc_en'] ?? ''));?></p>
                </div>
            </div>
          </div>

      </div>
  </section>

<?php
$contactCustomerAsset = bxsea_design_asset('contact', 'customer', 'assets/landing/image/phone-girl.png');
$contactWhatsappAsset = bxsea_design_asset('contact', 'whatsapp', 'assets/landing/image/whatsapp-girl.png');
$contactEmailAsset = bxsea_design_asset('contact', 'email', 'assets/landing/image/email-girl.png');
?>

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2"><h1>Book Tickets</h1></div>
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