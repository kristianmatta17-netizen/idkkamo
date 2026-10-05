/* =====================================================================
   Filip Řepa – interakce webu
   Vanilla JS, bez závislostí.
   ===================================================================== */
(function () {
  'use strict';

  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $  = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ---------------------------------------------------------------
     1) Horní lišta – stav po odscrollování, skrývání při scrollu dolů
     --------------------------------------------------------------- */
  var topbar   = $('#topbar');
  var progress = $('#topProgress');
  var lastY    = window.scrollY;

  function onScroll() {
    var y   = window.scrollY;
    var max = document.documentElement.scrollHeight - window.innerHeight;
    var pct = max > 0 ? (y / max) * 100 : 0;

    if (topbar) {
      topbar.classList.toggle('is-stuck', y > 28);
      var hide = y > lastY && y > window.innerHeight && !document.body.classList.contains('nav-open');
      topbar.classList.toggle('is-hidden', hide);
    }
    if (progress) progress.style.transform = 'scaleX(' + (pct / 100).toFixed(4) + ')';

    updateThread(pct);
    lastY = y;
  }

  var ticking = false;
  window.addEventListener('scroll', function () {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(function () { onScroll(); ticking = false; });
  }, { passive: true });

  /* ---------------------------------------------------------------
     2) Mobilní menu
     --------------------------------------------------------------- */
  var burger = $('#burger');
  var mainnav = $('#mainnav');

  if (burger && mainnav) {
    burger.addEventListener('click', function () {
      var open = mainnav.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Zavřít menu' : 'Otevřít menu');
      document.body.classList.toggle('nav-open', open);
    });

    $$('a', mainnav).forEach(function (a) {
      a.addEventListener('click', function () {
        mainnav.classList.remove('is-open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('nav-open');
      });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && mainnav.classList.contains('is-open')) burger.click();
    });
  }

  /* ---------------------------------------------------------------
     3) Nit sekcí – průběh a aktivní sekce
     --------------------------------------------------------------- */
  var thread     = $('#thread');
  var threadFill = $('#threadFill');
  var sections   = $$('main section[id]');

  function updateThread(pct) {
    if (threadFill) threadFill.style.height = Math.min(100, Math.max(0, pct)) + '%';
    if (!thread) return;
    thread.classList.toggle('is-on', window.scrollY > window.innerHeight * 0.6);
  }

  if ('IntersectionObserver' in window && sections.length) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var id = entry.target.id;
        $$('[data-nav]').forEach(function (a) { a.classList.toggle('is-active', a.dataset.nav === id); });
        $$('[data-thread]').forEach(function (a) { a.classList.toggle('is-active', a.dataset.thread === id); });
      });
    }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });

    sections.forEach(function (s) { spy.observe(s); });
  }

  /* ---------------------------------------------------------------
     4) Odkrývání obsahu při scrollu
     --------------------------------------------------------------- */
  var revealables = $$('[data-reveal]');

  if (reduced || !('IntersectionObserver' in window)) {
    revealables.forEach(function (el) { el.classList.add('is-in'); });
    var st = $('[data-steps]'); if (st) st.classList.add('is-drawn');
  } else {
    var io = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-in');
        obs.unobserve(entry.target);
      });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.12 });

    revealables.forEach(function (el) { io.observe(el); });

    /* Linka spojující čtyři kroky */
    var steps = $('[data-steps]');
    if (steps) {
      var stepsIO = new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('is-drawn');
          obs.unobserve(entry.target);
        });
      }, { threshold: 0.25 });
      stepsIO.observe(steps);
    }
  }

  /* ---------------------------------------------------------------
     5) Počítadlo let praxe
     --------------------------------------------------------------- */
  var counter = $('[data-count]');
  if (counter && !reduced && 'IntersectionObserver' in window) {
    var target = parseInt(counter.dataset.count, 10) || 0;
    var countIO = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        obs.unobserve(entry.target);
        var start = null, dur = 1400;
        function tick(ts) {
          if (!start) start = ts;
          var p = Math.min(1, (ts - start) / dur);
          var eased = 1 - Math.pow(1 - p, 3);
          counter.textContent = String(Math.round(target * eased));
          if (p < 1) requestAnimationFrame(tick);
        }
        counter.textContent = '0';
        requestAnimationFrame(tick);
      });
    }, { threshold: 0.6 });
    countIO.observe(counter);
  }

  /* ---------------------------------------------------------------
     6) Kontaktní formulář
     --------------------------------------------------------------- */
  var form   = $('#contactForm');
  var status = $('#formStatus');

  function setError(el, on) {
    var box = el.type === 'checkbox' ? el.closest('.consent') : el.closest('.input');
    if (box) box.classList.toggle('has-error', on);
  }

  function validate() {
    var ok = true;
    $$('input, textarea', form).forEach(function (el) {
      if (!el.required) return;
      var valid = el.type === 'checkbox' ? el.checked : el.value.trim() !== '';
      if (valid && el.type === 'email') valid = /^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i.test(el.value.trim());
      setError(el, !valid);
      if (!valid && ok) { ok = false; el.focus(); }
    });
    return ok;
  }

  if (form) {
    $$('input, textarea', form).forEach(function (el) {
      el.addEventListener('input',  function () { setError(el, false); });
      el.addEventListener('change', function () { setError(el, false); });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      status.textContent = '';
      status.className = 'form__status';

      if (!validate()) {
        status.textContent = 'Zkontrolujte prosím označená pole.';
        status.classList.add('is-err');
        return;
      }

      form.classList.add('is-sending');
      status.textContent = 'Odesílám…';

      fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'fetch' }
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          form.classList.remove('is-sending');
          status.className = 'form__status ' + (data.ok ? 'is-ok' : 'is-err');
          status.textContent = data.message;
          if (data.ok) form.reset();
        })
        .catch(function () {
          form.classList.remove('is-sending');
          status.className = 'form__status is-err';
          status.textContent = 'Odeslání se nezdařilo. Napište prosím přímo na uvedený e-mail.';
        });
    });
  }

  /* ---------------------------------------------------------------
     7) Cookie lišta (bez trackování, pouze potvrzení)
     --------------------------------------------------------------- */
  var bar = $('#cookiebar');
  var ok  = $('#cookieOk');

  function hasAck() { return document.cookie.indexOf('fr_cookies=1') !== -1; }

  if (bar && ok && !hasAck()) {
    bar.hidden = false;
    setTimeout(function () { bar.classList.add('is-on'); }, 900);
    ok.addEventListener('click', function () {
      document.cookie = 'fr_cookies=1; path=/; max-age=' + 60 * 60 * 24 * 180 + '; SameSite=Lax';
      bar.classList.remove('is-on');
      setTimeout(function () { bar.hidden = true; }, 600);
    });
  }

  /* ---------------------------------------------------------------
     8) Plynulý přechod na kotvu (i pro prohlížeče bez scroll-behavior)
     --------------------------------------------------------------- */
  $$('a[href^="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var id = a.getAttribute('href');
      if (id.length < 2) return;
      var el = document.querySelector(id);
      if (!el) return;
      e.preventDefault();
      var top = el.getBoundingClientRect().top + window.scrollY - 84;
      window.scrollTo({ top: top, behavior: reduced ? 'auto' : 'smooth' });
      history.replaceState(null, '', id);
    });
  });

  onScroll();
})();
