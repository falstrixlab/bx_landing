<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<?php
$cleanArticleHtmlEn = static function (?string $value, ?string $fallback = null): string {
    $html = bxsea_render_html($value ?: $fallback ?: '');
    $html = str_replace('????', '', $html);
    return trim($html);
};
?>

<?php if (!empty($article)): $art = $article[0]; ?>
<section class="detail-news-page">
    <div class="container">
        <div class="detail-news-back mb-3">
            <a href="<?= base_url('/en/berita');?>" class="btn-back-news"><i class="fa-solid fa-arrow-left"></i> Back to News</a>
        </div>
        <article class="detail-news-article">
            <img class="detail-news-cover" src="<?= bxsea_asset_url('article', $art['article_pict'] ?? '', 'assets/landing/image/bxsea_image-top-section_news.png');?>" alt="<?= esc($art['article_title_en'] ?? ($art['article_title'] ?? ''));?>">
            <h1 class="detail-news-title"><?= esc($art['article_title_en'] ?? ($art['article_title'] ?? ''));?></h1>
            <div class="detail-news-meta">
                <span><?= esc($art['article_created_date'] ?? '');?></span>
                <?php if (!empty($art['article_author'])): ?>
                <span> - <?= esc($art['article_author']);?></span>
                <?php endif; ?>
            </div>
            <div class="detail-news-content">
                <?= $cleanArticleHtmlEn($art['article_desc_en'] ?? '', $art['article_desc'] ?? '');?>
            </div>
        </article>
    </div>
</section>
<?php else: ?>
<section class="detail-news-page">
    <div class="container py-5 text-center">
        <h2>Article not found.</h2>
        <a href="<?= base_url('/en/berita');?>" class="btn btn-primary mt-3">Back to News</a>
    </div>
</section>
<?php endif; ?>
<?= $this->endSection() ?>