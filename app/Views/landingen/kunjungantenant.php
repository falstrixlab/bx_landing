<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>

<?php
$tenantHeroAsset    = bxsea_design_asset('tenant', 'hero',     'assets/landing/image/bxsea_image_bg-tenant.png');
$contactCustomerAsset = bxsea_design_asset('visit', 'contact_card_customer', 'assets/landing/image/sosmed.png');
$contactWhatsappAsset = bxsea_design_asset('visit', 'contact_card_whatsapp', 'assets/landing/image/sosmed2.png');
$contactEmailAsset    = bxsea_design_asset('visit', 'contact_card_email',    'assets/landing/image/sosmed3.png');

$normalizeTenantTextEn = static function (?string $value, ?string $fallbackValue = null, ?string $title = null, int $limit = 0): string {
  $text = bxsea_plain_text($value ?: $fallbackValue);
  $text = str_ireplace('souvernir', 'souvenir', $text);
  $text = str_ireplace('awesome merchandise souvenir', 'official merchandise collection', $text);
  if ($title && stripos($title, 'BXSea Merchandise Store') !== false) {
    $text = 'Bring your BXSea adventure home with our official merchandise collection and discover memorable keepsakes for every visit.';
  }
  if ($limit > 0 && function_exists('mb_substr')) {
    $text = mb_substr($text, 0, $limit);
  } elseif ($limit > 0) {
    $text = substr($text, 0, $limit);
  }
  return trim($text);
};
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= $tenantHeroAsset; ?>" alt="">
    </div>
    <div class="container">
      <div class="row descBanner">
        <div class="col-lg-12 box-schoolpackage">
          <div class="desc-schoolpackage">
            <h1>OUR TENANTS</h1>
            <p>Enjoy a variety of culinary options and exclusive services at BXSea.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="tenant">
  <div class="container">
    <div class="row">
      <?php foreach ($tenant as $idx => $te): ?>
      <div class="col-lg-4 col-md-6 mb-200 box-card-tenant">
          <div class="hand">
            <img class="hand-image" src="<?= bxsea_asset_url('tenant', $te['tenant_thumbnail_pict'] ?? '', 'assets/landing/image/image-card-tenant5.png');?>" alt="<?= esc($te['tenant_title'] ?? '');?>">
            <div class="overlay-barcode">
              <img src="<?= bxsea_asset_url('tenant', $te['tenant_main_pict'] ?? '', 'assets/landing/image/bxsea_image_tenant_wingstop_back.png');?>" alt="<?= esc($te['tenant_title'] ?? '');?>">
              <div class="box-overlay-barcode">
                <h2><?= esc($te['tenant_title'] ?? '');?></h2>
                <p><?= esc($normalizeTenantTextEn($te['tenant_desc_en'] ?? '', $te['tenant_desc'] ?? '', $te['tenant_title'] ?? '', 120));?></p>
                <button class="btn-detail-tenant" onclick="openTenantPopup('tenant-<?= (int)$te['tenant_id'];?>')">
                  View Details
                </button>
              </div>
            </div>
          </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Tenant Popup Overlay -->
<div class="tenant-popup-overlay" id="tenantPopupOverlay" onclick="closeTenantPopup()"></div>

<?php foreach ($tenant as $te): ?>
<div class="fodegraf-popup" id="tenant-<?= (int)$te['tenant_id'];?>" style="display:none;">
  <button class="close-popup-btn" onclick="closeTenantPopup()"><i class="fa-solid fa-xmark"></i></button>
  <div class="row align-items-center">
    <div class="col-lg-6">
      <img class="img-fluid" src="<?= bxsea_asset_url('tenant', $te['tenant_main_pict'] ?? '', 'assets/landing/image/bxsea_image_tenant_wingstop_back.png');?>" alt="<?= esc($te['tenant_title'] ?? '');?>">
    </div>
    <div class="col-lg-6">
      <h2><?= esc($te['tenant_title'] ?? '');?></h2>
      <p><?= nl2br(esc($normalizeTenantTextEn($te['tenant_desc_en'] ?? '', $te['tenant_desc'] ?? '', $te['tenant_title'] ?? '')));?></p>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script>
function openTenantPopup(id) {
  document.querySelectorAll('.fodegraf-popup').forEach(function(el){ el.style.display = 'none'; });
  var popup = document.getElementById(id);
  if (popup) {
    popup.style.display = 'block';
    document.getElementById('tenantPopupOverlay').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }
}
function closeTenantPopup() {
  document.querySelectorAll('.fodegraf-popup').forEach(function(el){ el.style.display = 'none'; });
  document.getElementById('tenantPopupOverlay').style.display = 'none';
  document.body.style.overflow = '';
}
</script>

<?= $this->endSection() ?>