<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$ticketHeroAsset = bxsea_design_asset('ticket', 'hero', 'assets/landing/image/bxsea_image_bg-ticket.png');
$ticketGrassAsset = bxsea_design_asset('ticket', 'grass', 'assets/landing/image/bg-grass.png');
$ticketLocationIconAsset = bxsea_design_asset('ticket', 'location_icon', 'assets/landing/image/dashicons_location.png');
$ticketExploreAddonsAsset = bxsea_design_asset('ticket', 'explore_addons', 'assets/landing/image/boat-tour-image.png');
$ticketExploreSchoolAsset = bxsea_design_asset('ticket', 'explore_school', 'assets/landing/image/bxsea-image-ticket-group2.png');
$ticketExploreSpecialAsset = bxsea_design_asset('ticket', 'explore_special', 'assets/landing/image/bxsea_image_explore-more.png');
$ticketExploreMaps = bxsea_design_asset('ticket', 'explore_maps', 'assets/landing/image/map_navigation 1.svg');
$ticketLongTitleParts = explode('||', bxsea_plain_text($ticketlong[0]['masterdesc_title'] ?? '18 Zona'));
$ticketLongDescParts = explode('||', bxsea_plain_text($ticketlong[0]['masterdesc_desc'] ?? ''));
$ticketBannerTitle = bxsea_plain_text($ticketheader[0]['masterdesc_title'] ?? 'PESAN TIKET');
$ticketBannerDesc = bxsea_plain_text($ticketheader[0]['masterdesc_desc'] ?? 'Pesan tiket anda lebih awal agar rencana liburan makin nyaman');
$ticketJourneyTitle = bxsea_plain_text($ticketjourney[0]['masterdesc_title'] ?? 'Petualangan Menanti!');
$ticketJourneyDesc = bxsea_plain_text($ticketjourney[0]['masterdesc_desc'] ?? 'Selamat datang di BXSea! Jelajahi terowongan bawah laut terbesar di Asia Tenggara! Temukan beragam spesies biota laut dan nikmati keajaiban dunia bawah laut yang menakjubkan');
?>

<section class="sectionBanner ticket-page-banner">
  <div class="hero-wrap2">
    <div class="container">
      <div class="hero-image2">
        <img src="<?= $ticketHeroAsset; ?>" alt="">
      </div>
      <div class="row descBanner padding-banner">
        <h1 class="banner-title"><?= esc($ticketBannerTitle); ?></h1>
        <p class="banner-description"><?= esc($ticketBannerDesc); ?></p>
      </div>
    </div>
  </div>
</section>

<section class="premiumpackage ticketfee-premiumpackage">
  <div class="container">
    <div class="title-premiumpackage">
      <h1><?= esc($ticketJourneyTitle); ?></h1>
      <p><?= esc($ticketJourneyDesc); ?></p>
    </div>
    <div class="premiun-package-flex">
          <div class="">
            <div class="card-premiumpackage">
              <div class="title-card-premium">
                <h1>LONG JOURNEY</h1>
              </div>
              <div class="strength">
                <p class="amount-zone">18 Zona</p>
                <p> Dengan rute sepanjang kurang lebih 485 meter, 'Long Journey' akan membawamu melewati berbagai zona yang berisi koleksi ikan air tawar terbesar dan penuh warna, reptil, amfibi, dan masih banyak lagi! Temukan seluruh biota BXSea sepuasnya dengan paket Long Journey</p>
                <div class="desc-strength">
                  <img src="<?= $ticketExploreMaps; ?>" alt="">
                  <div class="box-zone-detail">
                    <div class="zones-detail">
                      <p>Sea Wave</p>
                      <p>Hide & Seek</p>
                      <p>Seahorse Empires</p>
                      <p>Exotic Fish</p>
                      <p>Schooling Fish</p>
                      <p>Shark Path</p>
                    </div>
                    <div class="zones-detail">
                      <p>Raja Ampat</p>
                      <p>Rainforest</p>
                      <p>Mangrove</p>
                      <p>Touch pool</p>
                      <p>King of River</p>
                      <p>Children's playground</p>
                    </div>
                    <div class="zones-detail">
                      <p>Jellyfish</p>
                      <p>Activity room(For certain events)</p>
                      <p>Sea Tunnel</p>
                      <p>Sea Theatre</p>
                      <p>Yellow Submarine</p>
                      <p>Penguin</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <img class="grass-gray" src="<?= base_url('assets/landing/');?>image/grass-gray.png" alt="">
  </div>
</section>

<section class="ticketing ticketfee-ticketing">
  <img class="grass-gray-rotate" src="<?= base_url('assets/landing/');?>image/grass-gray.png" alt="">
  <img class="fishbuntal" src="<?= base_url('assets/landing/');?>image/fish-buntal.png" alt="">
  <img class="shark4" src="<?= base_url('assets/landing/');?>image/fish.png" alt="">
  <div class="container">
    <div class="head-title-ticketing"><h1>HARGA TIKET MASUK</h1></div>
    <div class="box-nav-ticketing">
      <a class="link-ourwork active" href="#work1" data-target="#work1"><div class="title-ourwork"><p>Regular</p></div></a>
      <a class="link-ourwork" href="#work2" data-target="#work2"><div class="title-ourwork"><p>Group</p></div></a>
    </div>

    <div class="ticket-tab-panel is-active" id="work1">
      <div class="title-lityhide">
        <p><?= esc(bxsea_plain_text($homedescticketreguler[0]['masterdesc_desc'] ?? 'Max. pembelian 10 tiket dalam 1x transaksi'));?></p>
      </div>
      <div class="splide card-ticketing-splide" role="group">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($ticketregular as $tk): ?>
            <li class="splide__slide box-card-ticketing">
              <div class="card-ticketing">
                <div class="overlay-bg-card"></div>
                <div class="image-card-ticketing">
                  <img src="<?= bxsea_asset_url('ticket', $tk['ticket_pict'] ?? '', 'assets/landing/image/bxsea-image-ticket-regular.png');?>" alt="<?= esc($tk['ticket_title'] ?? '');?>">
                </div>
                <div class="overlay-card-ticketing">
                  <div class="desc-card-ticketing">
                    <div class="title-card"><h3><?= esc(bxsea_plain_text($tk['ticket_title'] ?? ''));?></h3></div>
                    <p class="text-ticket-schedule"><?= esc(bxsea_plain_text($tk['ticket_schedule'] ?? ''));?></p>
                    <?php if(!empty($tk['ticket_subtitle'])): ?><p class="text-ticket-schedule"><?= esc(bxsea_plain_text($tk['ticket_subtitle']));?></p><?php endif; ?>
                    <div class="body-card-ticketing">
                      <p>Rp <?= number_format((int)($tk['ticket_price'] ?? 0), 0, ',', '.');?></p>
                      <?php if(!empty($tk['ticket_total_journey'])): ?>
                      <div class="location-card-ticketing">
                        <img src="<?= $ticketLocationIconAsset; ?>" alt="">
                        <p><?= esc($tk['ticket_total_journey']);?></p>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="footer-card-ticketing">
                      <div class="link-buy-card-ticketing">
                        <?php if(!empty($tk['ticket_link'])): ?>
                        <a href="<?= esc($tk['ticket_link']);?>" class="bg-blue-ticket" target="_blank" rel="noopener noreferrer">Beli Sekarang</a>
                        <?php else: ?>
                        <a href="javascript:void(0)">Segera Hadir</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="ticket-tab-panel" id="work2">
      <div class="title-lityhide">
        <p><?= esc(bxsea_plain_text($homedescticketgroup[0]['masterdesc_desc'] ?? 'Min. pembelian 20 tiket dalam 1x transaksi'));?></p>
      </div>
      <div class="splide card-ticketing-splide2" role="group">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($ticketgroup as $tk): ?>
            <li class="splide__slide box-card-ticketing">
              <div class="card-ticketing">
                <div class="overlay-bg-card"></div>
                <div class="image-card-ticketing">
                  <img src="<?= bxsea_asset_url('ticket', $tk['ticket_pict'] ?? '', 'assets/landing/image/bxsea-image-ticket-group.png');?>" alt="<?= esc($tk['ticket_title'] ?? '');?>">
                </div>
                <div class="overlay-card-ticketing">
                  <div class="desc-card-ticketing">
                    <div class="title-card"><h3><?= esc(bxsea_plain_text($tk['ticket_title'] ?? ''));?></h3></div>
                    <p class="text-ticket-schedule"><?= esc(bxsea_plain_text($tk['ticket_schedule'] ?? ''));?></p>
                    <?php if(!empty($tk['ticket_subtitle'])): ?><p class="text-ticket-schedule"><?= esc(bxsea_plain_text($tk['ticket_subtitle']));?></p><?php endif; ?>
                    <div class="body-card-ticketing">
                      <p>Rp <?= number_format((int)($tk['ticket_price'] ?? 0), 0, ',', '.');?></p>
                      <?php if(!empty($tk['ticket_total_journey'])): ?>
                      <div class="location-card-ticketing">
                        <img src="<?= $ticketLocationIconAsset; ?>" alt="">
                        <p><?= esc($tk['ticket_total_journey']);?></p>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="footer-card-ticketing">
                      <div class="link-buy-card-ticketing">
                        <?php if (!empty($tk['ticket_link'])): ?>
                        <a class="bg-blue-ticket" href="<?= esc($tk['ticket_link']);?>" target="_blank" rel="noopener noreferrer">Beli Sekarang</a>
                        <?php else: ?><a href="javascript:void(0)" class="bg-blue-ticket">Segera Hadir</a><?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container explore-more ticketfee-explore-more">
  <div class="left-grid">
    <div class="title-explore-more">
      <h1>Jelajahi pilihan <br> lainnya untuk Anda</h1>
    </div>
  </div>
  <div class="right-grid">
    <div class="box-explore-more">
      <a href="<?= base_url('/id/tiket/pengalaman-premium');?>">
        <div class="image-box-explore-more">
          <img src="<?= base_url('assets/landing/');?>image/boat-tour-image.png" alt="Add-Ons">
          <div class="desc-box-explore-more">
            <h4>Add-Ons</h4>
          </div>
        </div>
      </a>
    </div>
    <div class="box-explore-more">
      <a href="<?= base_url('/id/tiket/program-kunjungan-sekolah');?>">
        <div class="image-box-explore-more">
          <img src="<?= base_url('assets/landing/');?>image/bxsea-image-ticket-group2.png" alt="Program Kunjungan Sekolah">
          <div class="desc-box-explore-more">
            <h4>Program Kunjungan Sekolah</h4>
          </div>
        </div>
      </a>
    </div>
    <div class="box-explore-more">
      <a href="<?= base_url('/id/tiket/promosi');?>">
        <div class="image-box-explore-more">
          <img src="<?= base_url('assets/landing/');?>image/bxsea_image_explore-more.png" alt="Promosi">
          <div class="desc-box-explore-more">
            <h4>Promosi</h4>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
