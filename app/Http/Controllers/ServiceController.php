<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        // ดึง service ทั้งหมดมาแสดง
        $services = Service::all();

        return view('Service', compact('services'));
    }

    // ใช้เสิร์ฟไฟล์ PDF จาก storage/app/public/brochures
    public function showPdf($file)
    {
        // สมมติว่าชื่อไฟล์ใน DB เป็นแค่ test-001.pdf
        // ถ้าใน DB เก็บว่า brochures/test-001.pdf ให้ปรับตามด้านล่างคอมเมนต์
        $path = 'brochures/'.$file;

        // ถ้าในคอลัมน์ pdf เป็น 'brochures/test-001.pdf' อยู่แล้ว
        // $path = $file;

        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $fullPath = Storage::disk('public')->path($path);

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
