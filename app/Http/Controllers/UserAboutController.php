<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use Illuminate\Http\Request;

class UserAboutController extends Controller
{
    public function index()
    {
        $apotek = Apotek::first();
        
        // Jika belum ada data, redirect ke home atau buat default
        if (!$apotek) {
            $apotek = new Apotek([
                'nama_apotek' => 'Apotek Sehat',
                'alamat' => 'Jl. Kesehatan No. 123',
                'telepon' => '021-1234567',
                'email' => 'info@apotek.com',
            ]);
        }

        return view('user.about', compact('apotek'));
    }
}