<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$cleanArticleHtml = static function (?string $value): string {
  $html = bxsea_render_html($value ?? '');
  $html = str_replace('????', '', $html);
  return trim($html);
};
?>

<?php if (!empty($article)): $art = $article[0]; ?>
<section class="detail-news-page">
  <div class="container">
    <div class="detail-news-back mb-3">
      <a href="<?= base_url('/id/berita');?>" class="btn-back-news"><i class="fa-solid fa-arrow-left"></i> Kembali ke Berita</a>
    </div>
    <article class="detail-news-article">
      <img class="detail-news-cover" src="<?= base_url('assets/upload/article/'.(isset($art['article_pict']) ? $art['article_pict'] : ''));?>" alt="<?= esc($art['article_title'] ?? '');?>">
      <h1 class="detail-news-title"><?= esc($art['article_title'] ?? '');?></h1>
      <div class="detail-news-meta">
        <span><?= esc($art['article_created_date'] ?? '');?></span>
        <?php if (!empty($art['article_author'])): ?>
        <span> - <?= esc($art['article_author']);?></span>
        <?php endif; ?>
      </div>
      <div class="detail-news-content">
        <?= $cleanArticleHtml($art['article_desc'] ?? '');?>
      </div>
    </article>
  </div>
</section>
<?php else: ?>
<section class="detail-news-page">
  <div class="container py-5 text-center">
    <h2>Artikel tidak ditemukan.</h2>
    <a href="<?= base_url('/id/berita');?>" class="btn btn-primary mt-3">Kembali ke Berita</a>
  </div>
</section>
<?php endif; ?>

<?= $this->endSection() ?>
