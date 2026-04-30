<?php
/**
 * Slider Puzzle Captcha Widget
 * Required variables:
 *   $captcha_token  (string) – session token
 *   $captcha_gap_y  (int)    – vertical position of the gap in the image
 *   $captcha_lang   (string) – 'id' or 'en'
 */
$lang    = $captcha_lang ?? 'id';
$hint    = $lang === 'en' ? 'Slide to verify' : 'Geser untuk verifikasi';
$newTip  = $lang === 'en' ? 'New challenge'   : 'Ganti gambar';
$gapY    = (int)($captcha_gap_y ?? 50);
$token   = esc($captcha_token ?? '');
$bgUrl   = base_url('captcha/slide-bg/'    . $token);
$pcUrl   = base_url('captcha/slide-piece/' . $token);
$refUrl  = base_url('captcha/slide-refresh');
$bgBase  = base_url('captcha/slide-bg/');
$pcBase  = base_url('captcha/slide-piece/');
?>
<div class="sc-wrap" id="scWrap-<?= $token ?>">

  <!-- ── Image area ─────────────────────────────────────── -->
  <div class="sc-img-area">
    <button type="button" class="sc-refresh-btn"
            title="<?= $newTip ?>"
            data-token="<?= $token ?>"
            data-bg-base="<?= $bgBase ?>"
            data-pc-base="<?= $pcBase ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
           stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
           width="16" height="16">
        <polyline points="1 4 1 10 7 10"></polyline>
        <path d="M3.51 15a9 9 0 1 0 .49-3.5"></path>
      </svg>
    </button>

    <div class="sc-canvas" style="position:relative;width:310px;height:155px;overflow:hidden;user-select:none;">
      <!-- Background with hole -->
      <img id="scBg-<?= $token ?>"  class="sc-bg-img"
           src="<?= $bgUrl ?>"  width="310" height="155" draggable="false"
           style="position:absolute;top:0;left:0;display:block;">
      <!-- Puzzle piece -->
      <img id="scPc-<?= $token ?>" class="sc-piece-img"
           src="<?= $pcUrl ?>" width="65"  height="55"  draggable="false"
           style="position:absolute;left:0;top:<?= $gapY ?>px;z-index:2;">
    </div>
  </div>

  <!-- ── Slider ──────────────────────────────────────────── -->
  <div class="sc-slider-area">
    <div class="sc-track" id="scTrack-<?= $token ?>">
      <div class="sc-fill"  id="scFill-<?= $token ?>"></div>
      <span class="sc-hint" id="scHint-<?= $token ?>"><?= $hint ?></span>
      <div class="sc-btn"   id="scBtn-<?= $token ?>">
        <!-- grip icon -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2.5" stroke-linecap="round"
             width="20" height="20">
          <line x1="8"  y1="5" x2="8"  y2="19"/>
          <line x1="12" y1="5" x2="12" y2="19"/>
          <line x1="16" y1="5" x2="16" y2="19"/>
        </svg>
      </div>
    </div>
  </div>

  <!-- ── Hidden inputs ──────────────────────────────────── -->
  <input type="hidden" name="captcha_token" id="scToken-<?= $token ?>" value="<?= $token ?>">
  <input type="hidden" name="captcha_pos"   id="scPos-<?= $token ?>"   value="0">
</div>

<style>
.sc-wrap           { width:310px; background:#1a2035; border-radius:8px; overflow:hidden; }
.sc-img-area       { position:relative; width:310px; }
.sc-bg-img,
.sc-piece-img      { -webkit-user-drag:none; pointer-events:none; }
.sc-refresh-btn    { position:absolute; top:8px; right:8px; z-index:10;
                     background:rgba(255,255,255,.18); border:none; border-radius:5px;
                     color:#fff; cursor:pointer; padding:5px 6px; line-height:0;
                     transition:background .2s; }
.sc-refresh-btn:hover { background:rgba(255,255,255,.35); }
.sc-slider-area    { padding:0; }
.sc-track          { position:relative; width:310px; height:44px;
                     background:#2b3755; display:flex; align-items:center;
                     justify-content:center; overflow:hidden; box-sizing:border-box; }
.sc-fill           { position:absolute; left:0; top:0; height:100%; width:0;
                     background:linear-gradient(90deg,#3b7df5,#52c2ff);
                     pointer-events:none; transition:none; }
.sc-hint           { position:absolute; color:rgba(255,255,255,.45);
                     font-size:13px; pointer-events:none; user-select:none; white-space:nowrap; }
.sc-btn            { position:absolute; left:0; top:2px; width:40px; height:40px;
                     background:#fff; border-radius:50%; display:flex;
                     align-items:center; justify-content:center;
                     cursor:grab; color:#3b7df5; z-index:2;
                     box-shadow:0 2px 8px rgba(0,0,0,.35); }
.sc-btn:active     { cursor:grabbing; }
.sc-btn.sc-ok      { background:#4caf50; color:#fff; }
.sc-btn.sc-fail    { background:#f44336; color:#fff; }
</style>

<script>
(function(){
  var id      = '<?= $token ?>';
  var track   = document.getElementById('scTrack-'  + id);
  var btn     = document.getElementById('scBtn-'    + id);
  var fill    = document.getElementById('scFill-'   + id);
  var piece   = document.getElementById('scPc-'     + id);
  var hint    = document.getElementById('scHint-'   + id);
  var posInp  = document.getElementById('scPos-'    + id);
  var tokInp  = document.getElementById('scToken-'  + id);
  var bgImg   = document.getElementById('scBg-'     + id);
  var refBtn  = document.querySelector('[data-token="' + id + '"]');

  var dragging = false, startX = 0, curLeft = 0;
  var BTN_W = btn.offsetWidth || 40;

  function maxLeft() {
    return track.offsetWidth - BTN_W;
  }

  function moveTo(left) {
    left = Math.max(0, Math.min(maxLeft(), left));
    curLeft = left;
    btn.style.left   = left + 'px';
    piece.style.left = left + 'px';
    fill.style.width = (left + BTN_W / 2) + 'px';
    posInp.value     = left;
    if (left > 10) {
      hint.style.display = 'none';
    } else {
      hint.style.display = '';
    }
  }

  /* ── Mouse ─────────────────────────────────── */
  btn.addEventListener('mousedown', function(e) {
    e.preventDefault();
    dragging = true;
    startX   = e.clientX - curLeft;
    document.body.style.userSelect = 'none';
  });
  document.addEventListener('mousemove', function(e) {
    if (!dragging) return;
    moveTo(e.clientX - startX);
  });
  document.addEventListener('mouseup', function() {
    if (!dragging) return;
    dragging = false;
    document.body.style.userSelect = '';
  });

  /* ── Touch ─────────────────────────────────── */
  btn.addEventListener('touchstart', function(e) {
    e.preventDefault();
    dragging = true;
    startX   = e.touches[0].clientX - curLeft;
  }, { passive: false });
  document.addEventListener('touchmove', function(e) {
    if (!dragging) return;
    e.preventDefault();
    moveTo(e.touches[0].clientX - startX);
  }, { passive: false });
  document.addEventListener('touchend', function() {
    dragging = false;
  });

  /* ── Refresh button ─────────────────────────── */
  if (refBtn) {
    refBtn.addEventListener('click', function() {
      var old    = tokInp.value;
      var bgBase = refBtn.dataset.bgBase;
      var pcBase = refBtn.dataset.pcBase;
      fetch('<?= $refUrl ?>?old=' + encodeURIComponent(old))
        .then(function(r) { return r.json(); })
        .then(function(d) {
          if (!d.token) return;
          var t  = d.token;
          var ts = '?' + Date.now();
          tokInp.value    = t;
          bgImg.src       = bgBase + t + ts;
          piece.src       = pcBase + t + ts;
          piece.style.top = (d.gap_y || 0) + 'px';
          /* update data-token for next refresh */
          refBtn.dataset.token = t;
          btn.classList.remove('sc-ok', 'sc-fail');
          moveTo(0);
        });
    });
  }

  moveTo(0);
})();
</script>
