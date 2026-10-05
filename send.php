<?php
/**
 * Zpracování kontaktního formuláře.
 * Vrací JSON pro AJAX odeslání, jinak přesměruje zpět na #kontakt.
 */

declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

session_start();
mb_internal_encoding('UTF-8');

$isAjax = (
    (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] !== '')
    || (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json'))
);

/**
 * Ukončí zpracování odpovědí ve správném formátu.
 */
function respond(bool $ok, string $message, bool $isAjax): void
{
    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'message' => $message], JSON_UNESCAPED_UNICODE);
    } else {
        header('Location: index.php?stav=' . ($ok ? 'odeslano' : 'chyba') . '#kontakt');
    }
    exit;
}

/** Odstraní znaky, kterými by šlo podvrhnout hlavičky e-mailu. */
function clean(string $value): string
{
    return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', $value));
}

/* --------------------------- 1) Základní kontroly --------------------------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Neplatný požadavek.', $isAjax);
}

if (empty($_POST['csrf']) || empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], (string) $_POST['csrf'])) {
    respond(false, 'Platnost formuláře vypršela. Načtěte prosím stránku znovu.', $isAjax);
}

// Past na roboty – skryté pole musí zůstat prázdné
if (!empty($_POST['website'])) {
    respond(true, 'Děkuji, žádost byla odeslána.', $isAjax);
}

// Opakované odeslání krátce po sobě
if (!empty($_SESSION['odeslano_v']) && (time() - (int) $_SESSION['odeslano_v']) < 30) {
    respond(false, 'Žádost už byla odeslána. Děkuji, ozvu se vám.', $isAjax);
}

// Formulář odeslaný podezřele rychle
$ts = isset($_POST['ts']) ? (int) $_POST['ts'] : 0;
if ($ts > 0 && (time() - $ts) < FORM['min_seconds']) {
    respond(false, 'Odeslání proběhlo příliš rychle. Zkuste to prosím znovu.', $isAjax);
}

/* --------------------------- 2) Vstupní hodnoty --------------------------- */
$jmeno      = clean((string) ($_POST['jmeno'] ?? ''));
$spolecnost = clean((string) ($_POST['spolecnost'] ?? ''));
$email      = clean((string) ($_POST['email'] ?? ''));
$telefon    = clean((string) ($_POST['telefon'] ?? ''));
$situace    = trim((string) ($_POST['situace'] ?? ''));
$souhlas    = !empty($_POST['souhlas']);

$chyby = [];
if (mb_strlen($jmeno) < 3)                              { $chyby[] = 'jméno a příjmení'; }
if ($spolecnost === '')                                 { $chyby[] = 'společnost'; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL))         { $chyby[] = 'e-mail'; }
if (mb_strlen($situace) < 10)                           { $chyby[] = 'popis situace'; }
if (!$souhlas)                                          { $chyby[] = 'souhlas se zpracováním údajů'; }

if ($chyby) {
    respond(false, 'Doplňte prosím: ' . implode(', ', $chyby) . '.', $isAjax);
}

if (mb_strlen($situace) > 4000) {
    $situace = mb_substr($situace, 0, 4000);
}

/* --------------------------- 3) Sestavení zprávy --------------------------- */
$telefonText = $telefon !== '' ? $telefon : 'neuvedeno';

$telo = <<<TEXT
Nová žádost o úvodní konzultaci

Jméno a příjmení: {$jmeno}
Společnost:       {$spolecnost}
E-mail:           {$email}
Telefon:          {$telefonText}

Popis situace:
{$situace}

---
Odesláno z webu: {$_SERVER['HTTP_HOST']}
Datum a čas:     
TEXT;

$telo .= (new DateTimeImmutable('now'))->format('j. n. Y H:i');

$predmet = FORM['subject'] . ' – ' . $spolecnost;

$hlavicky = [
    'From: ' . sprintf('=?UTF-8?B?%s?= <%s>', base64_encode(SITE['name'] . ' – web'), FORM['from']),
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: 8bit',
    'MIME-Version: 1.0',
    'X-Mailer: PHP/' . phpversion(),
];

$odeslano = @mail(
    FORM['recipient'],
    '=?UTF-8?B?' . base64_encode($predmet) . '?=',
    $telo,
    implode("\r\n", $hlavicky)
);

/* --------------------------- 4) Záložní zápis do souboru --------------------------- */
$logDir = dirname(FORM['log_file']);
if (!is_dir($logDir)) {
    @mkdir($logDir, 0775, true);
}
if (is_dir($logDir) && is_writable($logDir)) {
    @file_put_contents(
        FORM['log_file'],
        str_repeat('=', 60) . PHP_EOL . $telo . PHP_EOL . 'Odeslání e-mailu: ' . ($odeslano ? 'OK' : 'SELHALO') . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );
}

/* --------------------------- 5) Odpověď --------------------------- */
if ($odeslano) {
    $_SESSION['odeslano_v'] = time();
    respond(true, 'Děkuji za zprávu. Ozvu se vám do dvou pracovních dnů.', $isAjax);
}

respond(false, 'Zprávu se nepodařilo odeslat. Napište prosím přímo na ' . SITE['email'] . '.', $isAjax);
