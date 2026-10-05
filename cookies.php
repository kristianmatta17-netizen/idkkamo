<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$isHome          = false;
$pageTitle       = 'Používání cookies – ' . SITE['name'];
$pageDescription = 'Přehled cookies, které web používá, a jejich účel.';

require __DIR__ . '/inc/header.php';
?>

<main id="obsah" class="section legal">
  <div class="wrap">
    <p class="eyebrow">Informace</p>
    <h1 class="h1">Používání cookies</h1>

    <div class="legal__body prose">
      <p class="legal__note">
        Text vychází ze současné podoby webu bez analytických nástrojů. Pokud později přidáte
        měření návštěvnosti, je nutné doplnit souhlasovou lištu s možností volby.
      </p>

      <h2>Co jsou cookies</h2>
      <p>
        Cookies jsou malé soubory, které si prohlížeč ukládá při návštěvě webu. Slouží k tomu,
        aby si stránka pamatovala základní nastavení mezi jednotlivými návštěvami.
      </p>

      <h2>Které cookies web používá</h2>
      <ul>
        <li>
          <strong>fr_cookies</strong> – uchovává informaci, že jste potvrdili oznámení o cookies.
          Platnost 180 dnů.
        </li>
        <li>
          <strong>PHPSESSID</strong> – technická session cookie nutná pro bezpečné odeslání
          kontaktního formuláře. Zaniká zavřením prohlížeče.
        </li>
      </ul>

      <h2>Analytické a marketingové cookies</h2>
      <p>
        Web je nepoužívá. Nesbírá data pro reklamní systémy ani je nepředává třetím stranám.
      </p>

      <h2>Externí služby</h2>
      <p>
        Pro zobrazení písem se načítají soubory ze služby Google Fonts. Při tomto načtení
        se přenáší IP adresa vašeho zařízení. Pokud chcete přenosu zabránit, lze písma
        umístit přímo na server webu.
      </p>

      <h2>Jak cookies odmítnout</h2>
      <p>
        Ukládání cookies lze zakázat v nastavení prohlížeče. Odesílání kontaktního formuláře
        pak nemusí fungovat správně.
      </p>

      <p class="legal__note">Poslední aktualizace: [doplňte datum].</p>
    </div>
  </div>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
