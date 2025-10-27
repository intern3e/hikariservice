<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; 


class HomeController extends Controller  
{
    public function home(Request $request)
    {
        $categories = [
            'UPS เครื่องสำรองไฟ',
            'แบตเตอรี่',
            'ไฟฉุกเฉิน และ ป้ายหนีไฟ',
            'ระบบแจ้งเหตุเพลิงไหม้'
        ];

        $services = Service::whereIn('category', $categories)
            ->get()
            ->groupBy('category')          
            ->map(function($items) {
                return $items->groupBy('brand'); 
            });

        return view('home', [
            'categories' => $categories,
            'services'   => $services,
        ]);
    }
}
