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
      --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --bg:#ffffff;
      --radius:14px; --header-h:74px; --max-w:1280px;
    }

    *,*::before,*::after{ box-sizing:border-box; margin:0; padding:0; }
    html{ scroll-behavior:smooth; scroll-padding-top:var(--header-h); }
    body{
      font-family:'Sarabun','Noto Sans Thai',sans-serif;
      color:var(--ink); background:#f1f5f9; line-height:1.6;
    }

    /* HEADER */
    header{
      position:sticky; top:0; z-index:50;
      background:rgba(255,255,255,0.9);
      backdrop-filter:blur(10px);
      border-bottom:1px solid #e2e8f0;
      box-shadow:0 2px 8px rgba(0,0,0,0.05);
      transition:all .3s ease;
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

    @media (max-width:1024px){
      .nav-desktop{ display:none; }
      .right{ display:none; }
    }

    /* PDF VIEWER */
    #pdfViewport{
      min-height: 90vh;
      padding: 24px 0 72px;
      background: #f8fafc;
      border-radius: 24px;
    }
    .a4-page{
      width: 100%;
      max-width: 210mm;
      aspect-ratio: 1 / 1.41421356;
      background:#fff;
      border-radius:18px;
      box-shadow:0 18px 40px rgba(15,23,42,.06);
      margin: 0 auto 32px;
      position:relative;
      overflow:hidden;
    }
    .a4-fit{
      position:absolute;
      inset:0;
      padding:12mm 10mm;
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
      border-radius:8px;
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
      .a4-fit{ padding:10mm 8mm; }
    }

    /* scrollbar ซ้าย */
    @media (min-width:768px){
      .scroll-y::-webkit-scrollbar{ width:8px; }
      .scroll-y::-webkit-scrollbar-thumb{ background:#cbd5e1; border-radius:999px; }
      .scroll-y:hover::-webkit-scrollbar-thumb{ background:#94a3b8; }
    }
  </style>
</head>

<body>
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
        <div class="contact-item"><a href="mailto:Info@hikaripower.com">Info@hikaripower.com</a></div>
        <a class="btn-quote" href="#contact">ขอใบเสนอราคา</a>
      </div>
    </div>
  </header>

  @php
    $servicesCollection = collect($services ?? []);

    // กรองตาม category ภาษาไทยจาก DB
    $upsByBrand = $servicesCollection
        ->where('category', 'UPS เครื่องสำรองไฟ')
        ->groupBy('brand')
        ->sortKeys();

    $emerByBrand = $servicesCollection
        ->where('category', 'ไฟฉุกเฉินและป้ายหนีไฟ')
        ->groupBy('brand')
        ->sortKeys();

    $batteryByBrand = $servicesCollection
        ->where('category', 'แบตเตอรี่')
        ->groupBy('brand')
        ->sortKeys();

    // default PDF = service แรกที่มีไฟล์
    $firstWithPdf = $servicesCollection->first(function($s){ return !empty($s->pdf); });
    $defaultPdfPath = $firstWithPdf ? asset('storage/'.$firstWithPdf->pdf) : null;

    // ปุ่มด้านซ้าย – กรอบยืดตามเนื้อหา
    $chipBox = 'flex items-center justify-center w-full
                h-auto min-h-10 px-4 py-2
                rounded-xl border border-slate-200 bg-white/90 text-slate-700
                shadow-sm transition
                hover:bg-blue-50 hover:border-blue-400 hover:text-blue-700
                focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-300
                active:translate-y-px text-sm
                whitespace-normal break-words';
  @endphp

  <!-- LAYOUT: ซ้ายเมนู / ขวา viewer -->
  <main class="max-w-7xl mx-auto px-3 md:px-6 py-6 grid grid-cols-1 md:grid-cols-[320px,1fr] gap-6">

    <!-- ซ้าย: หมวดหมู่ -->
    <aside class=>
      <div class="md:max-h-[calc(100vh-8rem)] md:overflow-y-auto overscroll-contain pr-1 scroll-y space-y-4">

        {{-- UPS --}}
        @if($upsByBrand->isNotEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-4">
          <div class="text-[11px] font-semibold tracking-[0.2em] text-slate-500 mb-2 uppercase">UPS</div>
          <details class="border border-slate-200 rounded-2xl p-3 group" open>
            <summary class="cursor-pointer font-semibold text-base flex justify-between items-center select-none">
              <span>UPS เครื่องสำรองไฟ</span>
              <i class="bi bi-chevron-down ml-2 text-slate-500 transition-transform duration-200 group-open:rotate-180"></i>
            </summary>
            <ul class="mt-3 grid grid-cols-2 gap-3 text-sm">
              @foreach($upsByBrand as $brand => $items)
                @php $file = $items->first(); @endphp
                @if(!empty($file->pdf))
                <li class="min-w-0">
                  <button type="button" class="{{ $chipBox }}"
                          data-pdf="{{ asset('storage/'.$file->pdf) }}"
                          onclick="handlePdfClick(this)"
                          title="{{ $brand }}">
                    <span class="truncate">{{ $brand }}</span>
                  </button>
                </li>
                @endif
              @endforeach
            </ul>
          </details>
        </section>
        @endif

        {{-- EMERGENCY --}}
        @if($emerByBrand->isNotEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-4">
          <div class="text-[11px] font-semibold tracking-[0.2em] text-slate-500 mb-2 uppercase">EMERGENCY</div>
          <details class="border border-slate-200 rounded-2xl p-3 group" open>
            <summary class="cursor-pointer font-semibold text-base flex justify-between items-center select-none">
              <span>ไฟฉุกเฉินและป้ายหนีไฟ</span>
              <i class="bi bi-chevron-down ml-2 text-slate-500 transition-transform duration-200 group-open:rotate-180"></i>
            </summary>
            <ul class="mt-3 grid grid-cols-2 gap-3 text-sm">
              @foreach($emerByBrand as $brand => $items)
                @php $file = $items->first(); @endphp
                @if(!empty($file->pdf))
                  @php $extra = strtolower($brand) === 'sunny' ? 'col-span-2 ' : ''; @endphp
                  <li class="{{ $extra }}min-w-0">
                    <button type="button" class="{{ $chipBox }}"
                            data-pdf="{{ asset('storage/'.$file->pdf) }}"
                            onclick="handlePdfClick(this)"
                            title="{{ $brand }}">
                      <span class="truncate">{{ $brand }}</span>
                    </button>
                  </li>
                @endif
              @endforeach
            </ul>
          </details>
        </section>
        @endif

        {{-- BATTERY --}}
        @if($batteryByBrand->isNotEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-4">
          <div class="text-[11px] font-semibold tracking-[0.2em] text-slate-500 mb-2 uppercase">BATTERY</div>
          <details class="border border-slate-200 rounded-2xl p-3 group" open>
            <summary class="cursor-pointer font-semibold text-base flex justify-between items-center select-none">
              <span>แบตเตอรี่</span>
              <i class="bi bi-chevron-down ml-2 text-slate-500 transition-transform duration-200 group-open:rotate-180"></i>
            </summary>

            <div class="mt-3 space-y-3 text-sm">
              @foreach($batteryByBrand as $brand => $items)
              <details class="border border-slate-200 rounded-xl p-3 group" open>
                <summary class="cursor-pointer font-semibold flex justify-between items-center select-none">
                  <span>{{ $brand }} Battery</span>
                  <i class="bi bi-chevron-down text-slate-500 transition-transform duration-200 group-open:rotate-180"></i>
                </summary>
                <ul class="mt-2 grid grid-cols-1 gap-3">
                  @foreach($items as $item)
                    @if(!empty($item->pdf))
                    <li class="min-w-0">
                      <button type="button"
                              class="{{ $chipBox }} justify-start text-left"
                              data-pdf="{{ asset('storage/'.$item->pdf) }}"
                              onclick="handlePdfClick(this)"
                              title="{{ $item->name_brochure }}">
                        <span class="leading-snug">{{ $item->name_brochure }}</span>
                      </button>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </details>
              @endforeach
            </div>
          </details>
        </section>
        @endif

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
        const raw = page.getViewport({ scale: 1 });
        const isLandscape = raw.width > raw.height;

        const wrap = document.createElement('div');
        wrap.className = 'a4-page';
        const fit = document.createElement('div');
        fit.className = 'a4-fit';
        wrap.appendChild(fit);
        container.appendChild(wrap);

        const rect = fit.getBoundingClientRect();
        const cssW = rect.width || 794;
        const cssH = rect.height || 1123;

        const rotation = isLandscape ? 90 : 0;
        const baseW = isLandscape ? raw.height : raw.width;
        const baseH = isLandscape ? raw.width  : raw.height;

        const dpr = Math.min(window.devicePixelRatio || 1, DPR_LIMIT);
        const scale = Math.min((cssW * dpr) / baseW, (cssH * dpr) / baseH);

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

      // เรียกจากปุ่มด้านซ้าย
      window.handlePdfClick = function(btn){
        const pdfPath  = btn.dataset.pdf;
        if (!pdfPath) return;
        showPDF(pdfPath);
      };

      // โหลด PDF
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
          await renderOnePage(pdf, 1);

          let n = 2;
          (function step(){
            if(n > pdf.numPages) return;
            renderOnePage(pdf, n++).then(()=>requestAnimationFrame(step));
          })();
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

      // โหลดเริ่มต้น (ไฟล์แรกจาก DB ถ้ามี)
      document.addEventListener("DOMContentLoaded", function(){
        @if($firstWithPdf)
          showPDF(@json($defaultPdfPath));
        @else
          container.innerHTML = `
            <div class="flex flex-col items-center justify-center my-10 text-slate-500 text-sm">
              ยังไม่มีไฟล์ PDF ให้แสดง
            </div>
          `;
        @endif
      });
    })();
  </script>
</body>
</html>
