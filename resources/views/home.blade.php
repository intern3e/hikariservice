<!DOCTYPE html>
<html lang="th" data-theme="blue-soft">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Hikari Denki - ผู้เชี่ยวชาญด้านระบบไฟฟ้า</title>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="https://img2.pic.in.th/pic/logohikari.png">
  <!-- พรีโหลดรูป splash เพื่อให้ขึ้นไว -->
  <link rel="preload" as="image" href="https://img5.pic.in.th/file/secure-sv1/-1a4e40a993810a3e6.jpg"/>

  <style>
    :root{
      --brand:#2563eb; --brand-dark:#1e40af; --brand-deep:#172554;
      --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --bg:#ffffff;
      --radius:14px; --header-h:74px; --max-w:1280px;
    }

    *,*::before,*::after{ box-sizing:border-box; margin:0; padding:0; }
    html{ scroll-behavior:smooth; scroll-padding-top:var(--header-h); }
    body{
      font-family:'Sarabun','Noto Sans Thai',sans-serif;
      color:var(--ink); background:var(--bg); line-height:1.6;
    }

    /* ===== HEADER ===== */
    header{
      position:sticky; top:0; z-index:50;
      background:rgba(255,255,255,0.9);
      backdrop-filter:blur(10px);
      border-bottom:1px solid #e2e8f0;
      box-shadow:0 2px 8px rgba(0,0,0,0.05);
      transition:all .3s ease;
    }
    header.scrolled{ background:rgba(255,255,255,0.95); box-shadow:0 4px 20px rgba(0,0,0,0.08); }

    .nav-container{
      max-width:var(--max-w); margin-inline:auto;
      padding:0 16px; height:var(--header-h);
      display:flex; align-items:center; gap:16px;
    }

    .logo{ display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--brand-dark); font-weight:700; font-size:1.25rem; }
    .logo img{ height:42px; border-radius:8px; }

    /* desktop menu */
    .nav-desktop ul{ list-style:none; display:flex; gap:24px; }
    .nav-desktop a{
      text-decoration:none; color:var(--ink); font-weight:700;
      padding:8px 10px; position:relative; transition:.25s;
    }
    .nav-desktop a::after{
      content:""; position:absolute; left:0; right:0; bottom:0; height:2px; background:var(--brand);
      transform:scaleX(0); transition:transform .25s ease;
    }
    .nav-desktop a:hover, .nav-desktop a.active{ color:var(--brand-dark); }
    .nav-desktop a:hover::after, .nav-desktop a.active::after{ transform:scaleX(1); }

    .right{ display:flex; align-items:center; gap:16px; margin-left:auto; }
    .contact-item a{ color:var(--ink); font-weight:600; text-decoration:none; }
    .contact-item a:hover{ color:var(--brand-dark); }

    .btn-quote{
      background:linear-gradient(90deg,var(--brand),var(--brand-dark));
      color:#fff; padding:10px 18px; border-radius:999px; font-weight:700; text-decoration:none;
      box-shadow:0 4px 12px rgba(37,99,235,0.25); transition:all .3s ease;
    }
    .btn-quote:hover{ transform:translateY(-2px); }
    .btn-quote.wide{ display:block; text-align:center; padding:14px 18px; border-radius:16px; }

    /* ===== HERO ===== */
    .hero{
      position:relative; min-height:500px; display:flex; align-items:center; justify-content:center;
      color:#fff; text-align:center; overflow:hidden;
    }
    .hero::after{ content:none; }

    /* ===== ABOUT (เก่า basic) ===== */
    .about-section{ padding:100px 20px; background:#f9fafb; }
    .about-section .container{ max-width:1280px; margin:0 auto; }

    /* ===== Drawer (mobile) ===== */
    .burger{
      margin-left:auto; width:36px; height:36px;
      border:0; background:transparent; cursor:pointer;
      display:none; place-items:center; color:#0b132a;
    }
    .burger svg{ width:22px; height:22px; display:block; }
    .burger[aria-expanded="false"] .close-icon{ display:none; }
    .burger[aria-expanded="true"]  .burger-icon{ display:none; }

    #backdrop{ position:fixed; inset:0; background:rgba(15,23,42,.38); opacity:0; visibility:hidden; transition:opacity .2s ease; z-index:60; }
    #backdrop.show{ opacity:1; visibility:visible; }

    #drawer{
      position:fixed; top:0; right:0; height:100dvh; width:min(420px,88vw);
      background:#fff; box-shadow:-16px 0 32px rgba(15,23,42,.12);
      transform:translateX(100%); transition:transform .28s ease; z-index:61;
      display:flex; flex-direction:column;
    }
    #drawer.open{ transform:translateX(0); }
    .drawer-head{ display:flex; align-items:center; justify-content:space-between; padding:14px 18px; border-bottom:1px solid var(--line); }
    .drawer-brand{ display:flex; align-items:center; gap:10px; }
    .drawer-brand img{ height:34px; border-radius:8px; }
    .drawer-close{ font-size:20px; border:0; background:transparent; cursor:pointer; color:#0b132a; }

    .drawer-body{ padding:16px 18px 22px; overflow:auto; display:grid; gap:16px; }
    .drawer-nav ul{ list-style:none; display:grid; gap:10px; }
    .drawer-nav a{ text-decoration:none; color:#0b132a; font-weight:800; padding:10px 4px; display:block; }
    .drawer-nav a.active,.drawer-nav a:hover{ color:var(--brand-dark); }

    .drawer-contacts{ display:grid; gap:12px; margin-top:6px; }
    .pill{ display:block; padding:14px 16px; border:1px solid var(--line); border-radius:999px; text-decoration:none; color:#0b132a; font-weight:700; background:#fff; }

    @media (max-width:1024px){
      .nav-desktop{ display:none; }
      .right{ display:none; }
      .burger{ display:inline-grid; }
    }
    @media (min-width:1025px){
      #drawer, #backdrop{ display:none; }
      .burger{ display:none; }
    }

    body.no-scroll{ overflow:hidden; }

    /* ===== ABOUT SECTION STYLE (ใหม่ + พื้นหลังรูป) ===== */
    .about-section{
      position:relative;
      padding:clamp(3rem,6vw,5rem) 1.5rem;
      background:url('https://img2.pic.in.th/pic/-2e07f0337ba49e1a2.png') center/cover no-repeat;
    }

    .about-section::before{
      content:"";
      position:absolute;
      inset:0;
      pointer-events:none;
      background:
        radial-gradient(circle at top left, rgba(248,250,252,0.82), transparent 60%),
        radial-gradient(circle at bottom right, rgba(248,250,252,0.7), transparent 55%);
      opacity:.2; /* ปรับค่าตรงนี้ให้รูปชัด/จางตามต้องการ */
    }

    .about-section *{
      position:relative;
      z-index:1;
    }

    .about-grid{
      max-width:var(--max-w, 1160px);
      margin:0 auto;
      display:grid;
      gap:2.5rem;
      align-items:center;
    }

    .about-text{
      color:var(--ink, #0f172a);
    }

    .about-title{
      font-size:clamp(2.5rem, 3vw, 2rem);
      font-weight:700;
      line-height:1.3;
      margin-bottom:1rem;
    }

    .about-lead{
      font-size:.98rem;
      color:var(--muted, #64748b);
      margin-bottom:1rem;
    }

    .about-body p{
      font-size:.95rem;
      color:var(--muted, #64748b);
      line-height:1.7;
      margin-bottom:.75rem;
    }

    .about-list{
      list-style:none;
      padding:0;
      margin:1.25rem 0 1.75rem;
      display:flex;
      flex-direction:column;
      gap:.6rem;
    }

    .about-list li{
      display:flex;
      align-items:flex-start;
      gap:.5rem;
      font-size:.95rem;
      color:var(--ink, #0f172a);
    }

    .icon-dot{
      flex-shrink:0;
      width:.5rem;
      height:.5rem;
      margin-top:.35rem;
      border-radius:999px;
      background:linear-gradient(135deg, var(--brand, #2563eb), var(--brand-dark, #1e40af));
      box-shadow:0 0 0 4px rgba(37,99,235,0.12);
    }

    .about-meta{
      display:flex;
      flex-wrap:wrap;
      gap:1.25rem;
    }

    .about-stat{
      display:flex;
      align-items:center;
      gap:.5rem;
      padding:.75rem 1rem;
      border-radius:var(--radius, 14px);
      background:#ffffffcc;
      box-shadow:0 10px 30px rgba(15,23,42,0.06);
      backdrop-filter:blur(14px);
    }

    .about-stat-number{
      font-size:1.4rem;
      font-weight:700;
      color:var(--brand, #2563eb);
    }

    .about-stat-label{
      font-size:.8rem;
      line-height:1.4;
      color:var(--muted, #64748b);
    }

    .about-media{
      display:flex;
      justify-content:center;
    }

    .about-media-card{
      position:relative;
      width:min(100%, 620px);
      border-radius:calc(var(--radius, 14px) * 1.2);
      overflow:hidden;
    }

    .about-media-card::before{
      content:"";
      position:absolute;
      inset:-30%;
      background:
        radial-gradient(circle at 0% 0%, rgba(96,165,250,0.38), transparent 60%),
        radial-gradient(circle at 100% 100%, rgba(56,189,248,0.3), transparent 55%);
      opacity:.9;
      mix-blend-mode:screen;
    }

    .about-image{
      position:relative;
      width:100%;
      display:block;
      border-radius:calc(var(--radius, 14px) * .9);
      border:1px solid rgba(148,163,184,0.4);
      box-shadow:0 14px 32px rgba(15,23,42,0.85);
    }

    @media (min-width: 900px){
      .about-grid{
        grid-template-columns:minmax(0, 1.2fr) minmax(0, 1fr);
      }
    }

    @media (max-width: 899.98px){
      .about-grid{
        text-align:left;
      }
      .about-media{
        order:-1;
      }
      .about-section{
        padding-top:3.5rem;
      }
    }
         .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 3rem;
            color: #0047AB;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .section-header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
        }

        .service-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background: linear-gradient(135deg, #0047AB, #0066FF);
            transition: height 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,71,171,0.15);
        }

        .service-card:hover::before {
            height: 100%;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0047AB, #0066FF);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .service-card h3 {
            font-size: 1.6rem;
            color: #0047AB;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .service-card p {
            color: #666;
            line-height: 1.8;
            font-size: 1.05rem;
        }
  </style>
  <style>
  .partners-section {
    padding: 80px 0;
    background: #f3f4f6;
  }

  .partners-section .section-header {
    text-align: center;
    margin-bottom: 48px;
  }

  .partners-section .section-header h2 {
    font-size: clamp(2.4rem, 3.4vw, 3rem);
    margin: 0 0 10px;
    font-weight: 700;
    color: #0056b3;
    letter-spacing: 0.03em;
  }

  .partners-section .section-header p {
    margin: 0 auto;
    max-width: 860px;
    color: #6b7280;
    font-size: 1rem;
    line-height: 1.7;
  }

  .partners-section .section-header::after {
    content: "";
    display: block;
    width: 80px;
    height: 3px;
    border-radius: 999px;
    background: #0056b3;
    margin: 18px auto 0;
    opacity: 0.9;
  }

  .partners-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 24px;
  }

  /* กล่องคอลัมน์หลักของแต่ละหมวด */
  .partner-group {
    background: #ffffff;
    border-radius: 26px;
    border: 1px solid #e5e7eb;
    padding: 18px 18px 22px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    display: flex;
    flex-direction: column;
    min-height: 100%;
  }

  /* สีแถบด้านบนแต่ละหมวด */
  .partner-group--ups {
    border-top: 5px solid #22c55e;
  }
  .partner-group--battery {
    border-top: 5px solid #1d4ed8;
  }
  .partner-group--emergency {
    border-top: 5px solid #f59e0b;
  }
  .partner-group--fire {
    border-top: 5px solid #f97373;
  }

  /* หัวหมวด */
  .partner-group-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding: 4px 4px 0;
  }

  .partner-icon {
    width: 26px;
    height: 26px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #1d4ed8;
    font-size: 14px;
  }

  .partner-group-title {
    font-size: 0.98rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
    white-space: nowrap;
  }

  .partner-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e5e7eb;
    padding: 18px 24px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 120px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
  }

  .partner-card:hover {
    transform: translateY(-2px);
    border-color: #bfdbfe;
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.1);
  }

  .partner-card img {
    max-width: 100%;
    max-height: 70px;
    object-fit: contain;
    display: block;
  }

  /* Responsive */
  @media (max-width: 1200px) {
    .partners-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  @media (max-width: 640px) {
    .partners-grid {
      grid-template-columns: 1fr;
    }

    .partners-section {
      padding: 56px 0;
    }
  }
</style>
</head>

<body>
  <!-- ===== HEADER ===== -->
  <header id="header">
    <div class="nav-container">
      <a href="#home" class="logo">
        <img src="{{ asset('storage/logohikari.png') }}" alt="Hikari Denki">
        HikariDenki
      </a>

      <!-- เมนูเดสก์ท็อป -->
      <nav class="nav-desktop">
        <ul>
          <li><a href="/" class="active">หน้าแรก</a></li>
          <li><a href="Service">บริการ</a></li>
          <li><a href="about">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <div class="right">
      <div class="contact-item">
        <a href="tel:0660975697">
        066-097-5697 <span class="text-black/75">(คุณ ผักบุ้ง)</span>
        </a>
      </div>

        <div class="contact-item"><a href="mailto:Info@hikaripower.com">Info@hikaripower.com</a></div>
        <a class="btn-quote" href="#contact">ขอใบเสนอราคา</a>
      </div>

      <!-- 3 ขีดแบบ SVG (มือถือ) -->
      <button class="burger" id="burger" aria-expanded="false" aria-controls="drawer" aria-label="Open menu">
        <svg class="burger-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4 7h16M4 12h16M4 17h16"
                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" fill="none"/>
        </svg>
        <svg class="close-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M6 6L18 18M6 18L18 6"
                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" fill="none"/>
        </svg>
      </button>
    </div>
  </header>

  <!-- Backdrop + Drawer -->
  <div id="backdrop" aria-hidden="true"></div>
  <aside id="drawer" role="dialog" aria-modal="true" aria-labelledby="drawerTitle">
    <div class="drawer-head">
      <div class="drawer-brand">
        <img src="{{ asset('storage/logohikari.png') }}" alt="Hikari Denki">
        <strong id="drawerTitle">HikariDenki</strong>
      </div>
      <button id="drawerClose" class="drawer-close" aria-label="Close menu">✕</button>
    </div>

    <div class="drawer-body">
      <nav class="drawer-nav">
        <ul>
          <li><a href="#home" class="active">หน้าแรก</a></li>
          <li><a href="#services">บริการ</a></li>
          <li><a href="#about">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <div class="drawer-contacts">
        <a class="pill" href="tel:0990802197">📞 099-080-2197</a>
        <a class="pill" href="mailto:Info@hikaripower.com">✉️ Info@hikaripower.com</a>
        <a class="pill" href="https://line.me/R/ti/p/@hikaridenki" target="_blank" rel="noopener">💬 LINE</a>
      </div>

      <a class="btn-quote wide" href="#contact">ขอใบเสนอราคา</a>
    </div>
  </aside>

  <!-- ===== HERO SECTION ===== -->
  <section id="home" class="hero"
    style="
      position:relative;
      height:70dvh;
      min-height:70vh;
      overflow:hidden;
    "
  >
    <!-- Splash 3 วิ -->
    <div id="heroSplash"
         style="position:absolute; inset:0; z-index:5;
                background:url('https://img2.pic.in.th/pic/-5e7daa1930914e9b7.jpg') center/cover no-repeat;
                opacity:1; transition:opacity .6s ease;"
         aria-label="opening image" role="img"></div>

    <!-- โปสเตอร์ท้ายคลิป -->
    <div id="endPoster"
         style="position:absolute; inset:0; z-index:4; pointer-events:none;
                background:url('https://img2.pic.in.th/pic/-5e7daa1930914e9b7.jpg') center/cover no-repeat;
                opacity:0; transition:opacity .6s ease;"></div>

    <!-- พื้นหลัง YouTube -->
    <div id="ytbg"
         style="
          position:absolute; top:50%; left:50%;
          width:max(100vw, 142.23vh);
          height:max(56.25vw, 80vh);
          transform:translate(-50%,-50%);
          z-index:-2; pointer-events:none; border:0;">
    </div>

    <!-- วิดีโอไฟล์ภายใน (fallback) -->
    <video id="heroFallback" muted playsinline preload="auto"
      style="
        opacity:0; transition:opacity .6s ease;
        position:absolute; top:50%; left:50%;
        width:max(100vw, 142.23vh);
        height:max(56.25vw, 80vh);
        transform:translate(-50%,-50%);
        object-fit:cover; z-index:-3;">
      <source src="{{ asset('assets/hikari-hero.mp4') }}" type="video/mp4">
    </video>

    <div aria-hidden="true" style="display:none"></div>
  </section>

  <!-- ===== ABOUT SECTION ===== -->
  <section id="about" class="about-section">
    <div class="container about-grid">
      <!-- ฝั่งข้อความ -->
      <div class="about-text">
        <h2 class="about-title">ผู้เชี่ยวชาญระบบไฟฟ้า</h2>
        <h2 class="about-title">และ ระบบป้องกันอัคคีภัยครบวงจร</h2>
        <p class="about-lead">
          เราคือผู้ให้บริการโซลูชันด้านระบบไฟฟ้าและระบบป้องกันอัคคีภัยที่มีความเชี่ยวชาญในระดับสากล<br>
          มุ่งมั่นมอบบริการที่มีคุณภาพสูงสุด เพื่อความปลอดภัยและประสิทธิภาพสูงสุดของธุรกิจคุณ
        </p>
        <div class="about-body">
          <p>
            ด้วยทีมงานมืออาชีพที่มีประสบการณ์มากกว่า <strong>10 ปี</strong> ให้บริการครบวงจรตั้งแต่การให้คำปรึกษา
            ออกแบบ ติดตั้ง จนถึงการบำรุงรักษาระบบ เพื่อให้มั่นใจว่าระบบของคุณจะทำงานได้อย่างมีประสิทธิภาพและปลอดภัยสูงสุด
          </p>
          <p>
            เรานำเข้าและจัดจำหน่ายสินค้าจากแบรนด์ชั้นนำระดับโลก พร้อมให้การรับประกันและบริการหลังการขายที่ครบวงจร
            เพราะความพึงพอใจและความปลอดภัยของคุณคือความสำเร็จของเรา
          </p>
        </div>

        <ul class="about-list">
          <li>
            <span class="icon-dot"></span>
            ออกแบบและติดตั้งระบบไฟฟ้าโรงงาน อาคารสำนักงาน และคลังสินค้า
          </li>
          <li>
            <span class="icon-dot"></span>
            ระบบป้องกันอัคคีภัยและความปลอดภัยตามมาตรฐานสากล
          </li>
          <li>
            <span class="icon-dot"></span>
            ทีมวิศวกรพร้อมให้คำปรึกษาและดูหน้างานจริงทั่วประเทศ
          </li>
        </ul>

        <div class="about-meta">
          <div class="about-stat">
            <span class="about-stat-number">10+</span>
            <span class="about-stat-label">ปีแห่งประสบการณ์<br>ด้านระบบไฟฟ้า</span>
          </div>
          <div class="about-stat">
            <span class="about-stat-number">300+</span>
            <span class="about-stat-label">โครงการที่ลูกค้า<br>ไว้วางใจเรา</span>
          </div>
        </div>
      </div>

      <!-- ฝั่งรูปภาพ -->
      <div class="about-media">
        <div class="about-media-card">
          <img src="{{ asset('storage/HikariDenkiUpdate.png') }}" alt="Hikari Denki" class="about-image">
          <div class="about-chip-row"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SCRIPTS ===== -->
  <script>
    // sticky effect
    const headerEl = document.getElementById('header');
    addEventListener('scroll', () => headerEl.classList.toggle('scrolled', scrollY > 20));

    // Drawer controls
    const burger = document.getElementById('burger');
    const drawer = document.getElementById('drawer');
    const backdrop = document.getElementById('backdrop');
    const drawerClose = document.getElementById('drawerClose');

    const openDrawer = () => {
      burger.setAttribute('aria-expanded','true');
      drawer.classList.add('open');
      backdrop.classList.add('show');
      document.body.classList.add('no-scroll');
    };
    const closeDrawer = () => {
      burger.setAttribute('aria-expanded','false');
      drawer.classList.remove('open');
      backdrop.classList.remove('show');
      document.body.classList.remove('no-scroll');
    };

    burger.addEventListener('click', openDrawer);
    drawerClose.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);
    addEventListener('keydown', e => { if(e.key==='Escape') closeDrawer(); });
    drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));

    // ===== Splash + Fallback + YouTube =====
    (function(){
      const VIDEO_ID = 'TlPy5AS7Keo';
      const SPLASH_MS = 3000;
      const splash   = document.getElementById('heroSplash');
      const fallback = document.getElementById('heroFallback');
      const endPoster = document.getElementById('endPoster');
      let ytLoadedInTime = false, ytPlayer = null;

      setTimeout(() => {
        splash.style.opacity = '0';
        setTimeout(() => { splash.style.display = 'none'; }, 650);
      }, SPLASH_MS);

      function showEndPoster(){
        try { ytPlayer?.stopVideo?.(); } catch(e){}
        try { fallback.pause(); } catch(e){}
        endPoster.style.opacity = '1';
      }

      setTimeout(() => {
        if (!ytLoadedInTime) {
          try {
            fallback.currentTime = 0;
            fallback.play().catch(()=>{});
            fallback.style.zIndex = -1;
            fallback.style.opacity = 1;
            fallback.addEventListener('ended', showEndPoster, { once:true });
          } catch(e){}
        }
      }, 4000);

      const tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      document.head.appendChild(tag);

      window.onYouTubeIframeAPIReady = function(){
        ytPlayer = new YT.Player('ytbg', {
          videoId: VIDEO_ID,
          playerVars: {
            autoplay: 1, mute: 1, controls: 0, playsinline: 1,
            modestbranding: 1, rel: 0, origin: window.location.origin
          },
          events: {
            onReady: (e) => {
              ytLoadedInTime = true;
              try { e.target.mute(); e.target.playVideo(); } catch(_) {}
            },
            onStateChange: (e) => {
              if (e.data === YT.PlayerState.ENDED) { showEndPoster(); }
            }
          }
        });
      };
    })();
  </script>

<style>
  .service-thumb {
    position: relative;
    width: 350px;
    height: 220px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  .service-thumb img.service-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    display: block;
    transition: opacity 0.45s ease-in-out;
  }

  .service-thumb img.overlay {
    opacity: 0; /* รูปชั้นบนเริ่มซ่อน */
  }

  .service-card {
    cursor: pointer; /* ให้รู้ว่ากรอบนี้มีเอฟเฟกต์ */
  }
</style>

<section id="services">
  <div class="container">
    <div class="section-header fade-in">
      <br>
      <h2>บริการของเรา</h2>
    </div>

    <div class="services-grid">

      <!-- การ์ด 1: เปลี่ยนแบตเตอรี่ UPS -->
      <div class="service-card"
           data-images='[
             "https://img5.pic.in.th/file/secure-sv1/S__66887831_0.jpg",
             "https://img2.pic.in.th/pic/S__66887834_0.jpg",
             "https://img2.pic.in.th/pic/S__66887789_0.jpg"
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img5.pic.in.th/file/secure-sv1/S__66887831_0.jpg"
            alt="บริการเปลี่ยนแบตเตอรี่ UPS"
          >
          <img
            class="service-img overlay"
            src="https://img5.pic.in.th/file/secure-sv1/S__66887831_0.jpg"
            alt=""
          >
        </div>
        <br>
        <h3>บริการเปลี่ยนแบตเตอรี่ UPS</h3>
        <p>
          ตรวจเช็คระบบเครื่องสำรองไฟฟ้า บริการเปลี่ยนแบตเตอรี่ UPS ทุกยี่ห้อ
          ด้วยทีมช่างมืออาชีพ พร้อมรับประกันคุณภาพและบริการหลังการขาย
        </p>
      </div>

      <!-- การ์ด 2: Report Test -->
      <div class="service-card"
           data-images='[
             "https://img5.pic.in.th/file/secure-sv1/image0d278ff5aaa81553.png",
             "https://img5.pic.in.th/file/secure-sv1/image985cb2601cdfe027.png",
             "https://img5.pic.in.th/file/secure-sv1/imagee9911b84a1cd86b5.png"
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img5.pic.in.th/file/secure-sv1/image0d278ff5aaa81553.png"
            alt="ออกเอกสารรับรอง Report Test"
          >
          <img
            class="service-img overlay"
            src="https://img5.pic.in.th/file/secure-sv1/image0d278ff5aaa81553.png"
            alt=""
          >
        </div>
        <br>
        <h3>ออกเอกสารรับรอง Report Test</h3>
        <p>
          ทดสอบและรายงานผลการทำงานของระบบอย่างละเอียด
          ออกเอกสารรับรองมาตรฐาน พร้อมรายงานการทดสอบระบบไฟฟ้าและระบบป้องกันอัคคีภัย
        </p>
      </div>

      <!-- การ์ด 3: Fire Alarm Test -->
      <div class="service-card"
           data-images='[
             "https://img2.pic.in.th/pic/image8a3aa2b31d794ba9.png",
             "https://img5.pic.in.th/file/secure-sv1/Screenshot-2025-11-05-091610.png",
             "https://img5.pic.in.th/file/secure-sv1/Screenshot-2025-11-05-091731.png"
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img2.pic.in.th/pic/image8a3aa2b31d794ba9.png"
            alt="ตรวจสอบระบบ Fire Alarm"
          >
          <img
            class="service-img overlay"
            src="https://img2.pic.in.th/pic/image8a3aa2b31d794ba9.png"
            alt=""
          >
        </div>
        <br>
        <h3>ตรวจสอบระบบ Fire Alarm</h3>
        <p>
          ตรวจสอบและบำรุงรักษาระบบแจ้งเหตุเพลิงไหม้ในอาคาร
          โดยผู้เชี่ยวชาญ ให้ทำงานได้อย่างมีประสิทธิภาพตามมาตรฐานสากล
        </p>
      </div>

      <!-- การ์ด 4: Fire Alarm Products -->
      <div class="service-card"
           data-images='[
             "https://img5.pic.in.th/file/secure-sv1/imagee51a99716a72db96.png",
             "https://img5.pic.in.th/file/secure-sv1/image340f1428ff177675.png",
             "https://img5.pic.in.th/file/secure-sv1/image73cc15fd2ba810ba.png"
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img5.pic.in.th/file/secure-sv1/imagee51a99716a72db96.png"
            alt="จำหน่ายอุปกรณ์ Fire Alarm"
          >
          <img
            class="service-img overlay"
            src="https://img5.pic.in.th/file/secure-sv1/imagee51a99716a72db96.png"
            alt=""
          >
        </div>
        <br>
        <h3>จำหน่ายอุปกรณ์ Fire Alarm</h3>
        <p>
          จำหน่ายอุปกรณ์ระบบแจ้งเหตุเพลิงไหม้และระบบไฟฉุกเฉิน ครบวงจร
          ตู้ควบคุม เครื่องตรวจจับควัน สัญญาณเตือน จากแบรนด์ชั้นนำระดับสากล
        </p>
      </div>

      <!-- การ์ด 5: Electrical Products -->
      <div class="service-card"
           data-images='[
             "https://img2.pic.in.th/pic/image03e1d2bccde4be21.png",
             "https://drive.google.com/thumbnail?id=1cO3mFMXPrT3atxCpNY4dWYwj2ywXfSTP&sz=w1000",
             "https://drive.google.com/thumbnail?id=1a7eErFfx6HAyCjx9d_ndR-Heq8O6RTtt&sz=w1000"
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img2.pic.in.th/pic/image03e1d2bccde4be21.png"
            alt="จำหน่ายอุปกรณ์ไฟฟ้า"
          >
          <img
            class="service-img overlay"
            src="https://img2.pic.in.th/pic/image03e1d2bccde4be21.png"
            alt=""
          >
        </div>
        <br>
        <h3>จำหน่ายอุปกรณ์ไฟฟ้า</h3>
        <p>
          จำหน่าย แบตเตอรี่, UPS, Emergency Light, Exit Sign รูปแบบต่างๆ ตามมาตรฐานสากล
          สินค้าคุณภาพ พร้อมให้คำปรึกษาเลือกสินค้าที่เหมาะสม
        </p>
      </div>

      <!-- การ์ด 6: Consult & After Sale -->
      <div class="service-card"
           data-images='[
           ]'>
        <div class="service-thumb">
          <img
            class="service-img base"
            src="https://img2.pic.in.th/pic/image6b4e6528b11be905.png"
            alt="ให้คำปรึกษาและบริการหลังการขาย"
          >
          <img
            class="service-img overlay"
            src="https://img2.pic.in.th/pic/image6b4e6528b11be905.png"
            alt=""
          >
        </div>
        <br>
        <h3>ให้คำปรึกษาและบริการ</h3>
        <p>
          ทีมงานมืออาชีพพร้อมให้คำปรึกษาฟรี แนะนำระบบที่เหมาะสมกับความต้องการ
          พร้อมบริการหลังการขายและรับประกันอย่างต่อเนื่อง
        </p>
      </div>

      <br>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.service-card');

    cards.forEach(card => {
      const thumb = card.querySelector('.service-thumb');
      const baseImg = thumb ? thumb.querySelector('img.base') : null;
      const overlayImg = thumb ? thumb.querySelector('img.overlay') : null;
      const imagesStr = card.getAttribute('data-images');

      if (!baseImg || !overlayImg || !imagesStr) return;

      let images;
      try {
        images = JSON.parse(imagesStr);
      } catch (e) {
        console.error('JSON data-images ไม่ถูกต้องในการ์ดนี้', e, card);
        return;
      }

      if (!images || images.length <= 1) return;

      // พรีโหลดรูปทุกใบของการ์ดนี้
      images.forEach(url => {
        const preImg = new Image();
        preImg.src = url;
      });

      // ตั้งต้นให้ base/overlay เป็นรูปตัวแรกใน data-images
      baseImg.src = images[0];
      overlayImg.src = images[0];

      let index = 0;
      let timer = null;
      let isAnimating = false;

      function showNextImage() {
        if (isAnimating) return;
        isAnimating = true;

        const nextIndex = (index + 1) % images.length;
        const nextUrl = images[nextIndex];

        overlayImg.src = nextUrl;
        overlayImg.style.opacity = '1';

        setTimeout(() => {
          baseImg.src = nextUrl;
          overlayImg.style.opacity = '0';
          index = nextIndex;
          isAnimating = false;
        }, 450); // ให้ตรงกับ transition 0.45s
      }

      function startSlide() {
        if (timer) return;
        timer = setInterval(showNextImage, 800); // เปลี่ยนทุก 0.8 วิ ตอนชี้เมาส์
      }

      function stopSlide() {
        if (!timer) return;
        clearInterval(timer);
        timer = null;
        isAnimating = false;
        overlayImg.style.opacity = '0';
      }

      // ชี้ตรงไหนก็ได้ในกรอบการ์ด → รูปเริ่มเปลี่ยน
      card.addEventListener('mouseenter', startSlide);
      card.addEventListener('mouseleave', stopSlide);
    });
  });
</script>




<section id="partners" class="partners-section">
  <div class="container">
    <div class="section-header">
      <h2>พันธมิตรแบรนด์ชั้นนำ</h2>
      <p>
        เราทำงานร่วมกับผู้ผลิตระดับสากล เพื่อส่งมอบโซลูชันที่เชื่อถือได้สำหรับองค์กรของคุณ
      </p>
    </div>

    <div class="partners-grid">
      <!-- UPS เครื่องสำรองไฟ -->
      <div class="partner-group partner-group--ups">
        <div class="partner-group-header">
          <span class="partner-icon">🔌</span>
          <h3 class="partner-group-title">UPS เครื่องสำรองไฟ</h3>
        </div>

        <div class="partner-card">
          <img src="{{ asset('storage/partner/apc.png') }}" alt="APC logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/cyberpower-seeklogo.png') }}" alt="CyberPower logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/delta-electronics-seeklogo.png') }}" alt="Delta logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/eaton-seeklogo.png') }}" alt="Eaton logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/schneider.png') }}" alt="Schneider logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/vertiv-seeklogo.png') }}" alt="Vertiv logo">
        </div>
      </div>

      <!-- แบตเตอรี่ -->
      <div class="partner-group partner-group--battery">
        <div class="partner-group-header">
          <span class="partner-icon">🔋</span>
          <h3 class="partner-group-title">แบตเตอรี่</h3>
        </div>

        <div class="partner-card">
          <img src="{{ asset('storage/partner/long.png') }}" alt="Long Battery logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/accu.png') }}" alt="Accu logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/csb-battery-seeklogo.png') }}" alt="CSB logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/Leoch Battery.png') }}" alt="Leoch logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/panasonic-seeklogo.png') }}" alt="Panasonic logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/yuasa-seeklogo.png') }}" alt="Yuasa logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/cyberpower-seeklogo.png') }}" alt="CyberPower logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/eaton-seeklogo.png') }}" alt="Eaton logo">
        </div>
      </div>

      <!-- ไฟฉุกเฉิน & ป้ายหนีไฟ -->
      <div class="partner-group partner-group--emergency">
        <div class="partner-group-header">
          <span class="partner-icon">💡</span>
          <h3 class="partner-group-title">ไฟฉุกเฉิน &amp; ป้ายหนีไฟ</h3>
        </div>

        <div class="partner-card">
          <img src="{{ asset('storage/partner/sunny.png') }}" alt="Sunny logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/iwachi.png') }}" alt="Iwachi logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/dyno.png') }}" alt="Dyno logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/delight.png') }}" alt="Delight logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/bec.png') }}" alt="BEC logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/safeguard.png') }}" alt="Safeguard logo">
        </div>
        <div class="partner-card">
          <img src="{{ asset('storage/partner/MAXBRIGHT.png') }}" alt="Maxbright logo">
        </div>
      </div>

      <!-- ระบบแจ้งเหตุเพลิงไหม้ -->
      <div class="partner-group partner-group--fire">
        <div class="partner-group-header">
          <span class="partner-icon">⚡</span>
          <h3 class="partner-group-title">ระบบแจ้งเหตุเพลิงไหม้</h3>
        </div>

        <div class="partner-card">
          <img src="{{ asset('storage/partner/notifier-seeklogo.png') }}" alt="Notifier logo">
        </div>
      </div>
    </div>
  </div>
</section>



<style>
  /* ============ PowerCare Footer ============ */
  .powercare-footer {
    position: relative;
    color: #f9fafb;
    overflow: hidden;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  .powercare-footer a {
    color: inherit;
    text-decoration: none;
  }

  .powercare-footer a:hover {
    text-decoration: none;
  }

  /* พื้นหลังไล่สี */
  .powercare-footer .pc-footer-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #0a2356, #0b2a6b 45%, #0f4c75);
    z-index: 0;
  }

  /* ฮาโลว์แสงด้านบน/ล่าง */
  .powercare-footer .pc-footer-halos {
    position: absolute;
    inset: 0;
    opacity: 0.12;
    pointer-events: none;
    z-index: 1;
  }

  /* คอนเทนต์ด้านใน */
  .powercare-footer .pc-footer-inner {
    position: relative;
    z-index: 5;
    max-width: 1120px;
    margin: 0 auto;
    padding: 3rem 1.5rem 2.5rem;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-footer-inner {
      padding-top: 4rem;
      padding-bottom: 3rem;
    }
  }

  /* เลย์เอาต์ 2 คอลัมน์ */
  .powercare-footer .pc-footer-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem 2.5rem;
    align-items: flex-start;
  }

  @media (min-width: 768px) {
    .powercare-footer .pc-footer-grid {
      grid-template-columns: minmax(0, 7fr) minmax(0, 5fr);
    }
  }

  .powercare-footer .pc-footer-brand {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  /* หัวข้อ PowerCare */
  .powercare-footer .pc-eyebrow {
    font-size: 0.75rem;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #fbbf24;
  }

  .powercare-footer .pc-title {
    margin-top: 0.25rem;
    font-size: 1.5rem;
    font-weight: 800;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-title {
      font-size: 1.875rem;
    }
  }

  .powercare-footer .pc-tagline {
    margin-top: 0.5rem;
    font-size: 0.95rem;
    line-height: 1.7;
    color: rgba(241, 245, 249, 0.9);
  }

  /* ส่วน contact */
  .powercare-footer .pc-contact {
    margin-top: 1.25rem;
    font-style: normal;
  }

  .powercare-footer .pc-contact-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.75rem;
    font-size: 0.95rem;
    line-height: 1.6;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-contact-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  .powercare-footer .pc-contact-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.7rem;
    background: rgba(255, 255, 255, 0.06);
    transition:
      background-color 0.2s ease,
      transform 0.15s ease,
      box-shadow 0.15s ease;
  }

  .powercare-footer .pc-contact-chip i {
    font-size: 1rem;
  }

  .powercare-footer .pc-contact-chip:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-1px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.4);
  }

  .powercare-footer .pc-text-soft {
    color: rgba(255, 255, 255, 0.75);
  }

  /* รายการ B2B */
  .powercare-footer .pc-b2b {
    margin-top: 0.75rem;
  }

  .powercare-footer .pc-b2b-label {
    font-weight: 600;
    color: #fbbf24;
    margin-bottom: 0.4rem;
  }

  .powercare-footer .pc-b2b-list {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.4rem;
    font-size: 0.93rem;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-b2b-list {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  .powercare-footer .pc-b2b-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .powercare-footer .pc-b2b-item i {
    color: #fbbf24;
  }

  /* การ์ด Map */
  .powercare-footer .pc-map-card {
    border-radius: 1rem;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.16);
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.6);
  }

  .powercare-footer .pc-map-header,
  .powercare-footer .pc-map-footer {
    padding: 1rem;
    border-color: rgba(255, 255, 255, 0.2);
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-map-header,
    .powercare-footer .pc-map-footer {
      padding: 1.25rem;
    }
  }

  .powercare-footer .pc-map-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .powercare-footer .pc-map-title {
    font-weight: 600;
  }

  /* ปุ่มหลัก */
  .powercare-footer .pc-button-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem 0.9rem;
    font-size: 0.9rem;
    border-radius: 0.7rem;
    background: #ffffff;
    color: #0b2a6b;
    border: none;
    cursor: pointer;
    transition:
      background-color 0.2s ease,
      color 0.2s ease,
      transform 0.15s ease,
      box-shadow 0.15s ease;
  }

  .powercare-footer .pc-button-primary:hover {
    background: #fbbf24;
    color: #000;
    transform: translateY(-1px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.5);
  }

  /* กล่อง Map */
  .powercare-footer .pc-map-wrapper {
    position: relative;
    background: rgba(15, 23, 42, 0.6);
    aspect-ratio: 16 / 10;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-map-wrapper {
      aspect-ratio: 16 / 9;
    }
  }

  .powercare-footer .pc-map-badge {
    position: absolute;
    inset: 0;
    pointer-events: none;
  }

  .powercare-footer .pc-map-badge-inner {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    border-radius: 0.75rem;
    background: rgba(255, 255, 255, 0.96);
    padding: 0.45rem 0.75rem;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.45);
    border: 1px solid rgba(15, 23, 42, 0.08);
  }

  .powercare-footer .pc-map-badge-inner span {
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.3;
    color: #0f172a;
  }

  .powercare-footer #gmap {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }

  /* ปุ่ม Map ด้านล่าง (เฉพาะมือถือ) */
  .powercare-footer .pc-map-footer {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
  }

  .powercare-footer .pc-map-footer .pc-button-primary {
    width: 100%;
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-map-footer {
      display: none;
    }
  }

  /* แถบล่างสุด */
  .powercare-footer .pc-bottom-bar {
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.18);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-items: flex-start;
    justify-content: space-between;
    font-size: 0.85rem;
    color: rgba(249, 250, 251, 0.85);
  }

  @media (min-width: 640px) {
    .powercare-footer .pc-bottom-bar {
      flex-direction: row;
      align-items: center;
    }
  }

  .powercare-footer .pc-bottom-links {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .powercare-footer .pc-bottom-links a {
    opacity: 0.9;
    transition: opacity 0.2s ease;
  }

  .powercare-footer .pc-bottom-links a:hover {
    opacity: 1;
  }

  .powercare-footer .pc-bottom-separator {
    opacity: 0.5;
  }

  .powercare-footer .tabular-nums {
    font-variant-numeric: tabular-nums;
  }
</style>

<footer class="powercare-footer" role="contentinfo" aria-label="PowerCare footer">
  <!-- Gradient background -->
  <div class="pc-footer-bg"></div>
  <!-- Soft light halos -->
  <div
    class="pc-footer-halos"
    style="
      background:
        radial-gradient(900px 280px at 15% -10%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0)),
        radial-gradient(700px 240px at 85% 110%, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0));
    "
  ></div>

  <!-- Content -->
  <div class="pc-footer-inner">
    <div class="pc-footer-grid">
      <!-- Brand & tagline -->
      <section class="pc-footer-brand">
        <div>
          <p class="pc-eyebrow">HikariDenki</p>
          <h2 class="pc-title">Service by HikariDenki</h2>
          <p class="pc-tagline">
            โซลูชันระบบไฟสำรองสำหรับองค์กร — ติดตั้ง บำรุงรักษา ตรวจรับรอง โดยทีมวิศวกรมืออาชีพ
          </p>
        </div>

        <!-- Contact -->
        <address class="pc-contact">
          <div class="pc-contact-grid">
            <a
              href="tel:+66660975697"
              class="pc-contact-chip"
              aria-label="โทร 066-097-5697"
            >
              <i class="bi bi-telephone"></i>
              <span>
                066-097-5697
                <span class="pc-text-soft">(คุณ ผักบุ้ง)</span>
              </span>
            </a>

            <a href="tel:0990802197" class="pc-contact-chip">
              <i class="bi bi-telephone"></i>
              <span>
                099-080-2197
                <span class="pc-text-soft">(คุณ ผักบุ้ง)</span>
              </span>
            </a>

            <a href="tel:021172995" class="pc-contact-chip">
              <i class="bi bi-telephone-inbound"></i>
              <span>
                02-117-2995
                <span class="pc-text-soft">(ติดต่อสำนักงาน)</span>
              </span>
            </a>

            <a
              href="mailto:Info@hikaripower.com"
              class="pc-contact-chip"
              rel="nofollow noopener"
              onclick="return openEmail(event, 'Info@hikaripower.com', { subject: 'สอบถามสินค้าของ hikaridenki' });"
            >
              <i class="bi bi-envelope"></i>
              <span>Info@hikaripower.com</span>
            </a>
          </div>

          <div class="pc-b2b">
            <p class="pc-b2b-label">พร้อมสำหรับงาน B2B</p>
            <ul class="pc-b2b-list">
              <li class="pc-b2b-item">
                <i class="bi bi-receipt-cutoff"></i>
                <span>ใบเสนอราคา / PO / ใบกำกับภาษี</span>
              </li>
              <li class="pc-b2b-item">
                <i class="bi bi-building-check"></i>
                <span>รองรับเครดิตเทอมองค์กร</span>
              </li>
              <li class="pc-b2b-item">
                <i class="bi bi-award"></i>
                <span>ทีมวิศวกรมีใบรับรอง</span>
              </li>
            </ul>
          </div>
        </address>
      </section>

      <!-- Map & CTA -->
      <section class="pc-footer-map">
        <div class="pc-map-card">
          <div class="pc-map-header">
            <h3 class="pc-map-title">บริษัท ฮิคาริ เดงกิ จำกัด</h3>
            <a
              href="https://www.google.com/maps/place/%E0%B8%97%E0%B8%A3%E0%B8%B4%E0%B8%9B%E0%B9%80%E0%B8%9B%E0%B8%B4%E0%B9%89%E0%B8%A5+%E0%B8%AD%E0%B8%B5+%E0%B9%80%E0%B8%97%E0%B8%A3%E0%B8%94%E0%B8%94%E0%B8%B4%E0%B9%89%E0%B8%87/@13.717683,100.473264,1929m/data=!3m1!1e3!4m6!3m5!1s0x30e2991a367db98b:0x4c961d180eb9153f!8m2!3d13.717683!4d100.4732644!16s%2Fg%2F1xg5q33q?hl=th&entry=ttu"
              target="_blank"
              rel="noopener"
              class="pc-button-primary"
              aria-label="เปิดตำแหน่งบน Google Maps"
            >
              <i class="bi bi-geo-alt-fill"></i>
              <span>เปิดใน Google Maps</span>
            </a>
          </div>

          <!-- กล่องแผนที่ + ป้ายชื่อซ้อนทับ -->
          <div class="pc-map-wrapper">
            <div class="pc-map-badge">
              <div class="pc-map-badge-inner">
                <span>บริษัท ฮิคาริ เดงกิ จำกัด</span>
              </div>
            </div>

            <!-- ใช้ iframe ฝัง Google Maps -->
            <iframe
              id="gmap"
              src="https://www.google.com/maps?q=13.717683,100.473264&hl=th&z=17&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen
            ></iframe>
          </div>

          <!-- ปุ่มล่าง (มือถือ) -->
          <div class="pc-map-footer">
            <a
              href="https://www.google.com/maps/place/%E0%B8%97%E0%B8%A3%E0%B8%B4%E0%B8%9B%E0%B9%80%E0%B8%9B%E0%B8%B4%E0%B9%89%E0%B8%A5+%E0%B8%AD%E0%B8%B5+%E0%B9%80%E0%B8%97%E0%B8%A3%E0%B8%94%E0%B8%94%E0%B8%B4%E0%B9%89%E0%B8%87/@13.717683,100.473264,1929m/data=!3m1!1e3!4m6!3m5!1s0x30e2991a367db98b:0x4c961d180eb9153f!8m2!3d13.717683!4d100.4732644!16s%2Fg%2F1xg5q33q?hl=th&entry=ttu"
              target="_blank"
              rel="noopener"
              class="pc-button-primary"
            >
              <i class="bi bi-map"></i>
              <span>เปิดใน Google Maps</span>
            </a>
          </div>
        </div>
      </section>
    </div>

    <!-- Bottom bar -->
    <div class="pc-bottom-bar">
      <p>
        © <span class="tabular-nums">{{ date('Y') }}</span> Service by HikariDenki. สงวนลิขสิทธิ์.
      </p>
      <div class="pc-bottom-links">
        <a href="#">นโยบายความเป็นส่วนตัว</a>
        <span class="pc-bottom-separator">•</span>
        <a href="#">ข้อตกลงการใช้งาน</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
