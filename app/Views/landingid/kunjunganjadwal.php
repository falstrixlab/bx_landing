<?= $this->extend('landingid/landingbase') ?>
<?= $this->section('content') ?>

<?php
$scheduleEvents = [];
foreach (($schedule ?? []) as $item) {
  if (empty($item['schedule_date'])) {
    continue;
  }

  $formattedDate = date('m/d/Y', strtotime((string) $item['schedule_date']));
  $badge = trim((string) ($item['schedule_time'] ?? ''));

  $scheduleEvents[] = [
    'name' => $item['schedule_name'] ?? 'BXSea Show',
    'description' => bxsea_plain_text($item['schedule_desc'] ?? 'BXSea Oceanarium Bintaro Xchange'),
    'date' => $formattedDate,
    'type' => 'event',
    'badge' => $badge !== '' ? '<i class="fa-regular fa-clock"></i> ' . esc($badge) : '',
  ];
}

$initialMonth = (int) date('n') - 1;
$initialYear = (int) date('Y');
?>

<section class="sectionBanner">
  <div class="hero-wrap2">
    <div class="hero-image2">
      <img src="<?= base_url('assets/landing/');?>image/bxsea_image_bg-visitor.png" alt="">
    </div>
    <div class="container">
      <div class="row descBanner2">
        <div class="col-lg-12 box-premium">
          <div class="desc-premium">
            <h1 class="banner-title"><?= esc(bxsea_plain_text($scheduleheader[0]['masterdesc_title'] ?? 'JADWAL PERTUNJUKAN'));?></h1>
            <p><?= esc(bxsea_plain_text($scheduleheader[0]['masterdesc_desc'] ?? 'Jika Anda mencari jadwal pertunjukan spektakuler kami, Anda berada di tempat yang tepat! Rencanakan kunjungan Anda ke BXSea di sini.'));?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="schedule">
  <div class="container">
    <div class="bg-schedule">
      <div class="row">
        <div class="col-md-1 col-sm-2 mb-500">
          <div class="image-date-">
            <img src="<?= base_url('assets/landing/');?>image/Vector.png" alt="">
          </div>
        </div>
        <div class="col-md-5 col-sm-5 box-month mb-500">
          <select class="form-control" name="month" id="month">
            <option value="0">Januari</option>
            <option value="1">Februari</option>
            <option value="2">Maret</option>
            <option value="3">April</option>
            <option value="4">Mei</option>
            <option value="5">Juni</option>
            <option value="6">Juli</option>
            <option value="7">Agustus</option>
            <option value="8">September</option>
            <option value="9">Oktober</option>
            <option value="10">November</option>
            <option value="11">Desember</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-5 box-year mb-500">
          <select class="form-control" name="year" id="year">
            <option value="<?= date('Y');?>"><?= date('Y');?></option>
            <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
            <option value="<?= date('Y')-2;?>"><?= date('Y')-2;?></option>
          </select>
        </div>
        <div class="col-md-2 col-sm-12">
          <input class="search-date" type="submit" name="Search" value="Search" id="search">
        </div>
      </div>
    </div>
    <div id="calendar"></div>
    <div class="btn-schedule">
      <a href="https://ticket.bxsea.co.id/" target="_blank" rel="noopener noreferrer">Dapatkan Tiket BXSea Sekarang!</a>
    </div>
    <div class="note-schedule"><?= bxsea_render_html($ticketdescschedule[0]['masterdesc_desc'] ?? 'Kini tersedia pengalaman seru memberi makan Penguin Humboldt kami yang menggemaskan melalui Penguin Feeding Fun!');?></div>
    <div class="btn-schedule-more">
      <a href="<?= base_url('/id/tiket/pengalaman-premium');?>">Cari tahu lebih lanjut <img class="arrow-right-btn-schedule-more" src="<?= base_url('assets/landing/');?>image/arrow-right-blue.png" alt=""></a>
    </div>
  </div>
</section>

<script>
window.bxseaScheduleEvents = <?= json_encode($scheduleEvents, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
window.bxseaScheduleInitialMonth = <?= $initialMonth; ?>;
window.bxseaScheduleInitialYear = <?= $initialYear; ?>;
</script>

<?= $this->endSection() ?>
