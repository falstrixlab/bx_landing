<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="overlay-blue-bg-banner"></div>
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
    </div>
    <div class="title-merchandise descBanner2">
      <h1>Privasi</h1>
    </div>
  </div>
</section>

<section class="SK">
  <div class="container">
    <div class="maxwidth">
      <?php if (!empty($legal[0]['masterlegal_content'])): ?>
        <?= bxsea_render_html($legal[0]['masterlegal_content']) ?>
      <?php else: ?>
        <h4>BXSea Privacy Policy</h4>
        <h5>Terakhir diperbarui pada [11/12/2023]</h5>
        <p>Selamat datang di BXSea. Privacy Policy ini menjelaskan bagaimana informasi pribadi Anda dikumpulkan, digunakan, dan diungkapkan oleh BXSea. Dengan mengakses atau menggunakan situs web kami di https://www.bxsea.co.id, Anda setuju dengan praktik privasi yang dijelaskan dalam Kebijakan Privasi ini.</p>
        <br>
        <div class="titleSK">
          <h5>Informasi yang Kami Kumpulkan</h5>
          <h6>Informasi Pribadi</h6>
          <p>Ketika Anda menggunakan BXSea, kami dapat mengumpulkan informasi pribadi yang dapat digunakan untuk mengidentifikasi Anda, mencakup namun tidak terbatas pada: Nama, Alamat Email, Alamat IP, Nomor telepon, dan Informasi identifikasi lainnya.</p>
        </div>
        <div class="titleSK">
          <h5>Informasi Transaksi</h5>
          <p>Kami dapat mengumpulkan informasi terkait transaksi, termasuk detail pembayaran, dan informasi lain yang berkaitan dengan pembelian atau penggunaan layanan kami.</p>
        </div>
        <div class="titleSK">
          <h5>Penggunaan Informasi</h5>
          <p>Kami dapat menggunakan informasi yang kami kumpulkan untuk menyediakan dan memelihara layanan kami, memproses transaksi, mengelola akun pengguna, dan meningkatkan pengalaman pengguna.</p>
        </div>
        <div class="titleSK">
          <h5>Keamanan Informasi</h5>
          <p>Kami mengambil langkah-langkah keamanan yang wajar untuk melindungi informasi pribadi Anda dari akses yang tidak sah.</p>
        </div>
        <div class="titleSK">
          <h5>Hubungi Kami</h5>
          <p>Jika Anda memiliki pertanyaan atau perlu informasi lebih lanjut tentang Kebijakan Privasi kami, jangan ragu untuk menghubungi kami di <?= esc($setup[0]['setup_email'] ?? 'info.bxsea@jayarealproperty.com');?>.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
