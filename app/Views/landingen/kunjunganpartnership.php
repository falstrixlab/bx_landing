<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/bxsea_image_bg-tenant.png" alt="Partnership background">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title">Partner With Us</h1>
            <p>Learn how a partnership with BXSea can create long-term impact through shared goals and meaningful collaboration.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="meaningful-section">
  <div class="container">
    <div class="text-center header-section">
      <h2>Working Together for Meaningful Change</h2>
      <p>As a home for thousands of marine species, BXSea is committed to delivering educational entertainment that inspires curiosity, conservation, and connection.</p>
    </div>
    <div class="row justify-content-center g-4 mb-5 pb-5">
      <div class="col-md-4"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_partnership2.png" class="img-fluid rounded-img" alt="Partnership image 1"></div>
      <div class="col-md-4"><img src="<?= base_url('assets/landing/');?>image/bxsea_image_partnership.png" class="img-fluid rounded-img" alt="Partnership image 2"></div>
    </div>
  </div>
</section>

<section class="partnership-section">
  <div class="container">
    <div class="partnership-box">
      <h5 class="text-center mb-4">Partnership Opportunities</h5>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-partner">
            <img src="<?= base_url('assets/landing/');?>image/bxsea_image_partnership_opportunity.png" class="img-fluid card-img" alt="Mission alignment">
            <h6>Mission Alignment</h6>
            <p>Join BXSea in inspiring people of all ages to value the ocean and support ongoing conservation efforts.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-partner">
            <img src="<?= base_url('assets/landing/');?>image/bxsea_image_partnership_opportunity2.png" class="img-fluid card-img" alt="Community engagement">
            <h6>Community Engagement</h6>
            <p>BXSea builds meaningful connections among families, educators, and curious individuals through shared educational experiences.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-partner">
            <img src="<?= base_url('assets/landing/');?>image/bxsea_image_partnership_opportunity3.png" class="img-fluid card-img" alt="Brand awareness">
            <h6>Brand Awareness</h6>
            <p>Create authentic visibility for both brands through a partnership grounded in real experiences and positive public impact.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success container mt-3">Your message has been sent successfully.</div>
<?php elseif(session()->getFlashdata('failed')): ?>
<div class="alert alert-danger container mt-3">Failed to send your message. Please try again.</div>
<?php endif; ?>

<section class="Contactus">
  <div class="container">
    <div class="title-Contactus">
      <h1>Leave Us a Message</h1>
      <p>If you are interested in becoming our partner, please contact us through the form below.</p>
    </div>
    <form action="<?= base_url('en/kunjungan/partnership-proses');?>" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="submit" value="1">
      <div class="row">
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1"><h5>Full Name</h5><input type="text" name="contact_fullname" required></div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1"><h5>Phone Number</h5><input type="text" name="contact_phone"></div></div>
        </div>
        <div class="col-lg-4 mb-200">
          <div class="form-row"><div class="form-row1"><h5>Email</h5><input type="email" name="contact_email"></div></div>
        </div>
        <div class="col-lg-12 mb-200">
          <div class="form-row"><div class="form-row1"><h5>Message</h5><textarea name="contact_desc" rows="5"></textarea></div></div>
        </div>
        <div class="submit-message">
          <button type="submit">Send Message</button>
        </div>
      </div>
    </form>
  </div>
</section>

<?= $this->endSection(); ?>