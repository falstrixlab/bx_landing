<?= $this->extend('landingen/landingbase'); ?>
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
        <h1 class="banner-title">What is Going on at BXSea</h1>
      </div>
    </div>
  </div>
</section>

<?php if($featuredArticle): ?>
<section class="latest-news-section" id="News">
  <div class="container latest-news-section-box">
    <h2 class="latest-news-title">Latest News</h2>
    <a class="latest-news-feature" href="<?= base_url('en/berita/detail/'.$featuredArticle['article_id']);?>">
      <div class="latest-news-feature-image">
        <img src="<?= base_url('assets/upload/article/'.$featuredArticle['article_pict']);?>" alt="<?= esc(bxsea_plain_text($featuredArticle['article_title_en'] ?? $featuredArticle['article_title'] ?? ''));?>">
      </div>
      <div class="latest-news-feature-content">
        <h3><?= esc(bxsea_plain_text($featuredArticle['article_title_en'] ?? $featuredArticle['article_title'] ?? ''));?></h3>
        <p><?= esc(substr(bxsea_plain_text($featuredArticle['article_desc_en'] ?? $featuredArticle['article_desc'] ?? ''), 0, 200));?>...</p>
        <span><?= esc($featuredArticle['article_created_date']);?></span>
      </div>
    </a>
  </div>
</section>
<?php endif; ?>

<section class="whats-hub-section">
  <div class="container">
    <div class="whats-hub-tabs" role="tablist">
      <button class="whats-hub-tab is-active" type="button" data-tab="news">News</button>
      <button class="whats-hub-tab" type="button" data-tab="conservation">Conservation Stories</button>
      <button class="whats-hub-tab" type="button" data-tab="awards">Awards &amp; Certifications</button>
    </div>

    <div class="whats-hub-panel is-active" data-panel="news">
      <div class="whats-hub-toolbar">
        <button type="button">Filter <i class="fa-solid fa-sliders"></i></button>
        <button type="button">Search <i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
      <div class="whats-grid-small">
        <?php foreach($articlenews ?? $articleall ?? [] AS $art): ?>
        <a class="whats-card-small" href="<?= base_url('en/berita/detail/'.$art['article_id']);?>">
          <img src="<?= base_url('assets/upload/article/'.$art['article_pict']);?>" alt="<?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?>">
          <span><?= esc($art['article_created_date']);?></span>
          <h4><?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?></h4>
        </a>
        <?php endforeach; ?>
      </div>
      <div class="whats-hub-button-wrap">
        <a href="<?= base_url('/en/berita');?>">View More +</a>
      </div>
    </div>

    <div class="whats-hub-panel" data-panel="conservation">
      <div class="whats-conservation-intro">
        <p>BXSea is committed to the protection and conservation of animal wildlife and strives to deliver <strong>conservation-based educational experiences</strong> to all.</p>
      </div>
      <div class="whats-grid-large">
        <?php foreach (array_slice($articleall ?? [], 0, 6) as $art): ?>
        <a class="whats-card-large" href="<?= base_url('en/berita/detail/'.$art['article_id']);?>">
          <img src="<?= base_url('assets/upload/article/'.(isset($art['article_pict']) ? $art['article_pict'] : ''));?>" alt="<?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?>">
          <div class="whats-card-large-overlay">
            <h4><?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?></h4>
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
        <a class="whats-card-large" href="<?= base_url('en/berita/detail/'.$art['article_id']);?>">
          <img src="<?= base_url('assets/upload/article/'.(isset($art['article_pict']) ? $art['article_pict'] : ''));?>" alt="<?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?>">
          <div class="whats-card-large-overlay">
            <h4><?= esc(bxsea_plain_text($art['article_title_en'] ?? $art['article_title'] ?? ''));?></h4>
            <span><?= esc($art['article_created_date'] ?? '');?></span>
          </div>
        </a>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center py-5">No award data yet.</p>
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
</script>

<?= $this->endSection(); ?>
