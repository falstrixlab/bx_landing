<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="overlay-blue-bg-banner"></div>
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
    </div>
    <div class="title-merchandise descBanner2">
      <h1>Privacy Policy</h1>
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
        <h4>BXSea Privacy Policy</h4>
        <h5>Last updated: [11/12/2023]</h5>
        <p>Welcome to BXSea. This Privacy Policy explains how your personal information is collected, used, and disclosed by BXSea. By accessing or using our website at https://www.bxsea.co.id, you agree to the privacy practices described in this Privacy Policy.</p>
        <br>
        <div class="titleSK">
          <h5>Information We Collect</h5>
          <h6>Personal Information</h6>
          <p>When you use BXSea, we may collect personal information that can be used to identify you, including but not limited to: Name, Email Address, IP Address, Phone Number, and other identifying information.</p>
        </div>
        <div class="titleSK">
          <h5>Transaction Information</h5>
          <p>We may collect transaction-related information, including payment details and other information related to purchases or use of our services.</p>
        </div>
        <div class="titleSK">
          <h5>Use of Information</h5>
          <p>We may use the information we collect to provide and maintain our services, process transactions, manage user accounts, and improve the user experience.</p>
        </div>
        <div class="titleSK">
          <h5>Information Security</h5>
          <p>We take reasonable security measures to protect your personal information from unauthorised access.</p>
        </div>
        <div class="titleSK">
          <h5>Contact Us</h5>
          <p>If you have questions or need further information about our Privacy Policy, please do not hesitate to contact us at <?= esc($setup[0]['setup_email'] ?? 'info.bxsea@jayarealproperty.com');?>.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
