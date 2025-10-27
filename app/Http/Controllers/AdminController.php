<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        // ตรวจสอบ session ว่ามีการล็อกอินเป็น admin หรือไม่
        if ($request->session()->get('user') === 'admin' &&
            $request->session()->get('password') === 'admin') {

            $tab = $request->get('tab', 'dashboard');
            $brochure = null;
            $searchbrochure = $request->get('searchbrochure', '');
            $search = ''; 
            if ($tab === 'brochure') {
                $brochure = Service::when($searchbrochure, function ($query, $searchbrochure) {
                    return $query->where('brand', 'like', "%{$searchbrochure}%");
                })->paginate(30);
            }
            return view('admin.AdminDashboard', compact('brochure', 'tab', 'search', 'searchbrochure'));
        }

        return redirect('/admin/login');
    }

    public function showLogin()
    {
        return view("admin.AdminLogin");
    }

    public function doLogin(Request $request)
    {
        // ตรวจสอบค่าที่ส่งมาจากฟอร์ม login
        $user = $request->input('user');
        $password = $request->input('password');

        if ($user === 'admin' && $password === 'admin') {
            // เก็บค่า session
            $request->session()->put('user', $user);
            $request->session()->put('password', $password);

            return redirect('/admin');
        }

        return back()->with('error', 'รหัสผิดพลาดโปรดลองอีกครั่ง');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
    public function deletebrochure($id_service)
    {
        $item = Service::findOrFail($id_service);
        if ($item->pdf && Storage::disk('public')->exists($item->pdf)) {
            Storage::disk('public')->delete($item->pdf);
        }

        // ลบ record ใน database
        $item->delete();

        return response()->json(['success' => true]);
    }

public function addbrochures(Request $request)
{
    // Validate input
    $request->validate([
        'brand'         => 'required|string|max:255',
        'name_brochure' => 'required|string|max:255',
        'category'      => 'required|string|max:255',
        'pdf'           => 'required|file|mimes:pdf|max:100240',
    ]);

    $brand = $request->brand;
    $name_brochure = $request->name_brochure;

    // หา service ของ brand นี้ล่าสุด เพื่อกำหนดเลขต่อท้าย
    $lastService = Service::where('brand', $brand)
        ->orderBy('id_service', 'desc')
        ->first();

    if ($lastService) {
        // ดึงเลขท้าย id_service และ +1
        $lastNumber = (int)substr($lastService->id_service, strlen($brand) + 1);
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newNumber = '001';
    }

    $id_service = $brand . '-' . $newNumber;

    // อัปโหลดไฟล์ PDF และเปลี่ยนชื่อเป็น id_service.pdf
    $pdfFile = $request->file('pdf');
    $pdfName = $id_service . '.pdf'; // ตั้งชื่อไฟล์เป็น id_service.pdf
    $pdfPath = $pdfFile->storeAs('brochures', $pdfName, 'public');

    // สร้าง service ใหม่
    $service = Service::create([
        'id_service'     => $id_service,
        'name_brochure'  => $name_brochure,
        'brand'          => $brand,
        'category'       => $request->category,
        'pdf'            => $pdfPath,
    ]);

    return redirect()->back()->with('success', 'เพิ่มข้อมูล brochure เรียบร้อยแล้ว');
}

}
