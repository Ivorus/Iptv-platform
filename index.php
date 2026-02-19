<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STREAM MAX — Бесплатное интернет-телевидение</title>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#060610;--bg2:#0b0b1a;--bg3:#101025;--card:#12122a;--card2:#181835;
  --border:#1e1e42;--border2:#2a2a5a;
  --blue:#3d5afe;--blue2:#536dfe;--cyan:#00e5ff;--purple:#7c4dff;
  --green:#00e676;--red:#ff1744;
  --text:#e8eaf6;--muted:#7986cb;--pale:#c5cae9;
  --grad:linear-gradient(135deg,#3d5afe,#7c4dff);--r:12px;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);overflow-x:hidden;}
::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-thumb{background:var(--border2);border-radius:3px;}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:500;display:flex;align-items:center;justify-content:space-between;padding:0 60px;height:70px;background:rgba(6,6,16,.95);backdrop-filter:blur(20px);border-bottom:1px solid transparent;transition:border-color .3s;}
.nav.stuck{border-bottom-color:var(--border);}
.nav-logo{font-family:'Exo 2',sans-serif;font-size:22px;font-weight:900;letter-spacing:3px;text-decoration:none;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.nav-links{display:flex;gap:28px;}
.nav-links a{color:var(--muted);font-size:13px;font-weight:500;text-decoration:none;transition:color .2s;}
.nav-links a:hover{color:var(--text);}
.nav-right{display:flex;gap:10px;align-items:center;}
.nav-phone{color:var(--cyan);font-size:13px;font-weight:600;text-decoration:none;margin-right:8px;}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:11px 22px;border-radius:var(--r);font-family:'Inter',sans-serif;font-size:13px;font-weight:600;border:none;cursor:pointer;text-decoration:none;transition:all .2s;letter-spacing:.3px;}
.btn-primary{background:var(--grad);color:#fff;box-shadow:0 4px 20px rgba(61,90,254,.3);}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(61,90,254,.5);}
.btn-outline{background:transparent;border:1.5px solid var(--border2);color:var(--pale);}
.btn-outline:hover{border-color:var(--blue);color:var(--blue2);}
.btn-cyan{background:linear-gradient(135deg,#00b0ff,#00e5ff);color:#000;font-weight:700;box-shadow:0 4px 20px rgba(0,229,255,.2);}
.btn-cyan:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,229,255,.4);}
.btn-sm{padding:8px 16px;font-size:12px;}

/* HERO */
.hero{min-height:100vh;display:flex;align-items:center;padding:100px 60px 60px;position:relative;overflow:hidden;}
.hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 60% 40%,rgba(61,90,254,.1) 0%,transparent 60%);pointer-events:none;}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(61,90,254,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(61,90,254,.03) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;}
.hero-inner{max-width:1180px;margin:0 auto;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;position:relative;z-index:2;}
.hero-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(0,229,255,.08);border:1px solid rgba(0,229,255,.2);border-radius:100px;padding:6px 16px;margin-bottom:24px;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--cyan);}
.live-dot{width:7px;height:7px;border-radius:50%;background:var(--green);box-shadow:0 0 8px var(--green);animation:blink 1.5s infinite;}
@keyframes blink{0%,100%{opacity:1;}50%{opacity:.3;}}
.hero h1{font-family:'Exo 2',sans-serif;font-size:clamp(44px,5.5vw,74px);font-weight:900;line-height:.95;letter-spacing:-1px;margin-bottom:22px;}
.hero h1 .gr{background:linear-gradient(90deg,var(--cyan),var(--blue),var(--purple));-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:block;}
.hero-sub{font-size:17px;color:var(--muted);line-height:1.7;max-width:460px;margin-bottom:34px;}
.hero-cta{display:flex;gap:12px;margin-bottom:44px;flex-wrap:wrap;}
.hero-stats{display:flex;gap:28px;padding-top:28px;border-top:1px solid var(--border);}
.hs-num{font-family:'Exo 2',sans-serif;font-size:28px;font-weight:900;color:var(--cyan);}
.hs-lbl{font-size:12px;color:var(--muted);margin-top:2px;}
.hero-sep{width:1px;background:var(--border);}

/* TV MOCKUP */
.tv-frame{background:var(--card);border:1px solid var(--border2);border-radius:18px;overflow:hidden;box-shadow:0 32px 64px rgba(0,0,0,.6);}
.tv-bar{background:var(--card2);border-bottom:1px solid var(--border);padding:10px 14px;display:flex;align-items:center;gap:6px;}
.tvd{width:10px;height:10px;border-radius:50%;}
.tv-screen{aspect-ratio:16/9;background:linear-gradient(135deg,#060610,#0e0e2a,#060620);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;position:relative;overflow:hidden;}
.tv-screen::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 30% 40%,rgba(61,90,254,.2) 0%,transparent 60%),radial-gradient(ellipse at 70% 60%,rgba(0,229,255,.1) 0%,transparent 50%);}
.tv-play{width:60px;height:60px;border-radius:50%;background:rgba(61,90,254,.2);border:2px solid rgba(61,90,254,.4);display:flex;align-items:center;justify-content:center;font-size:22px;position:relative;z-index:1;animation:flt 3s ease-in-out infinite;}
@keyframes flt{0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);}}
.tv-slabel{color:var(--muted);font-size:13px;position:relative;z-index:1;}
.tv-foot{padding:12px 18px;display:flex;align-items:center;justify-content:space-between;}
.tv-fn{font-size:13px;font-weight:600;}
.tv-live{background:var(--red);color:#fff;font-size:9px;font-weight:800;padding:3px 8px;border-radius:4px;letter-spacing:1px;}
.ch-pills{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:12px;}
.ch-pill{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:8px 6px;text-align:center;font-size:11px;font-weight:600;color:var(--muted);transition:all .2s;}
.ch-pill:hover{border-color:var(--blue);color:var(--cyan);}
.fb{position:absolute;background:var(--card);border:1px solid var(--border2);border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(0,0,0,.5);font-size:12px;font-weight:600;animation:fbf 4s ease-in-out infinite;z-index:3;}
.fb1{top:-18px;right:-18px;}
.fb2{bottom:28px;left:-28px;animation-delay:1.5s;}
@keyframes fbf{0%,100%{transform:translateY(0);}50%{transform:translateY(-6px);}}

/* SECTIONS */
.sec{padding:90px 60px;}
.sec-inner{max-width:1180px;margin:0 auto;}
.sec-bg2{background:var(--bg2);}
.stag{font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--blue2);margin-bottom:12px;display:block;}
.sh{font-family:'Exo 2',sans-serif;font-size:clamp(28px,3.5vw,46px);font-weight:800;line-height:1.1;margin-bottom:14px;}
.sd{font-size:15px;color:var(--muted);line-height:1.7;max-width:560px;}

/* CONNECT SECTION */
.connect-grid{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center;margin-top:50px;}
.dev-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.dcard{background:var(--card);border:1px solid var(--border);border-radius:var(--r);padding:22px 18px;position:relative;overflow:hidden;transition:all .25s;}
.dcard::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--grad);opacity:0;transition:opacity .25s;}
.dcard:hover{transform:translateY(-3px);border-color:var(--border2);}
.dcard:hover::after{opacity:1;}
.di{font-size:28px;margin-bottom:10px;}
.dn{font-size:14px;font-weight:600;margin-bottom:4px;}
.dd{font-size:12px;color:var(--muted);}
.form-wrap{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:34px;}
.form-wrap h3{font-family:'Exo 2',sans-serif;font-size:21px;font-weight:800;margin-bottom:6px;}
.form-wrap .fd{color:var(--muted);font-size:13px;line-height:1.6;margin-bottom:22px;}
.fg{margin-bottom:14px;}
.fg label{display:block;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);margin-bottom:6px;}
.fg input,.fg select{width:100%;background:var(--bg3);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;color:var(--text);font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color .2s;appearance:none;}
.fg input:focus,.fg select:focus{border-color:var(--blue);}
.fg input::placeholder{color:var(--border2);}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.form-success{display:none;text-align:center;padding:28px 0;}
.form-success .si{font-size:50px;margin-bottom:12px;}

/* CHANNELS */
.ch-tags{display:flex;flex-wrap:wrap;gap:10px;margin-top:36px;}
.ch-tag{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:10px 16px;display:flex;align-items:center;gap:10px;font-size:13px;font-weight:500;transition:all .2s;cursor:default;}
.ch-tag:hover{border-color:var(--blue);color:var(--blue2);}
.ch-count-box{display:inline-flex;align-items:center;gap:20px;margin-top:36px;background:rgba(0,229,255,.06);border:1px solid rgba(0,229,255,.15);border-radius:14px;padding:18px 26px;}
.cc-num{font-family:'Exo 2',sans-serif;font-size:50px;font-weight:900;color:var(--cyan);line-height:1;}

/* DEVICES */
.dev-big{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px;}
.dbc{background:var(--card);border:1px solid var(--border);border-radius:var(--r);padding:28px 22px;transition:all .25s;}
.dbc:hover{border-color:var(--border2);transform:translateY(-4px);}
.dbi{font-size:34px;margin-bottom:12px;}
.dbn{font-size:15px;font-weight:700;margin-bottom:8px;}
.dbd{font-size:13px;color:var(--muted);line-height:1.5;margin-bottom:12px;}
.dbl{font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--blue2);text-decoration:none;}

/* FAQ */
.faq-g{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:46px;}
.faq-item{background:var(--card);border:1px solid var(--border);border-radius:var(--r);overflow:hidden;}
.faq-q{padding:16px 18px;display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-size:14px;font-weight:500;gap:12px;transition:color .2s;}
.faq-q:hover{color:var(--blue2);}
.faq-icon{width:24px;height:24px;border-radius:50%;background:var(--border);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;transition:all .25s;font-style:normal;}
.faq-item.open .faq-icon{transform:rotate(45deg);background:rgba(61,90,254,.25);color:var(--blue2);}
.faq-a{padding:0 18px;max-height:0;overflow:hidden;font-size:13px;color:var(--muted);line-height:1.7;transition:all .3s;}
.faq-item.open .faq-a{padding:0 18px 16px;max-height:200px;}

/* CONTACT BANNER */
.contact-banner{background:var(--bg2);border-top:1px solid var(--border);padding:72px 60px;text-align:center;}
.c-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:28px;}
.c-row{display:flex;gap:36px;justify-content:center;flex-wrap:wrap;margin-top:44px;padding-top:36px;border-top:1px solid var(--border);}
.ci{text-align:center;}
.ci-lbl{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:6px;}
.ci-val{font-size:15px;font-weight:700;color:var(--cyan);text-decoration:none;}

/* FOOTER */
footer{background:var(--bg);border-top:1px solid var(--border);padding:44px 60px;}
.foot-g{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:36px;max-width:1180px;margin:0 auto;}
.foot-logo{font-family:'Exo 2',sans-serif;font-size:18px;font-weight:900;letter-spacing:3px;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:10px;}
.foot-about{font-size:13px;color:var(--muted);line-height:1.7;max-width:240px;}
.foot-col h4{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:12px;}
.foot-col a{display:block;font-size:13px;color:var(--pale);text-decoration:none;margin-bottom:8px;transition:color .2s;}
.foot-col a:hover{color:var(--blue2);}
.foot-bot{max-width:1180px;margin:28px auto 0;padding-top:24px;border-top:1px solid var(--border);display:flex;justify-content:space-between;font-size:12px;color:var(--muted);}

/* MODAL */
.overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);backdrop-filter:blur(10px);z-index:1000;align-items:center;justify-content:center;padding:20px;}
.overlay.on{display:flex;}
.modal{background:var(--card2);border:1px solid var(--border2);border-radius:18px;padding:38px;width:100%;max-width:420px;position:relative;animation:mIn .3s ease;}
@keyframes mIn{from{opacity:0;transform:scale(.96) translateY(10px);}to{opacity:1;transform:none;}}
.mx{position:absolute;top:14px;right:14px;background:var(--border);border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;color:var(--text);font-size:14px;display:flex;align-items:center;justify-content:center;transition:background .2s;}
.mx:hover{background:var(--blue);}
.m-logo{font-family:'Exo 2',sans-serif;font-size:18px;font-weight:900;letter-spacing:2px;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:6px;}
.modal h2{font-family:'Exo 2',sans-serif;font-size:20px;font-weight:800;margin-bottom:4px;}
.modal .mp{color:var(--muted);font-size:13px;margin-bottom:20px;}
.modal .btn{width:100%;padding:13px;font-size:14px;margin-top:4px;}
.m-sw{text-align:center;margin-top:14px;font-size:13px;color:var(--muted);}
.m-sw a{color:var(--blue2);cursor:pointer;}
.m-demo{margin-top:14px;padding:11px 14px;background:rgba(61,90,254,.08);border:1px solid rgba(61,90,254,.2);border-radius:10px;font-size:12px;color:var(--muted);line-height:1.9;}
.merr{color:var(--red);font-size:12px;margin-top:4px;display:none;}

/* TOAST */
.toast{position:fixed;bottom:22px;right:22px;z-index:9999;background:var(--card2);border:1px solid var(--border2);border-radius:10px;padding:12px 16px;font-size:13px;font-weight:500;transform:translateX(130%);transition:transform .3s;box-shadow:0 8px 24px rgba(0,0,0,.5);max-width:300px;}
.toast.show{transform:translateX(0);}
.toast.ok{border-left:3px solid var(--green);}
.toast.err{border-left:3px solid var(--red);}
.toast.inf{border-left:3px solid var(--blue2);}

/* RESPONSIVE */
@media(max-width:1024px){
  .nav{padding:0 20px;}
  .nav-links{display:none;}
  .hero{padding:90px 20px 50px;}
  .hero-inner{grid-template-columns:1fr;gap:40px;text-align:center;}
  .hero-sub,.hero-cta,.hero-stats{margin-left:auto;margin-right:auto;}
  .hero-cta,.hero-stats{justify-content:center;}
  .sec{padding:60px 20px;}
  .connect-grid,.dev-big,.faq-g{grid-template-columns:1fr;}
  .contact-banner{padding:60px 20px;}
  footer{padding:36px 20px;}
  .foot-g{grid-template-columns:1fr 1fr;}
  .foot-bot{flex-direction:column;gap:8px;text-align:center;}
}
</style>
</head>
<body>

<nav class="nav" id="nav">
  <a href="/" class="nav-logo">STREAM MAX</a>
  <div class="nav-links">
    <a href="#connect">Подключиться</a>
    <a href="#channels">Каналы</a>
    <a href="#devices">Устройства</a>
    <a href="#faq">Вопросы</a>
  </div>
  <div class="nav-right">
    <a href="tel:<?=SITE_PHONE?>" class="nav-phone">📞 <?=SITE_PHONE?></a>
    <button class="btn btn-outline btn-sm" onclick="openAuth('login')">Войти</button>
    <button class="btn btn-primary btn-sm" onclick="openAuth('reg')">Регистрация</button>
  </div>
</nav>

<!-- HERO -->
<div class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-inner">
    <div>
      <div class="hero-tag"><div class="live-dot"></div>Прямой эфир прямо сейчас</div>
      <h1>Бесплатное<br>интернет<br><span class="gr">телевидение</span></h1>
      <p class="hero-sub">Более 1000 каналов на любом устройстве — смартфон, телевизор, планшет, компьютер. Регистрируйтесь и начните смотреть прямо сейчас.</p>
      <div class="hero-cta">
        <a href="#connect" class="btn btn-cyan" style="font-size:15px;padding:14px 30px;">🎁 Подключиться бесплатно</a>
        <a href="#channels" class="btn btn-outline" style="font-size:15px;padding:14px 30px;">Смотреть каналы</a>
      </div>
      <div class="hero-stats">
        <div><div class="hs-num">1000+</div><div class="hs-lbl">каналов</div></div>
        <div class="hero-sep" style="height:36px"></div>
        <div><div class="hs-num">4K</div><div class="hs-lbl">качество</div></div>
        <div class="hero-sep" style="height:36px"></div>
        <div><div class="hs-num">14 дн.</div><div class="hs-lbl">архив</div></div>
        <div class="hero-sep" style="height:36px"></div>
        <div><div class="hs-num">24/7</div><div class="hs-lbl">поддержка</div></div>
      </div>
    </div>
    <div style="position:relative">
      <div class="fb fb1">🔴 <span>Сейчас в эфире: 1000+ каналов</span></div>
      <div class="fb fb2">✅ <span>Архив передач 14 дней</span></div>
      <div class="tv-frame">
        <div class="tv-bar">
          <div class="tvd" style="background:#ff5f57"></div>
          <div class="tvd" style="background:#ffbd2e;margin-left:5px"></div>
          <div class="tvd" style="background:#28c840;margin-left:5px"></div>
          <span style="margin-left:10px;font-size:12px;color:var(--muted)">STREAM MAX Player</span>
        </div>
        <div class="tv-screen">
          <div class="tv-play">▶</div>
          <div class="tv-slabel">Выберите канал для просмотра</div>
        </div>
        <div class="tv-foot">
          <span class="tv-fn">Прямой эфир</span>
          <span class="tv-live">LIVE</span>
        </div>
      </div>
      <div class="ch-pills">
        <div class="ch-pill">📰 Новости</div><div class="ch-pill">⚽ Спорт</div>
        <div class="ch-pill">🎬 Кино</div><div class="ch-pill">🧒 Детские</div>
        <div class="ch-pill">🎭 Сериалы</div><div class="ch-pill">🎵 Музыка</div>
        <div class="ch-pill">📚 Образование</div><div class="ch-pill">🌍 Докум.</div>
      </div>
    </div>
  </div>
</div>

<!-- CONNECT -->
<div class="sec sec-bg2" id="connect">
  <div class="sec-inner">
    <span class="stag">🎁 Подключение</span>
    <div class="sh">Бесплатный доступ —<br>без карты и обязательств</div>
    <p class="sd">Выберите устройство и оставьте заявку. Наш специалист настроит всё за вас в тот же день.</p>
    <div class="connect-grid">
      <div>
        <div class="dev-grid">
          <div class="dcard"><div class="di">📺</div><div class="dn">Smart TV</div><div class="dd">Без приставки, напрямую на ваш телевизор</div></div>
          <div class="dcard"><div class="di">📱</div><div class="dn">Смартфон</div><div class="dd">Android, iOS, iPhone, iPad</div></div>
          <div class="dcard"><div class="di">💻</div><div class="dn">Компьютер</div><div class="dd">Windows и Mac, прямо в браузере</div></div>
          <div class="dcard"><div class="di">📦</div><div class="dn">MAG / DUNE</div><div class="dd">Все популярные IPTV-приставки</div></div>
        </div>
        <div style="margin-top:18px;padding:16px;background:rgba(0,229,255,.05);border:1px solid rgba(0,229,255,.15);border-radius:12px;">
          <div style="font-size:13px;font-weight:600;color:var(--cyan);margin-bottom:6px;">💡 Нужна помощь с подключением?</div>
          <p style="font-size:13px;color:var(--muted);line-height:1.6;">Оставьте заявку — наш специалист свяжется с вами и настроит всё под ключ в тот же день.</p>
        </div>
      </div>
      <div class="form-wrap">
        <h3>Получить доступ бесплатно</h3>
        <p class="fd">Заполните форму — мы свяжемся с вами сегодня.</p>
        <div id="lead-form">
          <div class="frow">
            <div class="fg"><label>Имя</label><input id="lf-name" type="text" placeholder="Ваше имя"></div>
            <div class="fg"><label>Телефон</label><input id="lf-phone" type="tel" placeholder="05X-XXX-XXXX"></div>
          </div>
          <div class="fg"><label>Email</label><input id="lf-email" type="email" placeholder="your@email.com"></div>
          <div class="fg"><label>Устройство</label>
            <select id="lf-device">
              <option value="">Выберите устройство</option>
              <option>Smart TV</option><option>Android TV</option><option>iPhone / iPad</option>
              <option>Android смартфон</option><option>Компьютер Windows</option>
              <option>MAG приставка</option><option>DUNE HD</option><option>Плейлист M3U</option>
            </select>
          </div>
          <div class="fg"><label>Откуда узнали о нас?</label>
            <select id="lf-src">
              <option value="">Выберите источник</option>
              <option>Instagram</option><option>TikTok</option><option>Facebook</option>
              <option>Google</option><option>Telegram</option><option>От друга</option>
            </select>
          </div>
          <button class="btn btn-cyan" style="width:100%;padding:14px;font-size:14px;margin-top:4px;" onclick="submitLead()">🚀 Получить доступ бесплатно</button>
          <p style="text-align:center;font-size:11px;color:var(--muted);margin-top:8px;">🔒 Ваши данные защищены.</p>
        </div>
        <div class="form-success" id="lead-success">
          <div class="si">✅</div>
          <h3 style="font-family:'Exo 2',sans-serif;font-size:19px;font-weight:800;color:var(--green);">Заявка принята!</h3>
          <p style="font-size:13px;color:var(--muted);margin-top:8px;">Наш специалист свяжется с вами сегодня.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CHANNELS -->
<div class="sec" id="channels">
  <div class="sec-inner">
    <span class="stag">📡 Каталог каналов</span>
    <div class="sh">1000+ каналов на любой вкус</div>
    <p class="sd">Спорт, кино, новости, детские, образовательные — всё в одном месте, без антенн.</p>
    <div class="ch-tags">
      <div class="ch-tag"><span style="font-size:18px">📰</span>Новости</div>
      <div class="ch-tag"><span style="font-size:18px">⚽</span>Спорт</div>
      <div class="ch-tag"><span style="font-size:18px">🎬</span>Кино</div>
      <div class="ch-tag"><span style="font-size:18px">🎭</span>Сериалы</div>
      <div class="ch-tag"><span style="font-size:18px">🧒</span>Детские</div>
      <div class="ch-tag"><span style="font-size:18px">📚</span>Образование</div>
      <div class="ch-tag"><span style="font-size:18px">🎵</span>Музыка</div>
      <div class="ch-tag"><span style="font-size:18px">🌍</span>Документальные</div>
      <div class="ch-tag"><span style="font-size:18px">🎮</span>Игры и киберспорт</div>
      <div class="ch-tag"><span style="font-size:18px">🍳</span>Кулинария</div>
      <div class="ch-tag"><span style="font-size:18px">🌐</span>Международные</div>
      <div class="ch-tag"><span style="font-size:18px">💃</span>Развлечения</div>
    </div>
    <div class="ch-count-box">
      <div class="cc-num">1000+</div>
      <div>
        <div style="font-size:15px;font-weight:700;">каналов в пакете</div>
        <div style="font-size:13px;color:var(--muted);margin-top:3px;">SD · HD · Full HD · 4K</div>
      </div>
      <a href="#connect" class="btn btn-cyan" style="margin-left:16px;">Смотреть бесплатно</a>
    </div>
  </div>
</div>

<!-- DEVICES -->
<div class="sec sec-bg2" id="devices">
  <div class="sec-inner">
    <span class="stag">📲 Устройства</span>
    <div class="sh">Работает на всех устройствах</div>
    <p class="sd">Настройка за 3–5 минут с нашей пошаговой инструкцией.</p>
    <div class="dev-big">
      <div class="dbc"><div class="dbi">📺</div><div class="dbn">Smart TV</div><div class="dbd">Фирменное приложение без приставок и сложной настройки.</div><a href="#connect" class="dbl">Инструкция →</a></div>
      <div class="dbc"><div class="dbi">🤖</div><div class="dbn">Android TV</div><div class="dbd">Приложение для Android-приставок и телевизоров.</div><a href="#connect" class="dbl">Инструкция →</a></div>
      <div class="dbc"><div class="dbi">🍎</div><div class="dbn">iPhone / iPad</div><div class="dbd">iOS-приложение и Apple TV. Просмотр на ходу.</div><a href="#connect" class="dbl">Инструкция →</a></div>
      <div class="dbc"><div class="dbi">📱</div><div class="dbn">Android</div><div class="dbd">Смартфон или планшет, плейлист в любом IPTV-плеере.</div><a href="#connect" class="dbl">Инструкция →</a></div>
      <div class="dbc"><div class="dbi">💻</div><div class="dbn">Windows / Mac</div><div class="dbd">Прямо в браузере или через фирменное приложение.</div><a href="#connect" class="dbl">Инструкция →</a></div>
      <div class="dbc"><div class="dbi">📦</div><div class="dbn">MAG / DUNE HD</div><div class="dbd">Все популярные IPTV-приставки с пошаговой настройкой.</div><a href="#connect" class="dbl">Инструкция →</a></div>
    </div>
  </div>
</div>

<!-- FAQ -->
<div class="sec" id="faq">
  <div class="sec-inner">
    <span class="stag">❓ Вопросы и ответы</span>
    <div class="sh">Часто задаваемые вопросы</div>
    <div class="faq-g">
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Что такое IPTV? <em class="faq-icon">+</em></div><div class="faq-a">IPTV — телевидение через интернет. Вместо кабеля или спутника вы получаете каналы через интернет-провайдер на любое устройство.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Как подключиться? <em class="faq-icon">+</em></div><div class="faq-a">Оставьте заявку на сайте. Наш специалист свяжется с вами и настроит под ваше устройство. Занимает 3–5 минут.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Какая скорость интернета нужна? <em class="faq-icon">+</em></div><div class="faq-a">Для HD достаточно 10 Мбит/с. Для 4K рекомендуется от 25 Мбит/с. Стандартное домашнее подключение подходит.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">На скольких устройствах можно смотреть? <em class="faq-icon">+</em></div><div class="faq-a">Можно подключить несколько устройств одновременно — смартфон, планшет, телевизор и компьютер.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Есть ли архив передач? <em class="faq-icon">+</em></div><div class="faq-a">Да, доступен архив за последние 14 дней. Пропустили передачу — найдёте её в архиве.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Какое качество изображения? <em class="faq-icon">+</em></div><div class="faq-a">Большинство каналов в HD и Full HD. Часть контента в 4K. Зависит от источника канала.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Как часто обновляются каналы? <em class="faq-icon">+</em></div><div class="faq-a">Постоянно добавляем каналы по запросам пользователей. Нет нужного — напишите нам.</div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Что делать при проблемах? <em class="faq-icon">+</em></div><div class="faq-a">Обращайтесь в техподдержку по телефону <?=SITE_PHONE?>. Помогаем круглосуточно без выходных.</div></div>
    </div>
  </div>
</div>

<!-- CONTACT -->
<div class="contact-banner">
  <span class="stag" style="display:block;text-align:center;">💬 Поддержка 24/7</span>
  <div class="sh" style="font-family:'Exo 2',sans-serif;font-size:clamp(24px,3vw,40px);font-weight:800;line-height:1.1;text-align:center;">Нужна помощь с подключением?</div>
  <p style="color:var(--muted);font-size:15px;text-align:center;margin-top:10px;">Наш специалист настроит всё за вас — бесплатно и в тот же день.</p>
  <div class="c-btns">
    <a href="tel:<?=SITE_PHONE?>" class="btn btn-cyan" style="font-size:15px;padding:14px 32px;">📞 Позвонить</a>
    <a href="#connect" class="btn btn-outline" style="font-size:15px;padding:14px 32px;">Оставить заявку</a>
  </div>
  <div class="c-row">
    <div class="ci"><div class="ci-lbl">Телефон</div><a href="tel:<?=SITE_PHONE?>" class="ci-val"><?=SITE_PHONE?></a></div>
    <div class="ci"><div class="ci-lbl">Email</div><a href="mailto:<?=SITE_EMAIL?>" class="ci-val"><?=SITE_EMAIL?></a></div>
    <div class="ci"><div class="ci-lbl">Telegram</div><a href="#" class="ci-val">@streammax_tv</a></div>
    <div class="ci"><div class="ci-lbl">Режим работы</div><div class="ci-val" style="color:var(--green);">Круглосуточно</div></div>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="foot-g">
    <div><div class="foot-logo">STREAM MAX</div><p class="foot-about">Интернет-телевидение нового поколения. 1000+ каналов на всех ваших устройствах.</p></div>
    <div class="foot-col"><h4>Сервис</h4><a href="#connect">Подключиться</a><a href="#channels">Каналы</a><a href="#devices">Устройства</a></div>
    <div class="foot-col"><h4>Помощь</h4><a href="#faq">Вопросы</a><a href="tel:<?=SITE_PHONE?>">Позвонить</a><a href="#" onclick="openAuth('login')">Личный кабинет</a></div>
    <div class="foot-col"><h4>Компания</h4><a href="#">О нас</a><a href="#">Блог</a><a href="#">Конфиденциальность</a></div>
  </div>
  <div class="foot-bot"><span>© <?=date('Y')?> STREAM MAX</span><span>Интернет-телевидение</span></div>
</footer>

<!-- AUTH MODAL -->
<div class="overlay" id="auth-ov">
  <div class="modal">
    <button class="mx" onclick="closeOv('auth-ov')">×</button>
    <div class="m-logo">STREAM MAX</div>
    <div id="auth-login">
      <h2>Добро пожаловать</h2>
      <p class="mp">Войдите в личный кабинет</p>
      <div class="fg"><label>Логин или Email</label><input id="l-user" type="text" placeholder="Введите логин"><div class="merr" id="l-err"></div></div>
      <div class="fg"><label>Пароль</label><input id="l-pass" type="password" placeholder="Введите пароль"></div>
      <button class="btn btn-primary" onclick="doLogin()">Войти</button>
      <div class="m-sw">Нет аккаунта? <a onclick="switchAuth('reg')">Зарегистрироваться</a></div>
      <div class="m-demo">
        <strong style="color:var(--text)">Демо:</strong><br>
        Admin: <strong style="color:var(--blue2)">admin</strong> / <strong style="color:var(--blue2)">admin123</strong><br>
        User: <strong style="color:var(--cyan)">user</strong> / <strong style="color:var(--cyan)">user123</strong>
      </div>
    </div>
    <div id="auth-reg" style="display:none">
      <h2>Регистрация</h2>
      <p class="mp">Создайте новый аккаунт</p>
      <div class="fg"><label>Имя</label><input id="r-name" type="text" placeholder="Ваше имя"></div>
      <div class="fg"><label>Логин</label><input id="r-user" type="text" placeholder="Придумайте логин"><div class="merr" id="r-err"></div></div>
      <div class="fg"><label>Email</label><input id="r-email" type="email" placeholder="email@example.com"></div>
      <div class="fg"><label>Пароль</label><input id="r-pass" type="password" placeholder="Минимум 6 символов"></div>
      <button class="btn btn-primary" onclick="doReg()">Зарегистрироваться</button>
      <div class="m-sw">Уже есть аккаунт? <a onclick="switchAuth('login')">Войти</a></div>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
const API = 'api/index.php';

// NAV SCROLL
window.addEventListener('scroll', () => {
  document.getElementById('nav').classList.toggle('stuck', scrollY > 50);
});

// FAQ
function toggleFaq(el) {
  const was = el.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
  if (!was) el.classList.add('open');
}

// OVERLAY
function openOv(id)  { document.getElementById(id).classList.add('on'); }
function closeOv(id) { document.getElementById(id).classList.remove('on'); }
document.querySelectorAll('.overlay').forEach(o => {
  o.addEventListener('click', e => { if (e.target === o) o.classList.remove('on'); });
});

// AUTH
function openAuth(mode) { switchAuth(mode); openOv('auth-ov'); }
function switchAuth(m) {
  document.getElementById('auth-login').style.display = m === 'login' ? '' : 'none';
  document.getElementById('auth-reg').style.display = m === 'reg' ? '' : 'none';
}

async function doLogin() {
  const username = document.getElementById('l-user').value.trim();
  const password = document.getElementById('l-pass').value;
  const err = document.getElementById('l-err');
  err.style.display = 'none';
  if (!username || !password) { err.textContent = 'Заполните все поля'; err.style.display = 'block'; return; }
  const res = await api({ action: 'login', username, password });
  if (res.error) { err.textContent = res.error; err.style.display = 'block'; return; }
  closeOv('auth-ov');
  toast('👋 Добро пожаловать!', 'ok');
  setTimeout(() => {
    window.location.href = res.role === 'admin' ? 'admin/' : 'user/';
  }, 800);
}

async function doReg() {
  const name = document.getElementById('r-name').value.trim();
  const username = document.getElementById('r-user').value.trim();
  const email = document.getElementById('r-email').value.trim();
  const password = document.getElementById('r-pass').value;
  const err = document.getElementById('r-err');
  err.style.display = 'none';
  if (!name || !username || !email || !password) { err.textContent = 'Заполните все поля'; err.style.display = 'block'; return; }
  const res = await api({ action: 'register', name, username, email, password });
  if (res.error) { err.textContent = res.error; err.style.display = 'block'; return; }
  closeOv('auth-ov');
  toast('✅ Аккаунт создан!', 'ok');
  setTimeout(() => window.location.href = 'user/', 800);
}

// LEAD FORM
async function submitLead() {
  const name = document.getElementById('lf-name').value.trim();
  const phone = document.getElementById('lf-phone').value.trim();
  if (!name || !phone) { toast('⚠️ Введите имя и телефон', 'err'); return; }
  const res = await api({
    action: 'lead',
    name, phone,
    email: document.getElementById('lf-email').value.trim(),
    device: document.getElementById('lf-device').value,
    source: document.getElementById('lf-src').value
  });
  if (res.ok) {
    document.getElementById('lead-form').style.display = 'none';
    document.getElementById('lead-success').style.display = 'block';
    toast('✅ Заявка принята!', 'ok');
  }
}

// API HELPER
async function api(data) {
  const form = new FormData();
  Object.entries(data).forEach(([k, v]) => form.append(k, v));
  try {
    const r = await fetch(API, { method: 'POST', body: form });
    return await r.json();
  } catch(e) { return { error: 'Ошибка соединения' }; }
}

// TOAST
function toast(msg, type = 'inf') {
  const t = document.getElementById('toast');
  t.textContent = msg; t.className = 'toast ' + type + ' show';
  setTimeout(() => t.classList.remove('show'), 3500);
}
</script>
</body>
</html>
