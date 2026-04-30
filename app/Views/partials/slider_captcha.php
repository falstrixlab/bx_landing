<?php
/**
 * Slider Puzzle Captcha Widget (CSS-based, no GD / image extension required)
 * Required variables:
 *   $captcha_token   (string) – session token
 *   $captcha_gap_x   (int)    – horizontal target position of the gap
 *   $captcha_gap_y   (int)    – vertical position of the gap
 *   $captcha_img_url (string) – public URL to the background image
 *   $captcha_lang    (string) – 'id' or 'en'
 */
$lang    = $captcha_lang    ?? 'id';
$hint    = $lang === 'en' ? 'Slide to verify'  : 'Geser untuk verifikasi';
$newTip  = $lang === 'en' ? 'New challenge'    : 'Ganti gambar';
$gapY    = (int)($captcha_gap_y    ?? 50);
$gapX    = (int)($captcha_gap_x    ?? 100);
$token   = esc($captcha_token      ?? '');
$imgUrl  = esc($captcha_img_url    ?? '');
$refUrl  = base_url('captcha/slide-refresh');
?>
<div class="sc-wrap" id="scWrap-<?= $token ?>">

  <!-- Image area -->
  <div class="sc-img-area">
    <button type="button" class="sc-refresh-btn"
            title="<?= $newTip ?>"
            data-token="<?= $token ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
           stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
           width="16" height="16">
        <polyline points="1 4 1 10 7 10"></polyline>
        <path d="M3.51 15a9 9 0 1 0 .49-3.5"></path>
      </svg>
    </button>

    <div class="sc-canvas">
      <img id="scBgImg-<?= $token ?>" class="sc-bg-img"
           src="<?= $imgUrl ?>" draggable="false">
      <div id="scHole-<?= $token ?>" class="sc-hole"
           style="left:<?= $gapX ?>px;top:<?= $gapY ?>px;"></div>
      <div id="scPc-<?= $token ?>" class="sc-piece"
           style="background-image:url('<?= $imgUrl ?>');background-position:-<?= $gapX ?>px -<?= $gapY ?>px;top:<?= $gapY ?>px;left:0;"></div>
    </div>
  </div>

  <!-- Slider -->
  <div class="sc-slider-area">
    <div class="sc-track" id="scTrack-<?= $token ?>">
      <div class="sc-fill"  id="scFill-<?= $token ?>"></div>
      <span class="sc-hint" id="scHint-<?= $token ?>"><?= $hint ?></span>
      <div class="sc-btn"   id="scBtn-<?= $token ?>">
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

  <!-- Hidden inputs -->
  <input type="hidden" name="captcha_token" id="scToken-<?= $token ?>" value="<?= $token ?>">
  <input type="hidden" name="captcha_pos"   id="scPos-<?= $token ?>"   value="0">
</div>

<style>
.sc-wrap        { width:310px; background:#1a2035; border-radius:8px; overflow:hidden; }
.sc-img-area    { position:relative; width:310px; }
.sc-canvas      { position:relative; width:310px; height:155px; overflow:hidden;
                  user-select:none; border-radius:4px 4px 0 0; }
.sc-bg-img      { position:absolute; top:0; left:0; width:310px; height:155px;
                  object-fit:cover; display:block;
                  -webkit-user-drag:none; pointer-events:none; }
.sc-hole        { position:absolute; width:55px; height:55px; z-index:1;
                  background:rgba(0,0,0,.72);
                  border:1.5px solid rgba(255,255,255,.45);
                  border-radius:3px; pointer-events:none; }
.sc-piece       { position:absolute; width:65px; height:55px; z-index:2;
                  background-size:310px 155px; background-repeat:no-repeat;
                  border:1.5px solid rgba(255,255,255,.6); border-radius:3px;
                  box-shadow:0 2px 10px rgba(0,0,0,.55); pointer-events:none; }
.sc-refresh-btn { position:absolute; top:8px; right:8px; z-index:10;
                  background:rgba(255,255,255,.18); border:none; border-radius:5px;
                  color:#fff; cursor:pointer; padding:5px 6px; line-height:0;
                  transition:background .2s; }
.sc-refresh-btn:hover { background:rgba(255,255,255,.35); }
.sc-slider-area { padding:0; }
.sc-track       { position:relative; width:310px; height:44px;
                  background:#2b3755; display:flex; align-items:center;
                  justify-content:center; overflow:hidden; box-sizing:border-box; }
.sc-fill        { position:absolute; left:0; top:0; height:100%; width:0;
                  background:linear-gradient(90deg,#3b7df5,#52c2ff);
                  pointer-events:none; }
.sc-hint        { position:absolute; color:rgba(255,255,255,.45);
                  font-size:13px; pointer-events:none; user-select:none; white-space:nowrap; }
.sc-btn         { position:absolute; left:0; top:2px; width:40px; height:40px;
                  background:#fff; border-radius:50%; display:flex;
                  align-items:center; justify-content:center;
                  cursor:grab; color:#3b7df5; z-index:2;
                  box-shadow:0 2px 8px rgba(0,0,0,.35); }
.sc-btn:active  { cursor:grabbing; }
.sc-btn.sc-ok   { background:#4caf50; color:#fff; }
.sc-btn.sc-fail { background:#f44336; color:#fff; }
</style>

<script>
(function(){
  var id     = '<?= $token ?>';
  var track  = document.getElementById('scTrack-'  + id);
  var btn    = document.getElementById('scBtn-'    + id);
  var fill   = document.getElementById('scFill-'   + id);
  var piece  = document.getElementById('scPc-'     + id);
  var hole   = document.getElementById('scHole-'   + id);
  var hint   = document.getElementById('scHint-'   + id);
  var posInp = document.getElementById('scPos-'    + id);
  var tokInp = document.getElementById('scToken-'  + id);
  var bgImg  = document.getElementById('scBgImg-'  + id);
  var refBtn = document.querySelector('#scWrap-' + id + ' .sc-refresh-btn');

  var dragging = false, startX = 0, curLeft = 0;
  var BTN_W = btn.offsetWidth || 40;

  function maxLeft() { return track.offsetWidth - BTN_W; }

  function moveTo(left) {
    left = Math.max(0, Math.min(maxLeft(), left));
    curLeft          = left;
    btn.style.left   = left + 'px';
    piece.style.left = left + 'px';
    fill.style.width = (left + BTN_W / 2) + 'px';
    posInp.value     = left;
    hint.style.display = left > 10 ? 'none' : '';
  }

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
  document.addEventListener('touchend', function() { dragging = false; });

  if (refBtn) {
    refBtn.addEventListener('click', function() {
      var old = tokInp.value;
      fetch('<?= $refUrl ?>?old=' + encodeURIComponent(old))
        .then(function(r) { return r.json(); })
        .then(function(d) {
          if (!d.token) return;
          var ts = '?' + Date.now();
          tokInp.value                   = d.token;
          bgImg.src                      = d.img_url + ts;
          piece.style.backgroundImage    = 'url(' + d.img_url + ts + ')';
          piece.style.backgroundPosition = '-' + d.gap_x + 'px -' + d.gap_y + 'px';
          piece.style.top                = d.gap_y + 'px';
          hole.style.left                = d.gap_x + 'px';
          hole.style.top                 = d.gap_y + 'px';
          refBtn.dataset.token           = d.token;
          btn.classList.remove('sc-ok', 'sc-fail');
          moveTo(0);
        });
    });
  }

  moveTo(0);
})();
</script>