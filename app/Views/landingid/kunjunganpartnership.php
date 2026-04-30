<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$pc = $partnershipContent ?? [];
$opps = $partnershipOpportunities ?? [];
$partnershipHeroAsset = bxsea_design_asset('visit', 'hero_contact', 'assets/landing/image/bxsea_image_bg-tenant.png');
$partnershipShowcase1 = !empty($pc['meaningful_img1']) ? base_url('assets/upload/partnership/'.$pc['meaningful_img1']) : bxsea_design_asset('visit', 'partnership_showcase_1', 'assets/landing/image/bxsea_image_partnership2.png');
$partnershipShowcase2 = !empty($pc['meaningful_img2']) ? base_url('assets/upload/partnership/'.$pc['meaningful_img2']) : bxsea_design_asset('visit', 'partnership_showcase_2', 'assets/landing/image/bxsea_image_partnership.png');
$partnershipOpportunity1 = bxsea_design_asset('visit', 'partnership_opportunity_1', 'assets/landing/image/bxsea_image_partnership_opportunity.png');
$partnershipOpportunity2 = bxsea_design_asset('visit', 'partnership_opportunity_2', 'assets/landing/image/bxsea_image_partnership_opportunity2.png');
$partnershipOpportunity3 = bxsea_design_asset('visit', 'partnership_opportunity_3', 'assets/landing/image/bxsea_image_partnership_opportunity3.png');
$defaultOpportunityImages = [$partnershipOpportunity1, $partnershipOpportunity2, $partnershipOpportunity3];
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $partnershipHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title">JADILAH MITRA KAMI</h1>
            <p>Pelajari bagaimana kemitraan dengan BXSea akan membantu menciptakan dampak yang berkelanjutan melalui tujuan bersama dan kolaborasi</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="meaningful-section">
  <div class="container">
    <div class="text-center header-section">
      <h2><?= !empty($pc['meaningful_title_id']) ? esc(bxsea_plain_text($pc['meaningful_title_id'])) : 'Bekerja Sama Demi Perubahan yang Bermakna'; ?></h2>
      <p><?= !empty($pc['meaningful_desc_id']) ? esc(bxsea_plain_text($pc['meaningful_desc_id'])) : 'Menjadi rumah bagi ribuan biota laut, BXSea berdedikasi untuk menyajikan hiburan edukatif—edutainment—guna menginspirasi rasa ingin tahu, upaya konservasi, dan keterhubungan.'; ?></p>
    </div>
    <div class="row justify-content-center g-4 mb-5 pb-5">
      <div class="col-md-4"><img src="<?= $partnershipShowcase1; ?>" class="img-fluid rounded-img"></div>
      <div class="col-md-4"><img src="<?= $partnershipShowcase2; ?>" class="img-fluid rounded-img"></div>
    </div>
  </div>
</section>

<section class="partnership-section">
  <div class="container">
    <div class="partnership-box">
      <h5 class="text-center mb-4">Peluang Kemitraan</h5>
      <div class="row g-4">
        <?php if (!empty($opps)): $oppIdx = 0; foreach ($opps as $opp): ?>
        <div class="col-md-4">
          <div class="card-partner">
            <img src="<?= !empty($opp['opp_image']) ? base_url('assets/upload/partnership/'.$opp['opp_image']) : ($defaultOpportunityImages[$oppIdx] ?? $defaultOpportunityImages[0]); ?>" class="img-fluid card-img">
            <h6><?= esc(bxsea_plain_text($opp['opp_title_id'] ?? '')); ?></h6>
            <p><?= esc(bxsea_plain_text($opp['opp_desc_id'] ?? '')); ?></p>
          </div>
        </div>
        <?php $oppIdx++; endforeach; else: ?>
        <div class="col-md-4"><div class="card-partner"><img src="<?= $partnershipOpportunity1; ?>" class="img-fluid card-img"><h6>Keselarasan Misi</h6><p>Sebagai mitra kami, Anda akan bergabung dalam misi untuk menginspirasi dan mengajak masyarakat dari segala usia untuk menghargai laut kita serta mendukung upaya konservasi kami.</p></div></div>
        <div class="col-md-4"><div class="card-partner"><img src="<?= $partnershipOpportunity2; ?>" class="img-fluid card-img"><h6>Pemberdayaan Komunitas</h6><p>Komitmen BXSea terhadap edutainment bersandar pada keterhubungan antara keluarga, pendidik, dan individu yang memiliki rasa ingin tahu tinggi.</p></div></div>
        <div class="col-md-4"><div class="card-partner"><img src="<?= $partnershipOpportunity3; ?>" class="img-fluid card-img"><h6>Kesadaran Merek</h6><p>Bersama-sama, kita bertujuan untuk membangun persepsi merek yang positif bagi kedua belah pihak serta menciptakan paparan merek yang autentik.</p></div></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success container mt-3">Pesan Anda berhasil terkirim!</div>
<?php elseif(session()->getFlashdata('captcha_error')): ?>
<div class="alert alert-danger container mt-3">Jawaban verifikasi salah. Silakan coba lagi.</div>
<?php elseif(session()->getFlashdata('failed')): ?>
<div class="alert alert-danger container mt-3">Gagal mengirim pesan. Coba lagi.</div>
<?php endif; ?>

<section class="Contactus">
  <div class="container">
    <div class="title-Contactus">
      <h1>Tinggalkan Pesan Anda</h1>
      <p>Jika Anda tertarik untuk menjadi mitra kami, silakan hubungi kami melalui formulir di bawah ini!</p>
    </div>
    <form action="<?= base_url('id/kunjungan/partnership-proses');?>" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="submit" value="1">
      <div class="row">
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Nama Lengkap</h5>
            <input type="text" name="contact_fullname" required maxlength="200" pattern="[A-Za-z ]+" title="Hanya huruf dan spasi">
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Nomor Telepon</h5>
            <input type="text" name="contact_phone" maxlength="20" pattern="[0-9]+" title="Hanya angka">
          </div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>E-mail</h5>
            <input type="email" name="contact_email" maxlength="100">
          </div></div>
        </div>
        <div class="col-lg-12 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Pesan</h5>
            <textarea name="contact_desc" rows="5"></textarea>
          </div></div>
        </div>
        <div class="col-lg-12 mb-200">
          <div class="form-row"><div class="form-row1">
            <h5>Verifikasi</h5>
            <div style="margin-top:10px;">
              <?= view('partials/slider_captcha', ['captcha_token' => $captcha_token, 'captcha_gap_y' => $captcha_gap_y, 'captcha_gap_x' => $captcha_gap_x, 'captcha_img_url' => $captcha_img_url, 'captcha_lang' => 'id']) ?>
            </div>
          </div></div>
        </div>
        <div class="col-12 submit-message">
          <button type="submit">Kirim Pesan</button>
        </div>
      </div>
    </form>
  </div>
</section>

<?= $this->endSection(); ?>
