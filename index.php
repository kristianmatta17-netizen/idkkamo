<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$isHome    = true;
$pageTitle = SITE['name'] . ' – ' . SITE['role'] . ' | Marketing v souvislostech';
$token     = csrf_token();

require __DIR__ . '/inc/header.php';
?>

<!-- Nit: svislá osa stránky, která propojuje jednotlivé sekce -->
<nav class="thread" id="thread" aria-label="Rychlý přehled sekcí">
  <span class="thread__track"><span class="thread__fill" id="threadFill"></span></span>
  <ul>
    <?php foreach (NAV as $id => $label): ?>
      <li>
        <a href="#<?= e($id) ?>" data-thread="<?= e($id) ?>">
          <span class="thread__dot" aria-hidden="true"></span>
          <span class="thread__label"><?= e($label) ?></span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>

<main id="obsah">

  <!-- ============================ ÚVOD ============================ -->
  <section class="hero" id="uvod">
    <span class="hero__glow" aria-hidden="true"></span>
    <div class="wrap hero__grid">

      <div class="hero__text">
        <p class="eyebrow eyebrow--soft hero__eyebrow">Marketing v souvislostech</p>

        <h1 class="hero__title">
          <span class="line"><span>Nezávislý pohled</span></span>
          <span class="line"><span>na marketing a komunikaci</span></span>
          <span class="line"><span>vaší společnosti</span></span>
        </h1>

        <p class="hero__lead">
          Pomáhám vedení firem posoudit současný stav marketingu, pojmenovat jeho skutečné
          priority a nastavit další rozvoj tak, aby podporoval obchodní cíle společnosti.
        </p>

        <div class="hero__body">
          <p>
            Dívám se na marketing z nadhledu – nezávisle, objektivně a v širších souvislostech.
            Díky zkušenostem z poradenství, médií, podnikání i vrcholového managementu
            propojuji strategii, obchod a komunikaci do funkčního celku.
          </p>
          <p>
            Mým cílem není vytvářet další marketingové aktivity. Pomáhám vedení společnosti
            získat podklady pro lepší rozhodování.
          </p>
        </div>

        <div class="hero__actions">
          <a class="btn btn--primary" href="#kontakt">Domluvit úvodní konzultaci</a>
          <a class="btn btn--ghost" href="#jak-pracuji">Zjistit, jak pracuji</a>
        </div>
      </div>

      <figure class="hero__figure">
        <div class="hero__figure__scale">
          <img src="assets/img/portrait-hero.png" alt=" – <?= e(SITE['role']) ?>" width="900" height="1200">
        </div>
      </figure>
    </div>

    <div class="wrap hero__foot">
      <p><span class="tick" aria-hidden="true"></span>Poradenství, média, podnikání a vrcholový management — více než 30 let praxe</p>
      <a class="scrollcue" href="#sluzby" aria-label="Přejít na služby"><span></span></a>
    </div>
  </section>

  <!-- ============================ SLUŽBY ============================ -->
  <section class="section" id="sluzby">
    <div class="wrap">
      <header class="shead" data-reveal>
        <p class="eyebrow">Služby</p>
        <h2 class="h2">S čím mohu pomoci</h2>
        <p class="shead__lead">
          Spolupracuji přímo s majiteli a vedením společností. Rozsah spolupráce vždy
          vychází z konkrétní situace, potřeb a cílů firmy.
        </p>
      </header>

      <div class="services">
        <?php foreach (SLUZBY as $i => $s): ?>
          <article class="service" data-reveal style="--d: <?= $i * 90 ?>ms">
            <span class="service__rule" aria-hidden="true"></span>
            <h3 class="service__title"><?= e($s['title']) ?></h3>
            <p class="service__text"><?= e($s['text']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="services__foot" data-reveal>
        <p>
          Každá spolupráce začíná úvodním rozhovorem. Jeho cílem je pochopit situaci
          společnosti a určit, jaký rozsah podpory bude mít největší přínos.
        </p>
        <a class="btn btn--dark" href="#kontakt">Probrat konkrétní situaci</a>
      </div>
    </div>
  </section>

  <!-- ============================ JAK PRACUJI ============================ -->
  <section class="section section--deep" id="jak-pracuji">
    <div class="wrap">
      <div class="method__intro">
        <header class="shead shead--onink" data-reveal>
          <p class="eyebrow eyebrow--soft">Postup</p>
          <h2 class="h2">Jak pracuji</h2>
        </header>

        <div class="method__copy" data-reveal style="--d: 100ms">
          <p class="method__opener">
            Každá firma je jiná. Proto nepřicházím s univerzálními řešeními
            ani s předem připravenými doporučeními.
          </p>
          <p>
            Nejprve potřebuji pochopit, jak společnost funguje, kam směřuje a co od marketingu
            skutečně očekává. Následně hodnotím současný stav, hledám souvislosti a identifikuji
            oblasti, které mají největší vliv na další rozvoj.
          </p>
          <p>
            Výsledkem nejsou obecné poučky ani zbytečně rozsáhlé analýzy. Vedení společnosti
            získá srozumitelná zjištění, jasné priority a doporučení, podle kterých se může
            rozhodovat.
          </p>
        </div>
      </div>

      <ol class="steps" data-steps>
        <span class="steps__line" aria-hidden="true"></span>
        <?php foreach (KROKY as $i => $k): ?>
          <li class="step" data-reveal style="--d: <?= $i * 120 ?>ms">
            <span class="step__num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3 class="step__title"><?= e($k['title']) ?></h3>
            <p class="step__text"><?= e($k['text']) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>

      <p class="statement" data-reveal>
        "Nedoporučuji více marketingu.<br>
        <em>Doporučuji marketing, který má pro firmu jasný smysl."</em>
      </p>
    </div>
  </section>

  <!-- ============================ O MNĚ ============================ -->
  <section class="section" id="o-mne">
    <div class="wrap about">

      <div class="about__media" data-reveal>

        <img src="assets/img/portrait-about.png" alt="<?= e(SITE['name']) ?> při práci" width="1000" height="1250">
      </div>

      <div class="about__text">
        <header class="shead" data-reveal>
          <p class="eyebrow">O mně</p>
          <h2 class="h2">Marketing jsem poznal<br>z různých stran</h2>
        </header>

        <div class="prose" data-reveal style="--d: 80ms">
          <p>
            Více než třicet let se pohybuji v marketingu, komunikaci, médiích a managementu.
            Během své profesní dráhy jsem pracoval jako konzultant, podnikatel, člen vrcholového
            managementu i vedoucí komunikace významné veřejné instituce.
          </p>
          <p>
            Díky tomu znám marketing nejen z pohledu jeho tvůrců, ale také z pohledu lidí,
            kteří za jeho výsledky, rozpočet a přínos pro organizaci nesou odpovědnost.
          </p>
          <p>
            Postupně jsem se utvrdil v tom, že dobrý marketing nezačíná kampaní. Začíná
            pochopením firmy – jejího obchodního modelu, zákazníků, možností a cílů. Teprve
            potom lze rozhodnout, jakou roli má marketing hrát a do čeho má smysl investovat.
          </p>
          <p>
            Dnes své zkušenosti využívám jako nezávislý partner vedení společností. Nabízím pohled
            člověka, který dokáže spojit marketing, komunikaci, obchod a řízení organizace
            do jednoho celku.
          </p>
        </div>

        <blockquote class="quote" data-reveal>
          <p>"Marketing má smysl jen tehdy, když vychází z pochopení firmy a podporuje její obchodní cíle."</p>
        </blockquote>
      </div>
    </div>
  </section>

  <!-- ============================ ZKUŠENOSTI ============================ -->
  <section class="section section--tint" id="zkusenosti">
    <div class="wrap">
      <header class="shead shead--wide" data-reveal>
        <p class="eyebrow">Zkušenosti</p>
        <h2 class="h2">Více než <span class="count" data-count="30">30</span> let profesních zkušeností</h2>
        <p class="shead__lead">
          Zkušenosti jsem získal v mezinárodním poradenství, médiích, podnikání,
          soukromém sektoru i ve veřejné instituci.
        </p>
      </header>

      <div class="block" data-reveal>
        <p class="block__label">Profesní působení</p>
        <ul class="logos">
          <?php foreach (PUSOBENI as $i => $p): ?>
            <li style="--d: <?= $i * 70 ?>ms">
              <!-- PLACEHOLDER: nahraďte souborem assets/img/<?= e($p['file']) ?> -->
              <img src="assets/img/<?= e($p['file']) ?>" alt="<?= e($p['name']) ?>" loading="lazy" 
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="block" data-reveal>
        <p class="block__label">Oblasti zkušeností</p>
        <ul class="fields">
          <?php foreach (OBLASTI as $i => $o): ?>
            <li class="field" style="--d: <?= $i * 45 ?>ms">
              <span class="field__mark" aria-hidden="true"></span>
              <span class="field__name"><?= e($o) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <p class="closing" data-reveal>
        Během své profesní dráhy jsem spolupracoval se společnostmi a institucemi ze
        soukromého i veřejného sektoru. Tato šíře zkušeností mi umožňuje posuzovat marketing
        nejen jako samostatnou disciplínu, ale jako součást fungování celé organizace.
      </p>
    </div>
  </section>

  <!-- ============================ HODNOTA SPOLUPRÁCE ============================ -->
  <section class="section section--deep section--value" id="hodnota">
    <div class="wrap">
      <div class="value__top">
        <header class="shead shead--onink" data-reveal>
          <p class="eyebrow eyebrow--soft">Hodnota spolupráce</p>
          <h2 class="h2">Co spolupráce přináší</h2>
        </header>
        <div class="value__copy" data-reveal style="--d: 100ms">
          <p>
            Získáte nezávislý pohled člověka, který rozumí marketingu, komunikaci
            i způsobu rozhodování vedení společnosti.
          </p>
          <p>
            Pomohu vám oddělit podstatné od nepodstatného, pojmenovat skutečné priority
            a převést je do konkrétních kroků. Bez vazby na nákup médií, produkci kampaní
            nebo prosazování konkrétních dodavatelů.
          </p>
        </div>
      </div>

      <div class="benefits">
        <?php foreach (PRINOSY as $i => $b): ?>
          <article class="benefit" data-reveal style="--d: <?= $i * 110 ?>ms">
            <h3 class="benefit__title"><?= e($b['title']) ?></h3>
            <p><?= e($b['text']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ KONTAKT ============================ -->
  <section class="section" id="kontakt">
    <div class="wrap contact">

      <div class="contact__intro">
        <header class="shead" data-reveal>
          <p class="eyebrow">Kontakt</p>
          <h2 class="h2">Pojďme si promluvit</h2>
        </header>

        <div class="prose" data-reveal style="--d: 80ms">
          <p>
            Hledáte nezávislý pohled na marketing, komunikaci nebo strategické směřování
            vaší společnosti?
          </p>
          <p>
            Při úvodním rozhovoru společně pojmenujeme vaši situaci a posoudíme, zda a jak
            vám mohu být přínosem. Rozhovor vás nezavazuje k další spolupráci.
          </p>
        </div>

        <ul class="contact__list" data-reveal style="--d: 140ms">
          <li>
            <span class="contact__label">Telefon</span>
            <a href="tel:<?= e(SITE['phone_href']) ?>"><?= e(SITE['phone']) ?></a>
          </li>
          <li>
            <span class="contact__label">E-mail</span>
            <a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a>
          </li>
          <li>
            <span class="contact__label">LinkedIn</span>
            <a href="<?= e(SITE['linkedin']) ?>" target="_blank" rel="noopener">Profil na LinkedIn</a>
          </li>
        </ul>
      </div>

      <div class="contact__form" data-reveal style="--d: 120ms">
        <form id="contactForm" class="form" action="send.php" method="post" novalidate>
          <input type="hidden" name="csrf" value="<?= e($token) ?>">
          <input type="hidden" name="ts" value="<?= time() ?>">
          <div class="form__trap" aria-hidden="true">
            <label>Nevyplňujte <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <div class="field-row">
            <div class="input">
              <input type="text" id="jmeno" name="jmeno" required autocomplete="name" placeholder=" ">
              <label for="jmeno">Jméno a příjmení</label>
            </div>
            <div class="input">
              <input type="text" id="spolecnost" name="spolecnost" required autocomplete="organization" placeholder=" ">
              <label for="spolecnost">Společnost</label>
            </div>
          </div>

          <div class="field-row">
            <div class="input">
              <input type="email" id="email" name="email" required autocomplete="email" placeholder=" ">
              <label for="email">E-mail</label>
            </div>
            <div class="input">
              <input type="tel" id="telefon" name="telefon" autocomplete="tel" placeholder=" ">
              <label for="telefon">Telefon <span class="optional">nepovinné</span></label>
            </div>
          </div>

          <div class="input">
            <textarea id="situace" name="situace" rows="5" required placeholder=" "></textarea>
            <label for="situace">Krátký popis situace</label>
          </div>

          <label class="consent">
            <input type="checkbox" name="souhlas" value="1" required>
            <span class="consent__box" aria-hidden="true"></span>
            <span class="consent__text">
              Souhlasím se zpracováním osobních údajů pro účely vyřízení této žádosti.
              Podrobnosti v <a href="zasady-ochrany-osobnich-udaju.php" target="_blank" rel="noopener">zásadách ochrany osobních údajů</a>.
            </span>
          </label>

          <button type="submit" class="btn btn--primary btn--wide">Odeslat žádost o konzultaci</button>

          <?php
          // Hláška pro odeslání bez JavaScriptu (návrat z send.php)
          $stav = (string) ($_GET['stav'] ?? '');
          $stavTrida = $stav === 'odeslano' ? ' is-ok' : ($stav === 'chyba' ? ' is-err' : '');
          $stavText = match ($stav) {
              'odeslano' => 'Děkuji za zprávu. Ozvu se vám do dvou pracovních dnů.',
              'chyba'    => 'Zprávu se nepodařilo odeslat. Napište prosím přímo na ' . SITE['email'] . '.',
              default    => '',
          };
          ?>
          <p class="form__status<?= $stavTrida ?>" id="formStatus" role="status" aria-live="polite"><?= e($stavText) ?></p>
        </form>
      </div>
    </div>
  </section>

</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
