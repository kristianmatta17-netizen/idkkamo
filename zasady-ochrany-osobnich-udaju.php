<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$isHome          = false;
$pageTitle       = 'Zásady ochrany osobních údajů – ' . SITE['name'];
$pageDescription = 'Informace o zpracování osobních údajů při využívání webu a kontaktního formuláře.';

require __DIR__ . '/inc/header.php';
?>

<main id="obsah" class="section legal">
  <div class="wrap">
    <p class="eyebrow">Informace</p>
    <h1 class="h1">Zásady ochrany osobních údajů</h1>

    

      <h2>Správce údajů</h2>
      <p>
        Správcem osobních údajů je <?= e(SITE['company']) ?>, IČ <?= e(SITE['ico']) ?>,
        se sídlem [Bášt?]. Kontaktní e-mail:
        <a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a>.
      </p>

      <h2>Jaké údaje zpracovávám</h2>
      <ul>
        <li>jméno a příjmení,</li>
        <li>název společnosti,</li>
        <li>e-mailovou adresu,</li>
        <li>telefonní číslo, pokud jej uvedete,</li>
        <li>text vaší zprávy.</li>
      </ul>

      <h2>Proč údaje zpracovávám</h2>
      <p>
        Údaje z kontaktního formuláře používám výhradně k tomu, abych mohl odpovědět na vaši
        žádost a domluvit úvodní rozhovor. Právním základem je oprávněný zájem na vyřízení
        vaší poptávky, případně kroky před uzavřením smlouvy.
      </p>

      <h2>Jak dlouho údaje uchovávám</h2>
      <p>
        Zprávy z formuláře uchovávám po dobu xy měsíců od poslední komunikace.
        Pokud ze spolupráce vznikne smluvní vztah, řídí se doba uchování zákonnými lhůtami.
      </p>

      <h2>Komu údaje předávám</h2>
      <p>
        Údaje nepředávám třetím stranám k marketingovým účelům. Přístup k nim může mít
        poskytovatel webhostingu [uvidim] a poskytovatel e-mailové služby
        [uvidim], a to výhradně v rozsahu nezbytném pro provoz služby.
      </p>

      <h2>Vaše práva</h2>
      <ul>
        <li>právo na přístup ke svým údajům,</li>
        <li>právo na opravu nepřesných údajů,</li>
        <li>právo na výmaz,</li>
        <li>právo na omezení zpracování,</li>
        <li>právo vznést námitku proti zpracování,</li>
        <li>právo podat stížnost u Úřadu pro ochranu osobních údajů.</li>
      </ul>
      <p>
        Uplatnit je můžete kdykoli na adrese
        <a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a>.
      </p>

      <h2>Cookies</h2>
      <p>
        Web používá pouze technicky nezbytné cookies. Podrobnosti najdete v
        <a href="cookies.php">informacích o používání cookies</a>.
      </p>

      <p class="legal__note">Poslední aktualizace: 28.08.2026.</p>
    </div>
  </div>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
