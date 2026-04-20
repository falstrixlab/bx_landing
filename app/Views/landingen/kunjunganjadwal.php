<?= $this->extend('landingen/landingbase'); ?>
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
        'name' => $item['schedule_name_en'] ?? ($item['schedule_name'] ?? 'BXSea Show'),
        'description' => bxsea_plain_text($item['schedule_desc_en'] ?? ($item['schedule_desc'] ?? 'BXSea Oceanarium Bintaro Xchange')),
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
            <h1 class="banner-title"><?= esc(bxsea_plain_text($scheduleheader[0]['masterdesc_title_en'] ?? 'SHOW SCHEDULE'));?></h1>
            <p><?= esc(bxsea_plain_text($scheduleheader[0]['masterdesc_desc_en'] ?? 'If you are looking for our spectacular show schedule, you are in the right place! Plan your visit to BXSea here.'));?></p>
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
            <option value="0">January</option>
            <option value="1">February</option>
            <option value="2">March</option>
            <option value="3">April</option>
            <option value="4">May</option>
            <option value="5">June</option>
            <option value="6">July</option>
            <option value="7">August</option>
            <option value="8">September</option>
            <option value="9">October</option>
            <option value="10">November</option>
            <option value="11">December</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-5 box-year mb-500">
          <select class="form-control" name="year" id="year">
            <?php for ($year = (int) date('Y') + 1; $year >= (int) date('Y') - 5; $year--): ?>
            <option value="<?= $year; ?>"><?= $year; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-2 col-sm-12">
          <input class="search-date" type="submit" name="Search" value="Search" id="search">
        </div>
      </div>
    </div>
    <div id="calendar"></div>
    <div class="btn-schedule">
      <a href="https://ticket.bxsea.co.id/" target="_blank" rel="noopener noreferrer">Get Your BXSea Tickets Now!</a>
    </div>
    <div class="note-schedule"><?= bxsea_render_html($ticketdescschedule[0]['masterdesc_desc_en'] ?? 'Penguin Feeding Fun is now available as one of BXSea\'s most exciting extra experiences!');?></div>
    <div class="btn-schedule-more">
      <a href="<?= base_url('/en/tiket/pengalaman-premium');?>">Find out more <img class="arrow-right-btn-schedule-more" src="<?= base_url('assets/landing/');?>image/arrow-right-blue.png" alt=""></a>
    </div>
  </div>
</section>

<script>
window.bxseaScheduleEvents = <?= json_encode($scheduleEvents, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
window.bxseaScheduleInitialMonth = <?= $initialMonth; ?>;
window.bxseaScheduleInitialYear = <?= $initialYear; ?>;
</script>

<?= $this->endSection() ?>