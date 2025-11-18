<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApotekSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('apoteks')->insert([
            'nama_apotek' => 'Apotek Sehat Sejahtera',
            'alamat' => 'Jl. Kesehatan No. 123, Medan, Sumatera Utara',
            'telepon' => '061-1234567',
            'email' => 'info@apoteksehat.com',
            'sejarah' => 'Apotek Sehat Sejahtera didirikan pada tahun 2020 dengan tujuan memberikan pelayanan kesehatan terbaik bagi masyarakat.',
            'visi' => 'Menjadi apotek terpercaya dan terdepan dalam memberikan pelayanan kesehatan yang berkualitas.',
            'misi' => "1. Menyediakan obat-obatan berkualitas dengan harga terjangkau\n2. Memberikan konsultasi kesehatan yang profesional\n3. Melayani dengan sepenuh hati dan ramah",
            'layanan' => "- Penjualan Obat Resep dan Bebas\n- Konsultasi Apoteker\n- Pemeriksaan Kesehatan\n- Delivery Order",
            'jam_operasional' => "Senin - Jumat: 08.00 - 21.00 WIB\nSabtu: 08.00 - 20.00 WIB\nMinggu & Hari Libur: 09.00 - 18.00 WIB",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}