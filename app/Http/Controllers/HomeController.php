<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $mobilTersedia = Kendaraan::where('status', 'Tersedia')->get();
        
        return view('welcome', compact('mobilTersedia'));
    }
}