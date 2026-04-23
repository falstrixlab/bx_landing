<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">
        <div class="hero-wrap2">
          <div class="hero-image2">
            <img src="<?= base_url('assets/landing/');?>image/bxsea_image_bg-visitor.png" alt="">
          </div>
          <div class="container">
              <div class="row descBanner2">
                 <div class="col-lg-12 box-premium">
                    <div class="desc-premium">
                      <h1><?= esc(bxsea_plain_text($map[0]['map_title_en'] ?? 'BXSea Map'));?></h1>
                    </div>
                 </div>
              </div>  
          </div>
        </div>
  </section>

  <section class="map-oceanarium">
  <div class="container image-map-oceanarium">
    <img class="iguana3" src="<?= base_url('assets/landing/');?>image/BXSEA_Rainforest_Assets.png" alt="">
    <?php if (!empty($map[0]['map_pict'])): ?>
    <img class="bxsea-map" src="<?= bxsea_asset_url('map', $map[0]['map_pict'] ?? '', 'assets/landing/image/FULL BXSea MAP [Revised]-1.png');?>" alt="<?= esc($map[0]['map_title'] ?? 'Denah BXSea');?>">
    <?php else: ?>
    <img class="bxsea-map" src="<?= $mapPreviewAsset; ?>" alt="Denah BXSea">
    <?php endif; ?>
    <div class="download-map">
      <?php if (!empty($map[0]['map_file'])): ?>
      <a href="<?= bxsea_asset_url('map', $map[0]['map_file'] ?? '', 'assets/landing/image/FULL BXSea MAP [Revised]_compressed.pdf'); ?>" download class="btn-download-map">Download Denah <img class="arrow-download-map" src="<?= base_url('assets/landing/');?>image/arrow-down-white.png" alt=""></a>
      <?php else: ?>
      <a href="<?= $mapDownloadAsset; ?>" download class="btn-download-map">Download Denah <img class="arrow-download-map" src="<?= base_url('assets/landing/');?>image/arrow-down-white.png" alt=""></a>
      <?php endif; ?>
    </div>
  </div>
</section>
  <?= $this->endSection() ?>