<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$contactHeroAsset = bxsea_design_asset('visit', 'hero_contact', 'assets/landing/image/bxsea_image_bg-tenant.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset = bxsea_design_asset('visit', 'contact_card_email', 'assets/landing/image/sosmed3.png');
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
            <h1 class="banner-title">HUBUNGI KAMI</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success container mt-3">Pesan Anda berhasil terkirim!</div>
<?php elseif (session()->getFlashdata('failed')): ?>
<div class="alert alert-danger container mt-3">Gagal mengirim pesan. Coba lagi.</div>
<?php endif; ?>

<section class="Contactus">
  <div class="container">
    <div class="title-Contactus">
      <h1>Kirimkan Pesan Anda</h1>
      <p>Jika Anda memiliki pertanyaan, saran, atau masukan untuk kami, silakan isi formulir di bawah ini. Tim kami akan segera menghubungi Anda.</p>
    </div>
    <form action="<?= base_url('id/kunjungan/hubungi-kami-proses');?>" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="submit" value="1">
      <div class="row">
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Nama Lengkap</h5>
            <input type="text" name="contact_fullname" required>
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Nomor Telepon</h5>
            <input type="tel" name="contact_phone">
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>E-mail</h5>
            <input type="email" name="contact_email">
          </div></div>
        </div>
        <div class="col-lg-12 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Pesan</h5>
            <textarea name="contact_desc" rows="5"></textarea>
          </div></div>
        </div>
        <div class="submit-message">
          <button type="submit">Kirim pesan</button>
        </div>
      </div>
    </form>
  </div>
</section>

<section class="contactus2">
  <div class="container">
    <div class="title-contactus2"><h1>Hubungi Kami</h1></div>
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
