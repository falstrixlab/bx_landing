<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">
        <div class="hero-wrap2">
          <div class="overlay-darkblue-bg-banner"></div>
          <div class="hero-image2">
            <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
          </div>
          <div class="container">
              <div class="row descBanner2">
                 <div class="col-lg-12 box-premium">
                    <div class="desc-premium">
                      <h1><?= esc(bxsea_plain_text($map[0]['map_title_en'] ?? 'BXSea Map'));?></h1>
                      <p><?= esc(bxsea_plain_text($map[0]['map_desc_en'] ?? ''));?></p>
                    </div>
                 </div>
              </div>  
          </div>
        </div>
  </section>


  <img class="bg-guide2" src="<?= base_url('assets/landing/');?>image/Rectangle 19546.png" alt="">


  <section class="map-oceanarium">
    <img class="grass36" src="<?= base_url('assets/landing/');?>image/bg-grass6.png" alt="">
    <img class="grass37" src="<?= base_url('assets/landing/');?>image/bg-grass3.png" alt="">
    <img class="grass38" src="<?= base_url('assets/landing/');?>image/bg-grass8.png" alt="">
    <img class="grass39" src="<?= base_url('assets/landing/');?>image/grass18.png" alt="">
    <img class="grass40" src="<?= base_url('assets/landing/');?>image/bg-grass4.png" alt="">
    <img class="grass41" src="<?= base_url('assets/landing/');?>image/bg-grass5.png" alt="">
    <img class="grass42" src="<?= base_url('assets/landing/');?>image/grass12.png" alt="">
    <div class="container">
      <div class="image-map-oceanarium">
        <img class="img-fluid" src="<?= base_url('assets/upload/map/'.$map[0]['map_pict']);?>" alt="">
      </div>
    </div>
    <div class="download-map">
      <a href="<?= base_url('assets/landing/');?>image/map-oceanarium.pdf" download>
        Download Map
      </a>
    </div>
  </section>
  <?= $this->endSection() ?>