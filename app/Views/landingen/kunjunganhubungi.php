<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$contactHeroAsset      = bxsea_design_asset('visit', 'hero_contact',          'assets/landing/image/bxsea_image_bg-tenant.png');
$contactCustomerAsset  = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset  = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset     = bxsea_design_asset('visit', 'contact_card_email',    'assets/landing/image/sosmed3.png');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $contactHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title">CONTACT US</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success container mt-3">Your message has been sent successfully!</div>
<?php elseif (session()->getFlashdata('failed')): ?>
<div class="alert alert-danger container mt-3">Failed to send your message. Please try again.</div>
<?php endif; ?>

<section class="Contactus">
  <img class="octopus" src="<?= base_url('assets/landing/');?>image/BXSea Asset plus-07 1.svg" alt="">
  <img class="octopus2" src="<?= base_url('assets/landing/');?>image/BXSea Asset plus-08 2.svg" alt="">
  <div class="container">
    <div class="title-Contactus">
      <h1>Send Us a Message</h1>
      <p>If you have any questions, suggestions, or feedback for us, please fill in the form below. Our team will get back to you shortly.</p>
    </div>
    <form action="<?= base_url('en/kunjungan/hubungi-kami-proses')?>" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="submit" value="1">
      <div class="row">
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Full Name</h5>
            <input type="text" name="contact_fullname" required>
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Phone Number</h5>
            <input type="tel" name="contact_phone">
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Email</h5>
            <input type="email" name="contact_email">
          </div></div>
        </div>
        <div class="col-lg-12 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Message</h5>
            <textarea name="contact_desc" rows="5"></textarea>
          </div></div>
        </div>
        <div class="submit-message">
          <button type="submit">Send Message</button>
        </div>
      </div>
    </form>
  </div>
</section>

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2"><h1>Contact Us</h1></div>
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
