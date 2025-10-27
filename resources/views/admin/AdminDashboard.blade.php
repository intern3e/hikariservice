<!DOCTYPE html>
<html lang="th">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | PowerCare</title>

  <meta name="description" content="PowerCare by Hikari — ผู้เชี่ยวชาญระบบไฟสำรอง แบตเตอรี่ และไฟฉุกเฉิน ครบวงจร">
  <meta name="theme-color" content="#0b2a6b">
  <meta property="og:title" content="PowerCare by Hikari">
  <meta property="og:description" content="โซลูชันระบบไฟสำรองและไฟฉุกเฉินแบบครบวงจร โดยทีมงานมืออาชีพ">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="th_TH">
  <link rel="icon" type="image/png" href="{{ asset('storage/logo/PNG.png') }}">
  <link rel="canonical" href="https://www.hikaripower.com/">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <script>window.tailwind = { config: { theme: { extend: {} } } }</script>
  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{ --brand:#0b2a6b; --brand-2:#0a2356; }
    [x-cloak]{ display:none !important; }
    body{ font-family:"Prompt", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans Thai", "Noto Sans", sans-serif; background:#f6f7fb; }
    .nice-scroll::-webkit-scrollbar{ height:10px; width:10px }
    .nice-scroll::-webkit-scrollbar-thumb{ background:#cbd5e1; border-radius:999px }
    .nice-scroll::-webkit-scrollbar-track{ background:transparent }
  </style>

  @php
    $tab = $tab ?? request()->get('tab', 'admin'); // ดีฟอลต์ Welcome
    $tabLabel = $tab === 'edit-product' ? 'Edit Products' : ($tab === 'brochure' ? 'Brochure' : 'Admin');
    $tabIcon  = $tab === 'edit-product' ? 'bi-box-seam' : ($tab === 'brochure' ? 'bi-file-earmark-pdf' : 'bi-gear');

    $products = $products ?? collect();
    $brochure = $brochure ?? collect();

    $hasProductPages  = $products instanceof \Illuminate\Contracts\Pagination\Paginator;
    $hasBrochurePages = $brochure instanceof \Illuminate\Contracts\Pagination\Paginator;
  @endphp

  <script defer>
    const CSRF = (document.querySelector('meta[name="csrf-token"]')||{}).content || '';

    window.adminUI = function(){
      return {
        sidebarOpen:false,
        brochureFormOpen:false,
        toast:{show:false,message:'',type:'ok'},
        showToast(msg, type='ok'){
          this.toast = {show:true,message:msg,type};
          setTimeout(()=> this.toast.show=false, 1800);
        }
      }
    };

    window.rowEditor = function(initial){
      return {
        editing:false,
        original: JSON.parse(JSON.stringify(initial)),
        form: JSON.parse(JSON.stringify(initial)),
        startEdit(){ this.editing = true; },
        cancelEdit(){ this.form = JSON.parse(JSON.stringify(this.original)); this.editing = false; },
        async saveRow(){
          try{
            const payload = {
              model: this.form.model,
              name: this.form.name,
              webpriceTHB: this.form.price,
              discount: this.form.discount,
              size: this.form.size,
              lead_time: this.form.lead_time,
              stock: this.form.stock,
              brand: this.form.brand
            };
            const res = await fetch(`/admin/product/${this.original.id}/update`, {
              method:'POST',
              headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN':CSRF },
              body: JSON.stringify(payload)
            });
            if(!res.ok){ throw new Error(`HTTP ${res.status}`); }
            const data = await res.json();
            if(data.success){
              this.original = JSON.parse(JSON.stringify(this.form));
              this.editing = false;
              if(window.__ui) window.__ui.showToast('อัปเดตเรียบร้อย','ok');
            }else{
              throw new Error(data.message || 'Unknown error');
            }
          }catch(err){
            if(window.__ui) window.__ui.showToast('เกิดข้อผิดพลาดในการบันทึก','err');
            console.error(err);
          }
        }
      }
    };

    window.removeRow = async function(id){
      if(!confirm('คุณแน่ใจว่าต้องการลบสินค้านี้หรือไม่?')) return;
      try{
        const res = await fetch(`/admin/product/${id}/delete`, {
          method:'DELETE',
          headers:{ 'X-CSRF-TOKEN':CSRF }
        });
        const data = await res.json();
        if(data.success){
          const tr = document.getElementById(`row-${id}`);
          if(tr) tr.remove();
          if(window.__ui) window.__ui.showToast('ลบข้อมูลแล้ว','ok');
        }else{
          throw new Error(data.message || 'Unknown error');
        }
      }catch(err){
        if(window.__ui) window.__ui.showToast('ลบไม่สำเร็จ','err');
        console.error(err);
      }
    };

    window.removeBrochure = async function(id){
      if(!confirm('คุณแน่ใจว่าต้องการลบโบชัวนี้หรือไม่?')) return;
      try{
        const res = await fetch(`/admin/brochure/${id}/delete`, {
          method:'DELETE',
          headers:{ 'X-CSRF-TOKEN':CSRF }
        });
        const data = await res.json();
        if(data.success){
          const tr = document.getElementById(`bro-${id}`);
          if(tr) tr.remove();
          if(window.__ui) window.__ui.showToast('ลบโบชัวแล้ว','ok');
        }else{
          throw new Error(data.message || 'Unknown error');
        }
      }catch(err){
        if(window.__ui) window.__ui.showToast('ลบไม่สำเร็จ','err');
        console.error(err);
      }
    };

    // Search: products
    document.addEventListener('DOMContentLoaded', ()=>{
      const input = document.getElementById('searchInput');
      if(!input) return;
      let t=null;
      input.addEventListener('keyup', e=>{
        clearTimeout(t);
        const q = input.value.trim();
        if(e.key==='Enter'){ fetchProducts(q); return; }
        if(q.length>=3 || q.length===0){ t=setTimeout(()=>fetchProducts(q),250); }
      });
      async function fetchProducts(search){
        try{
          const resp = await fetch(`/admin?tab=edit-product&search=${encodeURIComponent(search)}`);
          const html = await resp.text();
          const doc = new DOMParser().parseFromString(html,'text/html');
          const newTbody = doc.querySelector('#productTable tbody');
          const target = document.querySelector('#productTable tbody');
          if(newTbody && target) target.innerHTML = newTbody.innerHTML;
        }catch(err){ console.error(err); }
      }
    });

    // Search: brochure
    document.addEventListener('DOMContentLoaded', ()=>{
      const input = document.getElementById('searchbrochureInput');
      if(!input) return;
      let t=null;
      input.addEventListener('keyup', e=>{
        clearTimeout(t);
        const q = input.value.trim();
        if(e.key==='Enter'){ fetchBrochure(q); return; }
        if(q.length>=1 || q.length===0){ t=setTimeout(()=>fetchBrochure(q),250); }
      });
      async function fetchBrochure(search){
        try{
          const resp = await fetch(`/admin?tab=brochure&searchbrochure=${encodeURIComponent(search)}`);
          const html = await resp.text();
          const doc = new DOMParser().parseFromString(html,'text/html');
          const newTbody = doc.querySelector('#brochureTable tbody');
          const target = document.querySelector('#brochureTable tbody');
          if(newTbody && target) target.innerHTML = newTbody.innerHTML;
        }catch(err){ console.error(err); }
      }
    });
  </script>

  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>
</head>

<body x-data="adminUI()" x-init="window.__ui = $data" class="min-h-screen">

  <!-- Sidebar -->
  <aside class="fixed inset-y-0 left-0 z-40 w-60 bg-[var(--brand)] text-white shadow-xl transform transition-transform duration-200 nice-scroll overflow-y-auto md:translate-x-0"
         :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
    <div class="h-14 flex items-center gap-3 px-4 border-b border-white/15">
      <img src="https://drive.google.com/thumbnail?id=1zBSHzOsaxkFRiemPhZUZHDXm1kgwe3eA&sz=w1000" alt="Logo" class="h-8 w-8 rounded bg-white/90 p-1 shadow-sm">
      <div class="font-semibold tracking-wide">ผู้ดูแล service</div>
    </div>

    <nav class="py-3">
      <a href="/admin?tab=brochure"
         class="group flex items-center gap-3 px-4 py-2.5 {{ $tab==='brochure' ? 'bg-white/10 border-l-4 border-amber-400' : 'border-l-4 border-transparent hover:bg-white/10' }}">
        <i class="bi bi-file-earmark-pdf text-amber-300 group-hover:scale-110 transition"></i>
        <span>Brochure</span>
      </a>
    </nav>

    <div class="mt-auto p-4 text-xs text-white/80">
      <div class="opacity-80">HikariDenki Service admin</div>
      <div class="opacity-60">v1.0</div>
    </div>
  </aside>

  <!-- Topbar -->
  <header class="fixed top-0 right-0 left-0 md:left-60 z-30 h-14 bg-white/90 backdrop-blur border-b border-slate-200/70">
    <div class="h-full px-3 sm:px-4 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <button class="md:hidden inline-flex items-center justify-center h-9 w-9 rounded-md border border-slate-300 text-slate-700"
                @click="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar">
          <i class="bi bi-list text-lg"></i>
        </button>
        <div class="hidden sm:flex items-center gap-2 text-slate-700">
          <i class="bi {{ $tabIcon }}"></i>
          <span class="font-medium">{{ $tabLabel }}</span>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <a href="/" class="px-3 py-1.5 rounded-md border border-slate-300 text-slate-700 hover:bg-slate-50 text-sm">
          <i class="bi bi-house-door"></i> <span class="hidden sm:inline">Home</span>
        </a>
        <a href="/admin/logout" class="px-3 py-1.5 rounded-md bg-rose-500 hover:bg-rose-600 text-white text-sm">
          <i class="bi bi-box-arrow-right"></i> <span class="hidden sm:inline">Logout</span>
        </a>
      </div>
    </div>
  </header>
<br><br>
  <!-- Main -->
  <main class="pt-16 md:ml-60 p-4 sm:p-6 space-y-6">

    @if($tab === 'edit-product')
      <!-- ===== EDIT PRODUCT ===== -->
      <section class="rounded-xl bg-white shadow-sm ring-1 ring-slate-200 p-4 sm:p-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Edit Products</h1>
            <p class="text-slate-500 text-sm">เพิ่ม/แก้ไข/ลบ รายการสินค้า</p>
          </div>

          <form action="{{ route('admin.upload-csv') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-2">
            @csrf
            <input type="file" name="csv_file" accept=".csv"
                   class="block text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-amber-500 file:text-white hover:file:bg-amber-600 file:cursor-pointer"
                   required>
            <button type="submit" class="px-3 py-1.5 rounded-md bg-amber-500 hover:bg-amber-600 text-white text-sm">
              อัปโหลด CSV
            </button>
          </form>
        </div>

        <!-- Search -->
        <div class="mt-4 flex items-center gap-2">
          <div class="relative w-full sm:w-80">
            <i class="bi bi-search absolute left-3 top-2.5 text-slate-400"></i>
            <input id="searchInput" type="text" placeholder="ค้นหาด้วยชื่อสินค้า"
                   class="w-full pl-9 pr-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400">
          </div>
        </div>

        <!-- Table -->
        <div class="mt-4 overflow-auto nice-scroll rounded-lg ring-1 ring-slate-200">
          <table id="productTable" class="min-w-[900px] w-full text-sm">
            <thead class="bg-slate-50 sticky top-0 z-10">
              <tr class="text-slate-700">
                <th class="px-3 py-2 text-left font-semibold">ID</th>
                <th class="px-3 py-2 text-left font-semibold">Model</th>
                <th class="px-3 py-2 text-left font-semibold">Name</th>
                <th class="px-3 py-2 text-left font-semibold">Price (THB)</th>
                <th class="px-3 py-2 text-left font-semibold">Discount</th>
                <th class="px-3 py-2 text-left font-semibold">Size</th>
                <th class="px-3 py-2 text-left font-semibold">Lead Time</th>
                <th class="px-3 py-2 text-left font-semibold">Stock</th>
                <th class="px-3 py-2 text-left font-semibold">Brand</th>
                <th class="px-3 py-2 text-left font-semibold">จัดการข้อมูล</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              @forelse($products as $product)
              <tr id="row-{{ $product->iditem }}"
                  x-data="rowEditor({
                    id: '{{ $product->iditem }}',
                    model: @js($product->model ?? $product->Model ?? ''),
                    name: @js($product->name ?? ''),
                    price: @js($product->webpriceTHB?? $product->Price ),
                    discount: @js($product->discount?? ''),
                    size: @js($product->size ?? ''),
                    lead_time: @js($product->Lead_time_web ?? $product->Lead_time ),
                    stock: @js($product->stock ?? ''),
                    brand: @js($product->brand ?? '')
                  })"
                  class="hover:bg-slate-50">
                <td class="px-3 py-2 text-slate-600">{{ $product->iditem }}</td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.model" class="text-slate-800"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.model" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.name" class="text-slate-800"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.name" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.price"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.price" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.discount"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.discount" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.size"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.size" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.lead_time"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.lead_time" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.stock"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.stock" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <template x-if="!editing"><span x-text="form.brand"></span></template>
                  <template x-if="editing"><input type="text" x-model="form.brand" class="w-full px-2 py-1 rounded border border-slate-300"></template>
                </td>

                <td class="px-3 py-2">
                  <div class="flex flex-wrap gap-2">
                    <template x-if="!editing">
                      <button @click="startEdit()" class="px-2 py-1 rounded bg-sky-500 hover:bg-sky-600 text-white">แก้ไข</button>
                    </template>
                    <template x-if="editing">
                      <button @click="saveRow()" class="px-2 py-1 rounded bg-emerald-500 hover:bg-emerald-600 text-white">Save</button>
                    </template>
                    <template x-if="editing">
                      <button @click="cancelEdit()" class="px-2 py-1 rounded bg-slate-400 hover:bg-slate-500 text-white">Cancel</button>
                    </template>
                    <button @click="window.removeRow('{{ $product->iditem }}')" class="px-2 py-1 rounded bg-rose-500 hover:bg-rose-600 text-white">ลบ</button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="10" class="px-3 py-6 text-center text-slate-500">ไม่มีรายการสินค้า</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($hasProductPages)
          <div class="mt-3">
            {{ $products->appends(request()->query())->links() }}
          </div>
        @endif
      </section>

    @elseif($tab === 'brochure')
      <!-- ===== BROCHURE ===== -->
      <section class="rounded-xl bg-white shadow-sm ring-1 ring-slate-200 p-4 sm:p-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Edit Brochure</h1>
            <p class="text-slate-500 text-sm">เพิ่ม/แก้ไข/ลบ โบชัว PDF</p>
          </div>

          <button type="button" @click="brochureFormOpen = !brochureFormOpen"
                  class="px-3 py-1.5 rounded-md bg-emerald-500 hover:bg-emerald-600 text-white text-sm">
            <i class="bi bi-plus-lg"></i> เพิ่มข้อมูล
          </button>
        </div>

        <form id="addForm" x-cloak x-show="brochureFormOpen"
              action="{{ route('service.addbrochures') }}" method="POST" enctype="multipart/form-data"
              class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 rounded-lg border border-slate-200 p-4">
          @csrf
          <div>
            <label class="block text-sm text-slate-600 mb-1">Brand</label>
            <input type="text" name="brand" class="w-full px-3 py-2 rounded-md border border-slate-300" required>
          </div>
          <div>
            <label class="block text-sm text-slate-600 mb-1">ชื่อ</label>
            <input type="text" name="name_brochure" class="w-full px-3 py-2 rounded-md border border-slate-300" required>
          </div>
          <div>
            <label class="block text-sm text-slate-600 mb-1">Category</label>
            <select name="category" id="category" class="w-full px-3 py-2 rounded-md border border-slate-300" required>
              <option value="">-- เลือก Category --</option>
              <option value="UPS เครื่องสำรองไฟ">UPS เครื่องสำรองไฟ</option>
              <option value="แบตเตอรี่">แบตเตอรี่</option>
              <option value="ไฟฉุกเฉิน และ ป้ายหนีไฟ">ไฟฉุกเฉิน และ ป้ายหนีไฟ</option>
              <option value="ระบบแจ้งเหตุเพลิงไหม้">ระบบแจ้งเหตุเพลิงไหม้</option>
            </select>
          </div>
          <div>
            <label class="block text-sm text-slate-600 mb-1">PDF</label>
            <input type="file" name="pdf" accept="application/pdf"
                   class="block w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-amber-500 file:text-white hover:file:bg-amber-600 file:cursor-pointer"
                   required>
          </div>
          <div class="md:col-span-2 flex gap-2">
            <button type="submit" class="px-3 py-1.5 rounded-md bg-amber-500 hover:bg-amber-600 text-white text-sm">บันทึก</button>
            <button type="button" @click="brochureFormOpen=false" class="px-3 py-1.5 rounded-md border border-slate-300 text-slate-700 text-sm">ยกเลิก</button>
          </div>
        </form>

        <div class="mt-4 relative w-full sm:w-80">
          <i class="bi bi-search absolute left-3 top-2.5 text-slate-400"></i>
          <input id="searchbrochureInput" type="text" placeholder="ค้นหาด้วยยี่ห้อ"
                 class="w-full pl-9 pr-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400">
        </div>

        <div class="mt-4 overflow-auto nice-scroll rounded-lg ring-1 ring-slate-200">
          <table id="brochureTable" class="min-w-[720px] w-full text-sm">
            <thead class="bg-slate-50 sticky top-0 z-10">
              <tr class="text-slate-700">
                <th class="px-3 py-2 text-left font-semibold">ID</th>
                <th class="px-3 py-2 text-left font-semibold">Name</th>
                <th class="px-3 py-2 text-left font-semibold">Brand</th>
                <th class="px-3 py-2 text-left font-semibold">Category</th>
                <th class="px-3 py-2 text-left font-semibold">PDF</th>
                <th class="px-3 py-2 text-left font-semibold">จัดการข้อมูล</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              @forelse($brochure as $item)
              <tr id="bro-{{ $item->id_service }}">
                <td class="px-3 py-2 text-slate-600">{{ $item->id_service }}</td>
                <td class="px-3 py-2 text-slate-800">{{ $item->name_brochure }}</td>
                <td class="px-3 py-2">{{ $item->brand }}</td>
                <td class="px-3 py-2">{{ $item->category }}</td>
                <td class="px-3 py-2">
                  <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank" class="text-sky-600 hover:underline">
                    เปิด PDF <i class="bi bi-box-arrow-up-right"></i>
                  </a>
                </td>
                <td class="px-3 py-2">
                  <button @click="window.removeBrochure('{{ $item->id_service }}')"
                          class="px-2 py-1 rounded bg-rose-500 hover:bg-rose-600 text-white">ลบ</button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="px-3 py-6 text-center text-slate-500">ไม่มีรายการโบชัวร์</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($hasBrochurePages)
          <div class="mt-3">
            {{ $brochure->appends(request()->query())->links() }}
          </div>
        @endif
      </section>

    @else
      <!-- ===== WELCOME / DASHBOARD ===== -->
      <section class="space-y-4">
        <div class="relative overflow-hidden rounded-2xl p-8 sm:p-10 text-white
                    bg-gradient-to-br from-[#0a2356] via-[#0b2a6b] to-[#0f4c75]">
          <div class="pointer-events-none absolute inset-0 opacity-20"
               style="background:
                 radial-gradient(900px 280px at 15% -10%, rgba(255,255,255,.35), rgba(255,255,255,0)),
                 radial-gradient(700px 240px at 85% 110%, rgba(255,255,255,.22), rgba(255,255,255,0));"></div>

          <div class="relative">
            <div class="inline-flex items-center gap-2 px-2 py-1 rounded-full text-xs font-semibold
                        bg-white/15 ring-1 ring-white/25 mb-3">
              <i class="bi bi-shield-lock"></i> Admin Area
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold leading-tight">
              ยินดีต้อนรับสู่ <span class="text-amber-300">HikariDenki Service Admin</span>
            </h1>
            <p class="mt-2 text-white/90 max-w-3xl">
              ศูนย์ควบคุมสำหรับจัดการสินค้า อัปโหลดโบชัวร์ และดูแลข้อมูลเว็บไซต์ทั้งหมดของ HikariDenki Service Admin
              เลือกเมนูทางซ้ายเพื่อเริ่มงานได้ทันที หรือใช้ปุ่มลัดด้านล่าง
            </p>

            <div class="mt-5 flex flex-wrap gap-2">
              <a href="/admin?tab=brochure"
                 class="inline-flex items-center gap-2 px-4 py-2 rounded-md font-semibold
                        bg-amber-400 text-slate-900 hover:bg-amber-500 shadow">
                <i class="bi bi-box-seam"></i> ไปที่ Brochure
              </a>
            </div>
          </div>
        </div>

        @php
          $brochureCount = method_exists($brochure ?? null, 'total') ? $brochure->total() : (is_countable($brochure ?? []) ? count($brochure) : 0);
        @endphp
      </section>
    @endif

  </main>

  <div id="toast" x-cloak x-show="toast.show" x-transition
       class="fixed top-16 right-4 z-[60] max-w-sm px-4 py-3 rounded-lg shadow-lg"
       :class="toast.type==='ok' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white'">
    <div class="flex items-start gap-2">
      <i class="bi" :class="toast.type==='ok' ? 'bi-check-circle' : 'bi-exclamation-triangle'"></i>
      <div class="font-medium" x-text="toast.message"></div>
    </div>
  </div>

</body>
</html>
