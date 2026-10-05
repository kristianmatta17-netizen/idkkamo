<footer class="footer">
  <div class="wrap footer__grid">

    <div class="footer__id">
      <p class="footer__name"><?= e(SITE['name']) ?></p>
      <p class="footer__role"><?= e(SITE['role']) ?></p>
    </div>

    <div class="footer__col">
      <p class="footer__label">Kontakt</p>
      <ul class="footer__list">
        <li><a href="tel:<?= e(SITE['phone_href']) ?>"><?= e(SITE['phone']) ?></a></li>
        <li><a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a></li>
        <li><a href="<?= e(SITE['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn</a></li>
      </ul>
    </div>

    <div class="footer__col">
      <p class="footer__label">Provozovatel</p>
      <ul class="footer__list">
        <li><?= e(SITE['company']) ?></li>
        <li>IČ <?= e(SITE['ico']) ?></li>
      </ul>
    </div>

    <div class="footer__col">
      <p class="footer__label">Informace</p>
      <ul class="footer__list">
        <li><a href="zasady-ochrany-osobnich-udaju.php">Zásady ochrany osobních údajů</a></li>
        <li><a href="cookies.php">Používání cookies</a></li>
      </ul>
    </div>

  </div>

  <div class="wrap footer__bottom">
    <p>© <?= e((string) SITE['year']) ?> <?= e(SITE['name']) ?> / <?= e(SITE['company']) ?></p>
  </div>
</footer>

<a class="totop" href="#uvod" aria-label="Zpět nahoru">
  <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
    <path d="M12 19V5M5 12l7-7 7 7" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
</a>

<div class="cookiebar" id="cookiebar" role="dialog" aria-live="polite" aria-label="Informace o cookies" hidden>
  <p>Web používá pouze technicky nezbytné cookies. Podrobnosti najdete v <a href="cookies.php">informacích o cookies</a>.</p>
  <button type="button" class="btn btn--small" id="cookieOk">Rozumím</button>
</div>

<script src="assets/js/main.js?v=1.0" defer></script>
</body>
</html>
