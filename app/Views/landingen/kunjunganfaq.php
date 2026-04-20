<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$faqHeroTitle = bxsea_plain_text($faqdesc[0]['masterdesc_title_en'] ?? 'Frequently Asked Questions');
$faqHeroDesc = bxsea_plain_text($faqdesc[0]['masterdesc_desc_en'] ?? 'Find quick answers to the most common questions about visiting BXSea, from tickets and operating hours to guest facilities.');
?>
<section class="sectionBanner">
    <div class="hero-wrap2">
        <div class="overlay-blue-bg-banner"></div>
        <div class="hero-image2">
          <img src="<?= base_url('assets/landing/');?>image/Banner-FAQ.png " alt="">
        </div>
        <div class="title-faq descBanner2">
          <h1>FAQ</h1>
        </div>
      </div>        
  </section>


  <section class="FAQ">
    <img class="shark3" src="<?= base_url('assets/landing/');?>image/shark2.png" alt="">
    <div class="container">    
      <div class="row">
      <h3><?= esc($faqHeroTitle);?></h3>
        <p class="mb-200"><?= esc($faqHeroDesc);?></p>
        <div class="col-lg-12">
          <div class="title-question">
            <h1>FREQUENTLY ASKED QUESTIONS ?</h1>
          </div>
          <?php foreach($faqgeneral AS $fg) {?>
          <div class="faq">
              <div class="question">
                  <div class="header-question">
                      <img src="<?= base_url('assets/landing/');?>image/Group 1171274846.svg" alt="">
                      <h4>
                        <?= esc(bxsea_plain_text($fg['faq_title_en'] ?? ($fg['faq_title'] ?? '')));?>
                       </h4>
                  </div>
                  <img class="arrow" src="<?= base_url('assets/landing/');?>image/icons8-chevron-down-24.png" alt="">
              </div>
              <div class="answer">
                <hr>
                  <p>
                    <?= esc(bxsea_plain_text($fg['faq_desc_en'] ?? ($fg['faq_desc'] ?? '')));?>
                  </p>
              </div>
          </div>
          <?php } ?>
          
          <div class="title-question">
            <h1>VISITORS AND FACILITIES ?</h1>
          </div>
          <?php foreach($faqfacility AS $ff) {?>
          <div class="faq">
            <div class="question">
                <div class="header-question">
                    <img src="<?= base_url('assets/landing/');?>image/Group 1171274846.svg" alt="">
                    <h4>
                    <?= esc(bxsea_plain_text($ff['faq_title_en'] ?? ($ff['faq_title'] ?? '')));?>
                     </h4>
                </div>
                <img class="arrow" src="<?= base_url('assets/landing/');?>image/icons8-chevron-down-24.png" alt="">
            </div>
            <div class="answer">
              <hr>
                <p>
                <?= esc(bxsea_plain_text($ff['faq_desc_en'] ?? ($ff['faq_desc'] ?? '')));?>
                </p>
            </div>
          </div>
          <?php } ?>
          <div class="title-question">
            <h1>DIDN'T FIND WHAT YOU WERE LOOKING FOR ?</h1>
          </div>
          <?php foreach($faqother AS $fo) {?>
          <div class="faq">
            <div class="question">
                <div class="header-question">
                    <img src="<?= base_url('assets/landing/');?>image/Group 1171274846.svg" alt="">
                    <h4>
                    <?= esc(bxsea_plain_text($fo['faq_title_en'] ?? ($fo['faq_title'] ?? '')));?>
                     </h4>
                </div>
                <img class="arrow" src="<?= base_url('assets/landing/');?>image/icons8-chevron-down-24.png" alt="">
            </div>
            <div class="answer">
              <hr>
                <p>
                <?= esc(bxsea_plain_text($fo['faq_desc_en'] ?? ($fo['faq_desc'] ?? '')));?>
                </p>
            </div>
          </div>
          <?php } ?>

        </div>
      </div>
    </div>
    <img class="grass17" src="<?= base_url('assets/landing/')?>image/bg-grass.png" alt="">
  </section>
  <?= $this->endSection() ?>