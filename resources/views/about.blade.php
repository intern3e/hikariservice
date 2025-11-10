<!DOCTYPE html>
<html lang="th" data-theme="blue-soft">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Hikari Denki - ผู้เชี่ยวชาญด้านระบบไฟฟ้า</title>

  <!-- Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700&display=swap" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="https://img2.pic.in.th/pic/logohikari.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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

    .logo{
      display:flex; align-items:center; gap:10px;
      text-decoration:none; color:var(--brand-dark);
      font-weight:700; font-size:1.25rem;
    }
    .logo img{ height:42px; border-radius:8px; }

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

    .line-chip{
      background:#06C755;
      color:#ffffff;
      padding:4px 12px;
      border-radius:8px;
      font-weight:600;
      display:inline-block;
      text-decoration:none;
      font-size:0.9rem;
    }

    /* ===== Drawer (mobile) ===== */
    .burger{
      margin-left:auto; width:36px; height:36px;
      border:0; background:transparent; cursor:pointer;
      display:none; place-items:center; color:#0b132a;
    }
    .burger svg{ width:22px; height:22px; display:block; }
    .burger[aria-expanded="false"] .close-icon{ display:none; }
    .burger[aria-expanded="true"]  .burger-icon{ display:none; }

    #backdrop{
      position:fixed; inset:0; background:rgba(15,23,42,.38);
      opacity:0; visibility:hidden; transition:opacity .2s ease; z-index:60;
    }
    #backdrop.show{ opacity:1; visibility:visible; }

    #drawer{
      position:fixed; top:0; right:0; height:100dvh; width:min(420px,88vw);
      background:#fff; box-shadow:-16px 0 32px rgba(15,23,42,.12);
      transform:translateX(100%); transition:transform .28s.ease; z-index:61;
      display:flex; flex-direction:column;
    }
    #drawer.open{ transform:translateX(0); }
    .drawer-head{
      display:flex; align-items:center; justify-content:space-between;
      padding:14px 18px; border-bottom:1px solid var(--line);
    }
    .drawer-brand{ display:flex; align-items:center; gap:10px; }
    .drawer-brand img{ height:34px; border-radius:8px; }
    .drawer-close{ font-size:20px; border:0; background:transparent; cursor:pointer; color:#0b132a; }

    .drawer-body{
      padding:16px 18px 22px; overflow:auto; display:grid; gap:16px;
    }
    .drawer-nav ul{ list-style:none; display:grid; gap:10px; }
    .drawer-nav a{
      text-decoration:none; color:#0b132a; font-weight:800;
      padding:10px 4px; display:block;
    }
    .drawer-nav a.active,.drawer-nav a:hover{ color:var(--brand-dark); }

    .drawer-contacts{ display:grid; gap:12px; margin-top:6px; }
    .pill{
      display:block; padding:14px 16px; border:1px solid var(--line);
      border-radius:999px; text-decoration:none; color:#0b132a;
      font-weight:700; background:#fff;
    }

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

    /* ====== โซนเกี่ยวกับเรา + ใบรับรอง ====== */
    .about-cert-area {
      position: relative;
      padding: 64px 16px 56px;
      background:
        radial-gradient(900px 280px at 50% 0,
          rgba(37,99,235,0.06),
          transparent 60%)
        #ffffff;
    }

    .about-brief,
    .cert-section {
      max-width: 1200px;
      margin: 0 auto;
    }

    .about-brief {
      text-align: center;
      margin-bottom: 36px;
    }

    .about-brief-label {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 14px;
      border-radius: 999px;
      font-size: 0.78rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      background: rgba(37,99,235,0.08);
      color: #2563eb;
      margin-bottom: 12px;
    }

    .about-brief h2 {
      font-size: 2.2rem;
      margin: 0 0 10px;
      color: #0f172a;
      letter-spacing: 0.02em;
    }

    .about-brief p {
      margin: 0 auto;
      font-size: 0.96rem;
      line-height: 1.9;
      color: #6b7280;
      max-width: 760px;
    }

    .about-brief strong {
      color: #111827;
      font-weight: 600;
    }

    .cert-section {
      padding-top: 4px;
    }

    .cert-header {
      text-align: center;
      margin-bottom: 10px;
    }

    .cert-header h2 {
      font-size: 2rem;
      font-weight: 700;
      margin: 0;
      color: #0f172a;
      letter-spacing: 0.05em;
    }

    .cert-header h2::after {
      content: "";
      display: block;
      width: 80px;
      height: 3px;
      border-radius: 999px;
      margin: 12px auto 0;
      background: linear-gradient(90deg, #2563eb, #0ea5e9);
    }

    .cert-header p {
      margin: 10px auto 0;
      font-size: 0.95rem;
      color: #6b7280;
      max-width: 520px;
      line-height: 1.7;
    }

    .cert-header p span {
      font-weight: 600;
      color: #111827;
    }

    /* แถวรูปใบเซอร์ */
    .cert-row {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 8px;
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
      padding-top: 16px;
    }

    .cert-item {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .cert-item img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: contain;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .cert-item img:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(15,23,42,0.25);
    }

    @media (max-width: 1024px) {
      .cert-row {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }
    }

    @media (max-width: 768px) {
      .cert-row {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .about-brief h2 { font-size: 1.8rem; }
      .cert-header h2 { font-size: 1.5rem; }
    }

    @media (max-width: 560px) {
      .cert-row {
        grid-template-columns: 1fr;
      }
    }

    /* Modal */
    .cert-modal {
      position: fixed;
      inset: 0;
      background: rgba(15,23,42,0.9);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    .cert-modal.show { display: flex; }

    .cert-modal-inner {
      position: relative;
      max-width: 95vw;
      max-height: 95vh;
    }

    .cert-modal-inner img {
      max-width: 95vw;
      max-height: 90vh;
      display: block;
      border-radius: 8px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.6);
    }

    .cert-modal-close {
      position: absolute;
      top: -10px;
      right: -10px;
      width: 32px;
      height: 32px;
      border-radius: 999px;
      border: none;
      background: rgba(15,23,42,0.9);
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      line-height: 32px;
    }

    /* ============ PowerCare Footer ============ */
    .powercare-footer {
      position: relative;
      color: #f9fafb;
      overflow: hidden;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    .powercare-footer a { color: inherit; text-decoration: none; }
    .powercare-footer a:hover { text-decoration: none; }
    .powercare-footer .pc-footer-bg {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, #0a2356, #0b2a6b 45%, #0f4c75);
      z-index: 0;
    }
    .powercare-footer .pc-footer-halos {
      position: absolute;
      inset: 0;
      opacity: 0.12;
      pointer-events: none;
      z-index: 1;
    }
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
      .powercare-footer .pc-title { font-size: 1.875rem; }
    }
    .powercare-footer .pc-tagline {
      margin-top: 0.5rem;
      font-size: 0.95rem;
      line-height: 1.7;
      color: rgba(241, 245, 249, 0.9);
    }
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
      transition: background-color 0.2s ease, transform 0.15s ease, box-shadow 0.15s ease;
    }
    .powercare-footer .pc-contact-chip i { font-size: 1rem; }
    .powercare-footer .pc-contact-chip:hover {
      background: rgba(255, 255, 255, 0.12);
      transform: translateY(-1px);
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.4);
    }
    .powercare-footer .pc-text-soft { color: rgba(255, 255, 255, 0.75); }
    .powercare-footer .pc-b2b { margin-top: 0.75rem; }
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
    .powercare-footer .pc-b2b-item i { color: #fbbf24; }
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
    .powercare-footer .pc-map-title { font-weight: 600; }
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
      transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease, box-shadow 0.15s ease;
    }
    .powercare-footer .pc-button-primary:hover {
      background: #fbbf24;
      color: #000;
      transform: translateY(-1px);
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.5);
    }
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
    .powercare-footer .pc-map-footer {
      border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    .powercare-footer .pc-map-footer .pc-button-primary { width: 100%; }
    @media (min-width: 640px) {
      .powercare-footer .pc-map-footer { display: none; }
    }
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
    .powercare-footer .pc-bottom-links a:hover { opacity: 1; }
    .powercare-footer .pc-bottom-separator { opacity: 0.5; }
    .powercare-footer .tabular-nums {
      font-variant-numeric: tabular-nums;
    }
  </style>
</head>

<body>
  <!-- ===== HEADER ===== -->
  <header id="header">
    <div class="nav-container">
      <a href="/" class="logo">
        <img src="{{ asset('storage/logohikari.png') }}" alt="Hikari Denki">
        HikariDenki
      </a>

      <nav class="nav-desktop">
        <ul>
          <li><a href="/">หน้าแรก</a></li>
          <li><a href="Service">บริการ</a></li>
          <li><a href="about" class="active">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <div class="right">
        <div class="contact-item">
          <a href="tel:0660975697">
            066-097-5697 <span style="opacity:.75">(คุณ ผักบุ้ง)</span>
          </a>
        </div>

        <div class="contact-item">
          <a
            href="https://mail.google.com/mail/?view=cm&fs=1&to=Info@hikaripower.com&su=ขอใบเสนอราคา"
            target="_blank"
            rel="noopener noreferrer"
          >
            Info@hikaripower.com
          </a>
        </div>

        <!-- LINE desktop -->
        <div>
          <a
            href="https://line.me/R/ti/p/@hikaridenki"
            target="_blank"
            rel="noopener noreferrer"
            class="line-chip"
            onclick="openLine(event)"
          >
            LINE
          </a>
        </div>

        <a
          class="btn-quote"
          href="https://mail.google.com/mail/?view=cm&fs=1&to=Info@hikaripower.com&su=ขอใบเสนอราคา"
          target="_blank"
          rel="noopener noreferrer"
        >
          ขอใบเสนอราคา
        </a>
      </div>

      <!-- 3 ขีด (มือถือ) -->
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
          <li><a href="/">หน้าแรก</a></li>
          <li><a href="Service">บริการ</a></li>
          <li><a href="about" class="active">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <div class="drawer-contacts">
        <a class="pill" href="tel:0990802197">📞 099-080-2197</a>
        <a class="pill" href="mailto:Info@hikaripower.com">✉️ Info@hikaripower.com</a>
        <a class="pill" href="https://line.me/R/ti/p/@hikaridenki" target="_blank" rel="noopener">💬 LINE</a>
      </div>

      <a class="btn-quote wide"
         href="https://mail.google.com/mail/?view=cm&fs=1&to=Info@hikaripower.com&su=ขอใบเสนอราคา"
         target="_blank" rel="noopener noreferrer">
        ขอใบเสนอราคา
      </a>
    </div>
  </aside>

  <!-- ===== CONTENT: ใบรับรอง ===== -->
  <section class="about-cert-area" id="about-and-cert">
    <div class="about-brief">
      <div class="about-brief-label">ภาพชุดรวมใบรับรอง</div>
      <h2>มาตรฐานคุณภาพ และการแต่งตั้งตัวแทนจากแบรนด์ชั้นนำ</h2>
      <p>
        รวบรวมใบรับรองมาตรฐาน ระบบไฟฟ้า ระบบสำรองไฟ และการแต่งตั้งตัวแทนจำหน่าย
        จากผู้ผลิตและแบรนด์ชั้นนำ เพื่อยืนยันความน่าเชื่อถือในการให้บริการของเรา
      </p>
    </div>

    <div class="cert-section" id="certificates">
      <div class="cert-header">
        <h2>ใบรับรอง &amp; Alliance Partner</h2>
        <p><span>รับรองโดยสถาบันและผู้ผลิตชั้นนำ</span> ทั้งในและต่างประเทศ</p>
      </div>

      <div class="cert-row">
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/imagebcedaa5bfa08bbfa.png" alt="certificate 1"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image746db65bdb00c910.png" alt="certificate 2"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/imagef895f4eb3a71a8c3.png" alt="certificate 3"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/image83e72db582a38bbd.png" alt="certificate 4"></div>

        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/imaged46cf2cd4e4c516d.png" alt="certificate 5"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/imagee421781beb77dde3.png" alt="certificate 6"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image9c1db0cf2a2c4443.png" alt="certificate 7"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image84ba159c2a10f822.png" alt="certificate 8"></div>

        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image0442f8f5758eb112.png" alt="certificate 9"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/imagefbd98ec47b05969e.png" alt="certificate 10"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/imagef0afd1e7e293dbaf.png" alt="certificate 11"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/image164c2ea8fe44dc26.png" alt="certificate 12"></div>

        <div class="cert-item"><img src="https://img2.pic.in.th/pic/imagef66376062cd3d27a.png" alt="certificate 13"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/image8845dcb1be35b429.png" alt="certificate 14"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image025f6765b0a7cd36.png" alt="certificate 15"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/imagea3ec8689cd7b889a.png" alt="certificate 16"></div>

        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image2db8ca7cec4f0490.png" alt="certificate 17"></div>
        <div class="cert-item"><img src="https://img5.pic.in.th/file/secure-sv1/image25826fb5920e8503.png" alt="certificate 18"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/image9afbfe456663a1ed.png" alt="certificate 19"></div>
        <div class="cert-item"><img src="https://img2.pic.in.th/pic/image63d4690e61bc3f65.png" alt="certificate 20"></div>
      </div>
    </div>
  </section>

  <!-- Modal รูปใหญ่ -->
  <div class="cert-modal" id="certModal">
    <div class="cert-modal-inner">
      <button class="cert-modal-close" type="button">&times;</button>
      <img src="" alt="certificate large" id="certModalImg">
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="powercare-footer" role="contentinfo" aria-label="PowerCare footer">
    <div class="pc-footer-bg"></div>
    <div
      class="pc-footer-halos"
      style="
        background:
          radial-gradient(900px 280px at 15% -10%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0)),
          radial-gradient(700px 240px at 85% 110%, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0));
      "
    ></div>

    <div class="pc-footer-inner">
      <div class="pc-footer-grid">
        <section class="pc-footer-brand">
          <div>
            <p class="pc-eyebrow">HikariDenki</p>
            <h2 class="pc-title">Service by HikariDenki</h2>
            <p class="pc-tagline">
              โซลูชันระบบไฟสำรองสำหรับองค์กร — ติดตั้ง บำรุงรักษา ตรวจรับรอง โดยทีมวิศวกรมืออาชีพ
            </p>
          </div>

          <address class="pc-contact">
            <div class="pc-contact-grid">
              <a href="tel:+66660975697" class="pc-contact-chip" aria-label="โทร 066-097-5697">
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

            <div class="pc-map-wrapper">
              <div class="pc-map-badge">
                <div class="pc-map-badge-inner">
                  <span>บริษัท ฮิคาริ เดงกิ จำกัด</span>
                </div>
              </div>

              <iframe
                id="gmap"
                src="https://www.google.com/maps?q=13.717683,100.473264&hl=th&z=17&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen
              ></iframe>
            </div>

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

  <!-- ===== JS ===== -->
  <script>
    // sticky header
    const headerEl = document.getElementById('header');
    window.addEventListener('scroll', () => {
      headerEl.classList.toggle('scrolled', window.scrollY > 20);
    });

    // Drawer controls
    const burger = document.getElementById('burger');
    const drawer = document.getElementById('drawer');
    const backdrop = document.getElementById('backdrop');
    const drawerClose = document.getElementById('drawerClose');

    function openDrawer() {
      burger.setAttribute('aria-expanded','true');
      drawer.classList.add('open');
      backdrop.classList.add('show');
      document.body.classList.add('no-scroll');
    }
    function closeDrawer() {
      burger.setAttribute('aria-expanded','false');
      drawer.classList.remove('open');
      backdrop.classList.remove('show');
      document.body.classList.remove('no-scroll');
    }

    burger.addEventListener('click', openDrawer);
    drawerClose.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);
    window.addEventListener('keydown', e => { if(e.key === 'Escape') closeDrawer(); });
    drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));

    // LINE
    function openLine(event){
      event.preventDefault();
      var lineAppUrl = "line://ti/p/@hikaridenki";
      var lineWebUrl = "https://line.me/R/ti/p/@hikaridenki";
      var start = Date.now();
      window.location.href = lineAppUrl;
      setTimeout(function () {
        if (Date.now() - start < 1500) {
          window.open(lineWebUrl, "_blank");
        }
      }, 1000);
    }

    // mail helper (footer)
    function openEmail(e, address, opts) {
      e.preventDefault();
      opts = opts || {};
      const params = new URLSearchParams();
      if (opts.subject) params.append('subject', opts.subject);
      if (opts.body) params.append('body', opts.body);
      const qs = params.toString();
      window.location.href = 'mailto:' + address + (qs ? '?' + qs : '');
      return false;
    }

    // certificate modal
    document.querySelectorAll('.cert-row img').forEach(function (img) {
      img.addEventListener('click', function () {
        var modal = document.getElementById('certModal');
        var modalImg = document.getElementById('certModalImg');
        modalImg.src = this.src;
        modal.classList.add('show');
      });
    });
    (function () {
      var modal = document.getElementById('certModal');
      var closeBtn = modal.querySelector('.cert-modal-close');
      closeBtn.addEventListener('click', function () {
        modal.classList.remove('show');
      });
      modal.addEventListener('click', function (e) {
        if (e.target === modal) {
          modal.classList.remove('show');
        }
      });
    })();
  </script>
</body>
</html>
