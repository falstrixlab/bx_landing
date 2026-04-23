<?= $this->extend('landingid/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$newsHeroAsset = bxsea_design_asset('news', 'hero', 'assets/landing/image/bxsea_image-top-section_news.png');
$featuredArticle = $articleatop[0] ?? null;
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="container">
      <div class="hero-image2">
        <img src="<?= $newsHeroAsset; ?>" alt="">
      </div>
      <div class="title-whats-new">
        <h1 class="banner-title">Kabar Terbaru di BXSea</h1>
      </div>
    </div>
  </div>
</section>

<?php if($featuredArticle): ?>
<section class="latest-news-section" id="News">
  <div class="container latest-news-section-box">
    <h2 class="latest-news-title">Berita Terbaru</h2>
    <a class="latest-news-feature" href="<?= base_url('id/berita/detail/'.$featuredArticle['article_id']);?>">
      <div class="latest-news-feature-image">
        <img src="<?= base_url('assets/upload/article/'.$featuredArticle['article_pict']);?>" alt="<?= esc(bxsea_plain_text($featuredArticle['article_title'] ?? ''));?>">
      </div>
      <div class="latest-news-feature-content">
        <h3><?= esc(bxsea_plain_text($featuredArticle['article_title'] ?? ''));?></h3>
        <p><?= esc(substr(bxsea_plain_text($featuredArticle['article_desc'] ?? ''), 0, 200));?>...</p>
        <span><?= esc($featuredArticle['article_created_date']);?></span>
      </div>
    </a>
  </div>
</section>
<?php endif; ?>

<section class="whats-hub-section">
  <div class="container">
    <div class="whats-hub-tabs" role="tablist">
      <button class="whats-hub-tab is-active" type="button" data-tab="news">Berita</button>
      <button class="whats-hub-tab" type="button" data-tab="conservation">Cerita Konservasi</button>
      <button class="whats-hub-tab" type="button" data-tab="awards">Penghargaan &amp; Sertifikasi</button>
    </div>

    <div class="whats-hub-panel is-active" data-panel="news">
      <div class="whats-hub-toolbar">
        <div class="whats-toolbar-filter">
          <button type="button" class="whats-filter-btn is-active" data-sort="newest">Terbaru <i class="fa-solid fa-arrow-down-short-wide"></i></button>
          <button type="button" class="whats-filter-btn" data-sort="oldest">Terlama <i class="fa-solid fa-arrow-up-short-wide"></i></button>
        </div>
        <div class="whats-toolbar-search">
          <input type="text" id="berita-search-input" class="whats-search-input" placeholder="Cari berita..." autocomplete="off">
          <i class="fa-solid fa-magnifying-glass whats-search-icon"></i>
        </div>
      </div>
      <div class="whats-grid-small" id="berita-news-grid">
        <?php foreach($articlenews ?? $articleall ?? [] AS $art): ?>
        <a class="whats-card-small" href="<?= base_url('id/berita/detail/'.$art['article_id']);?>"
           data-title="<?= esc(strtolower(bxsea_plain_text($art['article_title'] ?? '')));?>"
           data-date="<?= esc($art['article_created_date']);?>">
          <img src="<?= base_url('assets/upload/article/'.$art['article_pict']);?>" alt="<?= esc(bxsea_plain_text($art['article_title'] ?? ''));?>">
          <span><?= esc($art['article_created_date']);?></span>
          <h4><?= esc(bxsea_plain_text($art['article_title'] ?? ''));?></h4>
        </a>
        <?php endforeach; ?>
      </div>
      <p id="berita-no-results" style="display:none;text-align:center;padding:2rem;color:#888;">Tidak ada berita yang ditemukan.</p>
      <div class="whats-hub-button-wrap">
        <a href="<?= base_url('/id/berita');?>">Lihat Lebih Banyak +</a>
      </div>
    </div>

    <div class="whats-hub-panel" data-panel="conservation">
      <div class="whats-conservation-intro">
        <p>BXSea berkomitmen terhadap perlindungan dan konservasi satwa liar serta berupaya menghadirkan <strong>pengalaman edukatif berbasis konservasi</strong> untuk semua kalangan.</p>
        <p>Melalui <strong>pembiakan spesies yang terancam punah</strong> dan pemulihan habitat yang rusak, kami ingin menginspirasi Anda untuk turut menjaga dunia kita dan menjaga lautan tetap sehat dan penuh kehidupan!</p>
      </div>
      <div class="whats-grid-large">
        <?php foreach (array_slice($articleall ?? [], 0, 6) as $art): ?>
        <a class="whats-card-large" href="<?= base_url('id/berita/detail/'.$art['article_id']);?>">
          <img src="<?= base_url('assets/upload/article/'.(isset($art['article_pict']) ? $art['article_pict'] : ''));?>" alt="<?= esc(bxsea_plain_text($art['article_title'] ?? ''));?>">
          <div class="whats-card-large-overlay">
            <h4><?= esc(bxsea_plain_text($art['article_title'] ?? ''));?></h4>
            <span><?= esc($art['article_created_date'] ?? '');?></span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="whats-hub-panel" data-panel="awards">
      <div class="whats-grid-large">
        <?php if (!empty($articlereward)): ?>
        <?php foreach ($articlereward as $art): ?>
        <a class="whats-card-large" href="<?= base_url('id/berita/detail/'.$art['article_id']);?>">
          <img src="<?= base_url('assets/upload/article/'.(isset($art['article_pict']) ? $art['article_pict'] : ''));?>" alt="<?= esc(bxsea_plain_text($art['article_title'] ?? ''));?>">
          <div class="whats-card-large-overlay">
            <h4><?= esc(bxsea_plain_text($art['article_title'] ?? ''));?></h4>
            <span><?= esc($art['article_created_date'] ?? '');?></span>
          </div>
        </a>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center py-5">Belum ada data penghargaan.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.whats-hub-tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.whats-hub-tab').forEach(t => t.classList.remove('is-active'));
    document.querySelectorAll('.whats-hub-panel').forEach(p => p.classList.remove('is-active'));
    tab.classList.add('is-active');
    document.querySelector('[data-panel="' + tab.dataset.tab + '"]').classList.add('is-active');
  });
});

// Berita Search & Filter
(function() {
  var currentSort = 'newest';
  var searchQuery = '';

  function applyBeritaFilter() {
    var grid = document.getElementById('berita-news-grid');
    if (!grid) return;
    var cards = Array.from(grid.querySelectorAll('.whats-card-small'));

    // Filter by search
    var filtered = cards.filter(function(card) {
      var title = card.getAttribute('data-title') || '';
      return !searchQuery || title.indexOf(searchQuery.toLowerCase()) !== -1;
    });

    // Sort
    filtered.sort(function(a, b) {
      var da = a.getAttribute('data-date') || '';
      var db = b.getAttribute('data-date') || '';
      return currentSort === 'newest' ? (db > da ? 1 : -1) : (da > db ? 1 : -1);
    });

    // Re-render: hide all, then show filtered in sorted order
    cards.forEach(function(c) { c.style.display = 'none'; });
    filtered.forEach(function(c) {
      grid.appendChild(c);
      c.style.display = '';
    });

    var noResults = document.getElementById('berita-no-results');
    if (noResults) noResults.style.display = filtered.length === 0 ? 'block' : 'none';
  }

  // Sort buttons
  document.querySelectorAll('.whats-filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.whats-filter-btn').forEach(function(b) { b.classList.remove('is-active'); });
      btn.classList.add('is-active');
      currentSort = btn.getAttribute('data-sort');
      applyBeritaFilter();
    });
  });

  // Search input
  var searchInput = document.getElementById('berita-search-input');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      searchQuery = this.value.trim();
      applyBeritaFilter();
    });
  }
})();
</script>

<?= $this->endSection(); ?>
