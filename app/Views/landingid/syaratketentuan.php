<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/banner-denah-BXSea.png" alt="">
    </div>
    <div class="title-merchandise descBanner2">
      <h1>Syarat dan Ketentuan</h1>
    </div>
  </div>
</section>

<section class="SK">
  <div class="container">
    <div class="maxwidth">
      <?php if (!empty($legal[0]['masterlegal_desc'])): ?>
        <?= bxsea_render_html($legal[0]['masterlegal_desc']) ?>
      <?php else: ?>
        <p>Persyaratan Masuk BXSea sangat memprioritaskan keselamatan tamu dan hewan, dan berkomitmen untuk memastikan bahwa standar tinggi dipatuhi oleh semua pengunjung. Diharapkan kerjasama Anda untuk menjaga Wahana dan fasilitasnya tetap aman sebagai tempat untuk menikmati pengalaman yang menyenangkan dan menarik.</p>
        <div class="titleSK">
          <h5>Umum :</h5>
          <ul><li>Untuk alasan kesehatan dan keselamatan, hanya kursi roda, kereta dorong, dan skuter mobilitas yang diizinkan dalam Wahana.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Tiket/Masuk :</h5>
          <ul><li>WAHANA ADALAH MILIK SWASTA. Semua pengunjung harus membayar masuk atau memiliki tiket yang valid. Anak di bawah 2 tahun dan lansia di atas 70 tahun boleh masuk tanpa biaya. Tiket tidak dapat dipindahkan, tidak untuk dijual kembali. Tiket hanya berlaku pada tanggal tercetak.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Perilaku Anda :</h5>
          <ul><li>Suara atau perilaku yang mengganggu tamu atau hewan tidak diizinkan. Merokok (termasuk e-sigaret) hanya di area merokok.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Keamanan :</h5>
          <ul><li>Dilarang membawa senjata, kembang api, atau barang berbahaya. Minuman beralkohol hanya diizinkan di tempat yang diizinkan. Substansi ilegal dilarang.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Hewan Peliharaan :</h5>
          <ul><li>Hewan peliharaan tidak diizinkan kecuali anjing penuntun, anjing pendengar, dan anjing bantu terdaftar.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Fotografi :</h5>
          <ul><li>Anda diizinkan mengambil foto dan rekaman di Wahana untuk penggunaan pribadi, tidak untuk tujuan komersial.</li></ul>
        </div>
        <div class="titleSK">
          <h5>Tanggung jawab kami :</h5>
          <p>BXSea tidak bertanggung jawab atas kerugian akibat kejadian di luar kendali kami.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
