<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$pageTitle       = $pageTitle       ?? SITE['name'] . ' – ' . SITE['role'];
$pageDescription = $pageDescription ?? 'Nezávislý pohled na marketing a komunikaci vaší společnosti. Strategický marketingový audit, poradenství a komunikační strategie pro majitele a vedení firem.';
$isHome          = $isHome          ?? false;
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<meta name="author" content="<?= e(SITE['name']) ?>">
<meta name="theme-color" content="#FBFBFA">
<link rel="canonical" href="<?= e(SITE['url']) ?>/">

<meta property="og:type" content="website">
<meta property="og:locale" content="cs_CZ">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:url" content="<?= e(SITE['url']) ?>/">
<meta property="og:image" content="<?= e(SITE['url']) ?>/assets/img/og-image.jpg">

<link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css?v=1.0">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "<?= e(SITE['name']) ?>",
  "jobTitle": "<?= e(SITE['role']) ?>",
  "url": "<?= e(SITE['url']) ?>",
  "email": "<?= e(SITE['email']) ?>",
  "telephone": "<?= e(SITE['phone']) ?>",
  "sameAs": ["<?= e(SITE['linkedin']) ?>"],
  "worksFor": { "@type": "Organization", "name": "<?= e(SITE['company']) ?>" }
}
</script>
</head>
<body<?= $isHome ? '' : ' class="page--inner"' ?>>

<a class="skip" href="#obsah">Přeskočit na obsah</a>

<header class="topbar" id="topbar">
  <div class="topbar__inner">
    <a class="brand" href="<?= $isHome ? '#uvod' : 'index.php' ?>">
      <span class="brand__name"><?= e(SITE['name']) ?></span>
      <span class="brand__role"><?= e(SITE['role']) ?></span>
    </a>

    <nav class="mainnav" id="mainnav" aria-label="Hlavní navigace">
      <ul>
        <?php foreach (NAV as $id => $label): ?>
          <li><a href="<?= $isHome ? '#' . $id : 'index.php#' . $id ?>" data-nav="<?= e($id) ?>"><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="btn btn--small btn--nav" href="<?= $isHome ? '#kontakt' : 'index.php#kontakt' ?>">Domluvit konzultaci</a>
    </nav>

    <button class="burger" id="burger" aria-expanded="false" aria-controls="mainnav" aria-label="Otevřít menu">
      <span></span><span></span>
    </button>
  </div>
  <span class="topbar__progress" id="topProgress" aria-hidden="true"></span>
</header>
