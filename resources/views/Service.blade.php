<!DOCTYPE html>
<html lang="th" data-theme="blue-soft">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Hikari Denki - ผู้เชี่ยวชาญด้านระบบไฟฟ้า</title>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700&display=swap" rel="stylesheet"/>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="https://img2.pic.in.th/pic/logohikari.png">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js"></script>

  <style>
    :root{
      --brand:#2563eb; --brand-dark:#1e40af; --brand-deep:#172554;
      --ink:#0f172a; --muted:#64748b; --line:#e2e8f0; --bg:#ffffff;
      --radius:14px; --header-h:74px; --max-w:1280px;
    }
    *,*::before,*::after{ box-sizing:border-box; margin:0; padding:0; }
    html{ scroll-behavior:smooth; scroll-padding-top:var(--header-h); }
    body{
      font-family:'Sarabun','Noto Sans Thai',sans-serif;
      color:var(--ink); background:#f1f5f9; line-height:1.6;
    }

    header{
      position:sticky; top:0; z-index:50;
      background:rgba(255,255,255,0.9);
      backdrop-filter:blur(10px);
      border-bottom:1px solid #e2e8f0;
      box-shadow:0 2px 8px rgba(0,0,0,0.05);
      transition:all .3s ease;
    }
    header.scrolled{
      background:rgba(255,255,255,0.95);
      box-shadow:0 4px 20px rgba(0,0,0,0.08);
    }

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
      box-shadow:0 4px 12px rgba(37,99,235,0.25); transition:.25s;
    }
    .btn-quote:hover{ transform:translateY(-2px); }
    .btn-quote.wide{ display:block; text-align:center; padding:14px 18px; border-radius:16px; }

    /* ====== PDF VIEWER ====== */
    #pdfViewport{
      min-height: 90vh;
      padding: 24px 0 72px;
      background: #f8fafc;
      border-radius: 24px;
    }
    .a4-page{
      width: 100%;
      background:#fff;
      border-radius:0px;
      box-shadow:0 18px 40px rgba(15,23,42,.06);
      margin: 0 auto 32px;
      position:relative;
      overflow:hidden;
    }
    .a4-fit{
      position:absolute;
      inset:0;
      padding:0;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .a4-fit>canvas{
      max-width:100%;
      max-height:100%;
      width:auto;
      height:auto;
      display:block;
      border-radius:0px;
    }
    .page-meta{
      position:absolute;
      right:10px;
      bottom:8px;
      font-size:12px;
      color:#64748b;
      background:#ffffffcc;
      padding:2px 8px;
      border-radius:999px
    }
    .loader{
      border:4px solid #e5e7eb;
      border-top:4px solid #0b2a6b;
      border-radius:50%;
      width:36px;
      height:36px;
      animation:spin .9s linear infinite;
      margin:20px auto;
    }
    @keyframes spin{ to{ transform:rotate(360deg);} }

    @media (max-width:640px){
      #pdfViewport{ min-height: 82vh; padding-bottom: 96px; }
    }

    /* ====== SCROLLBAR (ฝั่งซ้าย) ====== */
    @media (min-width:768px){
      .scroll-y::-webkit-scrollbar{ width:8px; }
      .scroll-y::-webkit-scrollbar-thumb{ background:#cbd5e1; border-radius:999px; }
      .scroll-y:hover::-webkit-scrollbar-thumb{ background:#94a3b8; }
    }

    /* ====== SIDE CATEGORY ====== */
    .category-sidebar{
      background:#ffffff;
      border-radius:0;
      border:1px solid var(--line);
      box-shadow:0 4px 10px rgba(15,23,42,0.02);
    }
    .cat-header{
      padding:0.75rem 1rem;
      font-size:0.82rem;
      font-weight:600;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color:#475569;
      background:#f8fafc;
      border-bottom:1px solid var(--line);
    }
    .cat-list{ background:#ffffff; }
    .cat-item{ border-top:1px solid #f1f5f9; }
    .cat-item:first-of-type{ border-top:none; }
    .cat-item summary{
      list-style:none;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:0.75rem;
      padding:0.7rem 1rem;
      cursor:pointer;
      user-select:none;
      background:#ffffff;
      transition:background-color .15s ease;
    }
    .cat-item summary:hover{ background:#f8fafc; }
    .cat-main{
      display:flex;
      align-items:center;
      gap:0.7rem;
      min-width:0;
    }
    .cat-icon{
      width:auto;
      height:auto;
      display:flex;
      align-items:center;
      justify-content:center;
      color:#64748b;
      flex-shrink:0;
      font-size:1.15rem;
    }
    .cat-title{
      font-size:0.95rem;
      font-weight:600;
      color:#0f172a;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }
    .cat-arrow{
      font-size:0.85rem;
      color:#cbd5e1;
      transition:transform .2s ease;
      flex-shrink:0;
    }
    .cat-item[open] .cat-arrow{
      transform:rotate(90deg);
    }

    .cat-sub{
      padding:0.15rem 1rem 0.6rem 2.6rem;
      background:#ffffff;
    }
    .cat-sub-list{
      list-style:none;
      display:flex;
      flex-direction:column;
      gap:0.1rem;
    }

    .cat-chip{
      width:100%;
      text-align:left;
      font-size:0.9rem;
      padding:0.35rem 0;
      border:none;
      border-radius:0;
      background:transparent;
      color:#0f172a;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:0.4rem;
      box-shadow:none;
      transition:background-color .15s ease,color .15s.ease;
    }
    .cat-chip span{
      flex:1;
      overflow:hidden;
      text-overflow:ellipsis;
      white-space:nowrap;
    }
    .cat-chip i{
      font-size:0.9rem;
      color:#cbd5e1;
      flex-shrink:0;
    }
    .cat-chip:hover{
      background:#f3f4f6;
      color:#1d4ed8;
    }
    .cat-chip:hover i{ color:#94a3b8; }

    .cat-sub-group{
      background:transparent;
      border-radius:0;
      padding:0.1rem 0 0.3rem;
      margin-bottom:0.2rem;
      border-left:2px solid #e5e7eb;
      padding-left:0.75rem;
    }
    .cat-sub-group summary{
      list-style:none;
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:0.25rem 0;
      cursor:pointer;
      user-select:none;
    }
    .cat-sub-title{
      font-size:0.9rem;
      font-weight:600;
      color:#0f172a;
    }
    .cat-sub-arrow{
      font-size:0.8rem;
      color:#cbd5e1;
      transition:transform .2s ease;
    }
    .cat-sub-group[open] .cat-sub-arrow{
      transform:rotate(90deg);
    }
    .cat-sub-inner{
      padding:0.15rem 0 0.15rem;
      display:flex;
      flex-direction:column;
      gap:0.1rem;
    }

    @media (max-width:768px){
      .cat-sub{
        padding-left:2.2rem;
      }
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
      transform:translateX(100%); transition:transform .28s ease; z-index:61;
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

    /* ===== Footer (เดิม) ===== */
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
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
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
      .powercare-footer .pc-map-wrapper { aspect-ratio: 16 / 9; }
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
      transition: opacity 0.2s.ease;
    }
    .powercare-footer .pc-bottom-links a:hover { opacity: 1; }
    .powercare-footer .pc-bottom-separator { opacity: 0.5; }
    .powercare-footer .tabular-nums {
      font-variant-numeric: tabular-nums;
    }

    /* LINE badge */
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
  </style>
</head>

<body>
@php
    $servicesCollection = collect($services ?? []);
    $normalize = fn($v) => str_replace(' ', '', trim($v ?? ''));

    $upsByBrand = $servicesCollection
        ->filter(fn($s) => $normalize($s->category) === $normalize('UPSเครื่องสำรองไฟ'))
        ->groupBy('brand')
        ->sortKeys();

    // ไฟฉุกเฉินและป้ายหนีไฟ: ย้ายแบรนด์ที่ขึ้นต้นด้วย S ขึ้นก่อน
    $emerByBrand = $servicesCollection
        ->filter(fn($s) => $normalize($s->category) === $normalize('ไฟฉุกเฉินและป้ายหนีไฟ'))
        ->groupBy('brand')
        ->sortBy(function ($items, $brand) {
            $first = strtoupper(substr(trim($brand), 0, 1));
            $priority = ($first === 'S') ? 0 : 1;   // S มาก่อน แล้วค่อยตัวอื่น
            return $priority.'_'.$brand;           // เรียงต่อด้วยชื่อแบรนด์ปกติ
        });

    $batteryByBrand = $servicesCollection
        ->filter(fn($s) => $normalize($s->category) === $normalize('แบตเตอรี่'))
        ->groupBy('brand')
        ->sortKeys();

    $defaultPdfPath = asset('storage/partner/h.pdf');
@endphp


  <!-- HEADER -->
  <header id="header">
    <div class="nav-container">
      <a href="/" class="logo">
        <img src="{{ asset('storage/logohikari.png') }}" alt="Hikari Denki">
        HikariDenki
      </a>

      <nav class="nav-desktop">
        <ul>
          <li><a href="{{ url('/') }}">หน้าแรก</a></li>
          <li><a href="{{ url('service') }}" class="active">บริการ</a></li>
          <li><a href="{{ url('about') }}">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <div class="right">
        <div class="contact-item">
          <a href="tel:0660975697">
            066-097-5697 <span class="text-black/75">(คุณ ผักบุ้ง)</span>
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
      <!-- เมนูหลัก -->
      <nav class="drawer-nav">
        <ul>
          <li><a href="{{ url('/') }}">หน้าแรก</a></li>
          <li><a href="{{ url('service') }}" class="active">บริการ</a></li>
          <li><a href="{{ url('about') }}">เกี่ยวกับเรา</a></li>
        </ul>
      </nav>

      <!-- ติดต่อ (มือถือ) -->
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

      <!-- หมวดหมู่โบรชัวร์ สำหรับมือถือ (ย้ายมาอยู่ใน 3 ขีด) -->
      <hr class="my-4 border-slate-200">

      <nav class="category-sidebar" aria-label="หมวดหมู่โบรชัวร์สินค้า (มือถือ)">
        <div class="cat-header">
          หมวดหมู่โบรชัวร์สินค้า
        </div>
        <div class="cat-list">
          {{-- UPS --}}
          @if($upsByBrand->isNotEmpty())
          <details class="cat-item" open>
            <summary>
              <div class="cat-main">
                <div class="cat-icon">
                  <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <span class="cat-title">UPS เครื่องสำรองไฟ</span>
              </div>
              <i class="bi bi-chevron-right cat-arrow"></i>
            </summary>
            <div class="cat-sub">
              <ul class="cat-sub-list">
                @foreach($upsByBrand as $brand => $items)
                  @php $file = $items->first(); @endphp
                  @if(!empty($file->pdf))
                  <li>
                    <button
                      type="button"
                      class="cat-chip"
                      data-pdf="{{ asset('storage/'.$file->pdf) }}"
                      onclick="handlePdfClick(this)"
                      title="{{ $brand }}"
                    >
                      <span>{{ $brand }}</span>
                      <i class="bi bi-file-earmark-pdf"></i>
                    </button>
                  </li>
                  @endif
                @endforeach
              </ul>
            </div>
          </details>
          @endif

          {{-- EMERGENCY --}}
          @if($emerByBrand->isNotEmpty())
          <details class="cat-item" open>
            <summary>
              <div class="cat-main">
                <div class="cat-icon">
                  <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <span class="cat-title">ไฟฉุกเฉินและป้ายหนีไฟ</span>
              </div>
              <i class="bi bi-chevron-right cat-arrow"></i>
            </summary>
            <div class="cat-sub">
              <ul class="cat-sub-list">
                @foreach($emerByBrand as $brand => $items)
                  @php $file = $items->first(); @endphp
                  @if(!empty($file->pdf))
                  <li>
                    <button
                      type="button"
                      class="cat-chip"
                      data-pdf="{{ asset('storage/'.$file->pdf) }}"
                      onclick="handlePdfClick(this)"
                      title="{{ $brand }}"
                    >
                      <span>{{ $brand }}</span>
                      <i class="bi bi-file-earmark-pdf"></i>
                    </button>
                  </li>
                  @endif
                @endforeach
              </ul>
            </div>
          </details>
          @endif

          {{-- BATTERY --}}
          @if($batteryByBrand->isNotEmpty())
          <details class="cat-item" open>
            <summary>
              <div class="cat-main">
                <div class="cat-icon">
                  <i class="bi bi-battery-full"></i>
                </div>
                <span class="cat-title">แบตเตอรี่</span>
              </div>
              <i class="bi bi-chevron-right cat-arrow"></i>
            </summary>
            <div class="cat-sub">
              @foreach($batteryByBrand as $brand => $items)
                <details class="cat-sub-group" open>
                  <summary>
                    <span class="cat-sub-title">{{ $brand }} Battery</span>
                    <i class="bi bi-chevron-right cat-sub-arrow"></i>
                  </summary>
                  <div class="cat-sub-inner">
                    @foreach($items as $item)
                      @if(!empty($item->pdf))
                      <button
                        type="button"
                        class="cat-chip"
                        data-pdf="{{ asset('storage/'.$item->pdf) }}"
                        onclick="handlePdfClick(this)"
                        title="{{ $item->name_brochure }}"
                      >
                        <span>{{ $item->name_brochure }}</span>
                        <i class="bi bi-file-earmark-pdf"></i>
                      </button>
                      @endif
                    @endforeach
                  </div>
                </details>
              @endforeach
            </div>
          </details>
          @endif
        </div>
      </nav>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="max-w-7xl mx-auto px-3 md:px-6 py-6 grid grid-cols-1 md:grid-cols-[320px,1fr] gap-6">
    <!-- ซ้าย: เมนูหมวดหมู่ (เฉพาะ PC/แท็บเล็ต) -->
    <aside class="hidden md:block">
      <div class="md:max-h-[calc(100vh-8rem)] md:overflow-y-auto overscroll-contain pr-1 scroll-y">
        <nav class="category-sidebar" aria-label="หมวดหมู่โบรชัวร์">
          <div class="cat-header">
            หมวดหมู่โบรชัวร์สินค้า
          </div>
          <div class="cat-list">
            {{-- UPS --}}
            @if($upsByBrand->isNotEmpty())
            <details class="cat-item" open>
              <summary>
                <div class="cat-main">
                  <div class="cat-icon">
                    <i class="bi bi-lightning-charge-fill"></i>
                  </div>
                  <span class="cat-title">UPS เครื่องสำรองไฟ</span>
                </div>
                <i class="bi bi-chevron-right cat-arrow"></i>
              </summary>
              <div class="cat-sub">
                <ul class="cat-sub-list">
                  @foreach($upsByBrand as $brand => $items)
                    @php $file = $items->first(); @endphp
                    @if(!empty($file->pdf))
                    <li>
                      <button
                        type="button"
                        class="cat-chip"
                        data-pdf="{{ asset('storage/'.$file->pdf) }}"
                        onclick="handlePdfClick(this)"
                        title="{{ $brand }}"
                      >
                        <span>{{ $brand }}</span>
                        <i class="bi bi-file-earmark-pdf"></i>
                      </button>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </details>
            @endif

            {{-- EMERGENCY --}}
            @if($emerByBrand->isNotEmpty())
            <details class="cat-item" open>
              <summary>
                <div class="cat-main">
                  <div class="cat-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                  </div>
                  <span class="cat-title">ไฟฉุกเฉินและป้ายหนีไฟ</span>
                </div>
                <i class="bi bi-chevron-right cat-arrow"></i>
              </summary>
              <div class="cat-sub">
                <ul class="cat-sub-list">
                  @foreach($emerByBrand as $brand => $items)
                    @php $file = $items->first(); @endphp
                    @if(!empty($file->pdf))
                    <li>
                      <button
                        type="button"
                        class="cat-chip"
                        data-pdf="{{ asset('storage/'.$file->pdf) }}"
                        onclick="handlePdfClick(this)"
                        title="{{ $brand }}"
                      >
                        <span>{{ $brand }}</span>
                        <i class="bi bi-file-earmark-pdf"></i>
                      </button>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </details>
            @endif

            {{-- BATTERY --}}
            @if($batteryByBrand->isNotEmpty())
            <details class="cat-item" open>
              <summary>
                <div class="cat-main">
                  <div class="cat-icon">
                    <i class="bi bi-battery-full"></i>
                  </div>
                  <span class="cat-title">แบตเตอรี่</span>
                </div>
                <i class="bi bi-chevron-right cat-arrow"></i>
              </summary>
              <div class="cat-sub">
                @foreach($batteryByBrand as $brand => $items)
                  <details class="cat-sub-group" open>
                    <summary>
                      <span class="cat-sub-title">{{ $brand }} Battery</span>
                      <i class="bi bi-chevron-right cat-sub-arrow"></i>
                    </summary>
                    <div class="cat-sub-inner">
                      @foreach($items as $item)
                        @if(!empty($item->pdf))
                        <button
                          type="button"
                          class="cat-chip"
                          data-pdf="{{ asset('storage/'.$item->pdf) }}"
                          onclick="handlePdfClick(this)"
                          title="{{ $item->name_brochure }}"
                        >
                          <span>{{ $item->name_brochure }}</span>
                          <i class="bi bi-file-earmark-pdf"></i>
                        </button>
                        @endif
                      @endforeach
                    </div>
                  </details>
                @endforeach
              </div>
            </details>
            @endif
          </div>
        </nav>
      </div>
    </aside>

    <!-- ขวา: PDF Viewer -->
    <section aria-label="PDF viewer">
      <div id="pdfViewport" class="bg-[#f8fafc] rounded-3xl shadow-sm">
        <div id="pdfContainer" class="mx-auto px-2 py-4"></div>
      </div>
    </section>
  </main>

  <!-- PDF.js renderer -->
  <script>
    (function(){
      const pdfjsLib = window['pdfjsLib'] || window['pdfjs-dist/build/pdf'];
      if (!pdfjsLib) return;

      pdfjsLib.GlobalWorkerOptions.workerSrc =
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

      const container = document.getElementById('pdfContainer');
      const DPR_LIMIT = 2;

      async function renderOnePage(pdf, pageNum){
        const page = await pdf.getPage(pageNum);
        const rotation = (page.rotate || 0) % 360;

        const ref = page.getViewport({ scale: 1, rotation });
        const aspect = ref.width / ref.height;

        const wrap = document.createElement('div');
        wrap.className = 'a4-page';
        const maxWmm = aspect >= 1 ? 297 : 210;
        wrap.style.maxWidth = maxWmm + 'mm';
        wrap.style.aspectRatio = aspect.toFixed(6);
        const fit = document.createElement('div');
        fit.className = 'a4-fit';
        wrap.appendChild(fit);
        container.appendChild(wrap);

        const rect = fit.getBoundingClientRect();
        const cssW = rect.width  || (aspect >= 1 ? 1122 : 794);
        const cssH = rect.height || (aspect >= 1 ? 794  : 1122);
        const dpr  = Math.min(window.devicePixelRatio || 1, DPR_LIMIT);
        const scale = Math.min((cssW * dpr) / ref.width, (cssH * dpr) / ref.height);

        const viewport = page.getViewport({ scale, rotation });

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d', { alpha:false });
        canvas.width  = Math.ceil(viewport.width);
        canvas.height = Math.ceil(viewport.height);
        canvas.style.width  = Math.round(viewport.width  / dpr) + 'px';
        canvas.style.height = Math.round(viewport.height / dpr) + 'px';
        fit.appendChild(canvas);

        const meta = document.createElement('div');
        meta.className = 'page-meta';
        meta.textContent = pageNum + ' / ' + pdf.numPages;
        wrap.appendChild(meta);

        await page.render({ canvasContext: ctx, viewport }).promise;
      }

      window.handlePdfClick = function(btn){
        const pdfPath  = btn.dataset.pdf;
        if (!pdfPath) return;
        showPDF(pdfPath);
      };

      window.showPDF = async function(pdfPath){
        container.innerHTML = `
          <div class="flex flex-col items-center justify-center my-10 text-slate-500 text-sm">
            <div class="loader"></div>
            <p class="mt-3">กำลังโหลดเอกสาร…</p>
          </div>
        `;

        try {
          const pdf = await pdfjsLib.getDocument(pdfPath).promise;
          container.innerHTML = '';
          for (let n = 1; n <= pdf.numPages; n++) {
            await renderOnePage(pdf, n);
          }
        } catch (e) {
          console.error(e);
          container.innerHTML = `
            <div class="flex flex-col items-center justify-center my-10 text-red-500 text-sm text-center px-4">
              <p>โหลดไฟล์ไม่ได้ โปรดตรวจสอบว่าไฟล์ PDF เข้าถึงได้จาก URL นี้:</p>
              <a href="${pdfPath}" target="_blank" class="mt-2 text-blue-600 underline break-all">${pdfPath}</a>
            </div>
          `;
        }
      };

      document.addEventListener("DOMContentLoaded", function(){
        const initialPdf = @json($defaultPdfPath);
        if (initialPdf) {
          showPDF(initialPdf);
        } else {
          container.innerHTML = `
            <div class="flex flex-col items-center justify-center my-10 text-slate-500 text-sm">
              ยังไม่มีไฟล์ PDF ให้แสดง
            </div>
          `;
        }
      });
    })();
  </script>

  <!-- HEADER / DRAWER / LINE & EMAIL helpers -->
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

    // LINE open (ใช้ได้ทั้ง desktop / mobile)
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

    // mail helper (ใช้ใน footer)
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
  </script>

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
</body>
</html>
