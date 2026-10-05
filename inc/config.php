<?php
/**
 * Filip Řepa – strategický marketingový poradce
 * ------------------------------------------------
 * Centrální konfigurace webu. Veškeré kontaktní údaje, texty sekcí
 * a nastavení formuláře se mění na tomto jediném místě.
 */

declare(strict_types=1);

/* ------------------------------------------------------------------
 * 1) Základní identita a kontaktní údaje
 *    >>> DOPLNIT skutečné hodnoty <<<
 * ------------------------------------------------------------------ */
const SITE = [
    'name'        => 'Filip Řepa',
    'role'        => 'Strategický marketingový poradce',
    'url'         => 'https://www.filiprepa.cz',          
    'phone'       => '+420 604 752 703',                 
    'phone_href'  => '+420604752703',                     
    'email'       => 'info@filiprepa.cz',                 // DOPLNIT
    'linkedin'    => 'https://www.linkedin.com/in/filip-%C5%99epa-5b04406a/', 
    'company'     => 'Presenta Pictures s.r.o.',
    'ico'         => '27062252',                          
    'year'        => 2026,
];

/* ------------------------------------------------------------------
 * 2) Nastavení kontaktního formuláře
 * ------------------------------------------------------------------ */
const FORM = [
    'recipient'  => 'info@filiprepa.cz',   // DOPLNIT – kam chodí poptávky
    'from'       => 'postmaster@filiprepa.cz',    // DOPLNIT – odesílatel na vaší doméně
    'subject'    => 'Nová žádost o konzultaci z webu',
    'log_file'   => __DIR__ . '/../storage/poptavky.log', // záloha poptávek
    'min_seconds'=> 3,                     // ochrana proti robotům
];

/* ------------------------------------------------------------------
 * 3) Navigace
 * ------------------------------------------------------------------ */
const NAV = [
    'uvod'        => 'Úvod',
    'sluzby'      => 'Služby',
    'jak-pracuji' => 'Jak pracuji',
    'o-mne'       => 'O mně',
    'zkusenosti'  => 'Zkušenosti',
    'kontakt'     => 'Kontakt',
];

/* ------------------------------------------------------------------
 * 4) Služby
 * ------------------------------------------------------------------ */
const SLUZBY = [
    [
        'title' => 'Strategický marketingový audit',
        'text'  => 'Nezávislé posouzení marketingové strategie, komunikace, procesů, kompetencí a spolupráce marketingu s obchodem. Výsledkem jsou jasně pojmenované priority a konkrétní doporučení pro další rozvoj.',
    ],
    [
        'title' => 'Strategické marketingové poradenství',
        'text'  => 'Průběžná podpora vedení společnosti při rozhodování o marketingu, značce, komunikaci a alokaci marketingových investic.',
    ],
    [
        'title' => 'Podpora řízení marketingu',
        'text'  => 'Pomoc při nastavování priorit, rolí, procesů a spolupráce interního týmu s externími dodavateli. Podle potřeby také dočasné zastřešení strategického řízení marketingu.',
    ],
    [
        'title' => 'Komunikační strategie',
        'text'  => 'Nastavení hlavních témat, sdělení a komunikačních priorit společnosti vůči zákazníkům, zaměstnancům, médiím i dalším důležitým skupinám.',
    ],
];

/* ------------------------------------------------------------------
 * 5) Postup práce
 * ------------------------------------------------------------------ */
const KROKY = [
    ['title' => 'Porozumění', 'text' => 'Poznání obchodního modelu, cílů, zákazníků a současné situace společnosti.'],
    ['title' => 'Analýza',    'text' => 'Vyhodnocení strategie, komunikace, aktivit, procesů, kompetencí a dostupných výsledků.'],
    ['title' => 'Souvislosti','text' => 'Propojení marketingových zjištění s obchodními a strategickými cíli firmy.'],
    ['title' => 'Doporučení', 'text' => 'Stanovení priorit, konkrétních kroků a realistického plánu dalšího postupu.'],
];

/* ------------------------------------------------------------------
 * 6) Profesní působení – logotypy
 *    Soubory nahrajte do assets/img/ pod uvedenými názvy.
 * ------------------------------------------------------------------ */
const PUSOBENI = [
    ['name' => 'Hill & Knowlton',           'file' => 'logo-hill-knowlton.svg'],
    ['name' => 'Pleon Impact',              'file' => 'logo-pleon-impact.svg'],
    ['name' => 'Presenta Pictures',         'file' => 'logo-presenta-pictures.jpg'],
    ['name' => 'TV Prima',                  'file' => 'logo-tv-prima.svg'],
    ['name' => 'Fakultní nemocnice Bulovka','file' => 'logo-fn-bulovka.svg'],
];

/* ------------------------------------------------------------------
 * 7) Oblasti zkušeností
 * ------------------------------------------------------------------ */
const OBLASTI = [
    'strategický marketing',
    'public relations',
    'marketingová komunikace',
    'média',
    'public affairs',
    'krizová komunikace',
    'řízení značky',
    'management',
    'interní komunikace',
    'tvorba obsahu',
];

/* ------------------------------------------------------------------
 * 8) Hodnota spolupráce
 * ------------------------------------------------------------------ */
const PRINOSY = [
    ['title' => 'Nadhled',       'text' => 'Objektivní posouzení současného stavu bez interních předsudků a provozní slepoty.'],
    ['title' => 'Souvislosti',   'text' => 'Propojení marketingových rozhodnutí s obchodem, strategií a fungováním organizace.'],
    ['title' => 'Jasné priority','text' => 'Konkrétní doporučení, která vedení společnosti může převést do rozhodnutí a dalších kroků.'],
];

/* ------------------------------------------------------------------
 * Pomocné funkce
 * ------------------------------------------------------------------ */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
