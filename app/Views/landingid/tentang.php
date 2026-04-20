<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$aboutHeroAsset = bxsea_design_asset('about', 'hero', 'assets/landing/image/bxsea_image_bg-tenant.png');
$aboutOctopusAsset = bxsea_design_asset('about', 'octopus', 'assets/landing/image/gurita.png');
$aboutGallery1 = bxsea_design_asset('about', 'gallery_1', 'assets/landing/image/image-aboutus2.png');
$aboutGallery2 = bxsea_design_asset('about', 'gallery_2', 'assets/landing/image/image-aboutus.png');
$aboutGallery3 = bxsea_design_asset('about', 'gallery_3', 'assets/landing/image/image-aboutus2.png');
$aboutMainImage = bxsea_design_asset('about', 'main_image', 'assets/landing/image/bxsea_image_aboutus.png');
$aboutIntroTitle = 'Xtraordinary Xperience at Sea and Forest';
$aboutIntroHtml = '<p>BXSea adalah destinasi akuarium utama di wilayah Tangerang Selatan, hadir sebagai sarana edutainment bagi segala usia untuk mengenal kehidupan laut. Terletak di bawah Bintaro Jaya Xchange Mall 2, kami menginspirasi hubungan antara manusia dan biota. Kenali keunikan serta karakteristik menarik dari biota kami, mulai dari Belut Moray, Penguin Humboldt, hingga Gurita Pasifik Raksasa. BXSea memprioritaskan lingkungan yang menstimulasi edukasi sambil tetap menjaga pelestarian dan konservasi biota.</p>';
$aboutConservationDesc = 'BXSea berkomitmen pada perlindungan dan konservasi biota serta berupaya menghadirkan pengalaman edukasi berbasis konservasi bagi semua orang. Melalui pengembangbiakan spesies yang terancam punah dan pemulihan habitat yang rusak, kami ingin menginspirasi Anda untuk membantu kami melindungi mereka serta menjaga perairan kita tetap sehat dan lestari.';
$aboutCommunityDesc = 'Komunitas adalah jantung dari BXSea! Kami berupaya menghubungkan keluarga dan orang-orang dari segala usia dengan keajaiban kehidupan laut. Dengan menyatukan komunitas untuk menyayangi laut dan penghuninya, kami ingin menyediakan wadah edukasi demi menciptakan perubahan positif bagi generasi mendatang.';
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
        <?php if ($aboutIntroHtml !== ''): ?>
        <div class="about-desc"><?= $aboutIntroHtml; ?></div>
        <?php else: ?>
        <div class="about-desc"><p>BXSea adalah destinasi akuarium utama di wilayah Tangerang Selatan, hadir sebagai sarana edutainment bagi segala usia untuk mengenal kehidupan laut. Terletak di bawah Bintaro Jaya Xchange Mall 2, BXSea menghadirkan pengalaman yang menghubungkan manusia dengan keajaiban laut dan hutan dalam satu perjalanan yang berkesan.</p></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="title-about-circle">
      <p>BXSea adalah rumah bagi keragaman biota laut yang sangat luas!</p>
    </div>
    <div class="row justify-content-center text-center mb-5 py-5">
      <div class="col-sm-6 col-md-4 circle-box1"><div class="circle1">7,354m² <br><span>Luas Area</span></div></div>
      <div class="col-sm-6 col-md-4 circle-box2"><div class="circle2">54 <br><span>Display Akuarium</span></div></div>
      <div class="col-sm-6 col-md-4 circle-box3"><div class="circle3">~25,000<br><span>Biota</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box4"><div class="circle4">Kapasitas air 4.5 Juta <br><span>Liter</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box5"><div class="circle5">140 <br><span>Spesies</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box6"><div class="circle6">10 <br><span>Terarium</span></div></div>
      <div class="col-sm-6 col-md-3 circle-box7"><div class="circle7">44 Akuarium<br><span>Air Tawar &amp; Air Laut</span></div></div>
    </div>

    <div class="row g-3 my-5 py-5">
      <div class="col-md-4"><img src="<?= $aboutGallery1; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery2; ?>" class="img-fluid gallery-img"></div>
      <div class="col-md-4"><img src="<?= $aboutGallery3; ?>" class="img-fluid gallery-img"></div>
    </div>

    <div class="row align-items-start g-4 my-5 py-5">
      <div class="col-lg-5">
        <div class="about-card d-flex flex-column align-items-center">
          <img class="img-fluid" src="<?= $aboutMainImage; ?>">
          <p>BXSea memiliki <strong>dome dan terowongan bawah air terbesar di Asia Tenggara!</strong> Membentang sepanjang 35 meter, lebar 2,4 meter, dan tinggi 2,8 meter, kagumilah keragaman ikan, hiu, pari, dan masih banyak lagi!</p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="about-text-block">
          <h4>Konservasi</h4>
          <p><?= esc($aboutConservationDesc);?></p>
          <div class="about-button">
            <a href="<?= base_url('/id/berita/terbaru');?>">Lihat Cerita Konservasi kami selengkapnya <div class="arrow-right-about-button">></div></a>
          </div>
          <h4>Komunitas</h4>
          <p><?= esc($aboutCommunityDesc);?></p>
          <div class="about-button">
            <a href="<?= base_url('/id/tiket/program-kunjungan-sekolah');?>">Lihat Program Kunjungan Sekolah kami selengkapnya <div class="arrow-right-about-button">></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>
