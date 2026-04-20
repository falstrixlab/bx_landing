<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="overlay-blue-bg-banner"></div>
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
    </div>
    <div class="title-merchandise descBanner2">
      <h1>Terms and Conditions</h1>
    </div>
  </div>
</section>

<section class="SK">
  <div class="container">
    <div class="maxwidth">
      <?php if (!empty($legal[0]['masterlegal_desc_en'])): ?>
        <?= bxsea_render_html($legal[0]['masterlegal_desc_en']) ?>
      <?php elseif (!empty($legal[0]['masterlegal_content'])): ?>
        <?= bxsea_render_html($legal[0]['masterlegal_content']) ?>
      <?php else: ?>
        <p>BXSea's Entry Requirements greatly prioritise the safety of guests and animals, and are committed to ensuring that high standards are adhered to by all visitors. Your cooperation is appreciated in keeping the Attraction and its facilities safe as a place to enjoy a fun and exciting experience.</p>
        <div class="titleSK">
          <h5>General :</h5>
          <ul><li>For health and safety reasons, only wheelchairs, strollers, and mobility scooters are permitted inside the Attraction.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Ticketing / Entry :</h5>
          <ul><li>THE ATTRACTION IS PRIVATE PROPERTY. All visitors must pay admission or hold a valid ticket. Children under 2 years and seniors over 70 years may enter free of charge. Tickets are non-transferable and not for resale. Tickets are valid only on the printed date.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Your Conduct :</h5>
          <ul><li>Noise or behaviour that disturbs other guests or animals is not permitted. Smoking (including e-cigarettes) is only allowed in designated smoking areas.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Safety :</h5>
          <ul><li>Bringing weapons, fireworks, or hazardous items is prohibited. Alcoholic beverages are only permitted in designated areas. Illegal substances are strictly forbidden.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Pets :</h5>
          <ul><li>Pets are not permitted except for registered guide dogs, hearing dogs, and assistance dogs.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Photography :</h5>
          <ul><li>You are permitted to take photos and recordings inside the Attraction for personal use only, not for commercial purposes.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Our Responsibility :</h5>
          <p>BXSea is not liable for losses arising from events beyond our reasonable control.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <img class="grass17" src="<?= base_url('assets/landing/');?>image/bg-grass.png" alt="">
</section>

<?= $this->endSection() ?>
