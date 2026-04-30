<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$ap = $aboutPage ?? [];
$aboutHeroAsset = bxsea_design_asset('about', 'hero', 'assets/landing/image/bxsea_image_bg-tenant.png');
$aboutOctopusAsset = bxsea_design_asset('about', 'octopus', 'assets/landing/image/gurita.png');
$aboutGallery1 = !empty($ap['gallery_1']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_1']) : bxsea_design_asset('about', 'gallery_1', 'assets/landing/image/image-aboutus2.png');
$aboutGallery2 = !empty($ap['gallery_2']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_2']) : bxsea_design_asset('about', 'gallery_2', 'assets/landing/image/image-aboutus.png');
$aboutGallery3 = !empty($ap['gallery_3']) ? base_url('assets/upload/about/gallery/'.$ap['gallery_3']) : bxsea_design_asset('about', 'gallery_3', 'assets/landing/image/image-aboutus2.png');
$aboutMainImage = !empty($ap['textblock_image']) ? base_url('assets/upload/about/'.$ap['textblock_image']) : bxsea_design_asset('about', 'main_image', 'assets/landing/image/bxsea_image_aboutus.png');
$aboutIntroTitle = !empty($ap['intro_title_id']) ? $ap['intro_title_id'] : 'Xtraordinary Xperience at Sea and Forest';
$aboutIntroHtml = !empty($ap['intro_desc_id']) ? $ap['intro_desc_id'] : '<p>BXSea adalah destinasi akuarium utama di wilayah Tangerang Selatan, hadir sebagai sarana edutainment bagi segala usia untuk mengenal kehidupan laut. Terletak di bawah Bintaro Jaya Xchange Mall 2, kami menginspirasi hubungan antara manusia dan biota. Kenali keunikan serta karakteristik menarik dari biota kami, mulai dari Belut Moray, Penguin Humboldt, hingga Gurita Pasifik Raksasa. BXSea memprioritaskan lingkungan yang menstimulasi edukasi sambil tetap menjaga pelestarian dan konservasi biota.</p>';
$subcircleDesc = !empty($ap['subcircle_desc_id']) ? $ap['subcircle_desc_id'] : 'BXSea adalah rumah bagi keragaman biota laut yang sangat luas!';
$bubbles = [];
for ($i = 1; $i <= 7; $i++) {
    $bubbles[$i] = !empty($ap['bubble'.$i.'_id']) ? $ap['bubble'.$i.'_id'] : '';
}
$bubbleDefaults = [
    1 => '7,354m² <br><span>Luas Area</span>',
    2 => '54 <br><span>Display Akuarium</span>',
    3 => '~25,000<br><span>Biota</span>',
    4 => 'Kapasitas air 4.5 Juta <br><span>Liter</span>',
    5 => '140 <br><span>Spesies</span>',
    6 => '10 <br><span>Terarium</span>',
    7 => '44 Akuarium<br><span>Air Tawar &amp; Air Laut</span>',
];
$leftDesc = !empty($ap['textblock_left_desc_id']) ? $ap['textblock_left_desc_id'] : 'BXSea memiliki <strong>dome dan terowongan bawah air terbesar di Asia Tenggara!</strong> Membentang sepanjang 35 meter, lebar 2,4 meter, dan tinggi 2,8 meter, kagumilah keragaman ikan, hiu, pari, dan masih banyak lagi!';
$block1Title = !empty($ap['textblock_title1_id']) ? $ap['textblock_title1_id'] : 'Konservasi';
$block1Desc  = !empty($ap['textblock_desc1_id'])  ? $ap['textblock_desc1_id']  : 'BXSea berkomitmen pada perlindungan dan konservasi biota serta berupaya menghadirkan pengalaman edukasi berbasis konservasi bagi semua orang. Melalui pengembangbiakan spesies yang terancam punah dan pemulihan habitat yang rusak, kami ingin menginspirasi Anda untuk membantu kami melindungi mereka serta menjaga perairan kita tetap sehat dan lestari.';
$block1Btn   = !empty($ap['textblock_btn1_id'])   ? $ap['textblock_btn1_id']   : 'Lihat Cerita Konservasi kami selengkapnya';
$block2Title = !empty($ap['textblock_title2_id']) ? $ap['textblock_title2_id'] : 'Komunitas';
$block2Desc  = !empty($ap['textblock_desc2_id'])  ? $ap['textblock_desc2_id']  : 'Komunitas adalah jantung dari BXSea! Kami berupaya menghubungkan keluarga dan orang-orang dari segala usia dengan keajaiban kehidupan laut. Dengan menyatukan komunitas untuk menyayangi laut dan penghuninya, kami ingin menyediakan wadah edukasi demi menciptakan perubahan positif bagi generasi mendatang.';
$block2Btn   = !empty($ap['textblock_btn2_id'])   ? $ap['textblock_btn2_id']   : 'Lihat Program Kunjungan Sekolah kami selengkapnya';
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $aboutHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title">TENTANG KAMI</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="custom-about">
  <img class="gurita-about" src="<?= $aboutOctopusAsset; ?>" alt="">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-lg-8 mx-auto">
        <h2 class="about-title"><?= esc($aboutIntroTitle);?></h2>
        <div class="about-desc"><?= $aboutIntroHtml; ?></div>
      </div>
    </div>

    <div class="title-about-circle">
      <p><?= esc($subcircleDesc); ?></p>
    </div>
    <div class="row justify-content-center text-center mb-5 py-5 about-bubble">
      <div class="col-sm-6 col-md-4 circle-box1"><div class="circle1"><?= !empty($bubbles[1]) ? $bubbles[1] : $bubbleDefaults[1]; ?></div></div>
      <div class="col-sm-6 col-md-4 circle-box2"><div class="circle2"><?= !empty($bubbles[2]) ? $bubbles[2] : $bubbleDefaults[2]; ?></div></div>
      <div class="col-sm-6 col-md-4 circle-box3"><div class="circle3"><?= !empty($bubbles[3]) ? $bubbles[3] : $bubbleDefaults[3]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box4"><div class="circle4"><?= !empty($bubbles[4]) ? $bubbles[4] : $bubbleDefaults[4]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box5"><div class="circle5"><?= !empty($bubbles[5]) ? $bubbles[5] : $bubbleDefaults[5]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box6"><div class="circle6"><?= !empty($bubbles[6]) ? $bubbles[6] : $bubbleDefaults[6]; ?></div></div>
      <div class="col-sm-6 col-md-3 circle-box7"><div class="circle7"><?= !empty($bubbles[7]) ? $bubbles[7] : $bubbleDefaults[7]; ?></div></div>
    </div>

    <div class="row g-3 my-5 py-5 about-gallery">
      <div class="col-md-4"><img src="<?= $aboutGallery1; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery2; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery3; ?>" class="img-fluid gallery-img"></div>
    </div>

    <div class="row align-items-start g-4 my-5 py-5 about-text-block">
      <div class="col-lg-5">
        <div class="about-card d-flex flex-column align-items-center">
          <img class="img-fluid" src="<?= esc($aboutMainImage); ?>">
          <p><?= bxsea_render_html($leftDesc, '<p><br><strong><em><ul><ol><li><h4><h5><h6><span><div>');?></p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="about-text-block">
          <h4><?= esc($block1Title); ?></h4>
          <p><?= bxsea_render_html($block1Desc, '<p><br><strong><em><ul><ol><li><h4><h5><h6><span><div>');?></p>
          <div class="about-button">
            <a href="<?= base_url('/id/berita/terbaru');?>"><?= esc($block1Btn); ?> <span class="arrow-right-about-button">></span></a>
          </div>
          <h4><?= esc($block2Title); ?></h4>
          <p><?= esc(bxsea_plain_text($block2Desc)); ?></p>
          <div class="about-button">
            <a href="<?= base_url('/id/tiket/program-kunjungan-sekolah');?>"><?= esc($block2Btn); ?> <span class="arrow-right-about-button">></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>
